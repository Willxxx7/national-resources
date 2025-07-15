/*======================================================================
Countdown Timer

Put your JS code to create the countdown timer that counts down to December 1, 2025. The countdown should display the number of days, hours, minutes, and seconds remaining until that date.
========================================================================*/

(() => {
  /*Define targeted date and the missing DOM elements below.*/
  /* ↓ PLACE YOUR CODE BELOW↓*/

  /* ↑ PLACE YOUR CODE ABOVE ↑*/
  // Do not modify the code below this line as is required for the countdown to work.
  function updateCountdown() {
    const now = new Date().getTime();
    const difference = targetDate - now;

    if (difference > 0) {
      const days = Math.floor(difference / (1000 * 60 * 60 * 24));
      const hours = Math.floor(
        (difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
      );

      const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((difference % (1000 * 60)) / 1000);

      daysEl.textContent = days.toString().padStart(2, '0');
      hoursEl.textContent = hours.toString().padStart(2, '0');
      minutesEl.textContent = minutes.toString().padStart(2, '0');
      secondsEl.textContent = seconds.toString().padStart(2, '0');
    } else {
      daysEl.textContent = '00';
      hoursEl.textContent = '00';
      minutesEl.textContent = '00';
      secondsEl.textContent = '00';
    }
  }

  updateCountdown();

  setInterval(updateCountdown, 1000);
})();
