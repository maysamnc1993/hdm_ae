import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
gsap.registerPlugin(ScrollTrigger);

import "../components/faq";

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
    const column3Wrapper = document.querySelector(".column-3 .content-wrapper");
    let contentChangeTimeout = null;

    function updateScrollPhase() {
      const rect = stickyContainer.getBoundingClientRect();
      const progress = Math.max(0, Math.min(1, -rect.top / (rect.height - window.innerHeight)));

      // Reset transformations, classes, and clear timeouts
      columns.forEach((col, index) => {
        col.style.transform = "none";
        col.style.opacity = "1";
        col.setAttribute("aria-hidden", index > 1 ? "true" : "false");
      });
      column2Wrapper.parentElement.classList.remove("image-changing");
      column3Wrapper.parentElement.classList.remove("content-changing", "content-changed");
      if (contentChangeTimeout) {
        clearTimeout(contentChangeTimeout);
        contentChangeTimeout = null;
      }

      // Define phase thresholds, transformations, and content changes
      const phases = [
        {
          range: [0.15, 0.3],
          transforms: [[0, "scale(0.8)", "0"], [1, "translateX(-100%)"], [2, "translateY(calc(-100vh - 10px))"]],
          actions: () => {
            column2Wrapper.parentElement.classList.add("image-changing");
          }
        },
        {
          range: [0.3, 0.45],
          transforms: [[0, "scale(0.8)", "0"], [1, "translateX(-100%) scale(0.8)", "0"], [2, "translateY(calc(-100vh - 10px)) translateX(calc(-100% - 10px))"], [3, "translateY(calc(-200vh - 20px))"]],
          actions: () => {
            column3Wrapper.parentElement.classList.add("content-changing");
            contentChangeTimeout = setTimeout(() => {
              column3Wrapper.innerHTML = `
                <h2>Step 2: Planning</h2>
                <p>With discoveries in hand, we now plan the next steps to bring our vision to life.</p>
              `;
              column3Wrapper.parentElement.classList.remove("content-changing");
              column3Wrapper.parentElement.classList.add("content-changed");
            }, 600);
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
        // Reset column-3 content immediately
        column3Wrapper.parentElement.classList.add("content-changing");
        contentChangeTimeout = setTimeout(() => {
          column3Wrapper.innerHTML = `
            <h3>Step 1: Discovery</h3>
            <p>This is the first hidden column that slides up to replace the image. We begin our journey with discovery and exploration of new possibilities.</p>
          `;
          column3Wrapper.parentElement.classList.remove("content-changing");
          column3Wrapper.parentElement.classList.add("content-changed");
        }, 600);
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
  






    

  // // Section 4: Scrolling cards
  // const section = document.querySelector("#section4");
  //       const cards = [
  //           document.querySelector(".card1-section4"),
  //           document.querySelector(".card2-section4"),
  //           document.querySelector(".card3-section4"),
  //           document.querySelector(".card4-section4"),
  //       ];

  //       // Final top positions for each card
  //       const finalTops = [0, 70, 140, 210]; // in pixels

  //       window.addEventListener("scroll", () => {
  //           const rect = section.getBoundingClientRect();
  //           const viewportHeight = window.innerHeight;

  //           // Total scrollable area inside sticky section
  //           const totalScroll = section.offsetHeight - viewportHeight;

  //           // Distance user has scrolled inside the section
  //           const scrolled = Math.min(Math.max(-rect.top, 0), totalScroll);

  //           // Progress as a value between 0 and 1
  //           const progress = scrolled / totalScroll;

  //           // Calculate top position for each card
  //           cards.forEach((card, index) => {
  //               // Start at 100vh, end at finalTops[index]
  //               const startPos = viewportHeight;
  //               const endPos = finalTops[index];
  //               // Linear interpolation: position = start + (end - start) * progress
  //               // Adjust progress to spread animation across scroll
  //               const cardProgress = Math.min(Math.max((progress - 0.2 * index) / 0.2, 0), 1);
  //               const topPos = startPos + (endPos - startPos) * cardProgress;
  //               card.style.top = `${topPos}px`;
  //           });
  //       });



  
// Section 4: Scrolling cards
const section = document.querySelector("#section4");
const cards = document.querySelectorAll(".card");
const viewportHeight = window.innerHeight;

// تنظیمات قابل تغییر
const initialOffset = 20; // فاصله اولیه کارت‌ها از بالای ویوپورت (در پیکسل)
const cardSpacing = 70; // فاصله بین کارت‌ها در موقعیت نهایی (در پیکسل)
const animationDuration = 0.25; // مدت زمان انیمیشن هر کارت (بخشی از اسکرول)

// موقعیت‌های نهایی کارت‌ها
const finalTops = Array.from(cards).map((_, index) => index * cardSpacing);

window.addEventListener("scroll", () => {
    const rect = section.getBoundingClientRect();
    const totalScroll = section.offsetHeight - viewportHeight;
    const scrolled = Math.min(Math.max(-rect.top, 0), totalScroll);
    const progress = scrolled / totalScroll;

    cards.forEach((card, index) => {
        // شروع و پایان انیمیشن برای هر کارت
        const startProgress = index * animationDuration; // زمان شروع انیمیشن کارت
        const endProgress = startProgress + animationDuration; // زمان پایان انیمیشن
        const cardProgress = Math.min(Math.max((progress - startProgress) / animationDuration, 0), 1);

        // موقعیت اولیه (خارج از دید یا نزدیک بالای ویوپورت)
        const startPos = initialOffset + viewportHeight * 0.5; // شروع از وسط ویوپورت
        const endPos = finalTops[index]; // موقعیت نهایی

        // محاسبه موقعیت فعلی کارت
        const topPos = startPos + (endPos - startPos) * cardProgress;
        card.style.top = `${topPos}px`;

        // تنظیم opacity برای ظاهر شدن تدریجی
        card.style.opacity = cardProgress;
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



//  Feature Benefit

var lastScrollTop = 0;
var ScrolledRight = 0;
var FeaturesBox = Number(jQuery(".FeaturesBox").offset().top);
jQuery(document).scroll(function(e) {
    var st = jQuery(this).scrollTop();
    var scrolled = jQuery(this).scrollTop();

   jQuery(".features_items .feature_item").each(function(){

      var position_item = Number(jQuery(this).offset().top) - 600;
      if(st > position_item){
        jQuery(this).addClass("active");
      }else{
        jQuery(this).removeClass("active");
      }

   });


    // Scroll Down
    if(st > lastScrollTop){

     

    }

    // Scroll Up
    else{

    }
    lastScrollTop = st;
});





//  Feature Benefit

var lastScrollTop = 0;
var ScrolledRight = 0;
var SectionListsItem = Number(jQuery(".SectionListsItem").offset().top);
jQuery(document).scroll(function(e) {
    var st = jQuery(this).scrollTop();
    var scrolled = jQuery(this).scrollTop();


    if(st > SectionListsItem){
    
      var time_step = 0;
      jQuery(".SectionListsItem .Lists_item .item").each(function(){

          time_step+= 500;
          var This_Item = jQuery(this);
          setTimeout(function(){
              This_Item.addClass("active");
          },time_step);

      })
      
    }



    // Scroll Down
    if(st > lastScrollTop){

     

    }

    // Scroll Up
    else{

    }
    lastScrollTop = st;
});
