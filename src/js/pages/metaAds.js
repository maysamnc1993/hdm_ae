  const target = document.getElementById("home-hero-video");

  let scrollAmount = 0;

  window.addEventListener("scroll", () => {
    const delta = window.scrollY - scrollAmount;
    if (delta > 0) {
      incrementStyles(target);
    }
    scrollAmount = window.scrollY;
  });

  function incrementStyles(el) {
    const style = el.getAttribute("style");
    const updatedStyle = style.replace(/([-+]?\d*\.?\d+)(vh|vw|deg|px)?/g, (match, num, unit) => {
      const newVal = parseFloat(num) + 1;
      return newVal + (unit || "");
    });
    el.setAttribute("style", updatedStyle);
  }