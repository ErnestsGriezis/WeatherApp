<section class="details-split">
    <article class="panel">
        <h2 class="panel-title">Detailed breakdown</h2>

        <div class="rows">
            <div class="row">
                <div class="k">Humidity</div>
                <div class="v"><?= (int)($weather['humidity'] ?? 0) ?>%</div>
            </div>
            <div class="row">
                <div class="k">Pressure</div>
                <div class="v"><?= (int)($weather['pressure'] ?? 0) ?> hPa</div>
            </div>
            <div class="row">
                <div class="k">Cloudiness</div>
                <div class="v"><?= (int)($weather['clouds'] ?? 0) ?>%</div>
            </div>
            <div class="row">
                <div class="k">Rain (1h)</div>
                <div class="v"><?= htmlspecialchars((string)($weather['rain_1h'] ?? 0)) ?> mm</div>
            </div>
            <div class="row">
                <div class="k">Snow (1h)</div>
                <div class="v"><?= htmlspecialchars((string)($weather['snow_1h'] ?? 0)) ?> mm</div>
            </div>
            <div class="row">
                <div class="k">Visibility</div>
                <div class="v"><?= htmlspecialchars((string)($weather['visibility_km'] ?? 0)) ?> km</div>
            </div>
        </div>
    </article>

    <article class="panel">
        <h2 class="panel-title">Wind & direction</h2>

        <div class="wind-card">
            <div class="wind-main">
                <div class="wind-speed">
                    <span class="num"><?= htmlspecialchars((string)($weather['wind_speed'] ?? 0)) ?></span>
                    <span class="unit"><?= get_wind_unit_symbol($units) ?></span>
                </div>
                <div class="wind-meta">
                    Gusts <?= htmlspecialchars((string)($weather['wind_gust'] ?? 0)) ?> <?= get_wind_unit_symbol($units) ?>
                </div>
            </div>

            <?php if (($weather['wind_deg'] ?? null) !== null): ?>
                <div class="wind-compass">
                    <div class="compass">
                        <div
                                class="needle"
                                style="--rot: <?= (((int)$weather['wind_deg'] + 180) % 360) ?>deg;"
                        ></div>
                        <div class="center"></div>
                    </div>
                    <div class="wind-deg">
                        <?= (int)$weather['wind_deg'] ?>°
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </article>
</section>
