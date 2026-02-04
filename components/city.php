<?php require_once "../header.php" ?>
<?php require_once "../components/cities-controls.php" ?>

<?php
$config = require_once "../config.php";
$api_key = $config['OPENWEATHER_API_KEY'];

require_once __DIR__ . '/../functions/weather.php';
$cities = require __DIR__ . '/../data/cities.php';

$units = $_GET['units'] ?? 'metric';
if ($units !== 'metric' && $units !== 'imperial') {
    $units = 'metric';
}

$id = (int)($_GET['id']);

$city_name = null;
foreach ($cities as $city) {
    if ((int)$city['id'] === $id) {
        $city_name = $city['name'];
        break;
    }
}

$weather = get_city_weather($city_name, $api_key, $units);
?>

<div class="main-container">

    <section class="city-hero">
        <div class="hero-left">
            <div class="hero-title-row">
                <h1 class="city-title"><?= $city_name ?></h1>
                <span class="city-badge"><?= $weather['country_code'] ?></span>
            </div>

            <div class="hero-sub">
                <?= $weather['condition_desc'] ?>
                • Updated <?= $weather['dt'], (int)($weather['timezone_offset']) ?>
            </div>

            <div class="hero-highlights">
                <div class="highlight">
                    <div class="label">Feels like</div>
                    <div class="value">
                        <?= $weather['feels_like'] ?><?= get_temperature_unit_symbol($units) ?>
                    </div>
                </div>

                <div class="highlight">
                    <div class="label">Min / Max</div>
                    <div class="value">
                        <?= $weather['temp_min'] ?><?= get_temperature_unit_symbol($units) ?>
                        /
                        <?= $weather['temp_max'] ?><?= get_temperature_unit_symbol($units) ?>
                    </div>
                </div>

                <div class="highlight">
                    <div class="label">Humidity</div>
                    <div class="value"><?= $weather['humidity'] ?>%</div>
                </div>
            </div>
        </div>

        <div class="hero-right">
            <?php if (!empty($weather['icon_url'])): ?>
                <img class="hero-icon" src="<?= $weather['icon_url'] ?>" alt="<?= $weather['icon_alt'] ?>">
            <?php endif; ?>

            <div class="hero-temp">
                <div class="temp">
                    <?= $weather['temp'] ?><?= get_temperature_unit_symbol($units) ?>
                </div>
                <div class="temp-meta">
                    Wind <?= $weather['wind_speed'] ?> <?= get_wind_unit_symbol($units) ?>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-grid">
        <article class="stat-card">
            <div class="stat-label">Temperature</div>
            <div class="stat-value">
                <?= $weather['temp'] ?><?= get_temperature_unit_symbol($units) ?>
            </div>
            <div class="stat-sub">
                Feels like <?= $weather['feels_like'] ?><?= get_temperature_unit_symbol($units) ?>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-label">Wind</div>
            <div class="stat-value">
                <?= $weather['wind_speed'] ?> <?= get_wind_unit_symbol($units) ?>
            </div>
            <div class="stat-sub">
                Gusts <?= $weather['wind_gust'] ?> <?= get_wind_unit_symbol($units) ?>
                • <?= $weather['wind_deg'] ?>°
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-label">Clouds</div>
            <div class="stat-value"><?= $weather['clouds'] ?>%</div>
            <div class="stat-sub"><?= $weather['condition_desc'] ?></div>
        </article>

        <article class="stat-card">
            <div class="stat-label">Rain</div>
            <div class="stat-value"><?= $weather['rain_1h'] ?> mm</div>
            <div class="stat-sub">Last 1h</div>
        </article>

        <article class="stat-card">
            <div class="stat-label">Pressure</div>
            <div class="stat-value"><?= $weather['pressure'] ?> hPa</div>
            <div class="stat-sub">Sea level</div>
        </article>

        <article class="stat-card">
            <div class="stat-label">Visibility</div>
            <div class="stat-value">
                <?= $weather['visibility_km'] ?> km
            </div>
            <div class="stat-sub">Good</div>
        </article>

        <article class="stat-card wide">
            <div class="stat-label">Sun</div>
            <div class="stat-value">
                Sunrise <?= $weather['sunrise'], $weather['timezone_offset'] ?>
            </div>
            <div class="stat-sub">
                Sunset <?= $weather['sunset'], $weather['timezone_offset'] ?>
            </div>
        </article>

        <article class="stat-card wide">
            <div class="stat-label">Extra</div>
            <div class="stat-value">
                Snow (1h): <?= $weather['snow_1h'] ?> mm
            </div>
            <div class="stat-sub">
                Rain (3h): <?= $weather['rain_3h'] ?> mm • Snow
                (3h): <?= $weather['snow_3h'] ?> mm
            </div>
        </article>
    </section>

    <section class="details-split">
        <article class="panel">
            <h2 class="panel-title">Detailed breakdown</h2>

            <div class="rows">
                <div class="row">
                    <div class="k">Humidity</div>
                    <div class="v"><?= $weather['humidity'] ?>%</div>
                </div>
                <div class="row">
                    <div class="k">Pressure</div>
                    <div class="v"><?= $weather['pressure'] ?> hPa</div>
                </div>
                <div class="row">
                    <div class="k">Cloudiness</div>
                    <div class="v"><?= $weather['clouds'] ?>%</div>
                </div>
                <div class="row">
                    <div class="k">Rain (1h)</div>
                    <div class="v"><?= $weather['rain_1h'] ?> mm</div>
                </div>
                <div class="row">
                    <div class="k">Snow (1h)</div>
                    <div class="v"><?= $weather['snow_1h'] ?> mm</div>
                </div>
                <div class="row">
                    <div class="k">Visibility</div>
                    <div class="v"><?= $weather['visibility_km'] ?> km</div>
                </div>
            </div>
        </article>

        <article class="panel">
            <h2 class="panel-title">Wind & direction</h2>

            <div class="wind-card">
                <div class="wind-main">
                    <div class="wind-speed">
                        <span class="num"><?= $weather['wind_speed'] ?></span>
                        <span class="unit"><?= get_wind_unit_symbol($units) ?></span>
                    </div>
                    <div class="wind-meta">
                        Gusts <?= $weather['wind_gust'] ?> <?= get_wind_unit_symbol($units) ?>
                    </div>
                </div>
                <!--
                <div class="wind-compass">
                    <div class="compass">
                        <div
                                class="needle"
                                style="transform: rotate(<?= $weather['wind_deg'] ?>deg)"
                        ></div>
                        <div class="center"></div>
                    </div>
                    <div class="wind-deg">
                        <?= $weather['wind_deg'] ?>°
                    </div>
                </div>
                -->
            </div>
        </article>
    </section>
</div>

<?php require_once "../footer.php" ?>
