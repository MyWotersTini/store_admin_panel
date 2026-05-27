<?php 
include_once "../config.php";
include "../header.php";

$orders = get_orders();

$breadcrumb = array(
    array('name' => 'orders', 'url' => '/admin/orders '),
    array('name' => 'Add order', 'url' => '')
);

createBreadcrumbs($breadcrumb);
?>

<form class="uk-form-horizontal uk-margin-large form-add">

    <div class="uk-margin">
        <label class="uk-form-label" for="orders_name">Client name</label>
        <div>
            <input class="uk-input" id="orders_name" type="text">
        </div>
        <label id="orders_label_name" for="orders_name"></label>    
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="orders_surname">Client surname</label>
        <div>
            <input class="uk-input" id="orders_surnamname="text">
        </div>
        <label id="orders_label_surname" for="orders_surname"></label>    
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="orders_address">Address</label>
        <div>
            <input class="uk-input" id="orders_surnamname="text">
        </div>
        <label id="orders_label_surname" for="orders_surname"></label>    
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="orders_district"></label>
        <div class="edit_items-line-input">
            <select class="uk-select" id="orders_district">
                <?php foreach ($districts as $key => $value): ?>
                    <option value="<?php echo $value['id'] ?>">
                    <?php echo $value['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <label id="orders_label_district" for="orders_district"></label>
        </div>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="orders_name">Title</label>
        <div>
            <input class="uk-input" id="orders_name" type="text">
        </div>
        <label id="orders_label_name" for="orders_name"></label>    
    </div>

    <p uk-margin>
        <button class="uk-button uk-button-default" id="orders_add_button">ADD</button>
    </p>
                </form>

<script src="/admin/js/orders.js"></script>

<?php include "../footer.php"; ?>