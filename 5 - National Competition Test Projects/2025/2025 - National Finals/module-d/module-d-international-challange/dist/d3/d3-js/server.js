/* eslint-env node */
// PATH:server.js - DO NOT MODIFY
const http = require('http');
const fs = require('fs');
const path = require('path');

const PORT = 3000;

// Import competitor's solution
const contactHandler = require('./api/contact.js');

const server = http.createServer((req, res) => {
  const urlParts = new URL(req.url, `http://localhost:${PORT}`);
  const pathname = urlParts.pathname;

  // Set CORS headers
  res.setHeader('Access-Control-Allow-Origin', '*');
  res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
  res.setHeader('Access-Control-Allow-Headers', 'Content-Type');

  if (req.method === 'OPTIONS') {
    res.writeHead(200);
    res.end();
    return;
  }

  // Handle API requests - delegate to competitor's code
  if (pathname === '/api/contacts') {
    contactHandler.handleRequest(req, res);
    return;
  }

  // Serve static files
  let filePath = pathname === '/' ? './index.html' : '.' + pathname;
  const extname = path.extname(filePath).toLowerCase();

  const mimeTypes = {
    '.html': 'text/html',
    '.css': 'text/css',
    '.js': 'text/javascript',
  };

  const contentType = mimeTypes[extname] || 'application/octet-stream';

  fs.readFile(filePath, (error, content) => {
    if (error) {
      if (error.code === 'ENOENT') {
        res.writeHead(404);
        res.end('File not found');
      } else {
        res.writeHead(500);
        res.end('Server error: ' + error.code);
      }
    } else {
      res.writeHead(200, { 'Content-Type': contentType });
      res.end(content, 'utf-8');
    }
  });
});

server.listen(PORT, () => {
  console.log(`Server running on http://localhost:${PORT}`);
});
