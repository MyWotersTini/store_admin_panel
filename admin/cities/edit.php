<?php
include_once "../config.php";

if (empty($_SESSION) || empty($_GET['id'])) {
    header("Location: /");
    exit;
}

$result = get_cities_by_id($_GET['id']);
$districts = get_districts();
// $cities = $result->fetch_row();
$cities = mysqli_fetch_assoc($result);
// var_dump($cities);

if (empty($cities)) {
    header("Location: /");
    exit;
}

include "../header.php";

$breadcrumb = array(
    [
        'name' => 'cities', 
        'url' => '/admin/cities'
    ],
    [
        'name' => 'Edit cities', 
        'url' => ''
    ]
);

createBreadcrumbs($breadcrumb);
?>


<div id="cities_form_edit" class="form-edit">
    <div class="main_edit">
        <div class="first_text">Editing</div>
        <div class="edit_items">
            <div class="edit_items-line">
                <div class="edit_items-line-type">Type</div>
                <div class="edit_items-line-input">
                    <input id="cities_type" class="uk-input" type="text" value="<?php echo $cities['type']?>" disabled>
                    <label id="cities_label_type" for="cities_type"></label>
                </div>
            </div>
            <div class="edit_items-line">
                <div class="edit_items-line-name">District</div>
                <div class="edit_items-line-input">
                    <select id="cities_district" class="uk-select">
                        <?php foreach ($districts as $key => $value): ?>
                            <option value="<?php echo $value['id'] ?>"
                                <?php echo ($value['id'] == $cities['district_id']) ? 'selected' : '' ?>
                            >
                            <?php echo $value['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label id="cities_label_district" for="cities_district"></label>
                </div>
            </div>
            <div class="edit_items-line">
                <div class="edit_items-line-name">Title</div>
                <div class="edit_items-line-input">
                    <input id="cities_name" class="uk-input" type="text" value="<?php echo $cities['title']?>">
                    <label id="cities_label_name" for="cities_name"></label>
                </div>
            </div>
        </div>
        <div class="submit_item">
            <button id="cities_edit_button" class="uk-button uk-button-default" cities_id="<?php echo $cities['id']?>">Save</button>
        </div>
    </div>
</div>

<script src="/admin/js/cities.js"></script>

<?php include "../footer.php"; ?>