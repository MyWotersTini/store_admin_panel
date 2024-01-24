<?php 
include_once "config.php";
include "header.php";

$countries = get_countries();
?>

<form class="uk-form-horizontal uk-margin-large">

    <div class="uk-margin">
        <label class="uk-form-label" for="manufacture_name">Назва компанії</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="manufacture_name" type="text">
        </div>
        <label id="manufacture_label_name" for="manufacture_name"></label>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="manufacture_country">Країна</label>
        <div class="edit_items-line-input">
            <select id="manufacture_country">
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

<script src="js/manufacture.js"></script>

<?php include "footer.php"; ?>