<?php
include_once "../pass.php";

if (!empty($_POST) and !empty($_POST['action'])) {
    switch ($_POST['action']) {
        case 'review_access':
            review_access($_POST);
            break;
        
        case 'session_unset':
            session_unset();
            break;
            
        case 'manufacture_edit':
            manufacture_edit($_POST);
            break;

        case 'manufacture_add':
            manufacture_add($_POST);
            break;
        
        case 'manufacture_delete':
            manufacture_delete($_POST);
            break;

        case 'category_edit':
            category_edit($_POST);
            break;

        case 'category_add':
            category_add($_POST);
            break;
        
        case 'category_delete':
            category_delete($_POST);   
            break;

        case 'regions_edit':
            regions_edit($_POST);
            break;

        case 'regions_add':
            regions_add($_POST);
            break;
        
        case 'regions_delete':
            regions_delete($_POST);   
            break; 

        case 'districts_edit':
            districts_edit($_POST);
            break;

        case 'districts_add':
            districts_add($_POST);
            break;
        
        case 'districts_delete':
            districts_delete($_POST);   
            break;

        case 'cities_edit':
            cities_edit($_POST);
            break;

        case 'cities_add':
            cities_add($_POST);
            break;
        
        case 'cities_delete':
            cities_delete($_POST);   
            break;

        default:
            # code...
            break;
    }
}

function manufacture_add($data){
    global $connection;

    $error = [
        'success' => true
    ];

    if(empty($data['name'])){

        $error['success'] = false;
        $error['errors']['name'] = 'Порожне поле';
    }else if(strlen($data['name']) >= 100){
        
        $error['success'] = false;
        $error['errors']['name'] = 'Завелике поле';
    }else{

        $sql    = "SELECT * FROM `manufactures` WHERE name='" . $data['name'] . "'";
        $result = mysqli_query($connection, $sql);
        
        if($result->num_rows > 0){

            $error['success'] = false;
            $error['errors']['name'] = 'Така назва вже є';
        }
    }
    
    if(empty($data['country'])){

        $error['success'] = false;
        $error['errors']['country'] = 'Не коректні дані';
    }

    if($error['success'] == false){
        //http_response_code(400);
        echo json_encode($error);

        die;
    }

    $sql = "INSERT INTO `manufactures` (`id`, `name`, `country_id`) VALUES (NULL, '" . $data['name'] . "', '" . $data['country'] . "');";
    mysqli_query($connection, $sql);

    echo json_encode(['success' => 'Дані успішно збережено.']);

    die;
    
    //перевірити що передані значення не пусті. якщо пусті то повернути json error, інакше зберегти данні повернути json succes
}

function manufacture_edit($data){

    $error = [
        'success' => true
    ];

    if(empty($data['name'])){

        $error['success'] = false;
        $error['errors']['name'] = 'Порожне поле';
    }else if(strlen($data['name']) >= 100){
        
        $error['success'] = false;
        $error['errors']['name'] = 'Завелике поле';
    }
    
    if(empty($data['country'])){

        $error['success'] = false;
        $error['errors']['country'] = 'Не коректні дані';
    }

    if($error['success'] == false){
        //http_response_code(400);
        echo json_encode($error);

        die;
    }

    global $connection;

    
     $sql = "SELECT id FROM manufactures WHERE name = '" . $data['name'] . "' AND id != " . $data['id'];
     $result = mysqli_query($connection, $sql);
 
     if ($result && mysqli_num_rows($result) > 0) {
         $error['success'] = false;
         $error['errors']['name'] = 'Компанія з таким іменем вже існує в іншій країні.';
         echo json_encode($error);
         die;
     } 

    $sql = "UPDATE `manufactures` SET `name` = '" . $data['name'] . "', `country_id` = '" . $data['country'] . "' WHERE `manufactures`.`id` = " . $data['id'];
    // var_dump($sql);
    // die;
    mysqli_query($connection, $sql);

    echo json_encode(['success' => 'Дані успішно збережено.']);

    die;
    
    //перевірити що передані значення не пусті. якщо пусті то повернути json error, інакше зберегти данні повернути json succes
}

function review_access($params){

    global $connection;
    
    if (empty($_POST['login']) and empty($_POST['pass'])) {
        return json_encode(['success'=> false, 'message'=> 'login or password is empty']);
    }

    // $response  = [];

    $password = encode($_POST['pass'], $_POST['login']);

    $sql = "SELECT * FROM managers WHERE `login` = '" . $_POST['login'] . "' and `password` = '" . $password . "'";
    
    $result = mysqli_query($connection, $sql);
    
    foreach($result as $row){
        $_SESSION["user_id"] = $row["id"];
        echo json_encode(['status' => 'success', 'massage' => $_SESSION["user_id"]]);
        return;
    }

    echo json_encode(['status' => 'error', 'massage' => 'User not found']);
    return;
}

function manufacture_delete($data){
    global $connection;
    $sql = "DELETE FROM `manufactures` WHERE `manufactures`.`id` = " . $data['id'];
    mysqli_query($connection, $sql);
    echo json_encode(['status' => 'success', 'massage' => $_SESSION["user_id"]]);
    return;
}

function category_add($data){
    global $connection;

    $error = [
        'success' => true
    ];

    if(empty($data['name'])){

        $error['success'] = false;
        $error['errors']['name'] = 'Порожне поле';
    }else if(strlen($data['name']) >= 100){
        
        $error['success'] = false;
        $error['errors']['name'] = 'Завелике поле';
    }else{

        $sql    = "SELECT * FROM `categories` WHERE name='" . $data['name'] . "'";
        $result = mysqli_query($connection, $sql);
        
        if($result->num_rows > 0){

            $error['success'] = false;
            $error['errors']['name'] = 'Така назва вже є';
        }
    }   
    
    $sql = "INSERT INTO `categories` (`id`, `name`) VALUES (NULL, '" . $data['name'] . "')";
    mysqli_query($connection, $sql);

    if($error['success'] == false){
        //http_response_code(400);
        echo json_encode($error);

        die;
    }

    echo json_encode(['success' => 'Дані успішно збережено.']);

    die;
}

function category_edit($data){

    $error = [
        'success' => true
    ];

    if(empty($data['name'])){

        $error['success'] = false;
        $error['errors']['name'] = 'Порожне поле';
    }else if(strlen($data['name']) >= 100){
        
        $error['success'] = false;
        $error['errors']['name'] = 'Завелике поле';
    }

    if($error['success'] == false){
        //http_response_code(400);
        echo json_encode($error);

        die;
    }

    global $connection;


    $sql = "UPDATE `categories` SET `name` = '" . $data['name'] . "' WHERE `categories`.`id` = " . $data['id'];
    // var_dump($sql);
    // die;
    mysqli_query($connection, $sql);

    echo json_encode(['success' => 'Дані успішно збережено.']);

    die;
}

function category_delete($data){
    global $connection;
    $sql = "DELETE FROM `categories` WHERE `categories`.`id` = " . $data['id'];
    mysqli_query($connection, $sql);
    echo json_encode(['status' => 'success', 'massage' => $_SESSION["user_id"]]);
    return;
}

function regions_edit($data){

    $error = [
        'success' => true
    ];

    if(empty($data['name'])){

        $error['success'] = false;
        $error['errors']['name'] = 'Порожне поле';
    }else if(strlen($data['name']) >= 100){
        
        $error['success'] = false;
        $error['errors']['name'] = 'Завелике поле';
    }

    if($error['success'] == false){
        //http_response_code(400);
        echo json_encode($error);

        die;
    }

    global $connection;


    $sql = "UPDATE `regions` SET `name` = '" . $data['name'] . "' WHERE `regions`.`id` = " . $data['id'];
    // var_dump($sql);
    // die;
    mysqli_query($connection, $sql);

    echo json_encode(['success' => 'Дані успішно збережено.']);

    die;
}

function regions_add($data){
    global $connection;

    $error = [
        'success' => true
    ];

    if(empty($data['name'])){

        $error['success'] = false;
        $error['errors']['name'] = 'Порожне поле';
    }else if(strlen($data['name']) >= 100){
        
        $error['success'] = false;
        $error['errors']['name'] = 'Завелике поле';
    }else{

        $sql    = "SELECT * FROM `regions` WHERE name='" . $data['name'] . "'";
        $result = mysqli_query($connection, $sql);
        
        if($result->num_rows > 0){

            $error['success'] = false;
            $error['errors']['name'] = 'Така назва вже є';
        }
    }   
    
    $sql = "INSERT INTO `regions` (`id`, `name`) VALUES (NULL, '" . $data['name'] . "')";
    mysqli_query($connection, $sql);

    if($error['success'] == false){
        //http_response_code(400);
        echo json_encode($error);

        die;
    }

    echo json_encode(['success' => 'Дані успішно збережено.']);

    die;
}

function regions_delete($data){
    global $connection;
    $sql = "DELETE FROM `regions` WHERE `regions`.`id` = " . $data['id'];
    mysqli_query($connection, $sql);
    echo json_encode(['status' => 'success', 'massage' => $_SESSION["user_id"]]);
    return;
}

function districts_add($data){
    global $connection;

    $error = [
        'success' => true
    ];

    if(empty($data['name'])){

        $error['success'] = false;
        $error['errors']['name'] = 'Порожне поле';
    }else if(strlen($data['name']) >= 100){
        
        $error['success'] = false;
        $error['errors']['name'] = 'Завелике поле';
    }else{

        $sql    = "SELECT * FROM `districts` WHERE name='" . $data['name'] . "'";
        $result = mysqli_query($connection, $sql);
        
        if($result->num_rows > 0){

            $error['success'] = false;
            $error['errors']['name'] = 'Така назва вже є';
        }
    }
    
    if(empty($data['region'])){

        $error['success'] = false;
        $error['errors']['region'] = 'Не коректні дані';
    }

    if($error['success'] == false){
        //http_response_code(400);
        echo json_encode($error);

        die;
    }

    $sql = "INSERT INTO `districts` (`id`, `name`, `region_id`) VALUES (NULL, '" . $data['name'] . "', '" . $data['region'] . "');";
    mysqli_query($connection, $sql);

    echo json_encode(['success' => 'Дані успішно збережено.']);

    die;
    
    //перевірити що передані значення не пусті. якщо пусті то повернути json error, інакше зберегти данні повернути json succes
}

function districts_edit($data){

    $error = [
        'success' => true
    ];

    if(empty($data['name'])){

        $error['success'] = false;
        $error['errors']['name'] = 'Порожне поле';
    }else if(strlen($data['name']) >= 100){
        
        $error['success'] = false;
        $error['errors']['name'] = 'Завелике поле';
    }

    if($error['success'] == false){
        //http_response_code(400);
        echo json_encode($error);

        die;
    }

    global $connection;


    $sql = "UPDATE `districts` SET `name` = '" . $data['name'] . "', `region_id` = '" . $data['region'] . "'   WHERE `districts`.`id` = " . $data['id'];
    // var_dump($sql);
    // die;
    mysqli_query($connection, $sql);

    echo json_encode(['success' => 'Дані успішно збережено.']);

    die;
}

function districts_delete($data){
    global $connection;
    $sql = "DELETE FROM `districts` WHERE `districts`.`id` = " . $data['id'];
    mysqli_query($connection, $sql);
    echo json_encode(['status' => 'success', 'massage' => $_SESSION["user_id"]]);
    return;
}

function cities_add($data){
    global $connection;

    $error = [
        'success' => true
    ];

    if(empty($data['name'])){

        $error['success'] = false;
        $error['errors']['name'] = 'Порожне поле';
    }else if(strlen($data['name']) >= 100){
        
        $error['success'] = false;
        $error['errors']['name'] = 'Завелике поле';
    }else{

        $sql    = "SELECT * FROM `cities` WHERE title='" . $data['name'] . "'";
        $result = mysqli_query($connection, $sql);
        
        if($result->num_rows > 0){

            $error['success'] = false;
            $error['errors']['name'] = 'Така назва вже є';
        }
    }   
    
    $sql = "INSERT INTO `cities` (`id`, `type`, `district_id`, `title`) VALUES (NULL, '" . $data['type'] . "', '" . $data['district_id'] . "', '" . $data['name'] . "');";

    mysqli_query($connection, $sql);

    if($error['success'] == false){
        //http_response_code(400);
        echo json_encode($error);

        die;
    }

    echo json_encode(['success' => 'Дані успішно збережено.']);

    die;
}

function cities_edit($data){

    $error = [
        'success' => true
    ];

    if(empty($data['name'])){

        $error['success'] = false;
        $error['errors']['name'] = 'Порожне поле';
    }else if(strlen($data['name']) >= 100){
        
        $error['success'] = false;
        $error['errors']['name'] = 'Завелике поле';
    }

    if($error['success'] == false){
        //http_response_code(400);
        echo json_encode($error);

        die;
    }

    global $connection;


    $sql = "UPDATE `cities` SET `title` = '" . $data['name'] . "', `district_id` = '" . $data['district'] . "' WHERE `cities`.`id` = " . $data['id'];

    mysqli_query($connection, $sql);

    echo json_encode(['success' => 'Дані успішно збережено.']);

    die;
}

function cities_delete($data){
    global $connection;
    $sql = "DELETE FROM `cities` WHERE `cities`.`id` = " . $data['id'];
    mysqli_query($connection, $sql);
    echo json_encode(['status' => 'success', 'massage' => $_SESSION["user_id"]]);
    return;
}