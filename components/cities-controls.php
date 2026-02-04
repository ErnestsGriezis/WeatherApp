<?php
$currentUnits = $_GET['units'] ?? 'metric';
if ($currentUnits !== 'metric' && $currentUnits !== 'imperial') {
    $currentUnits = 'metric';
}

?>

<div class="main-container">
    <div class="cities-controls">

        <div class="add-city">

        </div>

        <div class="units-switch">
            <a class="units-btn <?= $currentUnits === 'metric' ? 'is-active' : '' ?>" href="?units=metric">°C</a>
            <a class="units-btn <?= $currentUnits === 'imperial' ? 'is-active' : '' ?>" href="?units=imperial">°F</a>
        </div>

    </div>
</div>
