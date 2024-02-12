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

?>

<nav aria-label="Breadcrumb">
    <ul class="uk-breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/category">Categories</a></li>
        <li><a href="#"><?php echo $category['name']?></a></li>
    </ul>
</nav>

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