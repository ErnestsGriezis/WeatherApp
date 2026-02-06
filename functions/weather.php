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

    $city_temp = isset($data['main']['temp']) ? round((float)$data['main']['temp']) : null;
    $city_weather = $data['weather'][0]['main'] ?? '';

    $country_code = $data['sys']['country'] ?? '';

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

    $feels_like = isset($data['main']['feels_like']) ? round((float)$data['main']['feels_like']) : null;
    $temp_min = isset($data['main']['temp_min']) ? round((float)$data['main']['temp_min']) : null;
    $temp_max = isset($data['main']['temp_max']) ? round((float)$data['main']['temp_max']) : null;

    $condition_main = $data['weather'][0]['main'] ?? '';
    $condition_desc = $data['weather'][0]['description'] ?? '';

    $humidity = isset($data['main']['humidity']) ? (int)$data['main']['humidity'] : null;
    $pressure = isset($data['main']['pressure']) ? (int)$data['main']['pressure'] : null;

    $clouds = isset($data['clouds']['all']) ? (int)$data['clouds']['all'] : null;

    $visibility_km = isset($data['visibility']) ? round(((int)$data['visibility']) / 1000, 1) : null;

    $wind_deg = isset($data['wind']['deg']) ? (int)$data['wind']['deg'] : null;
    $wind_gust = isset($data['wind']['gust']) ? round((float)$data['wind']['gust'], 1) : null;

    $rain_1h = isset($data['rain']['1h']) ? (float)$data['rain']['1h'] : 0.0;
    $rain_3h = isset($data['rain']['3h']) ? (float)$data['rain']['3h'] : 0.0;

    $snow_1h = isset($data['snow']['1h']) ? (float)$data['snow']['1h'] : 0.0;
    $snow_3h = isset($data['snow']['3h']) ? (float)$data['snow']['3h'] : 0.0;

    $timezone_offset = isset($data['timezone']) ? (int)$data['timezone'] : 0;
    $dt = isset($data['dt']) ? (int)$data['dt'] : null;

    $sunrise = isset($data['sys']['sunrise']) ? (int)$data['sys']['sunrise'] : null;
    $sunset = isset($data['sys']['sunset']) ? (int)$data['sys']['sunset'] : null;


    return [
        'ok' => true,

        'temp' => $city_temp,
        'weather' => $city_weather,
        'wind_speed' => $wind_speed,
        'icon_url' => $icon_url,
        'icon_alt' => $icon_alt,
        'units' => $units,

        'condition_main' => $condition_main,
        'condition_desc' => $condition_desc,

        'country_code' => $country_code,

        'feels_like' => $feels_like,
        'temp_min' => $temp_min,
        'temp_max' => $temp_max,

        'humidity' => $humidity,
        'pressure' => $pressure,
        'clouds' => $clouds,
        'visibility_km' => $visibility_km,

        'wind_deg' => $wind_deg,
        'wind_gust' => $wind_gust,

        'rain_1h' => $rain_1h,
        'rain_3h' => $rain_3h,
        'snow_1h' => $snow_1h,
        'snow_3h' => $snow_3h,

        'timezone_offset' => $timezone_offset,
        'dt' => $dt,
        'sunrise' => $sunrise,
        'sunset' => $sunset,
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

function format_local_time(int $unix, int $timezone_offset, string $format = 'H:i'): string
{

    return gmdate($format, $unix + $timezone_offset);
}
