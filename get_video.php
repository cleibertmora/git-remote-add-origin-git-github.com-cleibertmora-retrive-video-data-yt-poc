<?php

header('Content-Type: application/json');
$jsonFilePath = 'latest_video.json';

if (file_exists($jsonFilePath)) {
    echo file_get_contents($jsonFilePath);
} else {
    echo json_encode(['error' => 'No data found']);
}
?>