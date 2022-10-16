<?php
include 'php_includes/functions.php';
include 'database_connection.php';
if (!is_admin_login()) {
    header("location:login.php");
}
include 'php_includes/header.php';
?>

<section>
    <div class="row p-1" >
        <div class="pricing-column col-lg-3 col-md-6 m-auto p-4">
            <div class="card" style="text-align:center; background-color: rgb(89, 212, 109);color:white;" >
                <div class="card-header">
                    <?php

                    $query1 = $connect->query("SELECT COUNT(cattle_id) FROM cattle;");
                    $s1 = 0;
                    foreach ($query1 as $data2) {
                        $s1 += $data2['COUNT(cattle_id)'];
                    }

                    ?>
                    <h3><strong><?php echo "$s1 " ?></strong><span>
                            <h6 style="display:inline ;">Cattles</h6>
                        </span></h3>
                    <div class="card-body" <p>In Farm</p>


                    </div>
                </div>
            </div>
        </div>

        <div class="pricing-column col-lg-3 col-md-6 m-auto p-3">
            <div class="card" style="text-align:center; background-color: rgb(89, 212, 109);color:white;">
                <div class="card-header">
                    <?php

                    $query1 = $connect->query("SELECT COUNT(dealer_id) FROM dealers;");
                    $s1 = 0;
                    foreach ($query1 as $data2) {
                        $s1 += $data2['COUNT(dealer_id)'];
                    }


                    ?>
                    <h3> <?php echo "$s1 " ?> <span>
                            <h6 style="display:inline ;">Dealers</h6>
                        </span></h3>
                    <div class="card-body">
                        <p>Purchasing Products from Farm</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="pricing-column col-lg-3 col-md-6 m-auto p-4 ">
            <div class="card" style="text-align:center; background-color: rgb(89, 212, 109);color:white;">
                <div class="card-header">
                    <?php

                    $query1 = $connect->query("SELECT SUM(quantity) FROM production where p_date=CURRENT_DATE AND c_id LIKE'C%';");
                    $s1 = 0;
                    foreach ($query1 as $data2) {
                        $s1 += $data2['SUM(quantity)'];
                    }



                    ?>
                    <h3><?php echo "$s1 " ?><span>
                            <h6 style="display:inline ;">Liters</h6>
                        </span></h3>
                    <div class="card-body">
                        <p>Today by Cows</p>




                    </div>
                </div>
            </div>
        </div>

        <div class="pricing-column col-lg-3 p-4">
            <?php

            $query1 = $connect->query("SELECT SUM(quantity) FROM production where p_date=CURRENT_DATE AND c_id LIKE'B%';");       
            $s1 = 0;
            foreach ($query1 as $data2) {
                $s1+= $data2['SUM(quantity)'];
            }
            


            ?>
            <div class="card" style="text-align:center; background-color: rgb(89, 212, 109);color:white; ">
                <div class="card-header">
                    <h3><?php echo "$s1 " ?><span>
                            <h6 style="display:inline ;">Liters</h6>
                        </span></h3> </h3>
                    <div class="card-body">
                        <p>Today by Buffalos</p>



                    </div>
                </div>
            </div>
        </div>

    </div>
</section>