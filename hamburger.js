
  const hamburger = document.querySelector(".hamburger");
  const nav = document.querySelector("nav");
  const overlay = document.querySelector(".nav-overlay");
  const navLinks = document.querySelectorAll("nav a");

  // Toggle menu
  hamburger.addEventListener("click", () => {
    hamburger.classList.toggle("active");
    nav.classList.toggle("active");
    overlay.classList.toggle("active");
  });

  // Close when overlay is clicked
  overlay.addEventListener("click", () => {
    hamburger.classList.remove("active");
    nav.classList.remove("active");
    overlay.classList.remove("active");
  });

  // Close when any nav link is clicked
  navLinks.forEach(link => {
    link.addEventListener("click", () => {
      hamburger.classList.remove("active");
      nav.classList.remove("active");
      overlay.classList.remove("active");
    });
  });


