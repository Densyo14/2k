<?php
// api/create_player.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../controllers/PlayerController.php';

// Get the raw input
$rawInput = file_get_contents('php://input');
$data = json_decode($rawInput, true);

// Debug logging
error_log("Create player - Raw input: " . $rawInput);
error_log("Create player - Decoded data: " . print_r($data, true));

if (!$data) {
    echo json_encode(['success' => false, 'error' => 'No data provided or invalid JSON']);
    exit;
}

// Validate name
if (empty($data['name']) || trim($data['name']) === '') {
    echo json_encode(['success' => false, 'error' => 'Player name is required']);
    exit;
}

$controller = new PlayerController();
$result = $controller->create($data);

error_log("Create player - Result: " . print_r($result, true));

// Ensure we're outputting valid JSON
echo json_encode($result);
exit;
?>