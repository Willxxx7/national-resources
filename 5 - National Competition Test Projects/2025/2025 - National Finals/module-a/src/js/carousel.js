/* File path: /js/carousel.js */
// ============================================
// CLIENTS CAROUSEL
// ============================================
document.addEventListener('DOMContentLoaded', function () {
  const track = document.getElementById('clientsTrack');
  const carousel = document.querySelector('.clients-carousel');
  if (!track || !track.children.length) return;

  // Clone logos once for seamless loop
  const originalLogos = Array.from(track.children);
  originalLogos.forEach((logo) => {
    const clone = logo.cloneNode(true);
    clone.setAttribute('aria-hidden', 'true');
    track.appendChild(clone);
  });

  // Hover functionality to pause animation and reveal colors
  const allLogos = track.querySelectorAll('.client-logo');

  allLogos.forEach((logo) => {
    logo.addEventListener('mouseenter', () => {
      track.style.animationPlayState = 'paused';
    });

    logo.addEventListener('mouseleave', () => {
      track.style.animationPlayState = 'running';
    });
  });

  // Also handle carousel container hover as backup
  carousel.addEventListener('mouseenter', () => {
    track.style.animationPlayState = 'paused';
  });

  carousel.addEventListener('mouseleave', () => {
    track.style.animationPlayState = 'running';
  });

  // Smooth resize handler
  let resizeTimer;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
      // Preserve current position and restart smoothly
      const computedStyle = getComputedStyle(track);
      const matrix = new DOMMatrix(computedStyle.transform);
      const currentX = matrix.m41;

      track.style.transform = `translateX(${currentX}px)`;
      track.style.animation = 'none';

      requestAnimationFrame(() => {
        track.style.transform = '';
        track.style.animation = '';
      });
    }, 150);
  });
});
