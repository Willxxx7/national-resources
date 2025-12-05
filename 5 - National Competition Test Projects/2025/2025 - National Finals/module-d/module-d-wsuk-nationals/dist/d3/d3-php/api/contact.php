<?php

/*
  api/contact.php
  ================
  Implement the contact form API endpoint.

  Requirements:
  - Accept POST requests only (return 405 for other methods)
  - Parse JSON input from request body
  - Validate: name (min 2 chars), email (valid format), message (min 10 chars)
  - Save valid contacts to data/contacts.json with id and timestamp
  - Return JSON responses with success/error status
*/

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// TODO: Check request method (POST only)

// TODO: Parse JSON input

// TODO: Validate input fields

// TODO: Save contact to data/contacts.json

// TODO: Return appropriate JSON response
