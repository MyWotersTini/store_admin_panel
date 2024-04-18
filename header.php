<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php get_the_option('site_name') ?></title>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.19/dist/css/uikit.min.css" />
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<nav class="uk-navbar-container" uk-navbar>
    <div class="uk-container">
        <h1><?php get_the_option('site_name') ?></h1>
    </div>
</nav>
 <p><?php get_the_option('site_subtitle') ?></p>