jQuery(document).ready(function ($) {
  console.log("admin");
  // Mobile image upload
  $("#mobile_image_upload").on("click", function (e) {
    e.preventDefault();

    var image_frame;

    if (image_frame) {
      image_frame.open();
      return;
    }

    image_frame = wp.media({
      title: "Select Mobile Banner Image",
      multiple: false,
      library: {
        type: "image",
      },
    });

    image_frame.on("select", function () {
      var attachment = image_frame.state().get("selection").first().toJSON();
      $("#mobile_banner_image_id").val(attachment.id);
      $(".mobile-image-preview").html(
        '<img src=\"' +
          attachment.url +
          '\" style=\"max-width: 100%; height: auto;\">'
      );
      $("#mobile_image_upload").text("Change Mobile Banner");

      if ($("#mobile_image_remove").length === 0) {
        $(".mobile-image-container").append(
          '<button type=\"button\" class=\"button mobile-image-remove\" id=\"mobile_image_remove\">Remove Mobile Banner</button>'
        );
      }
    });

    image_frame.open();
  });

  // Mobile image remove
  $(document).on("click", "#mobile_image_remove", function (e) {
    e.preventDefault();
    $("#mobile_banner_image_id").val("");
    $(".mobile-image-preview").html("");
    $("#mobile_image_upload").text("Upload Mobile Banner");
    $(this).remove();
  });
});

jQuery(document).ready(function ($) {
  // Handle notice dismissal
  $(document).on(
    "click",
    ".notice.is-dismissible .notice-dismiss",
    function (e) {
      e.preventDefault();

      var $notice = $(this).closest(".notice");
      var noticeId = $notice.data("notice-id");

      if (!noticeId) {
        console.error("No notice ID found");
        return;
      }

      var data = {
        action: "dismiss_admin_notice",
        notice_id: noticeId,
        _wpnonce: themeAdminNotices.nonce,
      };

      // Log request for debugging
      console.log("Sending dismiss request:", data);

      $.ajax({
        url: themeAdminNotices.ajaxUrl,
        type: "POST",
        data: data,
        success: function (response) {
          console.log("Dismiss response:", response);
          if (response.success) {
            $notice.fadeOut(300, function () {
              $(this).remove();
            });
          } else {
            console.error(
              "Failed to dismiss notice: " +
                (response.data || "No error message")
            );
          }
        },
        error: function (xhr, status, error) {
          console.error("AJAX error: " + error, xhr.responseText);
        },
      });
    }
  );
});
