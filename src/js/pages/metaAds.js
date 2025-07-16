window.addEventListener("load", () => {
    const el = document.getElementById("home-hero-video");
    const scrollInfo = document.getElementById("scroll-info");

    if (!el) {
        console.error("Element with ID 'home-hero-video' not found!");
        return;
    }

    // Initial styles
    el.style.setProperty("transform", "translate(-32vw, 191.86px) rotate(-6deg)", "important");
    el.style.setProperty("width", "267.837px", "important");
    el.style.setProperty("height", "167.4px", "important");
    el.style.setProperty("position", "absolute", "important");

    // Scroll behavior
    window.addEventListener("scroll", () => {
        const scrollFactor = scrollY * 0.1;

        const translateX = -32 + scrollFactor;
        const translateY = 191.86 + scrollFactor;
        const rotateDeg = -6 + scrollFactor;
        const width = 267.837 + scrollFactor*10;
        const height = 167.4 + scrollFactor*10;

        const transformString = `translate(${translateX}vw, ${translateY}px) rotate(${rotateDeg}deg)`;

        el.style.setProperty("transform", transformString, "important");
        el.style.setProperty("width", `${width}px`, "important");
        el.style.setProperty("height", `${height}px`, "important");

        console.log("Transform applied:", transformString);
    });
});
