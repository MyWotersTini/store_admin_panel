<?php
include_once "../config.php";

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

include "../header.php";

$breadcrumb = array(
    [
        'name' => 'Manufactures', 
        'url' => '/manufacture'
    ],
    [
        'name' => 'Edit manufacture', 
        'url' => ''
    ]
);

createBreadcrumbs($breadcrumb);
?>


<div id="manufacture_form_edit" class="form-edit">
    <div class="main_edit">
        <div class="first_text">Editing</div>
        <div class="edit_items">
            <div class="edit_items-line">
                <div class="edit_items-line-name">Name</div>
                <div class="edit_items-line-input">
                    <input id="manufacture_name" class="uk-input" type="text" value="<?php echo $manufacture['name']?>">
                    <label id="manufacture_label_name" for="manufacture_name"></label>
                </div>
            </div>
            <div class="edit_items-line">
                <div class="edit_items-line-name">Country</div>
                <div class="edit_items-line-input">
                    <select id="manufacture_country" class="uk-select">
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
            <button id="manufacture_edit_button" class="uk-button uk-button-default" manufacture_id="<?php echo $manufacture['id']?>">Save</button>
        </div>
    </div>
</div>

<script src="/js/manufacture.js"></script>

<?php include "../footer.php"; ?>