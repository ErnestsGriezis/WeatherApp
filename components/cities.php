<?php


$config = require_once "./config.php";
$api_key = $config['OPENWEATHER_API_KEY'];
require_once __DIR__ . '/../functions/weather.php';

$cities = [
        [
                'id' => 1,
                'name' => 'Riga',
        ],
        [
                'id' => 2,
                'name' => 'Ventspils',
        ],
        [
                'id' => 3,
                'name' => 'Jelgava',
        ],
        [
                'id' => 4,
                'name' => 'Liepāja',
        ],
        [
                'id' => 5,
                'name' => 'Daugavpils',
        ],
        [
                'id' => 6,
                'name' => 'Valmiera',
        ],
        [
                'id' => 7,
                'name' => 'Jūrmala',
        ],
        [
                'id' => 8,
                'name' => 'Jūrkalne',
        ],
        [
                'id' => 9,
                'name' => 'Mārupe',
        ],
        [
                'id' => 10,
                'name' => 'Ozolnieki',
        ],
        [
                'id' => 10,
                'name' => 'Ozolnieki',
        ],
];

$units = $_GET['units'] ?? 'metric';
if ($units !== 'metric' && $units !== 'imperial') {
    $units = 'metric';
}

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
                <a href="city.php?id=<?= $city['id']; ?>" class="city-card">
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