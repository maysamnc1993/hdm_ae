import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

import SimplexNoise from "simplex-noise";

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
  






    

  // Section 4: Scrolling cards
  const section = document.querySelector("#section4");
        const cards = [
            document.querySelector(".card1-section4"),
            document.querySelector(".card2-section4"),
            document.querySelector(".card3-section4"),
            document.querySelector(".card4-section4"),
        ];

        // Final top positions for each card
        const finalTops = [0, 70, 140, 210]; // in pixels

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
                // Linear interpolation: position = start + (end - start) * progress
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