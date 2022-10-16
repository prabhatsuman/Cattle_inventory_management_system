<?php
    include 'php_includes/functions.php';
    include 'database_connection.php';
    if(!is_admin_login())
    {
        header("location:login.php");
    }
    include 'php_includes/header.php';
?>