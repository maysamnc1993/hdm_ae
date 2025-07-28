jQuery(document).ready(function ($) {
  $(".faq__item__body").hide(); 

  $(".faq__item__head").click(function (e) {
    e.preventDefault();

    var $trigger = $(this);
    var $content = $trigger.siblings(".faq__item__body");
    var isActive = $trigger.hasClass("active");

    
    
    $('.faq__item__head.active').not($trigger).removeClass('active').siblings('.faq__item__body').slideUp({
        duration: 300,
        easing: 'swing'
    });
  

    if (isActive) {
      
      $content.slideUp({
        duration: 300, 
        easing: 'swing', 
        complete: function () {
          $trigger.removeClass("active");
        },
      });
    } else {

      $trigger.addClass("active");
      $content.slideDown({
        duration: 300,
        easing: 'swing',
      });
    }
  });
});