/**
 * AJAX Comment Handling for WordPress
 * Using the WPAjaxHandler system
 */

// Register the comments AJAX action
document.addEventListener("DOMContentLoaded", function () {
  // Check if our AJAX system is loaded
  if (typeof wpAjax === "undefined") {
    console.error(
      "WP AJAX Handler not loaded. Comments will use standard form submission."
    );
    return;
  }
  console.log("comments loaded");
  // Setup reply link functionality
  setupCommentReplyLinks();
});

/**
 * Submit comment via AJAX
 */
window.submitCommentAjax = function (form) {
  console.log("Submitting comment...");
  event.preventDefault(); // Prevent default form submission

  // Show loading state
  const submitButton = form.querySelector("#submit");
  const originalButtonText = submitButton.innerText;
  const statusElement = document.getElementById("comment-status");

  submitButton.innerText = "در حال ارسال...";
  submitButton.disabled = true;
  statusElement.innerText = "در حال ارسال نظر...";
  statusElement.className = "comment-status comment-loading";

  // Get form data
  const formData = {
    comment_post_ID: form.querySelector('[name="comment_post_ID"]').value,
    comment: form.querySelector('[name="comment"]').value,
    comment_parent: form.querySelector('[name="comment_parent"]').value,
    nonce: form.querySelector('[name="nonce"]').value,
  };

  // Add author fields if not logged in
  if (!wpAjaxData.is_user_logged_in) {
    formData.author = form.querySelector('[name="author"]')?.value || "";
    formData.email = form.querySelector('[name="email"]')?.value || "";

    // Add cookies consent if present
    const cookiesConsent = form.querySelector(
      '[name="wp-comment-cookies-consent"]'
    );
    if (cookiesConsent && cookiesConsent.checked) {
      formData["wp-comment-cookies-consent"] = "yes";
    }
  }

  console.log("Form data:", formData);

  // Send AJAX request
  wpAjax("submit_comment", formData, function (response, error, rawResponse) {
    // Reset button state
    submitButton.innerText = originalButtonText;
    submitButton.disabled = false;

    if (error) {
      // Show error message - FIX: Add error message null check
      const errorMessage =
        error && error.message
          ? error.message
          : "خطا در ارسال نظر. لطفاً مجدداً تلاش کنید.";
      statusElement.innerText = errorMessage;
      statusElement.className = "comment-status comment-error";
      console.error("Comment submission error:", error);
      return;
    }

    // Check if response is null or undefined
    if (!response) {
      statusElement.innerText = "خطا در پاسخ سرور. لطفاً مجدداً تلاش کنید.";
      statusElement.className = "comment-status comment-error";
      console.error("Empty response from server");
      return;
    }

    // Extract data from WPAjaxHandler response
    const data = response; // response is the 'data' property from WPAjaxHandler

    // Comment was successful
    statusElement.innerText = data.message || "نظر شما با موفقیت ثبت شد.";
    statusElement.className = "comment-status comment-success";

    // Clear the form
    form.querySelector('[name="comment"]').value = "";
    if (!wpAjaxData.is_user_logged_in) {
      // Don't clear author fields to make it easier for repeated comments
    }

    // Reset comment parent
    form.querySelector('[name="comment_parent"]').value = "0";

    // Cancel reply mode if active
    cancelCommentReply();

    // Add the new comment to the page if appropriate
    if (data.html) {
      if (data.comment_parent > 0) {
        const parentLi = document.getElementById(
          "comment-" + data.comment_parent
        );
        if (parentLi) {
          let ul = parentLi.querySelector("ul.children");
          if (!ul) {
            ul = document.createElement("ul");
            ul.className = "children";
            parentLi.appendChild(ul);
          }
          ul.insertAdjacentHTML("beforeend", data.html);
        } else {
          console.warn(
            "Parent comment not found for ID " + data.comment_parent
          );
        }
      } else {
        const commentList = document.querySelector(".comment-list");
        if (commentList) {
          commentList.insertAdjacentHTML("beforeend", data.html);
        } else {
          const commentsArea = document.querySelector(".comments-area");
          const newCommentList = document.createElement("ul");
          newCommentList.className = "comment-list";
          newCommentList.innerHTML = data.html;
          commentsArea.insertBefore(
            newCommentList,
            document.getElementById("respond")
          );
        }
      }

      // Scroll to the new comment
      if (data.comment_id) {
        const newComment = document.getElementById(
          "comment-" + data.comment_id
        );
        if (newComment) {
          setTimeout(function () {
            newComment.scrollIntoView({ behavior: "smooth", block: "center" });
            newComment.classList.add("highlight-new-comment");
          }, 500);
        }
      }

      // Update comment count
      updateCommentCount(data.comments_count);
    } else if (data.moderation) {
      // Show moderation message
      const responseElement = document.getElementById("comment-ajax-response");
      responseElement.innerHTML =
        '<div class="comment-moderation-message">' +
        "نظر شما ثبت شد و پس از تایید نمایش داده خواهد شد." +
        "</div>";

      setTimeout(function () {
        responseElement.innerHTML = "";
      }, 5000);
    }

    // Clear status after a delay
    setTimeout(function () {
      statusElement.innerText = "";
      statusElement.className = "comment-status";
    }, 3000);
  });

  return false;
};

/**
 * Setup comment reply links to work with AJAX
 */
function setupCommentReplyLinks() {
  const replyLinks = document.querySelectorAll(".comment-reply-link");

  replyLinks.forEach(function (link) {
    link.addEventListener("click", function (e) {
      e.preventDefault();

      const commentId =
        this.getAttribute("data-commentid") ||
        this.getAttribute("href").split("?replytocom=")[1].split("#")[0];

      moveRespondForm(commentId);
    });
  });

  // Setup cancel reply link
  const cancelLink = document.getElementById("cancel-comment-reply-link");
  if (cancelLink) {
    cancelLink.addEventListener("click", function (e) {
      e.preventDefault();
      cancelCommentReply();
    });
  }
}

/**
 * Move the respond form to reply to a specific comment
 */
function moveRespondForm(commentId) {
  const respondForm = document.getElementById("respond");
  const commentParentInput = document.getElementById("comment_parent");
  const cancelReplyContainer = document.getElementById(
    "cancel-comment-reply-container"
  );
  const commentContainer = document.getElementById("comment-" + commentId);

  if (
    respondForm &&
    commentParentInput &&
    commentContainer &&
    cancelReplyContainer
  ) {
    // Set the parent comment ID
    commentParentInput.value = commentId;

    // Move the form
    commentContainer.appendChild(respondForm);

    // Show cancel link
    cancelReplyContainer.style.display = "inline-block";

    // Change title
    const replyTitle = document.querySelector(".comment-reply-title");
    if (replyTitle) {
      replyTitle.innerHTML =
        "پاسخ به نظر" +
        ' <small id="cancel-comment-reply-container">' +
        '<a id="cancel-comment-reply-link" href="#respond">لغو پاسخ</a>' +
        "</small>";
    }

    // Setup cancel link again (Consider moving this outside the conditional for clarity)
    const cancelReplyLink = document.getElementById(
      "cancel-comment-reply-link"
    );
    if (cancelReplyLink) {
      cancelReplyLink.addEventListener("click", function (e) {
        e.preventDefault();
        cancelCommentReply();
      });
    }

    // Scroll to form
    respondForm.scrollIntoView({ behavior: "smooth", block: "center" });

    // Focus on the textarea
    setTimeout(function () {
      document.getElementById("comment").focus();
    }, 500);
  }
}

/**
 * Cancel comment reply - move the form back to original position
 */
function cancelCommentReply() {
  const respondForm = document.getElementById("respond");
  const commentParentInput = document.getElementById("comment_parent");
  const commentsArea = document.querySelector(".comments-area");
  const cancelReplyContainer = document.getElementById(
    "cancel-comment-reply-container"
  );

  if (respondForm && commentParentInput && commentsArea) {
    // Reset the parent comment ID
    commentParentInput.value = "0";

    // Get the target element to insert the form before
    const formTarget = document.getElementById("comment-ajax-response");

    // Improved check: Ensure that formTarget exists within commentsArea
    if (formTarget && commentsArea.contains(formTarget)) {
      commentsArea.insertBefore(respondForm, formTarget);
    } else {
      console.warn(
        "comment-ajax-response missing or not a child of commentsArea. Appending form."
      );
      commentsArea.appendChild(respondForm); // Fallback to appending the form to the end
    }

    // Hide cancel link
    if (cancelReplyContainer) {
      cancelReplyContainer.style.display = "none";
    }

    // Reset title
    const replyTitle = document.querySelector(".comment-reply-title");
    if (replyTitle) {
      replyTitle.innerHTML =
        "نظر خود را ثبت کنید." +
        ' <small id="cancel-comment-reply-container" style="">' +
        '<a id="cancel-comment-reply-link" href="#respond">لغو پاسخ</a>' +
        "</small>";
    }
  }
}

/**
 * Update the comment count in the title
 */
function updateCommentCount(count) {
  const titleElement = document.getElementById("comments-section-title");
  if (titleElement) {
    titleElement.innerText = "نظرات کاربران (" + count + ")";
  }
}
