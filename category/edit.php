<?php
include_once "../config.php";

if (empty($_SESSION) || empty($_GET['id'])) {
    header("Location: /");
    exit;
}

$result = get_category_by_id($_GET['id']);
$category = mysqli_fetch_assoc($result);

if (empty($category)) {
    header("Location: /");
    exit;
}

include "../header.php";

$breadcrumb = array(
    array('name' => 'Categories', 'url' => '/category'),
    array('name' => 'Edit category', 'url' => '')
);

createBreadcrumbs($breadcrumb);
?>

<div id="category_form_edit" class="form-edit">
    <div class="main_edit">
        <div class="first_text">Edit category</div>
        <div class="edit_items">
            <div class="edit_items-line">
                <div class="edit_items-line-name">Name</div>
                <div class="edit_items-line-input">
                    <input class="uk-input" id="category_name" type="text" value="<?php echo $category['name']?>">
                    <label id="category_label_name" for="category_name"></label>
                </div>
            </div>
        </div>
        <div class="submit_item">
            <button id="category_edit_button" class="uk-button uk-button-default" category_id="<?php echo $category['id']?>">Save</button>
        </div>
    </div>
<div>
<script src="/js/category.js"></script>

<?php include "../footer.php"; ?>