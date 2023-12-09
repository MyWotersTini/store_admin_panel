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
                            <!-- має з'являтися при наведення на table_edit-content-item-td -->

                            <a href="manufacture_table_edit.php?id=<?php echo $item['id'] ?>">Edit</a>
                            <a href="" class="red">Trash</a>
                        </div>
                    </div>
                    <div class="table_edit-content-item-td"> <?php echo $item['country'] ?> </div>
                    <div class="table_edit-content-item-td"> <?php echo $item['count'] ?>  </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>