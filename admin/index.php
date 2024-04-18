<?php
include_once "config.php";

include "header.php";

if (!empty($_SESSION)) { ?>


<div class="uk-container">
    <div class="uk-child-width-expand@s uk-text-center" uk-grid>
        <div>
            <div class="uk-card uk-card-default uk-card-body">Item</div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body">Item</div>
        </div>
        <div>
            <div class="uk-card uk-card-default uk-card-body">Item</div>
        </div>
    </div>
</div>


<?php
}else{

?>
<div id="login-form">
    <div class="main_logo">
        <img src="https://i.imgur.com/OH7Yxoy.png" alt="Header Logo">
    </div>
    <div class="uk-margin">
        <div class="uk-inline" id="login-line">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <!-- <input class="uk-input" type="text" aria-label="Not clickable icon"> -->
            <?php 
                get_input_field([
                    'type'  => 'input', // select, textarea
                    'format' => 'text',
                    'class' => 'uk-input',
                ]);
            ?>
        </div>
            <div class="error_text" id="login_error" hidden></div>
    </div>

    <div class="uk-margin">
        <div class="uk-inline" id="pass-line">
            <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
            <input class="uk-input" type="password" aria-label="Not clickable icon">
        </div>
            <div class="error_text" id="pass_error" hidden></div>
    </div>
    <button class="uk-button uk-button-default" id="login-button">Connect</button>
</div>

<?php } ?>

<?php include "footer.php"; ?>