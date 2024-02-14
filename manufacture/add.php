<?php 
include_once "../config.php";
include "../header.php";

$countries = get_countries();

$breadcrump = array(
    array('name' => 'Manufactures', 'url' => '/manufacture'),
    array('name' => 'Add manufacture', 'url' => '')
);

create_breadcrumbs($breadcrump);
?>

<form class="uk-form-horizontal uk-margin-large form-add">

    <div class="uk-margin">
        <label class="uk-form-label" for="manufacture_name">Company name</label>
        <div>
            <input class="uk-input" id="manufacture_name" type="text">
        </div>
        <label id="manufacture_label_name" for="manufacture_name"></label>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="manufacture_country">Country</label>
        <div class="edit_items-line-input">
            <select class="uk-select" id="manufacture_country">
                <?php foreach ($countries as $key => $value): ?>
                    <option value="<?php echo $value['id'] ?>">
                    <?php echo $value['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <label id="manufacture_label_country" for="manufacture_country"></label>
        </div>
    </div>

    <p uk-margin>
        <button class="uk-button uk-button-default" id="manufacture_add_button">ADD</button>
    </p>
                </form>

<script src="/js/manufacture.js"></script>

<?php include "../footer.php"; ?>