const hamburger = document.querySelector('.hamburger');
  const nav = document.querySelector('nav');

  hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('active');
    nav.classList.toggle('active');
  });




document.addEventListener('DOMContentLoaded', function () {
  const hamburger = document.querySelector('.hamburger');
  const nav = document.querySelector('nav');
  const overlay = document.querySelector('.overlay');
  const body = document.body;

  // Toggle menu
  hamburger.addEventListener('click', function () {
    this.classList.toggle('active');
    nav.classList.toggle('active');
    overlay.classList.toggle('active');
    body.classList.toggle('no-scroll');
  });

  // Close menu on overlay click
  overlay.addEventListener('click', function () {
    this.classList.remove('active');
    hamburger.classList.remove('active');
    nav.classList.remove('active');
    body.classList.remove('no-scroll');
  });

  // Close menu when clicking a nav link
  document.querySelectorAll('nav a').forEach(link => {
    link.addEventListener('click', () => {
      hamburger.classList.remove('active');
      nav.classList.remove('active');
      overlay.classList.remove('active');
      body.classList.remove('no-scroll');
    });
  });
});
