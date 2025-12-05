/* eslint-env node */
/* eslint no-undef: "off" */
// SOLUTION: api/analyzer.js
// PUT YOUR CODE FROM THIS POINT ONWARD

// Main function that handles text counter requests
function handleRequest(req, res) {
  if (req.method !== 'POST') {
    res.writeHead(405, { 'Content-Type': 'application/json' });
    return res.end(
      JSON.stringify({ success: false, message: 'Method not allowed' })
    );
  }

  let body = '';
  req.on('data', (chunk) => (body += chunk));
  req.on('end', () => {
    try {
      const { text } = JSON.parse(body);
      if (!text || typeof text !== 'string' || text.trim().length === 0) {
        res.writeHead(400, { 'Content-Type': 'application/json' });
        return res.end(
          JSON.stringify({
            success: false,
            message: 'Text is required and must be non-empty',
          })
        );
      }
      res.writeHead(200, { 'Content-Type': 'application/json' });
      res.end(JSON.stringify({ success: true, analysis: analyzeText(text) }));
    } catch (error) {
      res.writeHead(400, { 'Content-Type': 'application/json' });
      res.end(
        JSON.stringify({
          success: false,
          message: 'Invalid request: ' + error.message,
        })
      );
    }
  });
}

// Analyze text and return statistics
function analyzeText(text) {
  // Character count (with spaces)
  const charCount = text.length;
  // Character count (without spaces)
  const charCountNoSpaces = text.replace(/\s/g, '').length;
  // Word count - split by whitespace and filter empty strings
  const wordCount = text
    .trim()
    .split(/\s+/)
    .filter((w) => w.length > 0).length;

  return { charCount, charCountNoSpaces, wordCount };
}

module.exports = { handleRequest };
