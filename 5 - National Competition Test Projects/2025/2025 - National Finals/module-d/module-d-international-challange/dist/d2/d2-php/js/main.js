// PATH: d2/d2-php/js/main.js - DO NOT CHANGE

// Initialize the page
document.addEventListener('DOMContentLoaded', function () {
  // Set footer copyright
  document.getElementById('dynamicFooter').innerHTML =
    '&copy; ' +
    new Date().getFullYear() +
    ' WorldSkills | All rights reserved.';

  // Get form elements
  const form = document.getElementById('analyzerForm');
  const clearBtn = document.getElementById('clearBtn');
  const resultElement = document.getElementById('analysisResult');

  // Handle form submission
  form.addEventListener('submit', async function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    const textContent = formData.get('textContent').trim();

    if (!textContent) {
      displayError('Please enter some text to analyze');
      return;
    }

    try {
      const response = await fetch('api/analyzer.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ text: textContent }),
      });

      const result = await response.json();
      displayResult(result, response.ok);
    } catch (error) {
      displayError('Network error: ' + error.message);
    }
  });

  // Handle clear button
  clearBtn.addEventListener('click', function () {
    form.reset();
    resultElement.innerHTML = 'Submit text to see analysis';
    resultElement.style.color = '#6c757d';
  });

  // Display result function
  function displayResult(result, isSuccess) {
    if (result.success && result.analysis) {
      const analysis = result.analysis;

      let html = '<div class="stats-grid">';
      html += createStatItem('Characters', analysis.charCount);
      html += createStatItem(
        'Characters (no spaces)',
        analysis.charCountNoSpaces
      );
      html += createStatItem('Words', analysis.wordCount);
      html += createStatItem('Sentences', analysis.sentenceCount);
      html += createStatItem('Paragraphs', analysis.paragraphCount);
      html += createStatItem('Avg Word Length', analysis.avgWordLength);
      html += createStatItem('Reading Time', analysis.readingTime);
      html += '</div>';

      if (
        analysis.topWords &&
        Array.isArray(analysis.topWords) &&
        analysis.topWords.length > 0
      ) {
        html += '<div class="keywords-section">';
        html += '<h4>Most Common Words:</h4>';
        html += '<div class="keyword-list">';
        analysis.topWords.forEach((item) => {
          html += `<span class="keyword-badge">${item.word}: ${item.count}</span>`;
        });
        html += '</div></div>';
      }

      resultElement.innerHTML = html;
    } else {
      displayError(result.message || 'An error occurred');
    }
  }

  function createStatItem(label, value) {
    return `
      <div class="stat-item">
        <div class="stat-label">${label}</div>
        <div class="stat-value">${value}</div>
      </div>
    `;
  }

  function displayError(message) {
    resultElement.style.color = '#721c24';
    resultElement.style.backgroundColor = '#f8d7da';
    resultElement.style.border = '1px solid #f5c6cb';
    resultElement.innerHTML = `<div style="text-align: center; padding: 20px;">${message}</div>`;
  }
});
