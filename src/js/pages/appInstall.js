import "../components/faq";

// typical import
import gsap from "gsap";
// or get other plugins:
import Draggable from "gsap/Draggable";
import ScrollTrigger from "gsap/ScrollTrigger";

// don't forget to register plugins
gsap.registerPlugin(ScrollTrigger, Draggable);

jQuery(document).ready(function ($) {
  // Split text into individual letters
  $(".animated-text").each(function () {
    const text = $(this).text();
    const letters = text.split("");
    let html = "";

    letters.forEach((letter, index) => {
      if (letter === " ") {
        html += '<span class="space">&nbsp;</span>';
      } else {
        html += `<span class="letter" data-index="${index}">${letter}</span>`;
      }
    });

    $(this).html(html);
  });

  const letters = $(".letter");
  const totalLetters = letters.length;
  const animatedText = $(".animated-text");
  const textColor = animatedText.data("text-color") || "#ff3c3c";

  // Create timeline for scroll-triggered animation
  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: ".colorful-text-section",
      start: "top center",
      end: "center center",
      scrub: true,
      markers: false, // Set to true for debugging
    },
  });

  // Animate each letter with staggered timing
  letters.each(function (index) {
    const hue = (index / totalLetters) * 360; // Color spectrum

    tl.to(
      $(this),
      {
        color: textColor,
        duration: 0.1,
        ease: "none",
      },
      index * 0.01
    ); // Stagger effect
  });
});

jQuery(document).ready(function ($) {
  const $header = $("header, .active"); // Adjust selector to match your header
  const headerHeight = elementExists($header) ? $header.outerHeight() + 50 : 80; // Fallback to 80px

  // Helper function to check if element exists
  function elementExists($el) {
    return $el && $el.length > 0;
  }

  // Create timeline for cart-ads sequential animation
  const cardTl = gsap.timeline({
    scrollTrigger: {
      trigger: ".additional-ad-services",
      start: `top top+=${headerHeight}`, // Offset by header height
      end: "100%", // Slightly shorter duration for natural scroll feel
      scrub: 1.5, // Moderate scrub for deliberate pacing
      pin: true, // Pin section during animation
      pinSpacing: true, // Ensure spacing accounts for pin
      markers: false, // Set to true for debugging
      onLeave: () => {
        // Smoothly scroll to the next section after the last card
        const nextSection = $(".additional-ad-services").next();
        if (elementExists(nextSection)) {
          gsap.to(window, {
            scrollTo: nextSection.offset().top,
            duration: 3, // Match site-wide 3000ms scrolling
            ease: "easeInOutCubic", // Match site-wide easing
          });
        }
      },
    },
  });

  // Animate each cart-ads item with blur effect
  gsap.utils.toArray(".cart-ads").forEach((card, index) => {
    cardTl
      .from(
        card,
        {
          opacity: 0,
          y: 100,
          scale: 0.7,
          rotation: 5,
          filter: "blur(10px)",
          duration: 1.5,
          ease: "back.out(1.4)",
        },
        index * 0.5
      )
      .to(
        card,
        {
          filter: "blur(0px)",
          duration: 0.5,
        },
        index * 0.5 + 1
      );

    // Animate dots within each card
    const dots = $(card).find(".dot-step:not(.active)");
    dots.each((dotIndex, dot) => {
      cardTl.to(
        dot,
        {
          backgroundColor: "#ff4b00",
          scale: 1.2,
          duration: 0.3,
          ease: "power1.inOut",
        },
        index * 0.5 + dotIndex * 0.1 + 0.5
      );
    });
  });

  // Add hover effect for interactivity
  gsap.utils.toArray(".cart-ads").forEach((card) => {
    $(card).on("mouseenter", function () {
      gsap.to(card, {
        scale: 1.08,
        duration: 0.4,
        ease: "power2.out",
      });
    });
    $(card).on("mouseleave", function () {
      gsap.to(card, {
        scale: 1,
        duration: 0.4,
        ease: "power2.out",
      });
    });
  });
});

jQuery(document).ready(function ($) {
  const $steps = $(".whyChooseUS-list li");
  const $container = $(".WhyChooseUS");
  const totalSteps = $steps.length;
  const sectionHeight = $container.outerHeight();
  var widthWindow = jQuery(window).width();
  if (widthWindow > 600) {
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
  }
});

jQuery(document).ready(function ($) {
  // Initialize sticky behavior for CaseStudyItem
  const $caseStudyItems = $('.caseStudyItem .CaseStudyItem');
  const $titleBox = $('.caseStudyItem .box_of_caseStudy .titleBox');
  let lastScrollTop = 0;

  $(window).on('scroll', function () {
    const scrollTop = $(this).scrollTop();
    const caseStudyTop = $('.caseStudyItem').offset().top - 200;

    // Apply sticky behavior and animations
    if (scrollTop > caseStudyTop) {
      $titleBox.addClass('active');
      $caseStudyItems.each(function (index) {
        const $item = $(this);
        const itemTop = $item.offset().top - scrollTop;
        const isVisible = itemTop < $(window).height() * 0.8;

        if (isVisible) {
          $item.addClass('active');
        } else {
          $item.removeClass('active');
        }
      });
    } else {
      $titleBox.removeClass('active');
      $caseStudyItems.removeClass('active');
    }

    lastScrollTop = scrollTop;
  });
});