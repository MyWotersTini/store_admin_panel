<?php
include_once "config.php";

if (empty($_SESSION)) {
    header("Location: /");
    exit;
}

include "header.php";

$manufactures = get_manufactures();
foreach($manufactures as $item){
    var_dump($item);
}
?>

<?php include "footer.php"; ?>