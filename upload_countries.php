<?php

$ourData = file_get_contents("CitiesAndVillages.json");

$json_cities = json_decode($ourData, true);

$last_region = '';
$last_district = '';
$cities_list = array();

$region_id = 0;
$district_id = 0;
$city_id = 0;

$first_time = microtime(true);

foreach ($json_cities as $cities_key => $data) {

    $category       = mysqli_real_escape_string($connection, $data['object_category']);
    $region         = mysqli_real_escape_string($connection, $data['region']);
    $community      = mysqli_real_escape_string($connection, $data['community']);
    $object_name    = mysqli_real_escape_string($connection, $data['object_name']);

    if($region != $last_region){
        $sql = "SELECT * FROM regions WHERE `name` LIKE '" . $region . "'";
        $result = mysqli_query($connection, $sql);

        if($result->num_rows){
            foreach($result as $data)
                $region_id = $data['id'];
        }else{
            $sql = "INSERT INTO `regions` (`id`, `name`) VALUES (NULL, '" .  $region . "')";
            mysqli_query($connection, $sql);

            $region_id = mysqli_insert_id($connection);
        }
        
        $last_region = $region;
    }

    if($community != $last_district){
        $sql = "SELECT * FROM districts WHERE `name` LIKE '" . $community . "' and region_id=" . $region_id;
        $result = mysqli_query($connection, $sql);

        if($result->num_rows){
            foreach($result as $data)
                $district_id = $data['id'];
        }else{
            $sql = "INSERT INTO `districts` (`id`, `name`, `region_id`) VALUES (NULL, '" .  $community . "', '" .  $region_id . "')";
            mysqli_query($connection, $sql);

            $district_id = mysqli_insert_id($connection);
        }
        
        $last_district = $community;
    }

    $sql = "SELECT * FROM cities WHERE `name` LIKE '" . $object_name . "' and district_id=" . $district_id;
    $result = mysqli_query($connection, $sql);

    if($result->num_rows){
        foreach($result as $data)
            $city_id = $data['id'];

        $sql = "UPDATE `cities` SET `type` = '" . $category  . "' WHERE id =" . $city_id;
        mysqli_query($connection, $sql);
    }else{
        $sql = "INSERT INTO `cities` (`id`, `type`, `district_id`, `title`) VALUES (NULL, '" . $category . "', '" . $district_id . "', '" . $object_name . "')";
        mysqli_query($connection, $sql);
    }

}
