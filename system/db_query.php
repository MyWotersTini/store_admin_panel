<?php 

function get_categories(){
    global $connection;
    $sql = "SELECT * FROM `categories`";
    return mysqli_query($connection, $sql);
}

function get_manufactures(){
    global $connection;
    $sql = "SELECT * FROM `manufactures`";
    return mysqli_query($connection, $sql);
}

function get_goods(){
    global $connection;
    $sql = "SELECT goods.*, manufactures.name AS manufacture_name, categories.name AS categori_name FROM `goods` , `manufactures` , `categories` WHERE goods.manufacturer = manufactures.id AND goods.category = categories.id;";
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

