

<section class="stats-grid">
    <article class="stat-card">
        <div class="stat-label">Temperature</div>
        <div class="stat-value">
            <?= (int)($weather['temp'] ?? 0) ?><?= get_temperature_unit_symbol($units) ?>
        </div>
        <div class="stat-sub">
            Feels like <?= (int)($weather['feels_like'] ?? 0) ?><?= get_temperature_unit_symbol($units) ?>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-label">Wind</div>
        <div class="stat-value">
            <?= htmlspecialchars((string)($weather['wind_speed'] ?? 0)) ?> <?= get_wind_unit_symbol($units) ?>
        </div>
        <div class="stat-sub">
            Gusts <?= htmlspecialchars((string)($weather['wind_gust'] ?? 0)) ?> <?= get_wind_unit_symbol($units) ?>
            • <?= (int)($weather['wind_deg'] ?? 0) ?>°
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-label">Clouds</div>
        <div class="stat-value"><?= (int)($weather['clouds'] ?? 0) ?>%</div>
        <div class="stat-sub"><?= htmlspecialchars($weather['condition_desc'] ?? '') ?></div>
    </article>

    <article class="stat-card">
        <div class="stat-label">Rain</div>
        <div class="stat-value"><?= htmlspecialchars((string)($weather['rain_1h'] ?? 0)) ?> mm</div>
        <div class="stat-sub">Last 1h</div>
    </article>

    <article class="stat-card">
        <div class="stat-label">Pressure</div>
        <div class="stat-value"><?= (int)($weather['pressure'] ?? 0) ?> hPa</div>
        <div class="stat-sub">Sea level</div>
    </article>

    <article class="stat-card">
        <div class="stat-label">Visibility</div>
        <div class="stat-value">
            <?= htmlspecialchars((string)($weather['visibility_km'] ?? 0)) ?> km
        </div>
        <div class="stat-sub">Good</div>
    </article>

    <article class="stat-card wide">
        <div class="stat-label">Sun</div>
        <div class="stat-value">
            Sunrise <?= format_local_time((int)($weather['sunrise'] ?? 0), (int)($weather['timezone_offset'] ?? 0)) ?>
        </div>
        <div class="stat-sub">
            Sunset <?= format_local_time((int)($weather['sunset'] ?? 0), (int)($weather['timezone_offset'] ?? 0)) ?>
        </div>
    </article>

    <article class="stat-card wide">
        <div class="stat-label">Extra</div>
        <div class="stat-value">
            Snow (1h): <?= htmlspecialchars((string)($weather['snow_1h'] ?? 0)) ?> mm
        </div>
        <div class="stat-sub">
            Rain (3h): <?= htmlspecialchars((string)($weather['rain_3h'] ?? 0)) ?> mm •
            Snow (3h): <?= htmlspecialchars((string)($weather['snow_3h'] ?? 0)) ?> mm
        </div>
    </article>
</section>
