<?php
// api/get_player.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/../controllers/PlayerController.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    echo json_encode(['success' => false, 'error' => 'Player ID required']);
    exit;
}

$controller = new PlayerController();
$result = $controller->getById($id);

echo json_encode($result);
?>