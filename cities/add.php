<?php 
include_once "../config.php";
include "../header.php";

$cities = get_cities();
$districts = get_districts();

$breadcrumb = array(
    array('name' => 'cities', 'url' => '/cities'),
    array('name' => 'Add city', 'url' => '')
);

createBreadcrumbs($breadcrumb);
?>

<form class="uk-form-horizontal uk-margin-large form-add">

    <div class="uk-margin">
        <label class="uk-form-label" for="cities_type">Type</label>
        <div>
            <input class="uk-input" id="cities_type" type="text">
        </div>
        <label id="cities_label_type" for="cities_type"></label>    
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="cities_district">District</label>
        <div class="edit_items-line-input">
            <select class="uk-select" id="cities_district">
                <?php foreach ($districts as $key => $value): ?>
                    <option value="<?php echo $value['id'] ?>">
                    <?php echo $value['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <label id="cities_label_district" for="cities_district"></label>
        </div>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="cities_name">Title</label>
        <div>
            <input class="uk-input" id="cities_name" type="text">
        </div>
        <label id="cities_label_name" for="cities_name"></label>    
    </div>

    <p uk-margin>
        <button class="uk-button uk-button-default" id="cities_add_button">ADD</button>
    </p>
                </form>

<script src="/js/cities.js"></script>

<?php include "../footer.php"; ?>