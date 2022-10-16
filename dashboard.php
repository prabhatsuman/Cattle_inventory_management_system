<?php
include 'php_includes/functions.php';
include 'database_connection.php';
if (!is_admin_login()) {
    header("location:login.php");
}
include 'php_includes/header.php';
?>

<section id="pricing">


    <div class="row">

        <div class="pricing-column col-lg-3 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Cattles In Farm</h3>
                    <div class="card-body">
                        <p>Total</p>
                        <?php

                        $query1 = $connect->query("
                        SELECT COUNT(cattle_id) FROM cattle;
                                ");

                                foreach($query1 as $data2)
                                {
                                  $sum_quantity_cow = $data2['COUNT(cattle_id)'];
                                  
                                }
                                echo json_encode($sum_quantity_cow);


                        ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="pricing-column col-lg-3 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3> Dealers </h3>
                    <div class="card-body">
                        <p>Total</p>
                        <?php

                        $query1 = $connect->query("
                        SELECT COUNT(dealer_id) FROM dealers;
                                ");

                                foreach($query1 as $data2)
                                {
                                  $sum_quantity = $data2['COUNT(dealer_id)'];
                                  
                                }
                                echo json_encode($sum_quantity);


                        ?>

                      

                    </div>
                </div>
            </div>
        </div>

        <div class="pricing-column col-lg-3 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Production(Cow)</h3>
                    <div class="card-body">
                        <p>Today</p>
                        <?php

                        $query1 = $connect->query("
                        SELECT SUM(quantity) FROM production where p_date=CURRENT_DATE AND c_id LIKE'C%';
                                ");

                                foreach($query1 as $data2)
                                {
                                  $sum_quantity = $data2['SUM(quantity)'];
                                  
                                }
                                echo json_encode($sum_quantity);


                        ?>



                    </div>
                </div>
            </div>
        </div>

        <div class="pricing-column col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h3>Production(Buffalo)</h3>
                    <div class="card-body">
                        <p>Today</p>
                        <?php

                        $query1 = $connect->query("
                        SELECT SUM(quantity) FROM production where p_date=CURRENT_DATE AND c_id LIKE'B%';
                                ");

                                foreach($query1 as $data2)
                                {
                                  $sum_quantity = $data2['SUM(quantity)'];
                                  
                                }
                                echo json_encode($sum_quantity);


                        ?>


                    </div>
                </div>
            </div>
        </div>

    </div>
</section>