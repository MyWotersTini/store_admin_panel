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

$regions = get_regions($args); 
$args['count']      = get_regions_count($args);
// var_dump($regions);
$breadcrumb = array(
    array('name' => 'Regions', 'url' => '/admin/regions'),
);

// createBreadcrumbs($breadcrumb);
?>

<div class="table_edit">
    <div class="table_edit-container uk-container" >
        <?php createBreadcrumbs($breadcrumb); ?>
        <div class="table_top_panel"  uk-margin>
            <a class="uk-button uk-button-default add-button" href="/admin/regions/add.php">Create new region</a>
            <div class="table_top_panel-right">
                <?php limitList($args); ?>
                <form class="uk-search uk-search-default" method="GET">
                    <button class="uk-search-icon-flip" uk-search-icon></button>
                    <input class="uk-search-input" type="search" placeholder="Search" aria-label="Search" name="search" value="<?php echo $args['search'] ?>">
                    <input type="hidden" name="limit" value="<?php echo $args['limit'] ?>">
                </form>
                <a class="uk-button uk-button-default" href="/admin/regions">Clear</a>
            </div>
        </div>

        <div class="table_edit-header">
           <?php table_head_generator(['orderby' => 'name','name' => 'Name'], $args); ?>
        </div>
        <div class="table_edit-content">
            
            <?php foreach($regions as $item){ ?>
                <div class="table_edit-content-item"> 
                    <div class="table_edit-content-item-td"> 
                        <?php echo $item['name'] ?>

                        <div class="actions_block">
                            <a href="edit.php?id=<?php echo $item['id'] ?>">Edit</a>
                            <a  
                                href="#modal_delete_table" 
                                data-name   ="<?php echo $item['name'] ?>" 
                                data-id     ="<?php echo $item['id'] ?>" 
                                class="red">Trash</a>
                        </div>
                    </div>   
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
            <button id="regions_delete_button" class="uk-button uk-button-primary" type="button">Delete</button>
        </p>
    </div>
</div>

<script src="/admin/js/regions.js"></script>

<?php include "../footer.php"; ?>