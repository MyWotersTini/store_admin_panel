<?php

// include_once "config.php";

$ourData = file_get_contents("countries.json");

$json_countries = json_decode($ourData, true);

foreach ($json_countries as $data) {

    $name           = mysqli_real_escape_string($connection, $data['name']);
    $code           = mysqli_real_escape_string($connection, $data['code']);

    $sql = "INSERT INTO `countries` (`id`, `name`, `code`) VALUES (NULL, '" .  $name . "', '" .  $code . "')";
    mysqli_query($connection, $sql);
};