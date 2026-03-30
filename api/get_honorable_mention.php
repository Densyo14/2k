<?php
// api/get_honorable_mention.php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/../controllers/RankingController.php';

$controller = new RankingController();
$result = $controller->getHonorableMention();

echo json_encode($result);
?>