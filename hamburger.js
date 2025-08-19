document.addEventListener('DOMContentLoaded', function() {
  // Menu elements
  const hamburger = document.querySelector('.hamburger');
  const nav = document.querySelector('nav');
  const body = document.body;
  
  // Only proceed if elements exist
  if (!hamburger || !nav) {
    console.error('Menu elements not found!');
    return;
  }

  // Toggle menu function
  function toggleMenu() {
    hamburger.classList.toggle('active');
    nav.classList.toggle('active');
    body.classList.toggle('no-scroll');
    
    // Add backdrop overlay if needed
    if (nav.classList.contains('active')) {
      const overlay = document.createElement('div');
      overlay.className = 'nav-overlay';
      document.body.appendChild(overlay);
      
      overlay.addEventListener('click', function() {
        closeMenu();
        overlay.remove();
      });
    } else {
      const overlay = document.querySelector('.nav-overlay');
      if (overlay) overlay.remove();
    }
  }

  // Close menu function
  function closeMenu() {
    hamburger.classList.remove('active');
    nav.classList.remove('active');
    body.classList.remove('no-scroll');
  }

  // Event listeners
  hamburger.addEventListener('click', function(e) {
    e.stopPropagation();
    toggleMenu();
  });

  // Close when clicking outside
  document.addEventListener('click', function(e) {
    if (!nav.contains(e.target) && !hamburger.contains(e.target)) {
      closeMenu();
    }
  });

  // Close when clicking links
  document.querySelectorAll('nav a').forEach(link => {
    link.addEventListener('click', closeMenu);
  });
});
