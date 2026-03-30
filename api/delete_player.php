<?php
// api/delete_player.php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../controllers/PlayerController.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['id'])) {
    echo json_encode(['success' => false, 'error' => 'Player ID required']);
    exit;
}

$controller = new PlayerController();
$result = $controller->delete($data['id']);

echo json_encode($result);
?>