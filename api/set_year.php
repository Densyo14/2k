<?php
// api/set_year.php

session_start();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$data = json_decode(file_get_contents('php://input'), true);

if ($data && isset($data['year'])) {
    $_SESSION['current_year'] = (int)$data['year'];
    echo json_encode(['success' => true, 'current_year' => $_SESSION['current_year']]);
} else {
    echo json_encode(['success' => false, 'error' => 'Year required']);
}
?>