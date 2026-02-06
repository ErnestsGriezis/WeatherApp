<?php

$api_key = getenv('OPENWEATHER_API_KEY');
$pdo = require_once __DIR__ . '/../functions/db.php';
require_once __DIR__ . '/../functions/weather.php';


$units = $_GET['units'] ?? 'metric';
if ($units !== 'metric' && $units !== 'imperial') {
    $units = 'metric';
}


$query = 'SELECT id, name FROM cities ORDER BY name';

$cities = $pdo->query($query)->fetchAll();
?>

<div class="main-container">
    <section class="cities-grid">
        <?php foreach ($cities as $city): ?>
            <?php

            $city_name = $city['name'];
            $weather = get_city_weather($city_name, $api_key, $units);

            $has_weather_data = $weather['ok'];
            $city_temp = $weather['temp'];
            $icon_url = $weather['icon_url'];
            $icon_alt = $weather['icon_alt'];
            $wind_speed = $weather['wind_speed'];

            ?>

            <?php if ($has_weather_data): ?>
                <a href="/components/city.php?id=<?= $city['id']; ?>&units=<?= htmlspecialchars($units) ?>"
                   class="city-card">
                    <article class="inner-city-card last-child-without-margin">

                        <div class="city-info-wrapper">
                            <?php if (!empty($city_name)): ?>
                                <h2 class="city-name"><?= htmlspecialchars($city_name); ?></h2>
                            <?php endif; ?>

                            <?php if ($city_temp !== null): ?>
                                <div class="city-temp">
                                    <?= htmlspecialchars((string)$city_temp); ?>
                                    <?= get_temperature_unit_symbol($units); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($wind_speed !== null): ?>
                                <div class="city-meta">
                                    Wind <?= htmlspecialchars((string)$wind_speed); ?>
                                    <?= get_wind_unit_symbol($units); ?>
                                </div>
                            <?php endif; ?>

                        </div>

                        <?php if (!empty($icon_url)): ?>
                            <img class="city-icon" src="<?= htmlspecialchars($icon_url); ?>"
                                 alt="<?= htmlspecialchars($icon_alt); ?>">
                        <?php endif; ?>
                    </article>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>

    </section>
</div>