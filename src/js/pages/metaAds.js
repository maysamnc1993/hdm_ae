
document.addEventListener("DOMContentLoaded", () => {
  const el = document.getElementById("home-hero-video");

  // Ensure initial styles match
  el.style.transform = "translate(-32vw, 191.86px) rotate(-6deg)";
  el.style.width = "267.837px";
  el.style.height = "167.4px";
  el.style.position = "absolute"; // ensure transform works as expected

  window.addEventListener("scroll", () => {
    const scrollTop = window.scrollY;
    const maxScroll = window.innerHeight; // Animation over 1 screen height
    const progress = Math.min(scrollTop / maxScroll, 1); // Clamp from 0 to 1

    // -- Translate X: from -32vw to 0px
    const x = -32 
    const translateX = `${x}vw`;

    // -- Translate Y: from 191.86px to 100vh
    const startY = 191.86;
    const endY = window.innerHeight;
    const y = startY + (endY - startY) * progress;

    // -- Rotation: from -6deg to 0
    const rotate = -6 * (1 - progress);

    // -- Width: from 267.837px to 100vw
    const width = 267.837 + (window.innerWidth - 267.837) * progress;

    // -- Height: from 167.4px to 100vh
    const height = 167.4 + (window.innerHeight - 167.4) * progress;

    // Apply styles
    el.style.transform = `translate(${translateX}, ${y}px) rotate(${rotate}deg)`;
    el.style.width = `${width}px`;
    el.style.height = `${height}px`;
  });
});

