<?php
include_once "../config.php";

if (empty($_SESSION) || empty($_GET['id'])) {
    header("Location: /");
    exit;
}

$result = get_districts_by_id($_GET['id']);
$regions = get_regions();
// $districts = $result->fetch_row();
$districts = mysqli_fetch_assoc($result);
// var_dump($districts);

if (empty($districts)) {
    header("Location: /");
    exit;
}

include "../header.php";

$breadcrumb = array(
    [
        'name' => 'Districts', 
        'url' => '/admin/districts'
    ],
    [
        'name' => 'Edit districts', 
        'url' => ''
    ]
);

createBreadcrumbs($breadcrumb);
?>


<div id="districts_form_edit" class="form-edit">
    <div class="main_edit">
        <div class="first_text">Editing</div>
        <div class="edit_items">
            <div class="edit_items-line">
                <div class="edit_items-line-name">Name</div>
                <div class="edit_items-line-input">
                    <input id="districts_name" class="uk-input" type="text" value="<?php echo $districts['name']?>">
                    <label id="districts_label_name" for="districts_name"></label>
                </div>
            </div>
            <div class="edit_items-line">
                <div class="edit_items-line-name">Region</div>
                <div class="edit_items-line-input">
                    <select id="districts_region" class="uk-select">
                        <?php foreach ($regions as $key => $value): ?>
                            <option value="<?php echo $value['id'] ?>"
                                <?php echo ($value['id'] == $districts['region_id']) ? 'selected' : '' ?>
                            >
                            <?php echo $value['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label id="districts_label_region" for="districts_region"></label>
                </div>
            </div>
        </div>
        <div class="submit_item">
            <button id="districts_edit_button" class="uk-button uk-button-default" districts_id="<?php echo $districts['id']?>">Save</button>
        </div>
    </div>
</div>

<script src="/admin/js/districts.js"></script>

<?php include "../footer.php"; ?>