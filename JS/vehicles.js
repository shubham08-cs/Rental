// Hamburger menu functionality
const hamburger = document.getElementById('hamburger');
const nav = document.querySelector('nav');

hamburger.addEventListener('click', () => {
  hamburger.classList.toggle('active');
  nav.classList.toggle('active');
  
  // Toggle body scroll when menu is open
  document.body.classList.toggle('no-scroll');
});

// Close menu when clicking outside
document.addEventListener('click', (e) => {
  if (nav.classList.contains('active') && 
      !e.target.closest('nav') && 
      !e.target.closest('.hamburger')) {
    hamburger.classList.remove('active');
    nav.classList.remove('active');
    document.body.classList.remove('no-scroll');
  }
});

// Filter functionality
const filterOptions = document.querySelectorAll('.filter-option');

filterOptions.forEach(option => {
  option.addEventListener('click', () => {
    // Remove active class from all options
    filterOptions.forEach(opt => opt.classList.remove('active'));
    // Add active class to clicked option
    option.classList.add('active');
    
    // Filter the vehicles based on selection
    filterVehicles(option.textContent.trim());
  });
});

// Vehicle filtering function
function filterVehicles(filter) {
  const vehicles = document.querySelectorAll('.vehicle-card');
  const filterValue = filter.toLowerCase();
  
  vehicles.forEach(vehicle => {
    const type = vehicle.querySelector('.vehicle-type').textContent.toLowerCase();
    
    if (filterValue === 'all vehicles' || type.includes(filterValue)) {
      vehicle.style.display = 'block';
    } else {
      vehicle.style.display = 'none';
    }
  });
}

// Newsletter form submission
const newsletterForm = document.querySelector('.footer-form');
if (newsletterForm) {
  newsletterForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const emailInput = newsletterForm.querySelector('input[type="email"]');
    const email = emailInput.value;
    
    if (email) {
      alert(`Thank you for subscribing with: ${email}`);
      emailInput.value = '';
    }
  });
}