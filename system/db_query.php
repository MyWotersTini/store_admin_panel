<?php 

function get_categories(){
    global $connection;
    $sql = "SELECT categories.* , COUNT(title) as count FROM `categories` LEFT JOIN goods ON goods.category = categories.id GROUP BY categories.id;";
    return mysqli_query($connection, $sql);
}

function get_category_by_id($id){
    global $connection;
    $sql = "SELECT * FROM `categories` WHERE id = $id";
    return mysqli_query($connection, $sql);
}

function get_manufactures(){
    global $connection;
    $sql = "SELECT manufactures.* , COUNT(title) as count, countries.name as country FROM `manufactures` LEFT JOIN goods ON goods.manufacturer = manufactures.id LEFT JOIN countries ON manufactures.country_id = countries.id GROUP BY manufactures.id;";
    return mysqli_query($connection, $sql);
}

function get_manufacture_by_id($id){
    global $connection;
    $sql = "SELECT * FROM `manufactures` WHERE id = $id";
    return mysqli_query($connection, $sql);
}

function get_goods(){
    global $connection;
    $sql = "SELECT goods.*, manufactures.name AS manufacture_name, categories.name AS categori_name FROM `goods` , `manufactures` , `categories` WHERE goods.manufacturer = manufactures.id AND goods.category = categories.id;";
    return mysqli_query($connection, $sql);
}

function get_countries(){
    global $connection;
    $sql = "SELECT * FROM `countries`";
    return mysqli_query($connection, $sql);
}
 /* ****************** */
function get_clients(){
    global $connection;
    $sql = "SELECT * FROM `clients`";
    return mysqli_query($connection, $sql);
}

function get_access(){
    global $connection;
    $sql = "SELECT * FROM `access`";
    return mysqli_query($connection, $sql);
}

function get_things(){
    global $connection;
    $sql = "SELECT * FROM `things_in_warehouse`";
    return mysqli_query($connection, $sql);
}

function get_warehouses(){
    global $connection;
    $sql = "SELECT * FROM `warehouses`";
    return mysqli_query($connection, $sql);
}

function get_сontracts(){
    global $connection;
    $sql = "SELECT * FROM `сontracts`";
    return mysqli_query($connection, $sql);
}

function get_districts(){
    global $connection;
    $sql = "SELECT districts.*, regions.name FROM `districts`, `regions` WHERE region_id = regions.id";
    return mysqli_query($connection, $sql);
}

