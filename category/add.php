<?php 
include_once "../config.php";
include "../header.php";
?>

<nav aria-label="Breadcrumb">
    <ul class="uk-breadcrumb">
        <li><a href="/">Home</a></li>
        <li><a href="/category">Categories</a></li>
        <li><a href="#">Create new category</a></li>
    </ul>
</nav>

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

<script src="/js/category.js"></script>

<?php include "../footer.php"; ?>