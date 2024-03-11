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

function get_districts($args){
    global $connection;
    $sql = "SELECT * FROM (SELECT districts.*, regions.name as regions FROM `districts` LEFT JOIN `regions` ON region_id = regions.id GROUP BY districts.id) as d";
    if($args['search']){
        $sql .= " WHERE d.name LIKE '%" . $args['search'] . "%' OR d.regions LIKE '%" . $args['search'] . "%'";
    }
    if($args['orderby']){
        $sql .= " ORDER BY  " . $args['orderby'] . " " . $args['ordertype'];
    }
    if($args['page']){
        $sql .= " LIMIT " . (($args['page'] - 1) * $args['limit']) . "," . $args['limit'];
    }
    // var_dump($sql);
    return mysqli_query($connection, $sql);
}

function get_cities($args){
    global $connection;
    $sql = "SELECT * FROM (SELECT cities.*, districts.name as district FROM `cities` LEFT JOIN `districts` ON district_id = districts.id GROUP BY cities.id) as d";
    if($args['search']){
        $sql .= " WHERE d.title LIKE '%" . $args['search'] . "%' OR d.district LIKE '%" . $args['search'] . "%' OR d.type LIKE '%" . $args['search'] . "%'";
    }  
    if($args['orderby']){
        $sql .= " ORDER BY  " . $args['orderby'] . " " . $args['ordertype'];
    }
    if($args['page']){
        $sql .= " LIMIT " . (($args['page'] - 1) * $args['limit']) . "," . $args['limit'];
    }
    //  var_dump($sql);
    return mysqli_query($connection, $sql);
}

function get_cities_by_id($id){
    global $connection;
    $sql = "SELECT * FROM `cities` WHERE id = $id";
    return mysqli_query($connection, $sql);
}

function get_districts_by_id($id){
    global $connection;
    $sql = "SELECT * FROM `districts` WHERE id = $id";
    return mysqli_query($connection, $sql);
}

function get_districts_count($args){
    global $connection;
    $sql = "SELECT COUNT(*) as count FROM (SELECT districts.*, regions.name as regions FROM `districts` LEFT JOIN `regions` ON region_id = regions.id GROUP BY districts.id) as d";
    if($args['search']){
        $sql .= " WHERE d.name LIKE '%" . $args['search'] . "%' OR d.regions LIKE '%" . $args['search'] . "%'";
    }
    $result = mysqli_fetch_assoc(mysqli_query($connection, $sql));
    return $result['count'];
}

function get_cities_count($args){
    global $connection;
    $sql = "SELECT COUNT(*) as count FROM (SELECT cities.*, districts.name as district FROM `cities` LEFT JOIN `districts` ON district_id = districts.id GROUP BY cities.id) as d";
    if($args['search']){
        $sql .= " WHERE d.title LIKE '%" . $args['search'] . "%' OR d.district LIKE '%" . $args['search'] . "%'  OR d.type LIKE '%" . $args['search'] . "%'";
    }
    $result = mysqli_fetch_assoc(mysqli_query($connection, $sql));
    return $result['count'];
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



