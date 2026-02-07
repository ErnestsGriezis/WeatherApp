<?php
header('Content-Type: application/json; charset=utf-8');

$pdo = require_once __DIR__ . '/db.php';

$cityName = trim($_POST['city_name'] ?? '');

if ($cityName === '') {
    echo json_encode(['ok' => false, 'error' => 'City name is empty']);
    exit;
}

if (mb_strlen($cityName) < 2 || mb_strlen($cityName) > 120) {
    echo json_encode(['ok' => false, 'error' => 'City name must be 2–120 characters']);
    exit;
}

if (!preg_match("/^[\p{L}\s\-']+$/u", $cityName)) {
    echo json_encode(['ok' => false, 'error' => 'Invalid city name']);
    exit;
}


$stmt = $pdo->prepare('INSERT INTO cities (name) VALUES (:name) ON CONFLICT (name) DO NOTHING RETURNING id, name');

$stmt->execute(['name' => $cityName]);
$city = $stmt->fetch();

if (!$city) {
    echo json_encode(['ok' => false, 'error' => 'City already exists']);
    exit;
}

echo json_encode(['ok' => true, 'city' => $city]);
