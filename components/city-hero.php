<section class="city-hero slide-in-up">
    <div class="hero-left">
        <div class="hero-title-row">
            <h1 class="city-title"><?= $city_name ?></h1>
            <span class="city-badge"><?= $weather['country_code'] ?></span>
        </div>

        <div class="hero-sub">
            <?= $weather['condition_desc'] ?>
            • Updated <?= format_local_time((int)$weather['dt'], (int)$weather['timezone_offset'], 'H:i') ?>
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