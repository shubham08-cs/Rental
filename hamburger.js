document.addEventListener("DOMContentLoaded", function () {
  const hamburger = document.querySelector(".hamburger");
  const nav = document.querySelector("nav");
  const overlay = document.querySelector(".overlay");
  const body = document.body;

  if (hamburger && nav) {
    // Toggle menu
    hamburger.addEventListener("click", function (e) {
      e.stopPropagation();
      this.classList.toggle("active");
      nav.classList.toggle("active");
      if (overlay) overlay.classList.toggle("active");
      body.classList.toggle("no-scroll");
    });

    // Close when clicking outside
    document.addEventListener("click", function (e) {
      if (!nav.contains(e.target) && !hamburger.contains(e.target)) {
        hamburger.classList.remove("active");
        nav.classList.remove("active");
        if (overlay) overlay.classList.remove("active");
        body.classList.remove("no-scroll");
      }
    });

    // Close when clicking nav links
    document.querySelectorAll("nav a").forEach((link) => {
      link.addEventListener("click", () => {
        hamburger.classList.remove("active");
        nav.classList.remove("active");
        if (overlay) overlay.classList.remove("active");
        body.classList.remove("no-scroll");
      });
    });
  }
});
