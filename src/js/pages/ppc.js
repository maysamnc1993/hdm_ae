var i = 0;
setInterval(function(){
  i++;
  jQuery(".circle_effect_1").css("transform","rotate("+ i +"deg)");
  // jQuery(".circle_effect_2").css("transform","rotate(-"+ i +"deg)");
},10)