<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="http://localhost/DBMS_project/js/font-awesome-5-all.min.js"></script>
<?php
include 'php_includes/functions.php';
include 'database_connection.php';
if (!is_admin_login()) {
    header("location:login.php");
}
include 'php_includes/header.php';
?>

<section>
    <div class="row p-1">
        <div class="pricing-column col-lg-3 col-md-6 m-auto p-4">
            <div class="card" style="text-align:center; background-color: rgb(89, 212, 109);color:white;">
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
                $s1 += $data2['SUM(quantity)'];
            }



            ?>
            <div class="card" style="text-align:center; background-color: rgb(89, 212, 109);color:white; ">
                <div class="card-header">
                    <h3><?php echo "$s1 " ?><span>
                            <h6 style="display:inline ;">Liters</h6>
                        </span></h3>
                    </h3>
                    <div class="card-body">
                        <p>Today by Buffalos</p>



                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- <div style="width: 500px;">
        <canvas id="myChart6"></canvas>
    </div>
    <div style="width: 500px;">
        <canvas id="myChart7"></canvas>
    </div> -->

<div class="card mb-4 p-1">

    <div class="card-body">

        <div class="row">

            <div class="col-md-4">
                <div class="card-header">
                <i class="fa-solid fa-chart-simple"></i>Total Production Per day
                </div>
                <div class="mb-3 m-auto" style="width:100%;">
                    <canvas id="myChart6"></canvas>
                </div>
            </div>
            <div class="col-md-4">
            <div class="card-header">
                    <i class="fas fa-user-plus"></i> Total By Each Cattle
                </div>
                <div class="mb-3 m-auto" style="width: 75%;">
                    <canvas id="myChart7"></canvas>
                </div>
            </div>
            <div class="col-md-4">
            <div class="card-header">
                    <i class="fas fa-user-plus"></i> Edit Dealer Details
                </div>
                <div class="mb-3" style="width: 500px;">
                    <canvas id="myChart7"></canvas>
                </div>
            </div>
        </div>

    </div>




    <?php
    // include 'database_connection.php';
    $query7 = $connect->query("SELECT SUM(production.quantity) as cow,p_date FROM production INNER JOIN cattle WHERE cattle.cattle_id=production.c_id AND cattle.cattle_type='COW' GROUP BY production.p_date;");
    $res7 = $query7->fetchAll();
    $sum_quantity_cow = array();
    $sum_cow_date = array();
    $query8 = $connect->query("SELECT SUM(production.quantity) as buffalo,production.p_date FROM production INNER JOIN cattle WHERE cattle.cattle_id=production.c_id AND cattle.cattle_type='BUFFALO' GROUP BY production.p_date;");
    $res8 = $query8->fetchAll();
    $query9 = $connect->query("SELECT DISTINCT p_date FROM production;");
    $res9 = $query9->fetchAll();
    $sum_quantity_buffalo = array();
    $sum_buffalo_date = array();


    $sum_quantity_cow = array();
    $sum_cow_date = array();
    $date = array();
    foreach ($res7 as $row) {
        $sum_quantity_cow[] = $row['cow'];
        $sum_cow_date[] = $row['p_date'];
    }
    foreach ($res8 as $row) {
        $sum_quantity_buffalo[] = $row['buffalo'];
        $sum_buffalo_date[] = $row['p_date'];
    }
    foreach ($res9 as $row) {
        $date[] = $row['p_date'];
    }
    $cow1 = array(
        'cow' => $sum_quantity_cow,
        'date' => $sum_cow_date
    );

    $buffalo1 = array(
        'buffalo' => $sum_quantity_buffalo,
        'date' => $sum_buffalo_date

    );
    // echo"<br>";
    // // print_r($cow1) ;
    // echo"<br>";
    // // echo count($cow1['cow']);
    // echo"<br>";
    $cow = array();
    $buffalo = array();
    for ($j = 0; $j < count($date); $j++) {

        $temp = $date[$j];
        // echo $temp;
        // echo "<br>";
        $flag = 0;
        for ($i = 0; $i < count($cow1['date']); $i++) {

            if ($temp == $cow1['date'][$i]) {
                $flag = 1;
                array_push($cow, $cow1['cow'][$i]);
                break;
            }
        }
        if ($flag == 0) {
            array_push($cow, 0);
        }
    }
    // print_r($cow);
    for ($j = 0; $j < count($date); $j++) {

        $temp = $date[$j];
        // echo $temp;
        echo "<br>";
        $flag = 0;
        for ($i = 0; $i < count($buffalo1['date']); $i++) {

            if ($temp == $buffalo1['date'][$i]) {
                $flag = 1;
                array_push($buffalo, $buffalo1['buffalo'][$i]);
                break;
            }
        }
        if ($flag == 0) {
            array_push($buffalo, 0);
        }
    }
    // print_r($cow) ;


    $sum_cow = $connect->query("SELECT SUM(quantity) FROM production INNER JOIN cattle WHERE production.c_id=cattle.cattle_id AND cattle.cattle_type='COW';");
    $sum_buff = $connect->query("SELECT SUM(quantity) FROM production INNER JOIN cattle WHERE production.c_id=cattle.cattle_id AND cattle.cattle_type='BUFFALO';");
    $result = $sum_cow->fetchAll();
    $result1 = $sum_buff->fetchAll();
    foreach ($result as $row) {
        $sum_cow = $row['SUM(quantity)'];
    }
    foreach ($result1 as $row) {
        $sum_buff = $row['SUM(quantity)'];
    }
    $sum = $sum_cow + $sum_buff;
    $percent_cow = ($sum_cow / $sum) * 100;
    $percent_buff = ($sum_buff / $sum) * 100;
    ?>

    <script>
        var ctx = document.getElementById("myChart6").getContext("2d");

        var data = {
            labels: <?php echo json_encode($date) ?>,
            datasets: [{
                    label: "Cow",
                    backgroundColor: "blue",
                    data: <?php echo json_encode($cow) ?>
                },
                {
                    label: "Buffalo",
                    backgroundColor: "red",
                    data: <?php echo json_encode($buffalo) ?>
                },

            ]
        };

        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {

                barValueSpacing: 15,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                        }
                    }]
                }
            }
        });
        <?php



        ?>
        var xValues = ["Cow", "Buffalo"];
        var yValues = [<?php echo $percent_cow ?>, <?php echo $percent_buff ?>];
        var barColors = [
            "#b91d47",
            "#00aba9",
            "#2b5797",
            "#e8c3b9",
            "#1e7145"
        ];

        new Chart("myChart7", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },


        });
    </script>