jQuery(document).ready(function ($) {
    // Show more functionality
    const $showMoreButton = $("#showMoreCategories");
    const $categoryItems = $(
      ".category-filter-item:not(:nth-child(-n+5)):not(:last-child)"
    );
  
    // Hide extra categories initially
    $categoryItems.hide();
  
    $showMoreButton.on("click", function () {
      const isExpanded = $(this).attr("aria-expanded") === "true";
  
      // Toggle visibility of extra categories
      $categoryItems.toggle(isExpanded ? "none" : "flex");
  
      // Update button text and icon
      const $buttonText = $(this).find("span");
      const $buttonIcon = $(this).find("svg");
  
      $buttonText.text(isExpanded ? "مشاهده بیشتر" : "مشاهده کمتر");
      $buttonIcon.css(
        "transform",
        isExpanded ? "rotate(0deg)" : "rotate(180deg)"
      );
  
      // Update accessibility attribute
      $(this).attr("aria-expanded", isExpanded ? "false" : "true");
    });
  
    // Handle checkbox events for any additional functionality
    $(".category-filter").on("change", function () {
      // You can add filtering logic here
      console.log(this.id + " is " + (this.checked ? "checked" : "unchecked"));
    });
  
    $("#showMoreBtn").click(function () {
      $("#textContainer").toggleClass("expanded");
  
      if ($("#textContainer").hasClass("expanded")) {
        $(this).text("نمایش کمتر");
      } else {
        $(this).text("نمایش بیشتر");
      }
    });
  });