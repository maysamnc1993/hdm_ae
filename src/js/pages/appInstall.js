import "../components/faq";

// typical import
import gsap from "gsap";
// or get other plugins:
import Draggable from "gsap/Draggable";
import ScrollTrigger from "gsap/ScrollTrigger";

// don't forget to register plugins
gsap.registerPlugin(ScrollTrigger, Draggable);


// jQuery(document).ready(function ($) {
//   const $body = $("body");
//   const $images = $(".hero-section .hero-images img.theme-image");
//   const $image1 = $(".hero-section .hero-images img.theme-image.hero-image-1");
//   const $image2 = $(".hero-section .hero-images img.theme-image.hero-image-2");
//   const $image3 = $(".hero-section .hero-images img.theme-image.hero-image-3");
//   const $content = $(".hero-section .hero-content");

//   // === 1. Ensure we're at the very top on page load ===
//   window.scrollTo(0, 0);

//   // === 2. Set hero section to full viewport height ===
//   $(".hero-section").css({
//     position: "relative",
//     width: "100%",
//     height: "100vh",
//     overflow: "hidden",
//   });

//   // === 3. Disable body scroll during animation ===
//   $body.css("overflow", "hidden");

//   // === 4. Force reflow to apply CSS before measuring ===
//   void $image3[0].offsetHeight; // Triggers layout sync for third image

//   // === 5. Capture starting position/size of third image AFTER CSS applied ===
//   const rect = $image3[0].getBoundingClientRect();
//   const initialState = {
//     width: rect.width,
//     height: rect.height,
//     x: rect.left,
//     y: rect.top,
//     borderRadius: $image3.css("border-radius"),
//   };

//   // === 6. Apply absolute positioning to third image ===
//   gsap.set($image3, {
//     position: "absolute",
//     top: 0,
//     left: 0,
//     x: initialState.x,
//     y: initialState.y,
//     width: initialState.width,
//     height: initialState.height,
//     borderRadius: initialState.borderRadius,
//     opacity: 0,
//     zIndex: 5,
//     willChange: "transform, width, height, opacity",
//   });

//   // === 7. Set initial state for all images and content ===
//   gsap.set($images, { opacity: 0 });
//   gsap.set($content, { opacity: 0, y: 50 });

//   // === 8. Create timeline for sequential animations ===
//   const tl = gsap.timeline({
//     onComplete: () => {
//       $body.css("overflow", ""); // Re-enable scrolling
//       $image3.css({
//         position: "",
//         top: "",
//         left: "",
//         x: "",
//         y: "",
//         willChange: "",
//       });
//     },
//   });

//   // === 9. Sequential appearance of images ===
//   tl.to($image1, {
//     opacity: 1,
//     duration: 0.5,
//     ease: "power2.out",
//   })
//     .to(
//       $image2,
//       {
//         opacity: 1,
//         duration: 0.5,
//         ease: "power2.out",
//       },
//       "+=0.3"
//     )
//     .to(
//       $image3,
//       {
//         opacity: 1,
//         duration: 0.5,
//         ease: "power2.out",
//       },
//       "+=0.3"
//     );

//   // === 10. Fade out first two images ===
//   tl.to(
//     [$image1, $image2],
//     {
//       opacity: 0,
//       duration: 0.5,
//       ease: "power2.in",
//     },
//     "+=0.5"
//   );

//   // === 11. Expand third image to full screen ===
//   tl.to(
//     $image3,
//     {
//       x: 0,
//       y: 0,
//       width: "100vw",
//       height: "100vh",
//       borderRadius: 0,
//       ease: "power4.inOut",
//       duration: 1.4,
//       onStart: () => {
//         $image3.addClass("full-width").css("z-index", 10);
//       },
//     },
//     "+=0.2"
//   );

//   // === 12. Reveal content after expansion ===
//   tl.to(
//     $content,
//     {
//       opacity: 1,
//       y: 0,
//       duration: 1.0,
//       ease: "power2.out",
//     },
//     "-=0.4"
//   );
// });
// //  hero section end


// jQuery(document).ready(function ($) {
//   const $body = $("body");
//   const $images = $(".hero-section .hero-images img.theme-image");
//   const $image1 = $(".hero-section .hero-images img.theme-image.hero-image-1");
//   const $image2 = $(".hero-section .hero-images img.theme-image.hero-image-2");
//   const $image3 = $(".hero-section .hero-images img.theme-image.hero-image-3");
//   const $content = $(".hero-section .hero-content");

//   // Scroll to top
//   window.scrollTo(0, 0);

//   $(".hero-section").css({
//     position: "relative",
//     width: "100%",
//     height: "100vh",
//     overflow: "hidden",
//   });

//   $body.css("overflow", "hidden");

//   // Force reflow for image2
//   void $image2[0].offsetHeight;

//   // Initial state from image2
//   const rect = $image2[0].getBoundingClientRect();
//   const initialState = {
//     width: rect.width,
//     height: rect.height,
//     x: rect.left,
//     y: rect.top,
//     borderRadius: $image2.css("border-radius"),
//   };

//   // Set absolute positioning on image2
//   gsap.set($image2, {
//     position: "absolute",
//     top: 0,
//     left: 0,
//     x: initialState.x,
//     y: initialState.y,
//     width: initialState.width,
//     height: initialState.height,
//     borderRadius: initialState.borderRadius,
//     opacity: 0,
//     zIndex: 5,
//     willChange: "transform, width, height, opacity",
//   });

//   gsap.set($images, { opacity: 0 });
//   gsap.set($content, { opacity: 0, y: 50 });

// // === تغییر onComplete: حفظ position: absolute بعد از انیمیشن ===
//   const tl = gsap.timeline({
//     onComplete: () => {
//       $body.css("overflow", "");
//       $image2.css({
//         x: "",
//         y: "",
//         willChange: "",
//         transform: "", // حذف ترنسفورم برای جلوگیری از جابجایی
//         position: "absolute",
//         top: 0,
//         left: 0,
//         width: "100vw",
//         height: "100vh",
//         zIndex: 10,
//       });
//     },
//   });


//   tl.to($image1, {
//     opacity: 1,
//     duration: 0.5,
//     ease: "power2.out",
//   })
//     .to(
//       $image2,
//       {
//         opacity: 1,
//         duration: 0.5,
//         ease: "power2.out",
//       },
//       "+=0.3"
//     )
//     .to(
//       $image3,
//       {
//         opacity: 1,
//         duration: 0.5,
//         ease: "power2.out",
//       },
//       "+=0.3"
//     );

//   tl.to(
//     [$image1, $image3], // fade out image1 and image3 instead of image1 + image2
//     {
//       opacity: 0,
//       duration: 0.5,
//       ease: "power2.in",
//     },
//     "+=0.5"
//   );

//   tl.to(
//     $image2,
//     {
//       x: 0,
//       y: 0,
//       width: "100vw",
//       height: "100vh",
//       position: "absolute",
//       top: 0,
//       left: 0,
//       borderRadius: 0,
//       ease: "power4.inOut",
//       duration: 1.4,
//       onStart: () => {
//         $image2.addClass("full-width").css("z-index", 10);
//       },
//     },
//     "+=0.2"
//   );

//   tl.to(
//     $content,
//     {
//       opacity: 1,
//       y: 0,
//       duration: 1.0,
//       ease: "power2.out",
//     },
//     "-=0.4"
//   );
// });

jQuery(document).ready(function ($) {
  const $body = $("body");
  const $images = $(".hero-section .hero-images img.theme-image");
  const $image1 = $(".hero-image-1");
  const $image2 = $(".hero-image-2");
  const $image3 = $(".hero-image-3");
  const $content = $(".hero-content");
  const $overlay = $(".image-overlay");

  // Scroll to top
  window.scrollTo(0, 0);

  // Set hero section
  $(".hero-section").css({
    position: "relative",
    width: "100%",
    height: "100vh",
    overflow: "hidden",
  });

  // Disable scroll
  $body.css("overflow", "hidden");

  // Force reflow for image2
  void $image2[0].offsetHeight;

  const rect = $image2[0].getBoundingClientRect();
  const initialState = {
    width: rect.width,
    height: rect.height,
    x: rect.left,
    y: rect.top,
    borderRadius: $image2.css("border-radius"),
  };

  // Set image2 for animation
  gsap.set($image2, {
    position: "absolute",
    top: 0,
    left: 0,
    x: initialState.x,
    y: initialState.y,
    width: initialState.width,
    height: initialState.height,
    borderRadius: initialState.borderRadius,
    opacity: 0,
    zIndex: 10,
    willChange: "transform, width, height, opacity, filter",
  });

  // Set initial state for all
  gsap.set($images, { opacity: 0 });
  gsap.set($content, { opacity: 0, y: 50 });
  gsap.set($overlay, { opacity: 0 });

  const tl = gsap.timeline({
    onComplete: () => {
      $body.css("overflow", "");
      $image2.css({
        transform: "",
        willChange: "",
        position: "absolute",
        top: 0,
        left: 0,
        width: "100vw",
        height: "100vh",
        zIndex: 10,
        filter: "blur(3px) brightness(1) contrast(1)",
      });
    },
  });

  tl.to($image1, {
    opacity: 1,
    duration: 0.5,
    ease: "power2.out",
  })
    .to(
      $image2,
      {
        opacity: 1,
        duration: 0.5,
        ease: "power2.out",
      },
      "+=0.3"
    )
    .to(
      $image3,
      {
        opacity: 1,
        duration: 0.5,
        ease: "power2.out",
      },
      "+=0.3"
    )
    .to(
      [$image1, $image3],
      {
        opacity: 0,
        duration: 0.5,
        ease: "power2.in",
      },
      "+=0.5"
    )
    .to(
      $image2,
      {
        x: 0,
        y: 0,
        width: "100vw",
        height: "100vh",
        borderRadius: 0,
        ease: "power4.inOut",
        duration: 1.4,
        onStart: () => {
          $image2.addClass("full-width").css("z-index", 10);
        },
      },
      "+=0.2"
    )
    .to(
      $image2,
      {
        filter: "blur(3px) brightness(1) contrast(1)",
        duration: 0.5,
        ease: "power1.out",
      },
      "-=1"
    )
    .to(
      $overlay,
      {
        opacity: 1,
        duration: 0.5,
        ease: "power1.out",
      },
      "-=0.8"
    )
    .to(
      $content,
      {
        opacity: 1,
        y: 0,
        duration: 1.0,
        ease: "power2.out",
      },
      "-=0.4"
    );
});


//=================================

// why-app start
jQuery(document).ready(function ($) {
  // Split text into individual letters
  $(".colorful-text-section .animated-text").each(function () {
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

  const $letters = $(".colorful-text-section .letter");
  const totalLetters = $letters.length;
  const $animatedText = $(".colorful-text-section .animated-text");
  const textColor = $animatedText.data("text-color") || "#252D44";

  // Create timeline for scroll-triggered animation
  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: ".colorful-text-section",
      start: "top center",
      end: "center center",
      scrub: true,
      markers: false,
    },
  });

  // Animate each letter with staggered timing
  $letters.each(function (index) {
    tl.to(
      $(this),
      {
        color: textColor,
        duration: 0.1,
        ease: "none",
      },
      index * 0.01
    );
  });
});
// why-app end

//==================================

// top-case-study start
jQuery(document).ready(function ($) {
  function CountUp(number) {
    const duration = 1000; // Animation duration in ms
    const frameRate = 60; // Frames per second
    const totalFrames = Math.round((duration / 1000) * frameRate);
    const increment = number / totalFrames;
    let current = 0;
    let frame = 0;

    const interval = setInterval(function () {
      frame++;
      current += increment;

      if (frame >= totalFrames) {
        current = number;
        clearInterval(interval);
      }

      $(".caseStudy .box_of_data .data .countUp").html(
        "+" + Math.floor(current)
      );
    }, 1000 / frameRate);
  }

  let lastScrollTop = 0;
  const caseStudyTop = $(".caseStudy").offset().top - 200;

  $(document).scroll(function () {
    const scrollTop = $(this).scrollTop();

    if (scrollTop > caseStudyTop) {
      $(".caseStudy .box_of_data .box_of_image").addClass("active");
      setTimeout(function () {
        $(".caseStudy .box_of_data .data .countUp").addClass("active");
        $(".caseStudy .box_of_data .data .title").addClass("active");
        $(".caseStudy .box_of_data .data h2").addClass("active");
        CountUp(300); // Adjust number based on ACF field if dynamic
      }, 1000);
    }

    lastScrollTop = scrollTop;
  });
});
// top-case-study end

//==================================

// additional-ad-services start
// additional-ad-services start
jQuery(document).ready(function ($) {
  const $header = $("header, .active");
  const headerHeight = $header.length > 0 ? $header.outerHeight() + 50 : 80;
  const $cards = $(".additional-ad-services .cart-ads");
  const isMobile = window.innerWidth <= 768;

  if (!isMobile) {
    // DESKTOP ANIMATION - Enhanced with more visual effects
    const cardTl = gsap.timeline({
      scrollTrigger: {
        trigger: ".additional-ad-services",
        start: `top top+=${headerHeight}`,
        end: "100%",
        scrub: 1.5,
        pin: true,
        pinSpacing: true,
        markers: false,
        onLeave: () => {
          const nextSection = $(".additional-ad-services").next();
          if (nextSection.length) {
            gsap.to(window, {
              scrollTo: nextSection.offset().top,
              duration: 3,
              ease: "easeInOutCubic",
            });
          }
        },
      },
    });

    // Enhanced desktop animation with more effects
    gsap.utils.toArray($cards).forEach((card, index) => {
      // Create a unique timeline for each card
      const cardAnim = gsap.timeline();

      // Initial animation with more effects
      cardAnim
        .from(card, {
          opacity: 0,
          y: 120,
          scale: 0.7,
          rotation: 5,
          filter: "blur(10px)",
          duration: 1.5,
          ease: "back.out(1.4)",
        })
        .to(card, {
          filter: "blur(0px)",
          duration: 0.5,
        })
        .to(
          card.querySelector(".card-inner"),
          {
            boxShadow: "0 20px 40px rgba(0,0,0,0.15)",
            duration: 0.8,
          },
          "-=0.5"
        )
        .to(
          card.querySelector(".card-icon"),
          {
            rotation: 360,
            scale: 1.2,
            duration: 0.8,
          },
          "-=0.8"
        )
        .to(
          card.querySelector(".card-title"),
          {
            y: 0,
            opacity: 1,
            duration: 0.6,
          },
          "-=0.6"
        )
        .to(
          card.querySelector(".card-description"),
          {
            y: 0,
            opacity: 1,
            duration: 0.6,
          },
          "-=0.4"
        );

      // Add to main timeline with stagger
      cardTl.add(cardAnim, index * 0.5);

      // Add hover effects
      $(card).on("mouseenter", function () {
        gsap.to(card, {
          scale: 1.08,
          y: -10,
          boxShadow: "0 25px 50px rgba(0,0,0,0.2)",
          duration: 0.4,
          ease: "power2.out",
        });
        gsap.to(card.querySelector(".card-icon"), {
          rotation: 15,
          scale: 1.3,
          duration: 0.4,
          ease: "back.out(1.7)",
        });
      });

      $(card).on("mouseleave", function () {
        gsap.to(card, {
          scale: 1,
          y: 0,
          boxShadow: "0 20px 40px rgba(0,0,0,0.15)",
          duration: 0.4,
          ease: "power2.out",
        });
        gsap.to(card.querySelector(".card-icon"), {
          rotation: 0,
          scale: 1.2,
          duration: 0.4,
          ease: "power2.out",
        });
      });
    });
  } else {
    // MOBILE ANIMATION - Simpler, touch-friendly without pinning
    // Set initial state
    gsap.set($cards, {
      opacity: 0,
      y: 80,
      scale: 0.9,
    });

    // Create scroll trigger for mobile
    ScrollTrigger.create({
      trigger: ".additional-ad-services",
      start: `top bottom-=100`, // Start when section is near bottom of viewport
      onEnter: () => {
        // Animate cards in sequence
        gsap.to($cards, {
          opacity: 1,
          y: 0,
          scale: 1,
          duration: 0.8,
          stagger: 0.15,
          ease: "back.out(1.2)",
          onComplete: () => {
            // Add subtle pulse animation to draw attention
            $cards.each((index, card) => {
              gsap.to(card, {
                scale: 1.03,
                duration: 0.4,
                yoyo: true,
                repeat: 1,
                delay: index * 0.1,
                ease: "power2.inOut",
              });
            });
          },
        });
      },
      once: true, // Only run once
    });

    // Add mobile tap effects
    $cards.on("click", function () {
      const card = this;
      gsap.to(card, {
        scale: 0.95,
        duration: 0.1,
        onComplete: () => {
          gsap.to(card, {
            scale: 1,
            duration: 0.2,
            ease: "back.out(1.7)",
          });
        },
      });
    });
  }
});
// additional-ad-services end
// additional-ad-services end

//==================================

// why-choose-us start
jQuery(document).ready(function ($) {
  const widthWindow = $(window).width();
  if (widthWindow > 600) {
    const $steps = $(".WhyChooseUS .whyChooseUS-list li");
    const $container = $(".WhyChooseUS");
    const totalSteps = $steps.length;

    // Dynamically calculate section height: 500px per item for more scroll space
    const itemHeight = 500; // Increased from 300px to ensure each item is fully visible
    const sectionHeight = totalSteps * itemHeight;
    $container.css("height", `${sectionHeight}px`);

    $(window).on("scroll", function () {
      const scrollY = $(window).scrollTop();
      const containerTop = $container.offset().top - $(window).height() * 0.5; // Start earlier
      const relativeScroll = scrollY - containerTop;

      if (scrollY >= containerTop && relativeScroll < sectionHeight) {
        // Adjust index to slow down transitions, ensuring all items are shown
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
        $steps.each(function () {
          $(this).removeClass("previous active next").css("opacity", "0");
        });
      }
    });
  }
});
// why-choose-us end

//==================================

/**
 * Services Section Interactive Component
 * Handles smooth animations and user interactions for the services showcase
 */

jQuery(document).ready(function ($) {
  class ServicesSection {
    constructor() {
      this.$titles = $(".titles .title");
      this.$contentItems = $(".content .content-item");
      this.activeTitleId = "1";
      this.isAnimating = false;
      this.animationTimeout = null;
      this.currentTimeline = null;
      this.pendingAnimation = null;

      this.init();
    }

    init() {
      this.setupIntersectionObserver();
      this.bindEvents();
    }

    setupIntersectionObserver() {
      const observer = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              this.initializeSection();
              observer.unobserve(entry.target);
            }
          });
        },
        { threshold: 0.3 }
      );

      observer.observe($(".grow-app")[0]);
    }

    initializeSection() {
      // Animate section entrance
      gsap.to(".grow-app", {
        opacity: 1,
        y: 0,
        duration: 0.8,
        ease: "power3.out",
      });

      // Stagger animate titles
      gsap.to(this.$titles, {
        opacity: 1,
        x: 0,
        duration: 0.6,
        stagger: 0.1,
        ease: "power2.out",
        delay: 0.3,
        onComplete: () => {
          this.$titles.addClass("animate-in");
        },
      });

      // Initialize first content item
      setTimeout(() => {
        this.showContentItem("1", true);
      }, 800);
    }

    showContentItem(titleId, isInitial = false) {
      // If there's a pending animation, execute it immediately
      if (this.pendingAnimation && this.pendingAnimation !== titleId) {
        this.executePendingAnimation();
      }

      // If same item or animating to same item, return
      if (titleId === this.activeTitleId && !isInitial) return;

      // If currently animating, queue this animation
      if (this.isAnimating && !isInitial) {
        this.pendingAnimation = titleId;
        return;
      }

      this.executeAnimation(titleId, isInitial);
    }

    executeAnimation(titleId, isInitial = false) {
      this.isAnimating = true;
      this.activeTitleId = titleId;
      this.pendingAnimation = null;

      const $targetItem = this.$contentItems.filter(
        `[data-title="${titleId}"]`
      );
      const $currentActiveItem = this.$contentItems.filter(".active");
      const $targetTitle = this.$titles.filter(`[data-title="${titleId}"]`);

      // Kill any existing timeline
      if (this.currentTimeline) {
        this.currentTimeline.kill();
      }

      // Update active states
      this.$titles.removeClass("active");
      $targetTitle.addClass("active");

      // Create new animation timeline
      this.currentTimeline = gsap.timeline({
        onComplete: () => {
          this.isAnimating = false;
          this.currentTimeline = null;

          // Execute pending animation if exists
          if (this.pendingAnimation) {
            const nextAnimation = this.pendingAnimation;
            this.pendingAnimation = null;
            setTimeout(() => {
              this.executeAnimation(nextAnimation);
            }, 50);
          }
        },
      });

      if ($currentActiveItem.length && !isInitial) {
        // Animate out current item
        this.currentTimeline.to($currentActiveItem, {
          opacity: 0,
          y: -20,
          scale: 0.95,
          duration: 0.25,
          ease: "power2.in",
          onComplete: () => {
            $currentActiveItem.removeClass("active");
          },
        });
      }

      // Animate in new item
      this.currentTimeline
        .set($targetItem, {
          opacity: 0,
          y: 30,
          scale: 0.95,
        })
        .add(() => {
          $targetItem.addClass("active");
        })
        .to(
          $targetItem,
          {
            opacity: 1,
            y: 0,
            scale: 1,
            duration: 0.5,
            ease: "power3.out",
          },
          isInitial ? 0 : 0.1
        );

      // Add subtle image animation
      this.currentTimeline.fromTo(
        $targetItem.find("img"),
        {
          scale: 1.08,
          opacity: 0.8,
        },
        {
          scale: 1,
          opacity: 1,
          duration: 0.7,
          ease: "power2.out",
        },
        isInitial ? 0.15 : 0.25
      );

      // Animate text content
      this.currentTimeline.fromTo(
        $targetItem.find("h3, p"),
        {
          opacity: 0,
          y: 15,
        },
        {
          opacity: 1,
          y: 0,
          duration: 0.4,
          stagger: 0.08,
          ease: "power2.out",
        },
        isInitial ? 0.3 : 0.35
      );
    }

    executePendingAnimation() {
      if (this.currentTimeline) {
        // Fast-forward current animation
        this.currentTimeline.progress(1);
      }
    }

    debouncedHover(titleId) {
      clearTimeout(this.animationTimeout);
      this.animationTimeout = setTimeout(() => {
        this.showContentItem(titleId);
      }, 80);
    }

    bindEvents() {
      // Hover handler with debouncing
      this.$titles.on("mouseenter", (e) => {
        const titleId = $(e.currentTarget).data("title");
        if (titleId !== this.activeTitleId) {
          this.debouncedHover(titleId);
        }
      });

      // Click handler for mobile and immediate response
      this.$titles.on("click", (e) => {
        e.preventDefault();
        const titleId = $(e.currentTarget).data("title");

        // Clear any pending hover
        clearTimeout(this.animationTimeout);

        if (titleId !== this.activeTitleId) {
          this.showContentItem(titleId);
        }

        // Optional: Scroll to section on mobile
        if (window.innerWidth <= 768) {
          $("html, body").animate(
            {
              scrollTop: $(".content").offset().top - 100,
            },
            300
          );
        }
      });

      // Optional: Add keyboard navigation
      this.$titles.on("keydown", (e) => {
        if (e.key === "Enter" || e.key === " ") {
          e.preventDefault();
          $(e.currentTarget).trigger("click");
        }
      });

      // Mouse leave handler to clear pending animations
      $(".titles").on("mouseleave", () => {
        clearTimeout(this.animationTimeout);
      });
    }
  }

  // Initialize the services section
  new ServicesSection();
});
