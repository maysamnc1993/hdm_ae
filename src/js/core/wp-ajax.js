/**
 * Ultra-Simple WP AJAX JavaScript Client
 * Enhanced with better error handling
 *
 * @version 2.1
 */

// Main AJAX function - with improved error handling
function wpAjax(action, data = {}, callback = null) {
  // Verify action is registered
  if (wpAjaxData.actions && !wpAjaxData.actions.includes(action)) {
    console.warn(
      `WP AJAX Warning: Action '${action}' is not registered on the server.`
    );
  }

  // Check if user is logged in when needed
  if (!wpAjaxData.is_user_logged_in) {
    console.info(
      `WP AJAX Info: User is not logged in while calling '${action}'.`
    );
  }

  // Prepare the data
  const requestData = {
    action: action,
    nonce: wpAjaxData.nonce,
    ...data,
  };

  // Send the request
  jQuery.ajax({
    url: wpAjaxData.url,
    type: "POST",
    data: requestData,
    dataType: "json",
    success: function (response) {
      // Handle WP format response
      if (response) {
        if (response.success === true) {
          if (callback) {
            callback(response.data || {}, null, response);
          }
        } else {
          // Format error message
          const errorMessage =
            response.data && response.data.message
              ? response.data.message
              : "Unknown error occurred";

          const errorCode =
            response.data && response.data.code
              ? response.data.code
              : "unknown_error";

          const errorObj = {
            message: errorMessage,
            code: errorCode,
            data:
              response.data && response.data.data ? response.data.data : null,
          };

          console.error(`WP AJAX Error (${action}): ${errorMessage}`, errorObj);

          if (callback) {
            callback(null, errorObj, response);
          }
        }
      } else {
        const errorObj = {
          message: "Invalid server response",
          code: "invalid_response",
        };

        console.error(`WP AJAX Error (${action}): Invalid server response`);

        if (callback) {
          callback(null, errorObj, response);
        }
      }
    },
    error: function (xhr, status, error) {
      console.error('AJAX Error:', xhr.status, xhr.statusText);
      console.error('Response Text:', xhr.responseText); // Log the raw response
      let errorMessage = "Request failed";
      let errorCode = "request_failed";
      if (xhr.responseText) {
        try {
          const responseData = JSON.parse(xhr.responseText);
          if (responseData && responseData.message) {
            errorMessage = responseData.message;
            errorCode = responseData.code || errorCode;
          }
        } catch (e) {
          errorMessage = xhr.statusText; // Fallback if not JSON
        }
      }
      const errorObj = {
        message: errorMessage,
        code: errorCode,
        status: xhr.status,
        statusText: xhr.statusText,
        originalError: error
      };
      console.error(`WP AJAX Error (${action}): ${errorMessage}`, errorObj);
      if (callback) {
        callback(null, errorObj, null);
      }
    }
  });
}

// Shorthand for simple GET requests
function wpAjaxGet(action, callback = null) {
  wpAjax(action, {}, callback);
}

// Shorthand for form submission
function wpAjaxForm(formElement, action, callback = null) {
  const $form = jQuery(formElement);
  const formData = {};

  // Convert form to object
  $form.serializeArray().forEach(function (item) {
    formData[item.name] = item.value;
  });

  // Send the request
  wpAjax(action, formData, callback);

  // Prevent default form submission
  return false;
}
