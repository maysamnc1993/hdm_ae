var i = 0;
setInterval(function(){
  i++;
  jQuery(".circle_effect_1").css("transform","rotate("+ i +"deg)");
  // jQuery(".circle_effect_2").css("transform","rotate(-"+ i +"deg)");
},10)



var values = jQuery('.Values').offset().top;
var ScrolledRight = 0;
var lastScrollTop = 0;
jQuery(document).scroll(function(e) {
    var st = jQuery(this).scrollTop();
    var scrolled = jQuery(this).scrollTop();
  console.log(values);
    if(st > values){
        jQuery(".Values .title_box").addClass("active");
    }else{
        jQuery(".Values .title_box").removeClass("active");
    }

});

