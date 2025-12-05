/* File path: patterns/animated-words/js-version/animated-words.js */

// ============================================
// ANIMATED WORDS HERO SECTION
// ============================================

document.addEventListener('DOMContentLoaded', function () {
  const AnimatedWords = {
    init() {
      this.words = document.querySelectorAll('.animated-word');
      this.descriptions = document.querySelectorAll('.word-description');
      this.currentIndex = 0;
      this.isAnimating = false;
      this.intervalDuration = 3000;
      this.interval = null;

      if (this.words.length > 0) {
        this.startCycle();
        this.handleVisibilityChange();
      }
    },

    startCycle() {
      this.interval = setInterval(() => this.nextWord(), this.intervalDuration);
    },

    stopCycle() {
      if (this.interval) {
        clearInterval(this.interval);
        this.interval = null;
      }
    },

    nextWord() {
      if (this.isAnimating || !this.words.length) return;

      this.isAnimating = true;

      // Get current elements
      const currentWord = this.words[this.currentIndex];
      const currentDesc = this.descriptions[this.currentIndex];

      // Exit current
      currentWord.classList.add('exit');
      currentWord.classList.remove('active');
      currentDesc?.classList.remove('active');

      // Calculate next index
      this.currentIndex = (this.currentIndex + 1) % this.words.length;

      // Get next elements
      const nextWord = this.words[this.currentIndex];
      const nextDesc = this.descriptions[this.currentIndex];

      // Show next after transition
      setTimeout(() => {
        currentWord.classList.remove('exit');
        nextWord.classList.add('active');
        nextDesc?.classList.add('active');
        this.isAnimating = false;
      }, 400);
    },

    handleVisibilityChange() {
      document.addEventListener('visibilitychange', () => {
        document.hidden ? this.stopCycle() : this.startCycle();
      });
    },

    // Public methods for external control
    destroy() {
      this.stopCycle();
      this.words.forEach((word) => word.classList.remove('active', 'exit'));
      this.descriptions.forEach((desc) => desc.classList.remove('active'));

      if (this.words.length > 0) {
        this.words[0].classList.add('active');
        this.descriptions[0]?.classList.add('active');
      }
    },

    triggerNext() {
      this.nextWord();
    },

    goToWord(index) {
      if (index >= 0 && index < this.words.length && !this.isAnimating) {
        // Remove current active states
        this.words[this.currentIndex].classList.remove('active');
        this.descriptions[this.currentIndex]?.classList.remove('active');

        // Set new active states
        this.currentIndex = index;
        this.words[this.currentIndex].classList.add('active');
        this.descriptions[this.currentIndex]?.classList.add('active');
      }
    },
  };

  // Initialize and expose globally
  AnimatedWords.init();
  window.animatedWords = AnimatedWords;
});
