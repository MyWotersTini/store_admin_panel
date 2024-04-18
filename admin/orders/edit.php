<?php
include_once "../config.php";

if (empty($_SESSION) || empty($_GET['id'])) {
    header("Location: /");
    exit;
}

$result = get_orders_by_id($_GET['id']);
$districts = get_districts($args);
// $orders = $result->fetch_row();
$orders = mysqli_fetch_assoc($result);
// var_dump($orders);

if (empty($orders)) {
    header("Location: /");
    exit;
}

include "../header.php";

$breadcrumb = array(
    [
        'name' => 'orders', 
        'url' => '/orders'
    ],
    [
        'name' => 'Edit orders', 
        'url' => ''
    ]
);

createBreadcrumbs($breadcrumb);
?>


<div id="orders_form_edit" class="form-edit">
    <div class="main_edit">
        <div class="first_text">Editing</div>
        <div class="edit_items">
            <div class="edit_items-line">
                <div class="edit_items-line-name">Type</div>
                <div class="edit_items-line-input">
                    <input id="orders_name" class="uk-input" type="text" value="<?php echo $orders['type']?>" disabled>
                    <label id="orders_label_name" for="orders_name"></label>
                </div>
            </div>
            <div class="edit_items-line">
                <div class="edit_items-line-name">District</div>
                <div class="edit_items-line-input">
                    <select id="orders_country" class="uk-select">
                        <?php foreach ($districts as $key => $value): ?>
                            <option value="<?php echo $value['id'] ?>"
                                <?php echo ($value['id'] == $orders['district']) ? 'selected' : '' ?>
                            >
                            <?php echo $value['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label id="orders_label_country" for="orders_country"></label>
                </div>
            </div>
            <div class="edit_items-line">
                <div class="edit_items-line-name">Title</div>
                <div class="edit_items-line-input">
                    <input id="orders_name" class="uk-input" type="text" value="<?php echo $orders['title']?>">
                    <label id="orders_label_name" for="orders_name"></label>
                </div>
            </div>
        </div>
        <div class="submit_item">
            <button id="orders_edit_button" class="uk-button uk-button-default" orders_id="<?php echo $orders['id']?>">Save</button>
        </div>
    </div>
</div>

<script src="/js/orders.js"></script>

<?php include "../footer.php"; ?>