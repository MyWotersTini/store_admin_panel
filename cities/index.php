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
$cities             = get_cities($args);
$args['count']      = get_cities_count($args);

$breadcrumb = array(
    array('name' => 'Cities', 'url' => '/cities'),
);

?>

<div class="table_edit">
    <div class="table_edit-container uk-container" >
        <?php create_breadcrumbs($breadcrumb); ?>
        <div class="table_top_panel"  uk-margin>
            <a class="uk-button uk-button-default add-button" href="/cities/add.php">Create new cities</a>
            <div class="table_top_panel-right">
                <?php limitList($args); ?>
                <form class="uk-search uk-search-default" method="GET">
                    <button class="uk-search-icon-flip" uk-search-icon></button>
                    <input class="uk-search-input" type="search" placeholder="Search" aria-label="Search" name="search" value="<?php echo $args['search'] ?>">
                    <input type="hidden" name="limit" value="<?php echo $args['limit'] ?>">
                </form>
                <a class="uk-button uk-button-default" href="/cities">Clear</a>
            </div>
        </div>

        <div class="table_edit-header">
            <div class="table_edit-header-item">
                <?php if($args['orderby'] == 'type' && $args['ordertype'] != 'DESC'): ?>    
            <a href="?orderby=type&ordertype=DESC"> Type </a>
                <?php else: ?>
                    <a href="?orderby=type"> Type </a>
                <?php endif; ?>
            </div>
            <div class="table_edit-header-item"><a href="?orderby=district"> District </a></div>
            <div class="table_edit-header-item"><a href="?orderby=title"> Title </a></div>
        </div>
        <div class="table_edit-content">
            
            <?php foreach($cities as $item){ ?>
                <div class="table_edit-content-item"> 
                    <div class="table_edit-content-item-td"> 
                        <?php echo $item['type'] ?>

                        <div class="actions_block">
                            <a href="edit.php?id=<?php echo $item['id'] ?>">Edit</a>
                            <a  
                                href="#modal_delete_table" 
                                data-name   ="<?php echo $item['type'] ?>" 
                                data-country="<?php echo $item['district'] ?>" 
                                data-id     ="<?php echo $item['id'] ?>" 
                                data-count  ="<?php echo $item['title'] ?>" 
                                class="red">Trash</a>
                        </div>
                    </div>
                    <div class="table_edit-content-item-td"> <?php echo $item['district'] ?> </div>
                    <div class="table_edit-content-item-td"> <?php echo $item['title'] ?>  </div>
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
            <button id="cities_delete_button" class="uk-button uk-button-primary" type="button">Delete</button>
        </p>
    </div>
</div>

<script src="/js/cities.js"></script>

<?php include "../footer.php"; ?>