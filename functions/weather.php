<?php
function get_city_weather(string $city_name, string $api_key, string $units): array
{

    $encoded_city = urlencode($city_name);
    $url = "https://api.openweathermap.org/data/2.5/weather?q=$encoded_city&units=$units&appid=$api_key";

    $json = @file_get_contents($url);
    if ($json === false) {
        return ['ok' => false];
    }

    $data = json_decode($json, true);
    $has_weather_data = ($data['cod'] ?? null) === 200;

    if (!$has_weather_data) {
        return ['ok' => false];
    }

    $city_temp = round($data['main']['temp']);
    $city_weather = $data['weather'][0]['main'] ?? '';

    $wind_speed = null;
    if (isset($data['wind']['speed'])) {
        $wind_speed = round((float)$data['wind']['speed'], 1);
    }

    $city_icon_code = $data['weather'][0]['icon'] ?? null;
    $icon_alt = $data['weather'][0]['description'] ?? '';

    $icon_url = null;
    if (!empty($city_icon_code)) {
        $icon_url = "https://openweathermap.org/img/wn/{$city_icon_code}@2x.png";
    }

    return [
        'ok' => true,
        'temp' => $city_temp,
        'weather' => $city_weather,
        'wind_speed' => $wind_speed,
        'icon_url' => $icon_url,
        'icon_alt' => $icon_alt,
        'units' => $units,
    ];
}


function get_temperature_unit_symbol(string $units): string
{
    if ($units === 'imperial') {
        return '°F';
    }

    return '°C';
}

function get_wind_unit_symbol(string $units): string
{
    if ($units === 'imperial') {
        return 'mph';
    }

    return 'm/s';
}
