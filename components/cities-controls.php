<?php
$currentUnits = $_GET['units'] ?? 'metric';
if ($currentUnits !== 'metric' && $currentUnits !== 'imperial') {
    $currentUnits = 'metric';
}

$paramsMetric = $_GET;
$paramsMetric['units'] = 'metric';
$metricUrl = '?' . http_build_query($paramsMetric);

$paramsImperial = $_GET;
$paramsImperial['units'] = 'imperial';
$imperialUrl = '?' . http_build_query($paramsImperial);
?>


<div class="main-container">
    <div class="cities-controls">

        <div class="add-city">

        </div>

        <div class="units-switch">
            <a class="units-btn <?= $currentUnits === 'metric' ? 'is-active' : '' ?>"
               href="<?= htmlspecialchars($metricUrl) ?>">°C</a>
            <a class="units-btn <?= $currentUnits === 'imperial' ? 'is-active' : '' ?>"
               href="<?= htmlspecialchars($imperialUrl) ?>">°F</a>
        </div>

    </div>
</div>
