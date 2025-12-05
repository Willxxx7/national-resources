/* eslint-env node */
/* eslint no-undef: "off" */
// SOLUTION: api/contact.js

const fs = require('fs');
const path = require('path');
const dataFile = path.join(__dirname, '..', 'data', 'contacts.json');

function handleRequest(req, res) {
  if (req.method === 'GET') return handleGetRequest(req, res);
  if (req.method === 'POST') return handlePostRequest(req, res);
  res.writeHead(405, { 'Content-Type': 'application/json' });
  res.end(JSON.stringify({ success: false, message: 'Method not allowed' }));
}

function handleGetRequest(req, res) {
  try {
    const contacts = JSON.parse(fs.readFileSync(dataFile, 'utf8'));
    res.writeHead(200, { 'Content-Type': 'application/json' });
    res.end(JSON.stringify({ success: true, contacts }));
  } catch {
    res.writeHead(500, { 'Content-Type': 'application/json' });
    res.end(JSON.stringify({ success: false, message: 'Server error' }));
  }
}

function handlePostRequest(req, res) {
  let body = '';
  req.on('data', (chunk) => (body += chunk));
  req.on('end', () => {
    try {
      const data = JSON.parse(body);
      const errors = validateInput(data);

      if (errors.length > 0) {
        res.writeHead(400, { 'Content-Type': 'application/json' });
        res.end(JSON.stringify({ success: false, errors }));
        return;
      }

      const result = saveContact(data);
      res.writeHead(result.success ? 200 : 500, {
        'Content-Type': 'application/json',
      });
      res.end(JSON.stringify(result));
    } catch {
      res.writeHead(400, { 'Content-Type': 'application/json' });
      res.end(JSON.stringify({ success: false, message: 'Invalid JSON data' }));
    }
  });
}

function validateInput(data) {
  const errors = [];
  if (!data.name || data.name.trim().length < 2)
    errors.push('Name must be at least 2 characters');
  if (!data.email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(data.email.trim()))
    errors.push('Valid email format required');
  if (!data.message || data.message.trim().length < 10)
    errors.push('Message must be at least 10 characters');
  return errors;
}

function saveContact(data) {
  try {
    const contacts = JSON.parse(fs.readFileSync(dataFile, 'utf8'));
    const newContact = {
      id: Math.floor(Math.random() * 90000000 + 10000000).toString(),
      name: data.name.trim(),
      email: data.email.trim(),
      message: data.message.trim(),
      timestamp: new Date().toISOString().slice(0, 19).replace('T', ' '),
    };
    contacts.unshift(newContact);
    fs.writeFileSync(dataFile, JSON.stringify(contacts, null, 2));
    return {
      success: true,
      message: 'Contact saved successfully',
      id: newContact.id,
    };
  } catch {
    return { success: false, message: 'Failed to save contact' };
  }
}

module.exports = { handleRequest };
