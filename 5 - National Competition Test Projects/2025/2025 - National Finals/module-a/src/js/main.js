/* File path: /js/main.js */

// ============================================
// MAIN FUNCTIONALITY
// ============================================

document.addEventListener('DOMContentLoaded', function () {
  // ============================================
  // UTILITY FUNCTIONS
  // ============================================

  function throttle(func, limit) {
    let inThrottle;
    return function (...args) {
      if (!inThrottle) {
        func.apply(this, args);
        inThrottle = true;
        setTimeout(() => (inThrottle = false), limit);
      }
    };
  }

  // ============================================
  // NAVIGATION MODULE
  // ============================================

  const navToggle = document.getElementById('navToggle');
  const navMenu = document.getElementById('navMenu');
  const navLinks = document.querySelectorAll('.nav-link');

  if (navToggle && navMenu) {
    let isMenuOpen = false;

    function toggleMenu() {
      isMenuOpen = !isMenuOpen;
      navMenu.classList.toggle('active');
      navToggle.classList.toggle('active');
      document.body.style.overflow = isMenuOpen ? 'hidden' : '';
    }

    function closeMenu() {
      if (isMenuOpen) {
        isMenuOpen = false;
        navMenu.classList.remove('active');
        navToggle.classList.remove('active');
        document.body.style.overflow = '';
      }
    }

    // Toggle menu on button click
    navToggle.addEventListener('click', toggleMenu);

    // Close menu when clicking nav links
    navLinks.forEach((link) => {
      link.addEventListener('click', closeMenu);
    });

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
      if (
        isMenuOpen &&
        !navMenu.contains(e.target) &&
        !navToggle.contains(e.target)
      ) {
        closeMenu();
      }
    });

    // Export close function for use by other modules
    window.closeNavMenu = closeMenu;
  }

  // ============================================
  // MODAL & EMAIL FORM MODULE
  // ============================================

  const modals = {
    email: document.getElementById('emailModal'),
    privacy: document.getElementById('privacyModal'),
    terms: document.getElementById('termsModal'),
    cookie: document.getElementById('cookieModal'),
  };

  function openModal(modal) {
    if (modal) {
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
  }

  function closeModal(modal) {
    if (modal) {
      modal.classList.remove('active');
      document.body.style.overflow = '';
    }
  }

  function closeAllModals() {
    Object.values(modals).forEach((modal) => {
      if (modal && modal.classList.contains('active')) {
        closeModal(modal);
      }
    });
  }

  // Email modal triggers
  document.getElementById('openEmailModal')?.addEventListener('click', (e) => {
    e.preventDefault();
    openModal(modals.email);
  });

  document
    .getElementById('closeEmailModal')
    ?.addEventListener('click', () => closeModal(modals.email));
  document
    .getElementById('cancelEmail')
    ?.addEventListener('click', () => closeModal(modals.email));

  // Privacy modal triggers
  document
    .querySelectorAll('a[href="#privacy"], a[data-modal="privacy"]')
    .forEach((trigger) => {
      trigger.addEventListener('click', (e) => {
        e.preventDefault();
        openModal(modals.privacy);
      });
    });

  document
    .getElementById('closePrivacyModal')
    ?.addEventListener('click', () => closeModal(modals.privacy));
  document
    .getElementById('closePrivacyModalBtn')
    ?.addEventListener('click', () => closeModal(modals.privacy));

  // Terms modal triggers
  document
    .querySelectorAll('a[href="#terms"], a[data-modal="terms"]')
    .forEach((trigger) => {
      trigger.addEventListener('click', (e) => {
        e.preventDefault();
        openModal(modals.terms);
      });
    });

  document
    .getElementById('closeTermsModal')
    ?.addEventListener('click', () => closeModal(modals.terms));
  document
    .getElementById('closeTermsModalBtn')
    ?.addEventListener('click', () => closeModal(modals.terms));

  // Cookie modal triggers
  document
    .querySelectorAll('a[href="#cookie"], a[data-modal="cookie"]')
    .forEach((trigger) => {
      trigger.addEventListener('click', (e) => {
        e.preventDefault();
        openModal(modals.cookie);
      });
    });

  document
    .getElementById('closeCookieModal')
    ?.addEventListener('click', () => closeModal(modals.cookie));
  document
    .getElementById('closeCookieModalBtn')
    ?.addEventListener('click', () => closeModal(modals.cookie));

  // Close modals when clicking outside
  Object.values(modals).forEach((modal) => {
    if (modal) {
      modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal(modal);
      });
    }
  });

  // Email form handling
  const emailForm = document.getElementById('emailForm');
  const sendButton = document.getElementById('sendEmail');

  if (emailForm && sendButton) {
    emailForm.addEventListener('submit', (e) => {
      e.preventDefault();

      const btnText = sendButton.querySelector('.btn-text');
      const btnLoading = sendButton.querySelector('.btn-loading');

      // Show loading state
      if (btnText) btnText.style.display = 'none';
      if (btnLoading) {
        btnLoading.style.display = 'inline';
        btnLoading.classList.add('show');
      }
      sendButton.disabled = true;

      // Simulate network request
      setTimeout(() => {
        // Hide loading state
        if (btnText) btnText.style.display = 'inline';
        if (btnLoading) {
          btnLoading.style.display = 'none';
          btnLoading.classList.remove('show');
        }
        sendButton.disabled = false;

        // Close modal and show success
        closeModal(modals.email);
        showSuccessPopup();
        emailForm.reset();
      }, 2000);
    });
  }

  function showSuccessPopup() {
    const popup = document.createElement('div');
    popup.className = 'success-popup';
    popup.innerHTML = `
    <div class="success-icon"><i class="fas fa-check"></i></div>
    <div class="success-message">Message sent successfully!</div>
  `;

    document.body.appendChild(popup);
    setTimeout(() => popup.classList.add('show'), 100);

    setTimeout(() => {
      popup.classList.remove('show');
      setTimeout(() => popup.remove(), 400);
    }, 4000);
  }

  // Export functions for use by other modules
  window.closeAllModals = closeAllModals;
  window.closeEmailModal = () => closeModal(modals.email);

  // ============================================
  // SCROLL EFFECTS MODULE
  // ============================================

  const navbar = document.getElementById('navbar');
  const backToTop = document.getElementById('backToTop');

  function handleScroll() {
    const scrollY = window.scrollY;

    // Add scrolled class to navbar after 50px
    if (navbar) {
      navbar.classList.toggle('scrolled', scrollY > 50);
    }

    // Show back to top button after 300px
    if (backToTop) {
      backToTop.classList.toggle('show', scrollY > 300);
    }
  }

  // Listen to scroll events
  window.addEventListener('scroll', throttle(handleScroll, 100));

  // Back to top button click handler
  if (backToTop) {
    backToTop.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  // ============================================
  // ANIMATIONS MODULE
  // ============================================

  // Counter animation
  const heroStats = document.querySelector('.hero-stats');

  if (heroStats) {
    const observer = new IntersectionObserver(
      (entries) => {
        if (entries[0].isIntersecting) {
          // Animate counters
          document.querySelectorAll('.stat-number').forEach((counter) => {
            const target = parseInt(counter.getAttribute('data-target'));
            const increment = target / 100;
            let current = 0;

            const updateCounter = () => {
              if (current < target) {
                current += increment;
                counter.textContent = Math.ceil(current);
                requestAnimationFrame(updateCounter);
              } else {
                counter.textContent = target;
              }
            };

            updateCounter();
          });

          // Only animate once
          observer.unobserve(heroStats);
        }
      },
      { threshold: 0.1, rootMargin: '0px 0px -50px 0px' }
    );

    observer.observe(heroStats);
  }

  // Smooth scrolling for anchor links
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener('click', function (e) {
      const href = this.getAttribute('href');

      // Skip modal links
      if (
        href.includes('privacy') ||
        href.includes('terms') ||
        href.includes('cookie')
      ) {
        return;
      }

      e.preventDefault();
      const target = document.querySelector(href);

      if (target) {
        window.scrollTo({
          top: target.offsetTop - 80,
          behavior: 'smooth',
        });

        // Close mobile menu if open
        if (window.closeNavMenu) {
          window.closeNavMenu();
        }
      }
    });
  });

  // ============================================
  // GLOBAL EVENT HANDLERS
  // ============================================

  // Escape key handler
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      if (window.closeNavMenu) window.closeNavMenu();
      if (window.closeAllModals) window.closeAllModals();
    }
  });

  // Keyboard navigation accessibility
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Tab') {
      document.body.classList.add('using-keyboard');
    }
  });

  document.addEventListener('mousedown', () => {
    document.body.classList.remove('using-keyboard');
  });

  // Set current year
  const yearElement = document.getElementById('currentYear');
  if (yearElement) {
    yearElement.textContent = new Date().getFullYear();
  }
});

// End of DOMContentLoaded
