import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
import ScrollSmoother from "gsap/ScrollSmoother";
import SimplexNoise from "simplex-noise";

import '../components/faq'

gsap.registerPlugin(ScrollTrigger, ScrollSmoother);

jQuery(document).ready(function ($) {
  window.addEventListener("load", () => {
    const el = document.getElementById("home-hero-video");
    const scrollInfo = document.getElementById("scroll-info");

    if (!el) {
      console.error("Element with ID 'home-hero-video' not found!");
      return;
    }

    // Initial styles
    el.style.setProperty("transform", "translate(-35vw, 190px) rotate(-6deg)", "important");
    el.style.setProperty("width", "15vw", "important");
    el.style.setProperty("height", "30vh", "important");
    el.style.setProperty("position", "absolute", "important");

    // Scroll behavior
    window.addEventListener("scroll", () => {
      const scrollY = window.scrollY;
      if (scrollInfo) scrollInfo.textContent = `Scroll: ${scrollY.toFixed(0)}`;

      const scrollFactor = scrollY * 0.1;

      // Base values
      const baseX = -35;
      const baseY = 190;
      const baseRotate = -6;
      const baseWidth = 15;
      const baseHeight = 30;

      // Calculated values with limits
      const translateX = Math.min(baseX + scrollFactor * 0.5, 0);
      const translateY = Math.min(baseY + scrollFactor * 10, 750);
      const rotateDeg = Math.min(baseRotate + scrollFactor * 0.1, 0);
      const width = Math.min(baseWidth + scrollFactor * 1.2, 100);
      const height = Math.min(baseHeight + scrollFactor, 100);

      const transformString = `translate(${translateX}vw, ${translateY}px) rotate(${rotateDeg}deg)`;

      el.style.setProperty("transform", transformString, "important");
      el.style.setProperty("width", `${width}vw`, "important");
      el.style.setProperty("height", `${height}vh`, "important");

      console.log("Transform applied:", transformString);
    });
  });

  window.addEventListener("scroll", function () {
    const caption = document.querySelector("span.video-caption");
    const scrollY = window.scrollY || window.pageYOffset;

    if (scrollY > 500) {
      caption.style.display = "block";
    } else {
      caption.style.display = "none";
    }
  });

  // Section 3: Business model section
 const stickySection = document.getElementById("stickySection");
    const stickyContainer = document.querySelector(".sticky-container");
    const columns = Array.from(document.querySelectorAll(".column-1, .column-2, .column-3, .column-4, .column-5, .column-6, .column-7"));
    const column2Wrapper = document.querySelector(".column-2 .image-wrapper");
    const column3Items = document.querySelectorAll(".column-3 .content-item");

    function updateScrollPhase() {
      const rect = stickyContainer.getBoundingClientRect();
      const progress = Math.max(0, Math.min(1, -rect.top / (rect.height - window.innerHeight)));

      // Reset transformations and aria attributes
      columns.forEach((col, index) => {
        col.style.transform = "none";
        col.style.opacity = "1";
        col.setAttribute("aria-hidden", index > 1 ? "true" : "false");
      });
      column2Wrapper.parentElement.classList.remove("image-changing");

      // Reset content items
      column3Items.forEach(item => item.classList.remove("active"));

      // Define phase thresholds and transformations
      const phases = [
        {
          range: [0.15, 0.3],
          transforms: [[0, "scale(0.8)", "0"], [1, "translateX(-100%)"], [2, "translateY(calc(-100vh - 10px))"]],
          actions: () => {
            column2Wrapper.parentElement.classList.add("image-changing");
            column3Items[0].classList.add("active");
          }
        },
        {
          range: [0.3, 0.45],
          transforms: [[0, "scale(0.8)", "0"], [1, "translateX(-100%) scale(0.8)", "0"], [2, "translateY(calc(-100vh - 10px)) translateX(calc(-100% - 10px))"], [3, "translateY(calc(-200vh - 20px))"]],
          actions: () => {
            column3Items[1].classList.add("active");
          }
        },
        {
          range: [0.45, 0.6],
          transforms: [[0, "scale(0.8)", "0"], [1, "translateX(-100%) scale(0.8)", "0"], [2, "translateY(calc(-100vh - 10px)) translateX(calc(-100% - 10px)) scale(0.8)", "0"], [3, "translateY(calc(-200vh - 20px)) translateX(calc(-100% - 10px))"], [4, "translateY(calc(-300vh - 30px))"]]
        },
        {
          range: [0.6, 0.75],
          transforms: [[0, "scale(0.8)", "0"], [1, "translateX(-100%) scale(0.8)", "0"], [2, "translateY(calc(-100vh - 10px)) translateX(calc(-100% - 10px)) scale(0.8)", "0"], [3, "translateY(calc(-200vh - 20px)) translateX(calc(-100% - 10px)) scale(0.8)", "0"], [4, "translateY(calc(-300vh - 30px)) translateX(calc(-100% - 10px))"], [5, "translateY(calc(-400vh - 40px))"]]
        },
        {
          range: [0.75, 1],
          transforms: [[0, "scale(0.8)", "0"], [1, "translateX(-100%) scale(0.8)", "0"], [2, "translateY(calc(-100vh - 10px)) translateX(calc(-100% - 10px)) scale(0.8)", "0"], [3, "translateY(calc(-200vh - 20px)) translateX(calc(-100% - 10px)) scale(0.8)", "0"], [4, "translateY(calc(-300vh - 30px)) translateX(calc(-100% - 10px)) scale(0.8)", "0"], [5, "translateY(calc(-400vh - 40px)) translateX(calc(-100% - 10px))"], [6, "translateY(calc(-500vh - 50px))"]]
        }
      ];

      // Apply transformations and actions for the current phase
      const activePhase = phases.find(({ range }) => progress > range[0] && progress <= range[1]);
      if (activePhase) {
        activePhase.transforms.forEach(([index, transform, opacity]) => {
          if (columns[index]) {
            columns[index].style.transform = transform;
            if (opacity !== undefined) columns[index].style.opacity = opacity;
            columns[index].setAttribute("aria-hidden", index > 1 && index <= activePhase.transforms.length ? "false" : "true");
          }
        });
        if (activePhase.actions) activePhase.actions();
      } else {
        column3Items[0].classList.add("active");
      }
    }

    const observer = new IntersectionObserver(
      (entries) => entries.forEach(updateScrollPhase),
      { threshold: [0, 0.15, 0.3, 0.45, 0.6, 0.75, 1], rootMargin: "0px" }
    );

    observer.observe(stickyContainer);

    let ticking = false;
    function onScroll() {
      if (!ticking) {
        requestAnimationFrame(() => {
          updateScrollPhase();
          ticking = false;
        });
        ticking = true;
      }
    }
    window.addEventListener("scroll", onScroll);

    // Keyboard navigation
    window.addEventListener("keydown", (e) => {
      if (e.key === "ArrowDown" || e.key === "ArrowUp") {
        const rect = stickyContainer.getBoundingClientRect();
        const progress = Math.max(0, Math.min(1, -rect.top / (rect.height - window.innerHeight)));
        const phases = [
          { range: [0.15, 0.3] }, { range: [0.3, 0.45] }, { range: [0.45, 0.6] },
          { range: [0.6, 0.75] }, { range: [0.75, 1] }
        ];
        const currentPhase = phases.findIndex(({ range }) => progress > range[0] && progress <= range[1]);
        const nextPhase = e.key === "ArrowDown" ? Math.min(currentPhase + 1, phases.length - 1) : Math.max(currentPhase - 1, -1);
        const scrollPosition = nextPhase === -1 ? stickyContainer.offsetTop : stickyContainer.offsetTop + (phases[nextPhase].range[0] * (stickyContainer.offsetHeight - window.innerHeight));
        window.scrollTo({ top: scrollPosition, behavior: "smooth" });
      }
    });

    document.documentElement.style.scrollBehavior = "smooth";
  






    

  const section = document.querySelector("#section4");
const cards = Array.from(document.querySelectorAll(".card"));

// Calculate final top positions dynamically (70px gap between cards)
const finalTops = cards.map((_, index) => index * 70);

window.addEventListener("scroll", () => {
    const rect = section.getBoundingClientRect();
    const viewportHeight = window.innerHeight;

    // Total scrollable area inside sticky section
    const totalScroll = section.offsetHeight - viewportHeight;

    // Distance user has scrolled inside the section
    const scrolled = Math.min(Math.max(-rect.top, 0), totalScroll);

    // Progress as a value between 0 and 1
    const progress = scrolled / totalScroll;

    // Calculate top position for each card
    cards.forEach((card, index) => {
        // Start at 100vh, end at finalTops[index]
        const startPos = viewportHeight;
        const endPos = finalTops[index];
        // Adjust progress to spread animation across scroll
        const cardProgress = Math.min(Math.max((progress - 0.2 * index) / 0.2, 0), 1);
        const topPos = startPos + (endPos - startPos) * cardProgress;
        card.style.top = `${topPos}px`;
    });
});


  

  /*------------------------------
  Making some circles noise
  ------------------------------*/
  const content = document.querySelector("#content");
  const simplex = new SimplexNoise();

  for (let i = 0; i < 5000; i++) {
    const div = document.createElement("div");
    div.classList.add("circle");
    const n1 = simplex.noise2D(i * 0.003, i * 0.0033);
    const n2 = simplex.noise2D(i * 0.002, i * 0.001);

    const style = {
      transform: `translate(${n2 * 200}px) rotate(${n2 * 270}deg) scale(${3 + n1 * 2}, ${3 + n2 * 2})`,
      boxShadow: `0 0 0 .2px hsla(${Math.floor(i * 0.3)}, 70%, 70%, .6)`,
    };
    Object.assign(div.style, style);
    content.appendChild(div);
  }
  const Circles = document.querySelectorAll(".circle");

  /*------------------------------
  Init ScrollSmoother
  ------------------------------*/
  const scrollerSmoother = ScrollSmoother.create({
    content: content,
    wrapper: "#wrapper",
    smooth: 1,
    effects: false,
  });

  /*------------------------------
  Scroll Trigger
  ------------------------------*/
  const main = gsap.timeline({
    scrollTrigger: {
      scrub: 0.7,
      start: "top 25%",
      end: "bottom bottom",
    },
  });
  Circles.forEach((circle) => {
    main.to(circle, {
      opacity: 1,
    });
  });

  // End
});


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