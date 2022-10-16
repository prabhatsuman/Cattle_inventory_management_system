<?php
//index.php
include 'database_connection.php';
include 'php_includes/functions.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>

    <style>
        .carousel-caption {
            /* justify-content: center; */
            /* justify-items: center; */
            /* bottom: 50%; */
            /* left: 20%; */
            /* right: 50%; */
            z-index: 2;
            color: white;
            /* text-shadow: 1px 1px #fffdfd; */
        }
    </style>

    <title>Document</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="color: white;
            font-weight: bold;
            font-size: x-large;">Cattle Manager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav  ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="About.html">About</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>
    <section id="abc">



        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner ">
                <div class="carousel-item active">
                    <img src="pictures/vito-natale-OVxH82dipDY-unsplash.jpg" class="d-block   abcd" alt="...">
                    <div class="carousel-caption">
                        <h1 style="font-size:300%;">We manage your herd with <strong>accuracy,</strong> </h1>
                        <h1 style="font-size:300%;"> <strong>simplicity</strong> and <strong>confidence.</strong> </h1>

                    </div>
                </div>

                <div class="carousel-item">
                    <img src="pictures/pexels-mark-stebnicki-8487939.jpg" class="d-block  abcd" alt="...">
                    <div class="carousel-caption">
                        <h1 style="font-size:300%;">We harness your valuable data to demonstrate compliance, and easily provide Inspectors with user-friendly reports.</h1>
                        <!-- <h1 style="font-size:300%;"> <strong>simplicity</strong> and <strong>confidence.</strong> </h1> -->
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="pictures/milk_6_generated.jpg" class="d-block abcd" alt="...">

                    <!-- <div class="carousel-caption"> -->
                    <!-- <h1 style="font-size:300%;">We have highest quality of milk and milk-products.</h1>
                         -->
                    <!-- <h1 style="font-size:300%;"> <strong>simplicity</strong> and <strong>confidence.</strong> </h1> -->
                    <!-- </div> -->

                </div>
                <div class="carousel-item">
                    <img src="pictures/healthy cow.jpeg" class="d-block abcd" alt="...">

                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">

    
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>

    </section>


    <!-- pricing -->

    <section id="pricing">

        <h2>Prices for sale of Milk</h2>
        <p>Pure milk at affordable rates for everyone.</p>
        <div class="row">

            <div class="pricing-column col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Cows's Milk</h3>
                        <div class="card-body">
                            <h2>₹65/L</h2>
                            <p>good and pure milk</p>
                            <p>available in morning from 8-10 am</p>
                            <p>home delivery in special case</p>
                            <p>no online orders</p>

                        </div>
                    </div>
                </div>
            </div>

            <div class="pricing-column col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Buffalo's Milk</h3>
                        <div class="card-body">

                            <h2>₹60/L</h2>
                            <p>good and pure milk</p>
                            <p>available in evening from 5-7 pm</p>
                            <p>home delivery in special case</p>
                            <p>no online orders</p>


                        </div>
                    </div>
                </div>
            </div>

            <div class="pricing-column col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Butter</h3>
                        <div class="card-body">
                            <h2>₹500/kg</h2>
                            <p>Healthy and tasty</p>
                            <p>available at any time</p>
                            <p>home delivery in special case</p>
                            <p>no online orders</p>



                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <div class="bottom-container">

        <a class="footer-link" href="https://www.linkedin.com/in/prabhat-suman-14a354200/">LinkedIn</a>
        <a class="footer-link" href="https://twitter.com/Pranav_bh003/">Twitter</a>
        <a class="footer-link" href="https://www.statista.com/">cattle_inventory</a>
        <p class="copyright">© Cattle-inventory.</p>
    </div>


</body>

</html>