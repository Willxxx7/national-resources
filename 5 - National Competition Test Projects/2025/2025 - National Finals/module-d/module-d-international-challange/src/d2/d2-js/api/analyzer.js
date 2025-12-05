/* eslint-env node */
/* eslint no-undef: "off" */
// SOLUTION: api/analyzer.js
// PUT YOUR CODE FROM THIS POINT ONWARD

// Main function that handles text analysis requests
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
  const words = text
    .trim()
    .split(/\s+/)
    .filter((w) => w.length > 0);
  const wordCount = words.length;
  // Sentence count - split by sentence-ending punctuation
  const sentenceCount = text
    .split(/[.!?]+/)
    .filter((s) => s.trim().length > 0).length;
  // Paragraph count - split by multiple newlines
  const paragraphCount = text
    .split(/\n\s*\n/)
    .filter((p) => p.trim().length > 0).length;
  // Average word length
  const avgWordLength =
    wordCount > 0 ? (words.join('').length / wordCount).toFixed(1) : 0;
  // Reading time (average 200 words per minute)
  const minutes = Math.ceil(wordCount / 200);
  const readingTime = minutes === 1 ? '1 min' : `${minutes} min`;

  // Top words (keyword density) - exclude common words
  const commonWords = new Set(
    'the,a,an,and,or,but,in,on,at,to,for,of,with,by,from,as,is,was,are,were,be,been,being,have,has,had,do,does,did,will,would,could,should,may,might,can,this,that,these,those,it,its'.split(
      ','
    )
  );
  const wordFreq = {};
  words.forEach((word) => {
    const cleanWord = word.toLowerCase().replace(/[^a-z0-9]/g, '');
    if (cleanWord.length > 2 && !commonWords.has(cleanWord)) {
      wordFreq[cleanWord] = (wordFreq[cleanWord] || 0) + 1;
    }
  });
  // Get top 5 words
  const topWords = Object.entries(wordFreq)
    .sort((a, b) => b[1] - a[1])
    .slice(0, 5)
    .map(([word, count]) => ({ word, count }));

  return {
    charCount,
    charCountNoSpaces,
    wordCount,
    sentenceCount,
    paragraphCount,
    avgWordLength,
    readingTime,
    topWords,
  };
}

module.exports = { handleRequest };
