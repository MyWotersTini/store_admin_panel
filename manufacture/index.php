<?php
include_once "../config.php";

if (empty($_SESSION)) {
    header("Location: /");
    exit;
}

include "../header.php";

$args         = array(
    'search'    => $_GET['search'] ?? '',
    'limit'     => $_GET['limit']      ?? 10,
    'orderby'   => $_GET ['orderby']   ?? '',
    'ordertype' => (!empty($_GET ['ordertype']) && $_GET['ordertype'] == 'DESC') ? 'DESC' : 'ASC',
    'page'      => $_GET['page']       ?? '1',
);
$manufactures = get_manufactures($args);
$args['count']      = get_manufactures_count($args);

$new_limit = $args['limit']; 
$show_array = ['search', 'limit', 'orderby', 'ordertype']; 

$newUrl = urlGenerator($args, 'limit', $new_limit, $show_array);

echo $newUrl;

$breadcrumb = array(
    array('name' => 'Manufactures', 'url' => '/manufacture'),
);

?>

<div class="table_edit">
    <div class="table_edit-container uk-container" >
        <?php createBreadcrumbs($breadcrumb); ?>
        <div class="table_top_panel"  uk-margin>
            <a class="uk-button uk-button-default add-button" href="/manufacture/add.php">Create new manufacture</a>
            <div class="table_top_panel-right">
                <?php limitList($args); ?>
                <form class="uk-search uk-search-default" method="GET">
                    <button class="uk-search-icon-flip" uk-search-icon></button>
                    <input class="uk-search-input" type="search" placeholder="Search" aria-label="Search" name="search" value="<?php echo $args['search'] ?>">
                </form>
                <a class="uk-button uk-button-default" href="/manufacture">Clear</a>
            </div>
        </div>

        <div class="table_edit-header">
            <div class="table_edit-header-item">
                <?php if($args['orderby'] == 'name' && $args['ordertype'] != 'DESC'): ?>    
                    <a href="?orderby=name&ordertype=DESC"> Name </a>
                <?php else: ?>
                    <a href="?orderby=nae"> Name </a>
                <?php endif; ?>
            </div>

            <div class="table_edit-header-item">
                <?php if($args['orderby'] == 'country' && $args['ordertype'] != 'DESC'): ?> 
            <a href="?orderby=country&ordertype=DESC"> Country </a>
                <?php else: ?>
                    <a href="?orderby=country"> Country </a>
                <?php endif; ?>
            </div>

            <div class="table_edit-header-item">
                <?php if($args['orderby'] == 'count' && $args['ordertype'] != 'DESC'): ?> 
                    <a href="?orderby=count&ordertype=DESC"> Count </a>
                <?php else: ?>
                    <a href="?orderby=count"> Count </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="table_edit-content">
            
            <?php foreach($manufactures as $item){ ?>
                <div class="table_edit-content-item"> 
                    <div class="table_edit-content-item-td"> 
                        <?php echo $item['name'] ?>

                        <div class="actions_block">
                            <a href="edit.php?id=<?php echo $item['id'] ?>">Edit</a>
                            <a  
                                href="#modal_delete_table" 
                                data-name   ="<?php echo $item['name'] ?>" 
                                data-country="<?php echo $item['country'] ?>" 
                                data-id     ="<?php echo $item['id'] ?>" 
                                data-count  ="<?php echo $item['count'] ?>" 
                                class="red">Trash</a>
                        </div>
                    </div>
                    <div class="table_edit-content-item-td"> <?php echo $item['country'] ?> </div>
                    <div class="table_edit-content-item-td"> <?php echo $item['count'] ?>  </div>
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
            <button id="manufacture_delete_button" class="uk-button uk-button-primary" type="button">Delete</button>
        </p>
    </div>
</div>

<script src="/js/manufacture.js"></script>

<?php include "../footer.php"; ?>