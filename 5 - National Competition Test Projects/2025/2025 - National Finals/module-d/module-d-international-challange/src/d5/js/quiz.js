//PATH: d5/js/quiz.js
//Put your code below

const submitBtn = document.getElementById('submit-btn');
const resetBtn = document.getElementById('reset-btn');
const scoreDisplay = document.getElementById('score');

submitBtn.addEventListener('click', function () {
  // Calculate score by adding up values of checked radio buttons
  let score = 0;
  const checkedAnswers = document.querySelectorAll(
    'input[type="radio"]:checked'
  );

  checkedAnswers.forEach((answer) => {
    score += parseInt(answer.value);
  });

  // Show score
  scoreDisplay.textContent = `Score: ${score}/3`;

  // Disable radio buttons and show reset
  const radioButtons = document.querySelectorAll('input[type="radio"]');
  radioButtons.forEach((radio) => (radio.disabled = true));

  submitBtn.style.display = 'none';
  resetBtn.style.display = 'block';
});

resetBtn.addEventListener('click', function () {
  // Enable radio buttons and clear selections
  const radioButtons = document.querySelectorAll('input[type="radio"]');
  radioButtons.forEach((radio) => {
    radio.disabled = false;
    radio.checked = false;
  });

  // Reset display
  scoreDisplay.textContent = 'Score: 0/3';
  submitBtn.style.display = 'block';
  resetBtn.style.display = 'none';
});
