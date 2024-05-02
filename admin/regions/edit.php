<?php
include_once "../config.php";

if (empty($_SESSION) || empty($_GET['id'])) {
    header("Location: /");
    exit;
}

$result = get_regions_by_id($_GET['id']);
$regions = mysqli_fetch_assoc($result);

if (empty($regions)) {
    header("Location: /");
    exit;
}

include "../header.php";

$breadcrumb = array(
    array('name' => 'Regions', 'url' => '/admin/regions'),
    array('name' => 'Edit regions', 'url' => '')
);

createBreadcrumbs($breadcrumb);
?>

<div id="regions_form_edit" class="form-edit">
    <div class="main_edit">
        <div class="first_text">Edit region</div>
        <div class="edit_items">
            <div class="edit_items-line">
                <div class="edit_items-line-name">Name</div>
                <div class="edit_items-line-input">
                    <input class="uk-input" id="regions_name" type="text" value="<?php echo $regions['name']?>">
                    <label id="regions_label_name" for="regions_name"></label>
                </div>
            </div>
        </div>
        <div class="submit_item">
            <button id="regions_edit_button" class="uk-button uk-button-default" regions_id="<?php echo $regions['id']?>">Save</button>
        </div>
    </div>
<div>
<script src="/admin/js/regions.js"></script>

<?php include "../footer.php"; ?>