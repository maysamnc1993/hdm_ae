document.addEventListener("DOMContentLoaded", function () {
  // Get the sticky header height (adjust selector to match your theme's header)
  const header = document.querySelector("header.sticky, .sticky-header"); // Replace with your header's selector
  const headerHeight = header ? header.offsetHeight : 0;

  // Smooth scroll with offset for TOC links
  const tocLinks = document.querySelectorAll(".toc-link");
  tocLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const targetId = this.getAttribute("href").substring(1);
      const targetElement = document.getElementById(targetId);
      if (targetElement) {
        const offsetTop =
          targetElement.getBoundingClientRect().top +
          window.pageYOffset -
          headerHeight -
          20; // Extra 20px for padding
        window.scrollTo({
          top: offsetTop,
          behavior: "smooth",
        });
      }
    });
  });

  // Highlight active TOC item on scroll
  const sections = document.querySelectorAll("h2[id], h3[id]");
  const observerOptions = {
    root: null,
    rootMargin: `-${headerHeight}px 0px 0px 0px`, // Adjust for header height
    threshold: 0.1, // Trigger when 10% of section is visible
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      const id = entry.target.getAttribute("id");
      const tocLink = document.querySelector(`.toc-link[href="#${id}"]`);
      if (entry.isIntersecting) {
        tocLinks.forEach((link) =>
          link
            .querySelector(".line-link-el")
            .classList.remove("line-link-el-active")
        );
        if (tocLink) {
          tocLink
            .querySelector(".line-link-el")
            .classList.add("line-link-el-active");
        }
      }
    });
  }, observerOptions);

  sections.forEach((section) => observer.observe(section));

  // Cleanup observer on page unload
  window.addEventListener("unload", () => {
    sections.forEach((section) => observer.unobserve(section));
  });
});

document.addEventListener("DOMContentLoaded", function () {
  // Existing TOC code...
  const header = document.querySelector("header.sticky, .sticky-header");
  const headerHeight = header ? header.offsetHeight : 0;

  const tocLinks = document.querySelectorAll(".toc-link");
  tocLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const targetId = this.getAttribute("href").substring(1);
      const targetElement = document.getElementById(targetId);
      if (targetElement) {
        const offsetTop =
          targetElement.getBoundingClientRect().top +
          window.pageYOffset -
          headerHeight -
          20;
        window.scrollTo({
          top: offsetTop,
          behavior: "smooth",
        });
      }
    });
  });

  const sections = document.querySelectorAll("h2[id], h3[id]");
  const observerOptions = {
    root: null,
    rootMargin: `-${headerHeight}px 0px 0px 0px`,
    threshold: 0.1,
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      const id = entry.target.getAttribute("id");
      const tocLink = document.querySelector(`.toc-link[href="#${id}"]`);
      if (entry.isIntersecting) {
        tocLinks.forEach((link) =>
          link
            .querySelector(".line-link-el")
            .classList.remove("line-link-el-active")
        );
        if (tocLink) {
          tocLink
            .querySelector(".line-link-el")
            .classList.add("line-link-el-active");
        }
      }
    });
  }, observerOptions);

  sections.forEach((section) => observer.observe(section));

  window.addEventListener("unload", () => {
    sections.forEach((section) => observer.unobserve(section));
  });

  // Custom Alert Function
  function showCustomAlert(message, type = "success") {
    const alertDiv = document.createElement("div");
    alertDiv.className = `fixed z-[9999] bottom-5 right-5 p-4 rounded-lg shadow-lg z-50 transition-opacity duration-300 opacity-0 ${
      type === "success"
        ? "bg-success-light text-success"
        : "bg-error-light text-error"
    }`;
    alertDiv.textContent = message;
    document.body.appendChild(alertDiv);
    // Fade in
    setTimeout(() => alertDiv.classList.add("opacity-100"), 100);
    // Remove after 5 seconds
    setTimeout(() => {
      alertDiv.classList.remove("opacity-100");
      setTimeout(() => alertDiv.remove(), 300);
    }, 5000);
  }

  // New AJAX Comment Submission
  const commentForm = document.getElementById("tt-post-comment-form");
  if (commentForm) {
    commentForm.addEventListener("submit", function (e) {
      e.preventDefault();
      const formData = new FormData(commentForm);
      const data = Object.fromEntries(formData.entries());
      console.log("Submitting comment data:", data); // Debugging

      wpAjax("submit_comment", data, function (successData, error, response) {
        let dataToUse =
          successData || (response && response.success ? response : null);
        if (dataToUse) {
          console.log("Success response:", dataToUse); // Debugging
          showCustomAlert(
            dataToUse.message || "Operation successful",
            "success"
          );
          if (dataToUse.moderation) {
            // Moderation message handled in alert
          } else if (dataToUse.html) {
            // Append new comment
            const commentsList =
              document.getElementById("comments-list") ||
              document.querySelector(".tt-comments-list ul");
            if (commentsList) {
              commentsList.insertAdjacentHTML("beforeend", dataToUse.html);
              // Scroll to new comment
              const newComment = document.getElementById(
                "comment-" + dataToUse.comment_id
              );
              if (newComment) {
                newComment.scrollIntoView({ behavior: "smooth" });
              }
            }
            // Update comments count if provided
            if (dataToUse.comments_count) {
              const commentsHeader = document.querySelector("#comments h2");
              if (commentsHeader) {
                commentsHeader.textContent =
                  dataToUse.comments_count +
                  (dataToUse.comments_count === 1 ? " Comment" : " Comments");
              }
            }
          }
          // Reset form
          commentForm.reset();
        } else if (error) {
          console.error("Error response:", error); // Debugging
          showCustomAlert(error.message || "An error occurred.", "error");
        } else {
          console.error("Unexpected response:", response);
          showCustomAlert("Unexpected response from server.", "error");
        }
      });
    });
  }
});
