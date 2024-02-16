<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Managment</title>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.19/dist/css/uikit.min.css" />
    <link rel="stylesheet" href="/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<?php if (!empty($_SESSION)) { ?>
<div class="header">
    <nav class="uk-navbar-container uk-margin uk-padding uk-padding-remove-vertical" uk-navbar>
        <div class="uk-navbar-left">
            <span class="menu_icon" uk-icon="menu" uk-toggle="target: #offcanvas-nav"></span>

            <a href="/"><img class="header_logo" src="https://i.imgur.com/OH7Yxoy.png" alt="Header Logo"></a>
        </div>
    </nav> 
</div>


<div id="offcanvas-nav" uk-offcanvas="overlay: true">
    <div class="uk-offcanvas-bar">

        <ul class="uk-nav uk-nav-default">
            <li class="uk-nav-header">Menu</li>
            <li><a href="/"><span class="uk-margin-small-right" uk-icon="icon: home"></span> Home</a></li>
            <li><a href="/manufacture"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Manufactures</a></li>
            <li><a href="/category"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Categories</a></li>
            <li><a href="/regions"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Regions</a></li>
            <li class="uk-nav-divider"></li>
            <li><a id="logout" href="#"><span class="uk-margin-small-right" uk-icon="icon: sign-out"></span> Logout</a></li>
        </ul>

    </div>
</div>


<?php } ?>