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

// jQuery(document).ready(function ($) {
//   window.addEventListener("load", () => {
//     const el = document.getElementById("home-hero-video");
//     const scrollInfo = document.getElementById("scroll-info");
//     const scrollHeightDiv = document.querySelector(".scroll-height");

//     if (!el) {
//       console.error("Element with ID 'home-hero-video' not found!");
//       return;
//     }
//     if (!scrollHeightDiv) {
//       console.error("Element with class 'scroll-height' not found!");
//       return;
//     }

//     // Initial styles (حالت اولیه)
//     el.style.setProperty("transform", "translate(-50%, -50%) rotate(10deg)", "important");
//     el.style.setProperty("width", "150px", "important");
//     el.style.setProperty("height", "300px", "important");
//     el.style.setProperty("position", "fixed", "important");
//     el.style.setProperty("left", "50%", "important");
//     el.style.setProperty("top", "50%", "important");
//     el.style.setProperty("border-radius", "50px", "important");
//     el.style.setProperty("overflow", "hidden", "important");

//     // Scroll behavior
//     window.addEventListener("scroll", () => {
//       const scrollY = window.scrollY;
//       if (scrollInfo) scrollInfo.textContent = `Scroll: ${scrollY.toFixed(0)}`;

//       const scrollFactor = scrollY * 0.1;

//       // Base values
//       const baseWidth = 150;
//       const baseHeight = 300;
//       const baseRotate = 10;
//       const baseRadius = 50;

//       // Width & Height افزایش تا کل صفحه
//       const width = Math.min(baseWidth + scrollFactor * 20, window.innerWidth);
//       const height = Math.min(baseHeight + scrollFactor * 15, window.innerHeight);

//       // Border radius کم‌کم صفر بشه
//       const borderRadius = Math.max(baseRadius - scrollFactor * 2, 0);

//       // Rotate کم‌کم صاف بشه
//       const rotateDeg = Math.max(baseRotate - scrollFactor * 0.5, 0);

//       // Sticky threshold
//       const scrollHeightBottom = scrollHeightDiv.offsetTop + scrollHeightDiv.offsetHeight;
//       const stickyThreshold = scrollHeightBottom - window.innerHeight / 2;

//       if (scrollY >= stickyThreshold) {
//         el.style.setProperty("position", "absolute", "important");
//         el.style.setProperty("top", `${scrollHeightBottom}px`, "important");
//       } else {
//         el.style.setProperty("position", "fixed", "important");
//         el.style.setProperty("top", "50%", "important");
//       }

//       // اعمال تغییرات
//       el.style.setProperty("width", `${width}px`, "important");
//       el.style.setProperty("height", `${height}px`, "important");
//       el.style.setProperty("border-radius", `${borderRadius}px`, "important");
//       el.style.setProperty("transform", `translate(-50%, -50%) rotate(${rotateDeg}deg)`, "important");

//       console.log("Width:", width, "Height:", height, "BorderRadius:", borderRadius, "Rotate:", rotateDeg);
//     });
//   });

//   // Caption toggle
//   window.addEventListener("scroll", function () {
//     const caption = document.querySelector("span.video-caption");
//     const scrollY = window.scrollY || window.pageYOffset;

//     if (caption) {
//       caption.style.display = scrollY > 500 ? "block" : "none";
//     }
//   });
// });

// jQuery(document).ready(function ($) {
//   window.addEventListener("load", () => {
//     const el = document.getElementById("home-hero-video");
//     const scrollInfo = document.getElementById("scroll-info");
//     const scrollHeightDiv = document.querySelector(".scroll-height");
//     const caption = document.querySelector("span.video-caption");

//     if (!el || !scrollHeightDiv) return;

//     // Initial styles
//     el.style.setProperty("transform", "translate(-50%, -50%) rotate(10deg)", "important");
//     el.style.setProperty("width", "150px", "important");
//     el.style.setProperty("height", "300px", "important");
//     el.style.setProperty("position", "fixed", "important");
//     el.style.setProperty("left", "50%", "important");
//     el.style.setProperty("top", "50%", "important");
//     el.style.setProperty("border-radius", "50px", "important");
//     el.style.setProperty("overflow", "hidden", "important");

//     // Scroll behavior
//     window.addEventListener("scroll", () => {
//       const scrollY = window.scrollY;
//       if (scrollInfo) scrollInfo.textContent = `Scroll: ${scrollY.toFixed(0)}`;

//       const scrollFactor = scrollY * 0.1;

//       const baseWidth = 150;
//       const baseHeight = 300;
//       const baseRotate = 10;
//       const baseRadius = 50;

//       const width = Math.min(baseWidth + scrollFactor * 20, window.innerWidth);
//       const height = Math.min(baseHeight + scrollFactor * 15, window.innerHeight);
//       const borderRadius = Math.max(baseRadius - scrollFactor * 2, 0);
//       const rotateDeg = Math.max(baseRotate - scrollFactor * 0.5, 0);

//       const scrollHeightBottom = scrollHeightDiv.offsetTop + scrollHeightDiv.offsetHeight;
//       const stickyThreshold = scrollHeightBottom - window.innerHeight / 2;

//       if (scrollY >= stickyThreshold) {
//         el.style.setProperty("position", "absolute", "important");
//         el.style.setProperty("top", `${scrollHeightBottom}px`, "important");
//         el.style.setProperty("width", `${Math.min(window.innerWidth, baseWidth + stickyThreshold * 2)}px`, "important");
//         el.style.setProperty("height", `${Math.min(window.innerHeight, baseHeight + stickyThreshold * 1.5)}px`, "important");
//         el.style.setProperty("border-radius", `0px`, "important");
//         el.style.setProperty("transform", `translate(-50%, -50%) rotate(0deg)`, "important");
//       } else {
//         el.style.setProperty("position", "fixed", "important");
//         el.style.setProperty("top", "50%", "important");
//         el.style.setProperty("width", `${width}px`, "important");
//         el.style.setProperty("height", `${height}px`, "important");
//         el.style.setProperty("border-radius", `${borderRadius}px`, "important");
//         el.style.setProperty("transform", `translate(-50%, -50%) rotate(${rotateDeg}deg)`, "important");
//       }

//       // Caption toggle
//       if (caption) {
//         caption.style.display = scrollY > 500 ? "block" : "none";
//       }
//     });
//   });
// });



// -------------------- تنظیمات --------------------



// -------------------- تنظیمات --------------------




// -------------------- تنظیمات --------------------

const TEXT_START_OFFSET = 1;   // شروع رشد متن بعد از 100px
const VIDEO_SCALE_START = 0.9;   // اسکیل اولیه ویدیو در سکشن 1
const VIDEO_SCALE_END   = 1.2;   // اسکیل نهایی ویدیو (لحظه‌ی تحویل)

// -------------------- اسکریپت --------------------
window.addEventListener("load", () => {
  const svg          = document.querySelector(".video-mask");
  const video        = document.getElementById("home-hero-video");
  const maskText     = document.getElementById("mask-text");
  const maskFullRect = document.getElementById("mask-fullrect");
  const section1     = document.querySelector(".section-1");
  const section2     = document.querySelector(".section-2");

  if (!svg || !video || !maskText || !maskFullRect || !section1 || !section2) {
    console.error("Required elements not found. Check your HTML structure.");
    return;
  }

  // پایه‌های متن
  const FONT_SIZE_BASE = 420;
  const FONT_SIZE_GROW = 320;
  const LETTER_BASE    = 8;

  const clamp = (v, min, max) => Math.min(max, Math.max(min, v));

  // حالت‌ها
  let mode = "hero"; // 'hero' (سکشن ۱ استیکی) | 'full' (سکشن ۲ فول) | 'hidden' (بعد از سکشن ۲)
  let layout = { s1Top: 0, s2Top: 0, handoffY: 0, s2End: 0 };

  function computeLayout() {
    const docY = window.scrollY;
    // موقعیت مطلق نسبت به کل صفحه
    const s1Rect = section1.getBoundingClientRect();
    const s2Rect = section2.getBoundingClientRect();

    const s1TopAbs = s1Rect.top + docY;
    const s2TopAbs = s2Rect.top + docY;

    // نقطه‌ی تحویل: وقتی پایین ویوپرت دقیقاً به ابتدای سکشن ۲ می‌رسد
    // یعنی scrollY = s2TopAbs - window.innerHeight
    const handoffY = s2TopAbs - window.innerHeight;

    layout = {
      s1Top: s1TopAbs,
      s2Top: s2TopAbs,
      handoffY,
      s2End: s2TopAbs + section2.offsetHeight // پایان سکشن ۲
    };
  }

  function setHeroMode() {
    if (mode === "hero") return;
    mode = "hero";
    svg.style.display = "";
    svg.classList.add("in-hero");
    svg.classList.remove("fullscreen-fixed");
    maskFullRect.setAttribute("opacity", "0");
    maskText.setAttribute("fill-opacity", "1");
  }

  function setFullMode() {
    if (mode === "full") return;
    mode = "full";
    svg.style.display = "";
    svg.classList.remove("in-hero");
    svg.classList.add("fullscreen-fixed"); // position: fixed; inset:0 در CSS
    maskFullRect.setAttribute("opacity", "1");
    maskText.setAttribute("fill-opacity", "0");
    video.style.transform = `scale(${VIDEO_SCALE_END})`;
    video.style.transformOrigin = "50% 50%";
  }

  function setHiddenMode() {
    if (mode === "hidden") return;
    mode = "hidden";
    svg.style.display = "none"; // ویدیو بعد از سکشن ۲ محو می‌شود تا فاصله نیفتد
  }

  function updateHeroProgress() {
    const y = window.scrollY;
  
    // پیشروی از ابتدای سکشن ۱ تا handoff
    const span = Math.max(1, layout.handoffY - layout.s1Top);
    const p = clamp((y - layout.s1Top) / span, 0, 1); // 0..1 دقیقاً تا handoffY
  
    // اسکیل ویدیو
    const scale = VIDEO_SCALE_START + (VIDEO_SCALE_END - VIDEO_SCALE_START) * p;
    video.style.transform = `scale(${scale})`;
    video.style.transformOrigin = "50% 50%";
  
    // رشد متن از 100px بعد از شروع
    const textSpan = Math.max(1, (layout.handoffY - (layout.s1Top + TEXT_START_OFFSET)));
    const pText = clamp((y - (layout.s1Top + TEXT_START_OFFSET)) / textSpan, 0, 1);
    const fontSize = FONT_SIZE_BASE + FONT_SIZE_GROW * pText;
    const letter   = Math.max(0, LETTER_BASE * (1 - pText));
  
    maskText.setAttribute("font-size", fontSize.toFixed(1));
    maskText.setAttribute("letter-spacing", letter.toFixed(2));
  
    // 👇 تغییر اینجاست: opacity متن از 0.5 → 1
    const textOpacity = 0.3 + 0.5 * p; 
    maskText.setAttribute("fill-opacity", textOpacity.toFixed(3));
  
    // هنوز کل ویدیو نمایان نشود
    maskFullRect.setAttribute("opacity", "0");
  }
  

  function onScroll() {
    const y = window.scrollY;

    // 1) قبل از handoff → هیرو (استیکی) بدون فاصله‌ی اضافی
    if (y < layout.handoffY) {
      setHeroMode();
      updateHeroProgress();
      return;
    }

    // 2) بین handoff و انتهای سکشن ۲ → فول‌اسکرین ثابت
    if (y >= layout.handoffY && y < layout.s2End) {
      setFullMode();
      return;
    }

    // 3) بعد از پایان سکشن ۲ → مخفی
    setHiddenMode();
  }

  // آغاز
  computeLayout();
  setHeroMode();
  onScroll();

  window.addEventListener("scroll", onScroll, { passive: true });
  window.addEventListener("resize", () => {
    computeLayout();
    onScroll();
  });
});






var i = 0;
setInterval(function(){
  i++;
  jQuery(".circle_effect_1").css("transform","rotate("+ i +"deg)");
  // jQuery(".circle_effect_2").css("transform","rotate(-"+ i +"deg)");
},10);




(function(){
  const wrapper = document.querySelector('.logo-scroller');
  if(!wrapper) return;

  // سرعت پیکسل/ثانیه – قابل تنظیم از data-speed
  const speed = Math.max(20, parseFloat(wrapper.getAttribute('data-speed')) || 120);

  // 1) یک ظرف "tape" بساز و UL موجود را داخلش بگذار
  const ul = wrapper.querySelector('.Customer_Gallery');
  if(!ul) return;

  const tape = document.createElement('div');
  tape.className = 'tape';
  wrapper.appendChild(tape);
  tape.appendChild(ul);

  // 2) یک کلون از UL بساز تا نوار دوبخشی شود (برای لوپ بی‌درز)
  const clone = ul.cloneNode(true);
  tape.appendChild(clone);

  // 3) مدت انیمیشن را از روی عرض «یک سگمنت» و سرعت محاسبه کن
  function setDuration(){
    // اطمینان از محاسبه‌ی دقیق بعد از لود تصویر
    const segWidth = ul.getBoundingClientRect().width; // عرض یک لیست
    if(segWidth > 0){
      const seconds = segWidth / speed; // زمان لازم برای طی‌کردن یک سگمنت
      wrapper.style.setProperty('--duration', `${seconds}s`);
    }
  }

  // وقتی تصاویر لود شدند یا تغییر اندازه رخ داد، مدت را دوباره محاسبه کن
  const imgs = ul.querySelectorAll('img');
  let pending = imgs.length;
  const done = () => setDuration();

  if(pending === 0) done();
  imgs.forEach(img=>{
    if(img.complete) { if(--pending === 0) done(); }
    else{
      img.addEventListener('load', ()=>{ if(--pending === 0) done(); });
      img.addEventListener('error', ()=>{ if(--pending === 0) done(); });
    }
  });

  // محاسبه مجدد روی ریسایز با حداقل کار
  let t;
  window.addEventListener('resize', () => {
    clearTimeout(t);
    t = setTimeout(setDuration, 150);
  });
})();




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