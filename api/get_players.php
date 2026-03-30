<?php
// api/get_players.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/../controllers/PlayerController.php';

try {
    $controller = new PlayerController();
    $result = $controller->getAll();
    
    // Debug: log the result
    error_log("get_players.php result: " . print_r($result, true));
    
    echo json_encode($result);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>