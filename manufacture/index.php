<?php
include_once "../config.php";

if (empty($_SESSION)) {
    header("Location: /");
    exit;
}

include "../header.php";

$args         = array(
    'search' => $_GET['search'] ?: '',
);
$manufactures = get_manufactures($args);

$breadcrumb = array(
    array('name' => 'Manufactures', 'url' => '/manufacture'),
);

create_breadcrumbs($breadcrumb);
?>

<div class="table_edit">
    <div class="table_edit-container uk-container" >
        <div class="table_top_panel"  uk-margin>
            <a class="uk-button uk-button-default add-button" href="/manufacture/add.php">Create new manufacture</a>
            <div class="table_top_panel-right">
                <form class="uk-search uk-search-default" method="GET">
                    <button class="uk-search-icon-flip" uk-search-icon></button>
                    <input class="uk-search-input" type="search" placeholder="Search" aria-label="Search" name="search" value="<?php echo $_GET['search'] ?>">
                </form>
                <a class="uk-button uk-button-default" href="/manufacture">Clear</a>
            </div>
        </div>

        <div class="table_edit-header">
            <div class="table_edit-header-item"> Name </div>
            <div class="table_edit-header-item"> Country </div>
            <div class="table_edit-header-item"> Count </div>
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