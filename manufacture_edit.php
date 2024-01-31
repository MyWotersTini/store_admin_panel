<?php
include_once "config.php";

if (empty($_SESSION) || empty($_GET['id'])) {
    header("Location: /");
    exit;
}

$result = get_manufacture_by_id($_GET['id']);
$countries = get_countries();
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
        <li><a href="/manufacture_list.php">Manufactures</a></li>
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
                    <label id="manufacture_label_name" for="manufacture_name"></label>
                </div>
            </div>
            <div class="edit_items-line">
                <div class="edit_items-line-name">Country</div>
                <div class="edit_items-line-input">
                    <select id="manufacture_country">
                        <?php foreach ($countries as $key => $value): ?>
                            <option value="<?php echo $value['id'] ?>"
                                <?php echo ($value['id'] == $manufacture['country_id']) ? 'selected' : '' ?>
                            >
                            <?php echo $value['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label id="manufacture_label_country" for="manufacture_country"></label>
                </div>
            </div>
        </div>
        <div class="submit_item">
            <button id="manufacture_edit_button" manufacture_id="<?php echo $manufacture['id']?>">Save</button>
        </div>
    </div>

<script src="js/manufacture.js"></script>

<?php include "footer.php"; ?>