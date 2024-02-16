<?php 

function get_categories($args){
    global $connection;
    $sql = "SELECT * FROM (SELECT categories.* , COUNT(title) as count FROM `categories` LEFT JOIN goods ON goods.category = categories.id GROUP BY categories.id) as d";
    if($args['search']){
        $sql .= " WHERE d.name LIKE '%" . $args['search'] . "%'";
    }
    // $sql .= " GROUP BY categories.id";
    return mysqli_query($connection, $sql);
}

function get_category_by_id($id){
    global $connection;
    $sql = "SELECT * FROM `categories` WHERE id = $id";
    return mysqli_query($connection, $sql);
}

function get_manufactures($args){
    global $connection;
    $sql = "SELECT * FROM (SELECT manufactures.* , COUNT(title) as count, countries.name as country FROM `manufactures` LEFT JOIN goods ON goods.manufacturer = manufactures.id LEFT JOIN countries ON manufactures.country_id = countries.id GROUP BY manufactures.id) as d";
    if($args['search']){
        $sql .= " WHERE d.name LIKE '%" . $args['search'] . "%' OR d.country LIKE '%" . $args['search'] . "%' OR d.count LIKE '%" . $args['search'] . "%';";
    }
    // $sql .= " GROUP BY manufactures.id";
    // var_dump($sql);
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

function get_regions($args){
    global $connection;
    $sql = "SELECT * FROM regions";
    if($args['search']){
        $sql .= " WHERE regions.name LIKE '%" . $args['search'] . "%'";
    }
    // $sql .= " GROUP BY categories.id";
    // var_dump($sql);
    return mysqli_query($connection, $sql);
}

function get_regions_by_id($id){
    global $connection;
    $sql = "SELECT * FROM `regions` WHERE id = $id";
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

