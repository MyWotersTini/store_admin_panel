<?php 
include_once "../config.php";
include "../header.php";
$breadcrumb = array(
    array('name' => 'Categories', 'url' => '/admin/category'),
    array('name' => 'Create new category', 'url' => '')
);

createBreadcrumbs($breadcrumb);
?>

<form class="uk-form-horizontal uk-margin-large form-add">
    <div class="uk-margin">
        <label class="uk-form-label" for="category_name"> Category Name </label>
        <div>
            <input class="uk-input" id="category_name" type="text">
        </div>
        <label id="category_label_name" for="category_name"></label>
    </div>

<p uk-margin>
    <button class="uk-button uk-button-default" id="category_add_button">ADD</button>
</p>

<script src="/admin/js/category.js"></script>

<?php include "../footer.php"; ?>