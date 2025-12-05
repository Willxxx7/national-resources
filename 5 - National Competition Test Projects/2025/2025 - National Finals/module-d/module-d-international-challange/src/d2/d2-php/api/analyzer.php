<?php

// SOLUTION: api/analyzer.php
// PUT YOUR CODE FROM THIS POINT ONWARD

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get POST data
$request = json_decode(file_get_contents('php://input'), true);
if (!isset($request['text']) || !is_string($request['text']) || trim($request['text']) === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Text is required and must be non-empty']);
    exit;
}

echo json_encode(['success' => true, 'analysis' => analyzeText($request['text'])]);

// Analyze text and return statistics
function analyzeText($text)
{
    // Character count (with spaces)
    $charCount = mb_strlen($text);
    // Character count (without spaces)
    $charCountNoSpaces = mb_strlen(preg_replace('/\s/', '', $text));
    // Word count - split by whitespace and filter empty strings
    $words = array_values(array_filter(preg_split('/\s+/', trim($text)), fn ($w) => mb_strlen($w) > 0));
    $wordCount = count($words);
    // Sentence count - split by sentence-ending punctuation
    $sentenceCount = count(array_filter(preg_split('/[.!?]+/', $text), fn ($s) => trim($s) !== ''));
    // Paragraph count - split by multiple newlines
    $paragraphCount = count(array_filter(preg_split('/\n\s*\n/', $text), fn ($p) => trim($p) !== ''));
    // Average word length
    $avgWordLength = $wordCount > 0 ? number_format(mb_strlen(implode('', $words)) / $wordCount, 1) : 0;
    // Reading time (average 200 words per minute)
    $minutes = ceil($wordCount / 200);
    $readingTime = $minutes === 1 ? '1 min' : "$minutes min";

    // Top words (keyword density) - exclude common words
    $commonWords = explode(',', 'the,a,an,and,or,but,in,on,at,to,for,of,with,by,from,as,is,was,are,were,be,been,being,have,has,had,do,does,did,will,would,could,should,may,might,can,this,that,these,those,it,its');
    $wordFreq = [];
    foreach ($words as $word) {
        $cleanWord = strtolower(preg_replace('/[^a-z0-9]/i', '', $word));
        if (mb_strlen($cleanWord) > 2 && !in_array($cleanWord, $commonWords)) {
            $wordFreq[$cleanWord] = ($wordFreq[$cleanWord] ?? 0) + 1;
        }
    }
    // Get top 5 words
    arsort($wordFreq);
    $topWords = array_map(fn ($w, $c) => ['word' => $w, 'count' => $c], array_keys(array_slice($wordFreq, 0, 5)), array_slice($wordFreq, 0, 5));

    return ['charCount' => $charCount, 'charCountNoSpaces' => $charCountNoSpaces, 'wordCount' => $wordCount, 'sentenceCount' => $sentenceCount, 'paragraphCount' => $paragraphCount, 'avgWordLength' => $avgWordLength, 'readingTime' => $readingTime, 'topWords' => $topWords];
}
