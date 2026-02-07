<?php
$api_key = getenv('OPENWEATHER_API_KEY');
$pdo = require_once __DIR__ . '/functions/db.php';

$units = $_GET['units'] ?? 'metric';
if ($units !== 'metric' && $units !== 'imperial') {
    $units = 'metric';
}

require_once __DIR__ . '/functions/city-delete.php';
delete_city($pdo, $units);

require_once __DIR__ . '/header.php';
require_once __DIR__ . '/components/cities-controls.php';
require_once __DIR__ . '/components/cities.php';
require_once __DIR__ . '/footer.php';
