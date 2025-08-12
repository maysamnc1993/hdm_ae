import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
import "../components/faq";



// or get other plugins:
import Draggable from "gsap/Draggable";

// don't forget to register plugins
gsap.registerPlugin(Draggable);
gsap.registerPlugin(ScrollTrigger);


// don't forget to register plugins
gsap.registerPlugin(ScrollTrigger, Draggable);

jQuery(document).ready(function ($) {

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



  // Image container animations (unchanged)
  const $imageContainer = $(".image-container");
  if ($imageContainer.length) {
    gsap.set(".image-left", { rotation: 0, x: 160, zIndex: 5 });
    gsap.set(".image-right", { rotation: 0, x: -160, zIndex: 5 });
    gsap.set(".image-center", { zIndex: 10 });

    gsap.to(".image-left", {
      rotation: -15,
      x: 0,
      duration: 1.2,
      ease: "power3.out",
      scrollTrigger: {
        trigger: ".image-container",
        start: "top 70%",
        end: "bottom 30%",
        toggleActions: "play none none reverse",
        scrub: 0.5,
      },
    });

    gsap.to(".image-right", {
      rotation: 15,
      x: 0,
      duration: 1.2,
      ease: "power3.out",
      scrollTrigger: {
        trigger: ".image-container",
        start: "top 70%",
        end: "bottom 30%",
        toggleActions: "play none none reverse",
        scrub: 0.5,
      },
    });
  }

  // Scroll-Controlled Stats Controller
  class ScrollControlledStatsController {
    constructor() {
      this.statSection = document.querySelector(".stat");
      this.statBg = document.querySelector(".stat-bg");
      this.statItems = document.querySelectorAll(".stat-item");
      this.counters = document.querySelectorAll("[data-count]");
      this.masterTimeline = null;
      this.currentCounterValues = {};
      this.hasAnimated = false; // Track if animation has run
      this.init();
    }

    init() {
      if (!this.statSection || !this.statBg || !this.counters.length) {
        console.error("Stat section, background, or counters not found");
        return;
      }
      this.setupInitialStates();
      this.createScrollControlledTimeline();
      this.setupHoverEffects();
    }

    setupInitialStates() {
      // Background setup
      gsap.set(this.statBg, {
        scale: 1,
        transformOrigin: "center center",
        filter: "brightness(0.9) contrast(1.0)",
        willChange: "transform, filter",
      });

      // Stat items initial state - start hidden
      gsap.set(this.statItems, {
        opacity: 0,
        scale: 0.8,
        y: 50,
        willChange: "transform, opacity",
      });

      // Initialize counters
      this.counters.forEach((counter, index) => {
        counter.textContent = "0";
        const rawValue = counter.getAttribute("data-count");
        const endValue = parseFloat(rawValue) || 0;
        this.currentCounterValues[index] = {
          current: 0,
          target: endValue,
          animObj: { value: 0 },
          element: counter,
        };
        console.log(
          `Counter ${index + 1} initialized with target: ${endValue}`
        );
      });
    }

    createScrollControlledTimeline() {
      this.masterTimeline = gsap.timeline({
        paused: true, // Start paused, only play on first enter
        scrollTrigger: {
          trigger: this.statSection,
          start: "top 85%", // Start when section is 85% in view
          end: "bottom 15%",
          once: true, // Run only once and disable trigger
          onEnter: () => {
            if (!this.hasAnimated) {
              console.log("Stat section entered viewport, starting animation");
              this.masterTimeline.play();
              this.hasAnimated = true;
            }
          },
        },
      });

      // Phase 1: Background zoom
      this.masterTimeline.to(
        this.statBg,
        {
          scale: 1.2,
          filter: "brightness(0.8) contrast(1.2) saturate(1.1)",
          duration: 0.5,
          ease: "power1.inOut",
        },
        0.1
      );

      // Phase 2: Stat items fade in
      this.statItems.forEach((item, index) => {
        this.masterTimeline.to(
          item,
          {
            opacity: 1,
            scale: 1,
            y: 0,
            duration: 0.3,
            ease: "power3.out",
          },
          0.1 + index * 0.05
        );
      });

      // Phase 3: Counter animations
      this.counters.forEach((counter, index) => {
        const counterData = this.currentCounterValues[index];
        this.masterTimeline.to(
          counterData.animObj,
          {
            value: counterData.target,
            duration: 0.8,
            ease: "power2.out",
            onUpdate: () => {
              this.updateCounterDisplay(index, counterData.animObj.value);
            },
            onComplete: () => {
              this.updateCounterDisplay(index, counterData.target);
              console.log(
                `Counter ${index + 1} reached target: ${counterData.target}`
              );
            },
          },
          0.3 + index * 0.05
        );
      });
    }

    updateCounterDisplay(index, currentValue) {
      const counterData = this.currentCounterValues[index];
      const counter = counterData.element;
      const value = Math.floor(currentValue);
      const target = counterData.target;

      let displayValue;
      if (target >= 1000000) {
        displayValue = (value / 1000000).toFixed(1).replace(/\.0$/, "") + "M";
      } else if (target >= 1000) {
        displayValue = (value / 1000).toFixed(1).replace(/\.0$/, "") + "K";
      } else {
        displayValue = value.toString();
      }

      counter.textContent = displayValue;
      console.log(
        `Counter ${index + 1} display: ${displayValue} (value: ${value}, target: ${target})`
      );

      if (currentValue > 0 && currentValue < target) {
        gsap.to(counter, {
          scale: 1.05,
          duration: 0.15,
          yoyo: true,
          repeat: 1,
          ease: "power2.inOut",
        });
      }
    }

    setupHoverEffects() {
      this.statItems.forEach((item, index) => {
        const glassBackground = document.createElement("div");
        glassBackground.className = "glass-background";
        glassBackground.style.cssText = `
          position: absolute;
          text-align: center;
          left: 0px;
          right: 0px;
          top: 0px;
          bottom: 0px;
          width: 100%;
          opacity: 0;
          pointer-events: none;
          z-index: -1;
        `;

        item.style.position = "relative";
        item.appendChild(glassBackground);

        const hoverTl = gsap.timeline({ paused: true });

        hoverTl.to(glassBackground, {
          opacity: 1,
          scale: 1.05,
          duration: 0.4,
          ease: "power2.out",
        });

        hoverTl.to(
          item,
          {
            y: -8,
            duration: 0.4,
            ease: "power2.out",
          },
          0
        );

        const numberEl = item.querySelector("[data-count]");
        if (numberEl) {
          hoverTl.to(
            numberEl,
            {
              scale: 1.05,
              duration: 0.4,
              ease: "power2.out",
            },
            0
          );
        }

        item.addEventListener("mouseenter", () => hoverTl.play());
        item.addEventListener("mouseleave", () => hoverTl.reverse());
      });
    }

    setProgress(progress) {
      this.masterTimeline.progress(progress);
      console.log(`Timeline progress set to: ${progress}`);
    }

    getCurrentProgress() {
      const progress = this.masterTimeline.progress();
      console.log(`Current timeline progress: ${progress}`);
      return progress;
    }

    pause() {
      ScrollTrigger.getAll().forEach((trigger) => trigger.disable());
      console.log("Scroll control paused");
    }

    resume() {
      ScrollTrigger.getAll().forEach((trigger) => trigger.enable());
      console.log("Scroll control resumed");
    }
  }

  const scrollStatsController = new ScrollControlledStatsController();
  window.scrollStatsController = scrollStatsController;

  gsap.config({
    force3D: true,
    nullTargetWarn: false,
  });

  ScrollTrigger.config({
    limitCallbacks: true,
    syncInterval: 16,
    ignoreMobileResize: true,
  });

  let resizeTimeout;
  window.addEventListener("resize", () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
      ScrollTrigger.refresh();
      console.log("ScrollTrigger refreshed");
    }, 300);
  });

  window.addEventListener("beforeunload", () => {
    ScrollTrigger.killAll();
    gsap.killTweensOf("*");
    console.log("Cleaned up ScrollTrigger and tweens");
  });
});

//-====================================
// team js
jQuery(document).ready(function ($) {
  let xPos = 0;

  gsap
    .timeline()
    .set(dragger, { opacity: 0 }) //make the drag layer invisible
    .set(ring, { rotationY: 180 }) //set initial rotationY so the parallax jump happens off screen
    .set(".img", {
      // apply transform rotations to each image
      rotateY: (i) => i * -30,
      transformOrigin: "50% 50% 1000px",
      z: -1000,
      backfaceVisibility: "hidden",
    })
    .from(".img", {
      duration: 1.5,
      y: 200,
      opacity: 0,
      stagger: 0.1,
      ease: "expo",
    });

  Draggable.create(dragger, {
    onDragStart: (e) => {
      if (e.touches) e.clientX = e.touches[0].clientX;
      xPos = Math.round(e.clientX);
    },

    onDrag: (e) => {
      if (e.touches) e.clientX = e.touches[0].clientX;

      gsap.to(ring, {
        rotationY: "-=" + ((Math.round(e.clientX) - xPos) % 360),
        onUpdate: () => {
          gsap.set(".img", { backgroundPosition: (i) => getBgPos(i) });
        },
      });

      xPos = Math.round(e.clientX);
    },

    onDragEnd: () => {
      gsap.set(dragger, { x: 0, y: 0 }); // reset drag layer
    },
  });
});

function getBgPos(i) {
  return (
    (-gsap.utils.wrap(
      0,
      360,
      gsap.getProperty(ring, "rotationY") - 180 - i * 18
    ) /
      360) *
      400 +
    "px 0px"
  );
}
//-====================================




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