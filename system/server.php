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
            
        default:
            # code...
            break;
    }
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

