<?php
$currentUnits = $_GET['units'] ?? 'metric';

$nextUnits = 'metric';
$buttonLabel = '°C';

if ($currentUnits === 'metric') {
    $nextUnits = 'imperial';
    $buttonLabel = '°F';
}

?>
<div class="main-container">
    <div class="cities-controls">

        <div class="add-city">

        </div>


        <div class="switch-units-wrapper">
            <form method="GET">
                <input type="hidden" name="units" value="<?= $nextUnits ?>">
                <button type="submit" class="btn btn-default">
                    <?= $buttonLabel ?>
                </button>
            </form>
        </div>
    </div>
</div>