<?php 
    function get_option($meta){
        global $connection;

        $sql = "SELECT value FROM options WHERE meta LIKE '" . $meta . "'";
        return mysqli_fetch_assoc(mysqli_query($connection, $sql))['value'];

    }
 
    function get_the_option($meta){
        global $connection;

        $sql = "SELECT value FROM options WHERE meta LIKE '" . $meta . "'";
        echo mysqli_fetch_assoc(mysqli_query($connection, $sql))['value'];

    }

