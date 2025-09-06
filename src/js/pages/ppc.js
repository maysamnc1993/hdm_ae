import "../components/faq";

// typical import
import gsap from "gsap";
// or get other plugins:
import Draggable from "gsap/Draggable";
import ScrollTrigger from "gsap/ScrollTrigger";

// don't forget to register plugins
gsap.registerPlugin(ScrollTrigger, Draggable);

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

// var ListOfValue = Number(jQuery(".ListOfValue").offset().top) - Number(400);
// var title = Number(jQuery(".value_section .title_box").offset().top) - Number(100);
// var ScrolledRight = 0;
// jQuery(document).scroll(function(e) {
//     var st = jQuery(this).scrollTop();
//     var scrolled = jQuery(this).scrollTop();

//     if(st > ListOfValue){
//         jQuery(".ListOfValue").addClass("active");
//     }else{
//         jQuery(".ListOfValue").removeClass("active");
//     }
//     if(st > title){
//       jQuery(".value_section .title_box").addClass("active");
//     }else{
//         jQuery(".value_section .title_box").removeClass("active");
//     }

// });



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

//==================================\




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
