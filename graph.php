<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Document</title>
</head>

<body>




  <div style="width: 500px;">
    <canvas id="myChart6"></canvas>
  </div>
  <div style="width: 500px;">
    <canvas id="myChart7"></canvas>
  </div>

  <div style="width: 500px;">
    <canvas id="myChart8"></canvas>
  </div>

  <div style="width: 500px;">
    <canvas id="myChart9"></canvas>
  </div>


  <?php
  include 'database_connection.php';
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
  $date=array();
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
  $cow1=array(
    'cow'=>$sum_quantity_cow,
    'date'=>$sum_cow_date
  );
  
  $buffalo1=array(
    'buffalo'=>$sum_quantity_buffalo,
    'date'=>$sum_buffalo_date
  
  );
  // echo"<br>";
  // // print_r($cow1) ;
  // echo"<br>";
  // // echo count($cow1['cow']);
  // echo"<br>";
  $cow = array();
  $buffalo = array();
  for($j=0;$j<count($date);$j++){

    $temp = $date[$j];
    echo $temp;
    echo "<br>";
    $flag = 0;
    for ($i = 0; $i < count($cow1['date']); $i++) {
     
      if ($temp == $cow1['date'][$i]) {
        $flag = 1;
        array_push($cow, $cow1['cow'][$i]);
        break;
      }
      
      }
      if($flag==0){
        array_push($cow,0);
    }
  }
  print_r($cow);
  for($j=0;$j<count($date);$j++){

    $temp = $date[$j];
    echo $temp;
    echo "<br>";
    $flag = 0;
    for ($i = 0; $i < count($buffalo1['date']); $i++) {
     
      if ($temp == $buffalo1['date'][$i]) {
        $flag = 1;
        array_push($buffalo, $buffalo1['buffalo'][$i]);
        break;
      }
      
      }
      if($flag==0){
        array_push($buffalo,0);
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
    new Chart("myChart5", {
      type: "line",
      data: {
        labels: <?php echo json_encode($p_date) ?>,
        datasets: [{
          label: ' COW',
          data: <?php echo json_encode($sum_quantity_cow) ?>,
          borderColor: "PINK",
          fill: false
        }, {
          label: ' BUFFALO',
          data: <?php echo json_encode($sum_quantity_buff) ?>,
          borderColor: "BLUE",
          fill: false
        }, {
          label: ' TOTAL',
          data: <?php echo json_encode($sum_quantity) ?>,
          borderColor: "GREEN",
          fill: false
        }]
      },
      options: {
        legend: {
          display: false
        }
      }
    });
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


    new Chart("myChart8", {
      type: "bar",
      data: {
        labels: <?php echo json_encode($months) ?>,
        datasets: [{
          label: 'PROFIT',
          backgroundColor: [
            'rgba(137, 196, 244,0.5)',
            'rgba(137, 196, 244,0.5)',
            'rgba(137, 196, 244,0.5)',
            'rgba(137, 196, 244,0.5)',
            'rgba(137, 196, 244,0.5)',
            'rgba(137, 196, 244,0.5)',
            'rgba(137, 196, 244,0.5)',
            'rgba(137, 196, 244,0.5)',
            'rgba(137, 196, 244,0.5)',
            'rgba(137, 196, 244,0.5)'
          ],
          borderColor: [
            'rgba(30, 139, 195,0.5)',
            'rgba(30, 139, 195,0.5)',
            'rgba(30, 139, 195,0.5)',
            'rgba(30, 139, 195,0.5)',
            'rgba(30, 139, 195,0.5)',
            'rgba(30, 139, 195,0.5)',
            'rgba(30, 139, 195,0.5)',
            'rgba(30, 139, 195,0.5)',
            'rgba(30, 139, 195,0.5)',
            'rgba(30, 139, 195,0.5)',
            'rgba(30, 139, 195,0.5)'
          ],
          borderWidth: 1,
          data: <?php echo json_encode($profit) ?>
        }]
      },
      options: {}
    });


    var ctx2 = document.getElementById("myChart9").getContext('2d');
    var myChart = new Chart(ctx2, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
          label: 'LEGEND',
          data: [9, 14, -4, 15, -8, 10]
        }]
      },
      options: {}

    });
  </script>

</body>

</html>