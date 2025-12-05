<?php

// SOLUTION: api/analyzer.php
// PUT YOUR CODE FROM THIS POINT ONWARD

header('Content-Type: application/json');

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed'
    ]);
    exit;
}

// Get JSON input
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Validate input
if (!isset($data['text']) || !is_string($data['text']) || trim($data['text']) === '') {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Text is required and must be non-empty'
    ]);
    exit;
}

$text = $data['text'];

// Calculate metrics
$charCount = mb_strlen($text);
$charCountNoSpaces = mb_strlen(preg_replace('/\s/', '', $text));

// Word count - split by whitespace and filter empty strings
$words = preg_split('/\s+/', trim($text), -1, PREG_SPLIT_NO_EMPTY);
$wordCount = count($words);

// Return success response
echo json_encode([
    'success' => true,
    'analysis' => [
        'charCount' => $charCount,
        'charCountNoSpaces' => $charCountNoSpaces,
        'wordCount' => $wordCount
    ]
]);
