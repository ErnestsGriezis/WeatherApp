<?php


$config = require_once "./config.php";
$api_key = $config['OPENWEATHER_API_KEY'];


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
];

?>


<div class="main-container">
    <section class="cities-grid">

        <?php foreach ($cities as $city): ?>
            <?php

            $city_name = $city['name'];

            $has_weather_data = false;
            $city_temp = null;
            $city_meta = '';
            $icon_url = null;
            $icon_alt = '';

            $encoded_city = urlencode($city_name);
            $url = "https://api.openweathermap.org/data/2.5/weather?q=$encoded_city&units=metric&appid=$api_key";

            $json = file_get_contents($url);
            $data = json_decode($json, true);

            $has_weather_data = ($data['cod'] ?? null) === 200;

            if ($has_weather_data) {
                $city_temp = round($data['main']['temp']);
                $city_weather = $data['weather'][0]['main'] ?? '';
                $wind_speed = null;
                if (isset($data['wind']['speed'])) {
                    $wind_speed = round((float)$data['wind']['speed'], 1);
                }

                $city_icon_code = $data['weather'][0]['icon'] ?? null;
                $icon_alt = $data['weather'][0]['description'] ?? '';

                if (!empty($city_icon_code)) {
                    $icon_url = "https://openweathermap.org/img/wn/{$city_icon_code}@2x.png";
                }

                if ($wind_speed !== null) {
                    $city_meta = $city_weather . ' · Wind ' . $wind_speed . ' m/s';
                } else {
                    $city_meta = $city_weather;
                }
            }

            ?>

            <?php if ($has_weather_data): ?>
                <a href="city.php?id=<?= $city['id']; ?>" class="city-card">
                    <article class="inner-city-card last-child-without-margin">

                        <div class="city-info-wrapper">
                            <?php if (!empty($city_name)): ?>
                                <h2 class="city-name"><?= htmlspecialchars($city_name); ?></h2>
                            <?php endif; ?>

                            <?php if ($city_temp !== null): ?>
                                <div class="city-temp"><?= htmlspecialchars((string)$city_temp); ?> °C</div>
                            <?php endif; ?>

                            <?php if (!empty($city_meta)): ?>
                                <div class="city-meta"><?= htmlspecialchars($city_meta); ?></div>
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