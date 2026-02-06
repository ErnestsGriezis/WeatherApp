<?php
$api_key = getenv('OPENWEATHER_API_KEY');
$pdo = require_once __DIR__ . '/../functions/db.php';

require_once __DIR__ . '/../functions/weather.php';

$units = $_GET['units'] ?? 'metric';
if ($units !== 'metric' && $units !== 'imperial') {
    $units = 'metric';
}

$id_raw = $_GET['id'] ?? null;
if ($id_raw === null || !ctype_digit($id_raw)) {
    header("Location: /index.php");
    exit;
}

$id = (int)$id_raw;

$stmt = $pdo->prepare('SELECT name FROM cities WHERE id = :id');
$stmt->execute(['id' => $id]);

$city = $stmt->fetch();
$city_name = $city['name'] ?? null;


if (!$city_name) {
    header("Location: /index.php");
    exit;
}

$weather = get_city_weather($city_name, $api_key, $units);
if (!($weather['ok'])) {
    header("Location: /index.php");
    exit;
}
?>

<?php require_once __DIR__ . "/../header.php"; ?>
<?php require_once __DIR__ . "/../components/cities-controls.php"; ?>

<div class="main-container">
    <?php require_once __DIR__ . "/city-hero.php"; ?>
    <?php require_once __DIR__ . "/city-stats.php"; ?>
    <?php require_once __DIR__ . "/city-details.php"; ?>
</div>

<?php require_once __DIR__ . "/../footer.php" ?>
