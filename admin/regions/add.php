<?php 
include_once "../config.php";
include "../header.php";
$breadcrumb = array(
    array('name' => 'Regions', 'url' => '/admin/regions'),
    array('name' => 'Create new region', 'url' => '')
);

createBreadcrumbs($breadcrumb);
?>

<form class="uk-form-horizontal uk-margin-large form-add">
    <div class="uk-margin">
        <label class="uk-form-label" for="regions_name"> Region Name </label>
        <div>
            <input class="uk-input" id="regions_name" type="text">
        </div>
        <label id="regions_label_name" for="regions_name"></label>
    </div>

<p uk-margin>
    <button class="uk-button uk-button-default" id="regions_add_button">ADD</button>
</p>

<script src="/admin/js/regions.js"></script>

<?php include "../footer.php"; ?>