<?php

//header.php
// include 'functions.php';
// include '../database_connection.php';

// if(!is_admin_login())
// {
//     header('location:../login.php');
// }

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Dashboard</title>
    <link rel="canonical" href="">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../style.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/scripts.js"></script>
    <script src="../js/select2.min.js"></script>
    <script src="../js/font-awesome-5-all.min.js"></script>
    <link rel="canonical" href="">

    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/simple-datatables-style.css">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/simple-datatables@latest.js"></script>
    
    <!-- Favicons -->
     <link rel="apple-touch-icon" href="" sizes="180x180">
        <link rel="icon" href="" sizes="32x32" type="image/png">
        <link rel="icon" href="" sizes="16x16" type="image/png">
        <!-- <link rel="manifest" href="">
        <link rel="mask-icon" href="" color="#7952b3">
        <link rel="icon" href="">
        <meta name="theme-color" content="#7952b3"> --> -->

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>
<body class="sb-nav-fixed">

        <nav class="sb-topnav navbar navbar-expand navbar-dark ">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Cattle Mangement</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 " id="sidebarToggle" href="#!" style="color:black"><i class="fas fa-bars"></i></button>
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="profile.php" style="color:black">Profile</a></li>
                       
                        <li><a class="dropdown-item" href="../logout.php" style="color:black">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav" id="sidenavAccordion" style="background-color: rgb(89, 212, 109); ">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <!-- <a class="nav-link" href="category.php" style="color:white;">Category</a> -->
                            <!-- <a class="nav-link" href="author.php"style="color:white;">Author</a> -->
                            <!-- <a class="nav-link" href="location_rack.php"style="color:white;">Location Rack</a> -->
                            <!-- <a class="nav-link" href="book.php"style="color:white;">Book</a> -->
                            <!-- <a class="nav-link" href="user.php"style="color:white;">User</a> -->
                            <!-- <a class="nav-link" href="issue_book.php"style="color:white;">Issue Book</a> -->
                            <a class="nav-link" href="../admin/cattle_info.php"style="color:white;">Cattle Information</a>
                            <a class="nav-link" href="../logout.php"style="color:white;">Logout</a>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                       
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
           
               
<!-- JavaScript Bundle with Popper -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> -->
</html>