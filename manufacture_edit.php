<?php
include_once "config.php";

if (empty($_SESSION)) {
    header("Location: /");
    exit;
}

include "header.php";

$manufactures = get_manufactures();
?>

<div class="table_edit">
    <div class="table_edit-container uk-container" >
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
                            <a href="manufacture_table_edit.php?id=<?php echo $item['id'] ?>">Edit</a>
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
        <p class="uk-text country_text">
        </p>
        <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <button class="uk-button uk-button-primary" type="button">Delete</button>
        </p>
    </div>
</div>

<script src="js/manufacture.js"></script>

<?php include "footer.php"; ?>