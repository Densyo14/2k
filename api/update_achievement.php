<?php
// api/update_achievement.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../controllers/PlayerController.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['player_id']) || !isset($data['achievement']) || !isset($data['value'])) {
    echo json_encode(['success' => false, 'error' => 'Player ID, achievement, and value required']);
    exit;
}

$controller = new PlayerController();
$result = $controller->updateAchievement($data['player_id'], $data['achievement'], $data['value']);

echo json_encode($result);
?>