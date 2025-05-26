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

  
  
 