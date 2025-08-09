var i = 0;
setInterval(function(){
  i++;
  jQuery(".circle_effect_1").css("transform","rotate("+ i +"deg)");
  // jQuery(".circle_effect_2").css("transform","rotate(-"+ i +"deg)");
},10)





jQuery(document).ready(function () {
  var $dashboard = jQuery(".ListOfValue");

  jQuery(window).on("scroll", function () {
      var sectionOffset = jQuery(".section-creative").offset().top;
      var scrollTop = jQuery(window).scrollTop();
      var distance = scrollTop - sectionOffset;

      if (distance < 0) return;

      var maxScroll = 300;
      var progress = Math.min(distance / maxScroll, 1);
      var rotateX = 35 * (1 - progress);
      var opacity = 1 + 0.5 * progress;

      jQuery(".ListOfValue").css({
          "transform": "perspective(1200px) rotateX(" + rotateX + "deg) rotateY(0)",
      });
    

     
  });

});

var ListOfValue = Number(jQuery(".ListOfValue").offset().top) - Number(400);
var title = Number(jQuery(".value_section .title_box").offset().top) - Number(100);
var ScrolledRight = 0;
jQuery(document).scroll(function(e) {
    var st = jQuery(this).scrollTop();
    var scrolled = jQuery(this).scrollTop();

    if(st > ListOfValue){
        jQuery(".ListOfValue").addClass("active");
    }else{
        jQuery(".ListOfValue").removeClass("active");
    }
    if(st > title){
      jQuery(".value_section .title_box").addClass("active");
    }else{
        jQuery(".value_section .title_box").removeClass("active");
    }

});