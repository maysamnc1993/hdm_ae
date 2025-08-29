import gsap from "gsap";
jQuery(document).ready(function ($) {
  // GSAP Animation for content fade-in
  gsap.from(".content", {
    opacity: 0,
    y: 50,
    duration: 1,
    ease: "power2.out",
    delay: 0.5,
  });

  // GSAP Animation for images
  gsap.from(".image-stack img", {
    opacity: 0,
    scale: 0.8,
    duration: 0.8,
    stagger: 0.2,
    ease: "back.out(1.7)",
    delay: 0.8,
  });

  // GSAP Animation for button hover
  $(".content a").hover(
    function () {
      gsap.to(this, {
        scale: 1.05,
        duration: 0.3,
        ease: "power2.out",
      });
    },
    function () {
      gsap.to(this, {
        scale: 1,
        duration: 0.3,
        ease: "power2.out",
      });
    }
  );

  // GSAP Animation for changing gradient colors
  const colors = [
    {
      r: 255,
      g: 255,
      b: 255,
      a: 0.1,
    }, // White-ish
    {
      r: 235,
      g: 44,
      b: 80,
      a: 0.3,
    }, // Red-ish
    {
      r: 242,
      g: 146,
      b: 32,
      a: 0.3,
    }, // Orange-ish
    {
      r: 254,
      g: 228,
      b: 53,
      a: 0.3,
    }, // Yellow-ish
    {
      r: 101,
      g: 191,
      b: 114,
      a: 0.3,
    }, // Green-ish
    {
      r: 71,
      g: 136,
      b: 200,
      a: 0.3,
    }, // Blue-ish
  ];

  let currentIndex = 0;

  function animateGradient() {
    const nextIndex = (currentIndex + 1) % colors.length;
    const currentColor = colors[currentIndex];
    const nextColor = colors[nextIndex];

    gsap.to("#gradient-overlay", {
      duration: 3,
      background: `radial-gradient(circle at 50% 50%, rgba(${nextColor.r}, ${nextColor.g}, ${nextColor.b}, ${nextColor.a}) 0%, rgba(0, 0, 0, 0.5) 70%)`,
      ease: "sine.inOut",
      onComplete: () => {
        currentIndex = nextIndex;
        animateGradient();
      },
    });
  }

  // Start the gradient animation
  animateGradient();
});
