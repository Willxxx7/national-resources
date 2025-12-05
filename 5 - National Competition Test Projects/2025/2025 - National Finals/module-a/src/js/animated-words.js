/* File path: /js/animated-words.js */
// ============================================
// ANIMATED WORDS HERO SECTION
// ============================================
document.addEventListener('DOMContentLoaded', function () {
  const words = document.querySelectorAll('.animated-word');
  const descriptions = document.querySelectorAll('.word-description');

  if (!words.length) return;

  let currentIndex = 0;
  let interval;

  function showWord(index) {
    // Update words
    words.forEach((word, i) => {
      word.classList.toggle('active', i === index);
      word.setAttribute('aria-hidden', i !== index);
    });

    // Update descriptions
    descriptions.forEach((desc, i) => {
      desc.classList.toggle('active', i === index);
      desc.setAttribute('aria-hidden', i !== index);
    });
  }

  function nextWord() {
    // Add exit animation to current word
    words[currentIndex].classList.add('exit');

    // Move to next word
    currentIndex = (currentIndex + 1) % words.length;

    // Remove exit class and show new word after animation
    setTimeout(() => {
      words.forEach((word) => word.classList.remove('exit'));
      showWord(currentIndex);
    }, 400);
  }

  // Start the cycle
  interval = setInterval(nextWord, 3000);

  // Pause when page is hidden (to save resources)
  document.addEventListener('visibilitychange', () => {
    if (document.hidden) {
      clearInterval(interval);
    } else {
      interval = setInterval(nextWord, 3000);
    }
  });
});
