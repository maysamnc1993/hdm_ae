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
    const translateX = Math.min(baseX + scrollFactor*0.5, 0);              // Max X: 0vw
    const translateY = Math.min(baseY + scrollFactor*10, 750);            // Max Y: 250px
    const rotateDeg  = Math.min(baseRotate + scrollFactor*0.1, 0);        // Max rotation: 10deg
    const width      = Math.min(baseWidth + scrollFactor*1.2, 100);        // Max width: 350px
    const height     = Math.min(baseHeight + scrollFactor, 100);       // Max height: 220px

    const transformString = `translate(${translateX}vw, ${translateY}px) rotate(${rotateDeg}deg)`;

    el.style.setProperty("transform", transformString, "important");
    el.style.setProperty("width", `${width}vw`, "important");
    el.style.setProperty("height", `${height}vh`, "important");

    console.log("Transform applied:", transformString);
    });
});

  window.addEventListener('scroll', function () {
    const caption = document.querySelector('span.video-caption');
    const scrollY = window.scrollY || window.pageYOffset;

    if (scrollY > 500) {
      caption.style.display = 'block';  // Show the caption
    } else{
        caption.style.display = 'none';   // Hide the caption
    }
  });
