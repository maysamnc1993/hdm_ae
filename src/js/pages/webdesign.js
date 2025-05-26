jQuery(document).ready(function () {
    var $dashboard = jQuery(".dashboard video");
    var isPlaying = false;

    jQuery(window).on("scroll", function () {
        var sectionOffset = jQuery(".section-creative").offset().top;
        var scrollTop = jQuery(window).scrollTop();
        var distance = scrollTop - sectionOffset;

        if (distance < 0) return;

        var maxScroll = 300;
        var progress = Math.min(distance / maxScroll, 1);
        var rotateX = 35 * (1 - progress);
        var opacity = 1 + 0.5 * progress;

        jQuery(".dashboard").css({
            "transform": "perspective(1200px) rotateX(" + rotateX + "deg) rotateY(0)",
            "opacity": opacity
        });

        // کنترل پخش ویدیو و کلاس active
        if (rotateX <= 1 && !isPlaying) {
            $dashboard.get(0).play();
            $dashboard.addClass("active");
            isPlaying = true;
        } else if (rotateX > 5 && isPlaying) {
            $dashboard.get(0).pause();
            $dashboard.removeClass("active");
            isPlaying = false;
        }
    });

});


// document.addEventListener("DOMContentLoaded", () => {
//     const steps = document.querySelectorAll(".whyChooseUS-list li");
//     const container = document.querySelector(".WhyChooseUS");
//     const totalSteps = steps.length;
//     const sectionHeight = container.offsetHeight;
  
//     window.addEventListener("scroll", () => {
//       const scrollY = window.scrollY;
//       const containerTop = container.offsetTop;
//       const relativeScroll = scrollY - containerTop;
  
//       // فقط وقتی 100vh پایین‌تر از ابتدای سکشن بود اجرا کن
//       if (scrollY >= containerTop - window.innerHeight && relativeScroll < sectionHeight) {
//         const index = Math.min(
//           totalSteps - 1,
//           Math.floor((relativeScroll / sectionHeight) * totalSteps)
//         );
  
//         steps.forEach((step, i) => {
//           step.classList.remove("previous", "active", "next");
//           step.style.transform = "";
  
//           if (i === index) {
//             step.classList.add("active");
//             step.style.transform =
//               i % 2 === 0
//                 ? "translate(-50%, -50%) scale(1) rotate(0deg)"
//                 : "translate(-50%, -50%) scale(1) rotate(0deg)";
//           } else if (i < index) {
//             step.classList.add("previous");
//             step.style.transform =
//               i % 2 === 0
//                 ? "translate(-60%, -52%) scale(0.93) rotate(-3deg)"
//                 : "translate(-40%, -52%) scale(0.93) rotate(3deg)";
//           } else {
//             step.classList.add("next");
//           }
//         });
//       } else {
//         // خارج از بازه → همه مخفی
//         steps.forEach((step) => {
//           step.classList.remove("previous", "active", "next");
//           step.style.opacity = "0";
//         });
//       }
//     });
//   });
  

jQuery(document).ready(function ($) {
    const $steps = $(".whyChooseUS-list li");
    const $container = $(".WhyChooseUS");
    const totalSteps = $steps.length;
    const sectionHeight = $container.outerHeight();
  
    $(window).on("scroll", function () {
      const scrollY = $(window).scrollTop();
      const containerTop = $container.offset().top;
      const relativeScroll = scrollY - containerTop;
  
      if (
        scrollY >= containerTop - $(window).height() &&
        relativeScroll < sectionHeight
      ) {
        const index = Math.min(
          totalSteps - 1,
          Math.floor((relativeScroll / sectionHeight) * totalSteps)
        );
  
        $steps.each(function (i) {
          const $step = $(this);
          $step.removeClass("previous active next");
          $step.css("transform", "");
          $step.css("opacity", "1");
  
          if (i === index) {
            $step.addClass("active");
            $step.css(
              "transform",
              i % 2 === 0
                ? "translate(-50%, -50%) scale(1) rotate(0deg)"
                : "translate(-50%, -50%) scale(1) rotate(0deg)"
            );
          } else if (i < index) {
            $step.addClass("previous");
            $step.css(
              "transform",
              i % 2 === 0
                ? "translate(-60%, -52%) scale(0.93) rotate(-3deg)"
                : "translate(-40%, -52%) scale(0.93) rotate(3deg)"
            );
          } else {
            $step.addClass("next");
          }
        });
      } else {
        // خارج از بازه → همه مخفی
        $steps.each(function () {
          $(this).removeClass("previous active next").css("opacity", "0");
        });
      }
    });
  });

  // Teams
jQuery(document).ready(function($) {

  let xPos = 0;

  gsap.timeline()
      .set(dragger, { opacity:0 }) //make the drag layer invisible
      .set(ring,    { rotationY:180 }) //set initial rotationY so the parallax jump happens off screen
      // .set(ring,    { rotationX: 45 }) 
      .set('.img',  { // apply transform rotations to each image
        rotateY: (i)=> i*-30,
        transformOrigin: '50% 50% 1000px',
        z: -1000,
       //  backgroundImage:(i)=>'url(https://picsum.photos/id/'+(i+32)+'/700/300/)',
       //  backgroundPosition:(i)=>getBgPos(i),
        backfaceVisibility:'hidden'
      })    
      .from('.img', {
        duration:1.5,
        y:200,
        opacity:0,
        stagger:0.1,
        ease:'expo'
      })
  
  Draggable.create(dragger, {
    
    onDragStart:(e)=>{ 
      if (e.touches) e.clientX = e.touches[0].clientX;
      xPos = Math.round(e.clientX);
    },
    
    onDrag:(e)=>{
      if (e.touches) e.clientX = e.touches[0].clientX;    
      
      gsap.to(ring, {
        rotationY: '-=' +( (Math.round(e.clientX)-xPos)%360 ),
        onUpdate: ()=>{gsap.set('.img', { backgroundPosition:(i)=>getBgPos(i) }) }
      });
      
      xPos = Math.round(e.clientX);
    },
    
    onDragEnd:()=> {
      // gsap.to(ring, { rotationY: Math.round(gsap.getProperty(ring,'rotationY')/36)*36 }) // move to nearest photo...at the expense of the inertia effect
      gsap.set(dragger, {x:0, y:0}) // reset drag layer
    }
    
  })
  
});

function getBgPos(i){ //returns the background-position string to create parallax movement in each image
  return ( -gsap.utils.wrap(0,360,gsap.getProperty(ring, 'rotationY')-180-i*18)/360*400 )+'px 0px';
}
 
 
jQuery(document).ready(function(){
  jQuery('.faq__item__head').click(function (e) {
    e.preventDefault();
    jQuery(this).siblings().slideToggle();
    jQuery(this).toggleClass('active');

});


})




jQuery(document).ready(function(){


  jQuery(window).on("scroll", function () {
    var sectionOffset = jQuery(".section-date").offset().top;
    var scrollTop = jQuery(window).scrollTop();
    var distance = scrollTop - sectionOffset;
  
    if (distance < 0) return;
  
    var maxScroll = 300; // حداکثر فاصله‌ای که تغییر اعمال میشه
    var progress = Math.min(distance / maxScroll, 0); // عدد بین 0 تا 1
  
    var rotateX = 35 * (1 - progress); // از 35 به 0
  
    jQuery(".date__wrap").css({
        "transform": "perspective(1200px) rotateX(" + rotateX + "deg) rotateY(0)"
    });
  });


const $images = jQuery('.dribImg');

jQuery(window).on('mousemove', function (e) {
    const centerX = window.innerWidth / 2;
    const centerY = window.innerHeight / 2;
    const posX = (e.clientX - centerX) / centerX;
    const posY = (e.clientY - centerY) / centerY;

    $images.each(function (index) {
        const intensity = (index + 1) * 8;
        const directionX = index % 2 === 0 ? 1 : -1;
        const directionY = index % 3 === 0 ? 1 : -1;

        gsap.to(jQuery(this), {
            x: posX * intensity * directionX,
            y: posY * intensity * directionY,
            ease: "none",
            duration: 0.2,
        });
    });
});


setInterval(function () {
  var $circle = jQuery('<div class="svg-circle"></div>');
  jQuery('.dev-svg').append($circle);

  $circle.on('animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd', function () {
    jQuery(this).remove();
  });
}, 5000);


setInterval(function () {
  var $circle = jQuery('<div class="svg-circle2"></div>');
  $('.dev-svg').append($circle);

  $circle.on('animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd', function () {
    jQuery(this).remove();
  });
}, 5000);
})