<?php
include_once "config.php";

if (empty($_SESSION) || empty($_GET['id'])) {
    header("Location: /");
    exit;
}

$result = get_manufacture_by_id($_GET['id']);
// $manufacture = $result->fetch_row();
$manufacture = mysqli_fetch_assoc($result);
// var_dump($manufacture);

if (empty($manufacture)) {
    header("Location: /");
    exit;
}

include "header.php";

?>

<nav aria-label="Breadcrumb">
    <ul class="uk-breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/manufacture_edit.php">Manufactures</a></li>
        <li><a href="#">$manufacture title</a></li>
    </ul>
</nav>

<div class="manufacture_form_edit">
    <div class="first_text">Редагування</div>
    <div class="main_edit">
        <div class="edit_items">
            <div class="edit_items-line">
                <div class="edit_items-line-name">Name</div>
                <div class="edit_items-line-input">
                    <input id="manufacture_name" type="text" value="<?php echo $manufacture['name']?>">
                </div>
            </div>
            <div class="edit_items-line">
                <div class="edit_items-line-name">Country</div>
                <div class="edit_items-line-input">
                    <input id="manufacture_country" type="text" value="<?php echo $manufacture['country']?>">
                </div>
            </div>
        </div>
        <div class="submit_item">
            <button id="manufacture_edit_button" manufacture_id="<?php echo $manufacture['id']?>">Save</button>
        </div>
    </div>

<script src="js/manufacture.js"></script>

<?php include "footer.php"; ?>