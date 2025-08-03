import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
import "../components/faq";

gsap.registerPlugin(ScrollTrigger);

jQuery(document).ready(function ($) {
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
      this.statSection = document.querySelector('.stat');
      this.statBg = document.querySelector('.stat-bg');
      this.statItems = document.querySelectorAll('.stat-item');
      this.counters = document.querySelectorAll('[data-count]');
      this.masterTimeline = null;
      this.currentCounterValues = {};
      this.hasAnimated = false; // Track if animation has run
      this.init();
    }

    init() {
      if (!this.statSection || !this.statBg || !this.counters.length) {
        console.error('Stat section, background, or counters not found');
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
        counter.textContent = '0';
        const rawValue = counter.getAttribute('data-count');
        const endValue = parseFloat(rawValue) || 0;
        this.currentCounterValues[index] = {
          current: 0,
          target: endValue,
          animObj: { value: 0 },
          element: counter,
        };
        console.log(`Counter ${index + 1} initialized with target: ${endValue}`);
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
              console.log('Stat section entered viewport, starting animation');
              this.masterTimeline.play();
              this.hasAnimated = true;
            }
          },
        },
      });

      // Phase 1: Background zoom
      this.masterTimeline.to(this.statBg, {
        scale: 1.2,
        filter: "brightness(0.8) contrast(1.2) saturate(1.1)",
        duration: 0.5,
        ease: "power1.inOut",
      }, 0.1);

      // Phase 2: Stat items fade in
      this.statItems.forEach((item, index) => {
        this.masterTimeline.to(item, {
          opacity: 1,
          scale: 1,
          y: 0,
          duration: 0.3,
          ease: "power3.out",
        }, 0.1 + index * 0.05);
      });

      // Phase 3: Counter animations
      this.counters.forEach((counter, index) => {
        const counterData = this.currentCounterValues[index];
        this.masterTimeline.to(counterData.animObj, {
          value: counterData.target,
          duration: 0.8,
          ease: "power2.out",
          onUpdate: () => {
            this.updateCounterDisplay(index, counterData.animObj.value);
          },
          onComplete: () => {
            this.updateCounterDisplay(index, counterData.target);
            console.log(`Counter ${index + 1} reached target: ${counterData.target}`);
          },
        }, 0.3 + index * 0.05);
      });
    }

    updateCounterDisplay(index, currentValue) {
      const counterData = this.currentCounterValues[index];
      const counter = counterData.element;
      const value = Math.floor(currentValue);
      const target = counterData.target;

      let displayValue;
      if (target >= 1000000) {
        displayValue = (value / 1000000).toFixed(1).replace(/\.0$/, '') + 'M';
      } else if (target >= 1000) {
        displayValue = (value / 1000).toFixed(1).replace(/\.0$/, '') + 'K';
      } else {
        displayValue = value.toString();
      }

      counter.textContent = displayValue;
      console.log(`Counter ${index + 1} display: ${displayValue} (value: ${value}, target: ${target})`);

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
        const glassBackground = document.createElement('div');
        glassBackground.className = 'glass-background';
        glassBackground.style.cssText = `
          position: absolute;
          text-align: center;
          left: 0px;
          right: 0px;
          top: 0px;
          bottom: 0px;
          width: 100%;
          background: rgba(255, 255, 255, 0.1);
          backdrop-filter: blur(10px);
          border-radius: 15px;
          border: 1px solid rgba(255, 255, 255, 0.2);
          opacity: 0;
          pointer-events: none;
          z-index: -1;
        `;
        
        item.style.position = 'relative';
        item.appendChild(glassBackground);

        const hoverTl = gsap.timeline({ paused: true });
        
        hoverTl.to(glassBackground, {
          opacity: 1,
          scale: 1.05,
          duration: 0.4,
          ease: "power2.out",
        });

        hoverTl.to(item, {
          y: -8,
          duration: 0.4,
          ease: "power2.out",
        }, 0);

        const numberEl = item.querySelector('[data-count]');
        if (numberEl) {
          hoverTl.to(numberEl, {
            scale: 1.05,
            duration: 0.4,
            ease: "power2.out",
          }, 0);
        }



        item.addEventListener('mouseenter', () => hoverTl.play());
        item.addEventListener('mouseleave', () => hoverTl.reverse());
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
      ScrollTrigger.getAll().forEach(trigger => trigger.disable());
      console.log('Scroll control paused');
    }

    resume() {
      ScrollTrigger.getAll().forEach(trigger => trigger.enable());
      console.log('Scroll control resumed');
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
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
      ScrollTrigger.refresh();
      console.log('ScrollTrigger refreshed');
    }, 300);
  });

  window.addEventListener('beforeunload', () => {
    ScrollTrigger.killAll();
    gsap.killTweensOf("*");
    console.log('Cleaned up ScrollTrigger and tweens');
  });
});