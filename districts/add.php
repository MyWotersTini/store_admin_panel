<?php 
include_once "../config.php";
include "../header.php";

$regions = get_regions($args);

$breadcrumb = array(
    array('name' => 'Districts', 'url' => '/districts'),
    array('name' => 'Add districts', 'url' => '')
);

create_breadcrumbs($breadcrumb);
?>

<form class="uk-form-horizontal uk-margin-large form-add">

    <div class="uk-margin">
        <label class="uk-form-label" for="districts_name">District name</label>
        <div>
            <input class="uk-input" id="districts_name" type="text">
        </div>
        <label id="districts_label_name" for="districts_name"></label>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="districts_region">Region</label>
        <div class="edit_items-line-input">
            <select class="uk-select" id="districts_region">
                <?php foreach ($regions as $key => $value): ?>
                    <option value="<?php echo $value['id'] ?>">
                    <?php echo $value['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <label id="districts_label_region" for="districts_region"></label>
        </div>
    </div>

    <p uk-margin>
        <button class="uk-button uk-button-default" id="districts_add_button">ADD</button>
    </p>
                </form>

<script src="/js/districts.js"></script>

<?php include "../footer.php"; ?>