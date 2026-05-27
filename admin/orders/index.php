<?php
include_once "../config.php";

if (empty($_SESSION)) {
    header("Location: /");
    exit;
}

include "../header.php";

$args         = array(
    'search'    => $_GET['search']     ?? '',
    'limit'     => $_GET['limit']      ?? 10,
    'orderby'   => $_GET ['orderby']   ?? '',
    'ordertype' => (!empty($_GET ['ordertype']) && $_GET['ordertype'] == 'DESC') ? 'DESC' : 'ASC',
    'page'      => $_GET['page']       ?? '1',
);

$orders             = get_orders($args);
$args['count']      = get_orders_count($args);
$clients            = get_clients();

$breadcrumb = array(
    array('name' => 'Orders', 'url' => '/orders'),
);

?>

<div class="table_edit">
    <div class="table_edit-container uk-container" >
        <?php createBreadcrumbs($breadcrumb); ?>
        <div class="table_top_panel"  uk-margin>
            <a class="uk-button uk-button-default add-button add-button-order" href="/admin/orders/add.php" >Create new order</a>
            <div class="table_top_panel-right">
                <?php limitList($args); ?>
                <form class="uk-search uk-search-default" method="GET">
                    <button class="uk-search-icon-flip" uk-search-icon></button>
                    <input class="uk-search-input" type="search" placeholder="Search" aria-label="Search" name="search" value="<?php echo $args['search'] ?>">
                    <input type="hidden" name="limit" value="<?php echo $args['limit'] ?>">
                </form>
                <a class="uk-button uk-button-default" href="/admin/orders">Clear</a>
            </div>
        </div>

        <div class="table_edit-header">
            <div class="table_edit-header-item">
                <?php if($args['orderby'] == 'order' && $args['ordertype'] != 'DESC'): ?>    
                    <a href="<?php echo urlGenerator($args, 'ordertype','DESC', ['search','limit','orderby','ordertype']) ?>"> Order </a>
                <?php else: ?>
                    <a href="<?php echo urlGenerator($args, 'orderby','order', ['search','limit','orderby']) ?>"> Order </a>
                <?php endif; ?>
            </div>

            <div class="table_edit-header-item">
                <?php if($args['orderby'] == 'client' && $args['ordertype'] != 'DESC'): ?> 
                    <a href="<?php echo urlGenerator($args, 'ordertype','DESC', ['search','limit','orderby','ordertype']) ?>"> Client </a>
                <?php else: ?>
                    <a href="<?php echo urlGenerator($args, 'orderby','client', ['search','limit','orderby']) ?>"> Client </a>
                <?php endif; ?>
            </div>

            <div class="table_edit-header-item">
                <?php if($args['orderby'] == 'total_cost' && $args['ordertype'] != 'DESC'): ?> 
                    <a href="<?php echo urlGenerator($args, 'ordertype','DESC', ['search','limit','orderby','ordertype']) ?>"> Sum </a>
                <?php else: ?>
                    <a href="<?php echo urlGenerator($args, 'orderby','total_cost', ['search','limit','orderby']) ?>"> Sum </a>
                <?php endif; ?>
            </div>

            <div class="table_edit-header-item">
                <?php if($args['orderby'] == 'date' && $args['ordertype'] != 'DESC'): ?> 
                    <a href="<?php echo urlGenerator($args, 'ordertype','DESC', ['search','limit','orderby','ordertype']) ?>"> Date </a>
                <?php else: ?>
                    <a href="<?php echo urlGenerator($args, 'orderby','date', ['search','limit','orderby']) ?>"> Date </a>
                <?php endif; ?>
            </div>

            <div class="table_edit-header-item">
                <?php if($args['orderby'] == 'mang' && $args['ordertype'] != 'DESC'): ?> 
                    <a href="<?php echo urlGenerator($args, 'ordertype','DESC', ['search','limit','orderby','ordertype']) ?>"> Manager </a>
                <?php else: ?>
                    <a href="<?php echo urlGenerator($args, 'orderby','mang', ['search','limit','orderby']) ?>"> Manager </a>
                <?php endif; ?>
            </div>

            <div class="table_edit-header-item">
                <?php if($args['orderby'] == 'status' && $args['ordertype'] != 'DESC'): ?> 
                    <a href="<?php echo urlGenerator($args, 'ordertype','DESC', ['search','limit','orderby','ordertype']) ?>"> Status </a>
                <?php else: ?>
                    <a href="<?php echo urlGenerator($args, 'orderby','status', ['search','limit','orderby']) ?>"> Status </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="table_edit-content">
            
            <?php foreach($orders as $item){ ?>
                <div class="table_edit-content-item"> 
                    <div class="table_edit-content-item-td"> 
                        <?php echo $item['id'] ?>

                        <div class="actions_block">
                            <a href="edit.php?id=<?php echo $item['id'] ?>">Edit</a>
                            <a  
                                href="#modal_delete_table" 
                                data-order   ="<?php echo $item['id'] ?>" 
                                data-client="<?php echo $item['client_id'] ?>" 
                                data-sum     ="<?php echo $item['total_cost'] ?>" 
                                data-date  ="<?php echo $item['date'] ?>" 
                                data-manager  ="<?php echo $item['manager'] ?>" 
                                data-status  ="<?php echo $item['status'] ?>" 
                                class="red">Trash</a>
                        </div>
                    </div>
                    <div class="client_table"> 
                        <div class="client_item">
                            <div class="table_edit-content-item-td"> <?php echo $item['client_name'] ?> </div>
                        </div>
                        <div class="client_item">
                            <div class="table_edit-content-item-td"> <?php echo $item['client_surname'] ?> </div>
                        </div>
                        <div class="client_item">
                            <div class="table_edit-content-item-td"> <?php echo $item['address'] ?> </div>
                        </div>
                        <div class="client_item">
                            <div class="table_edit-content-item-td"> <?php echo $item['client_phone'] ?> </div>
                        </div>
                    </div>
                    <div class="table_edit-content-item-td"> <?php echo $item['total_cost'] ?>  </div>
                    <div class="table_edit-content-item-td"> <?php echo $item['date'] ?>  </div>
                    <div class="table_edit-content-item-td"> <?php echo $item['manager'] ?>  </div>
                    <div class="table_edit-content-item-td"> <?php echo $item['status'] ?>  </div>
                </div>
            <?php } ?>

            <?php pagination($args); ?>
        </div>
    </div>
</div>

<div id="modal_delete_table" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">Delete Table <span></span>?</h2>
        <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <button id="orders_delete_button" class="uk-button uk-button-primary" type="button">Delete</button>
        </p>
    </div>
</div>

<script src="/admin/js/orders.js"></script>

<?php include "../footer.php"; ?>