document.addEventListener("DOMContentLoaded", function () {
  // Get the sticky header height (adjust selector to match your theme's header)
  const header = document.querySelector("header.sticky, .sticky-header"); // Replace with your header's selector
  const headerHeight = header ? header.offsetHeight : 0;

  // Smooth scroll with offset for TOC links
  const tocLinks = document.querySelectorAll(".toc-link");
  tocLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const targetId = this.getAttribute("href").substring(1);
      const targetElement = document.getElementById(targetId);
      if (targetElement) {
        const offsetTop =
          targetElement.getBoundingClientRect().top +
          window.pageYOffset -
          headerHeight -
          20; // Extra 20px for padding
        window.scrollTo({
          top: offsetTop,
          behavior: "smooth",
        });
      }
    });
  });

  // Highlight active TOC item on scroll
  const sections = document.querySelectorAll("h2[id], h3[id]");
  const observerOptions = {
    root: null,
    rootMargin: `-${headerHeight}px 0px 0px 0px`, // Adjust for header height
    threshold: 0.1, // Trigger when 10% of section is visible
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      const id = entry.target.getAttribute("id");
      const tocLink = document.querySelector(`.toc-link[href="#${id}"]`);
      if (entry.isIntersecting) {
        tocLinks.forEach((link) =>
          link
            .querySelector(".line-link-el")
            .classList.remove("line-link-el-active")
        );
        if (tocLink) {
          tocLink
            .querySelector(".line-link-el")
            .classList.add("line-link-el-active");
        }
      }
    });
  }, observerOptions);

  sections.forEach((section) => observer.observe(section));

  // Cleanup observer on page unload
  window.addEventListener("unload", () => {
    sections.forEach((section) => observer.unobserve(section));
  });
});
