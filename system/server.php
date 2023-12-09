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
        default:
            # code...
            break;
    }
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
    $sql = "UPDATE `manufactures` SET `name` = '" . $data['name'] . "', `country_id` = '" . $data['country'] . "' WHERE `manufactures`.`id` = " . $data['id'];
    /*var_dump($sql);
    die;*/
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

