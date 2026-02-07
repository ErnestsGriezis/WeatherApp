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

        <div class="city-add">
            <form class="city-add-form">
                <input type="text" name="city_name" id="city-name" placeholder="City"/>

                <button type="button" class="btn btn-submit city-add-submit">Add city</button>

                <div class="city-add-message"></div>
            </form>
        </div>


        <div class="units-switch">
            <a class="units-btn <?= $currentUnits === 'metric' ? 'is-active' : '' ?>"
               href="<?= htmlspecialchars($metricUrl) ?>">°C</a>
            <a class="units-btn <?= $currentUnits === 'imperial' ? 'is-active' : '' ?>"
               href="<?= htmlspecialchars($imperialUrl) ?>">°F</a>
        </div>

    </div>
</div>
