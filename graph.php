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

<?php 
  include 'database_connection.php';
  $query1 = $connect->query("
  SELECT SUM(sale),s_date from sales GROUP BY s_date;
  ");

  foreach($query1 as $data)
  {
    $sum_sale[] = $data['SUM(sale)'];
    $s_date[] = $data['s_date'];
  }


  $query2 = $connect->query("
  SELECT SUM(quantity),p_date FROM production where c_id LIKE 'C%'GROUP BY p_date;
  ");
  foreach($query2 as $data2)
  {
    $sum_quantity_cow[] = $data2['SUM(quantity)'];
    $p_date[] = $data2['p_date'];
  }


  $query3 = $connect->query("
  SELECT SUM(quantity),p_date FROM production where c_id LIKE 'B%'GROUP BY p_date;
  ");
  foreach($query3 as $data3)
  {
    $sum_quantity_buff[] = $data3['SUM(quantity)'];
    $p_date_c[] = $data3['p_date'];
  }

  $query4 = $connect->query("
  SELECT SUM(quantity),p_date FROM production GROUP BY p_date;
  ");
  foreach($query4 as $data4)
  {
    $sum_quantity[] = $data4['SUM(quantity)'];
    $p_date_all[] = $data4['p_date'];
  }

?>


<div style="width: 500px;">
  <canvas id="myChart"></canvas>
</div>

<div style="width: 500px;">
  <canvas id="myChart2"></canvas>
</div>
<div style="width: 500px;">
  <canvas id="myChart3"></canvas>
</div>
<div style="width: 500px;">
  <canvas id="myChart4"></canvas>
</div>

<div style="width: 500px;">
  <canvas id="myChart5"></canvas>
</div>
 
<script>
  // === include 'setup' then 'config' above ===
  new Chart("myChart", {
  type: "bar",
  data: {
    labels: <?php echo json_encode($s_date) ?>,
    datasets: [{
      label: 'SALES',
      backgroundColor: [
        'rgba(11, 156, 49, 0.2)',
        'rgba(11, 156, 49, 0.2)',
        'rgba(11, 156, 49, 0.2)',
        'rgba(11, 156, 49, 0.2)',
        'rgba(11, 156, 49, 0.2)',
        'rgba(11, 156, 49, 0.2)',
        'rgba(11, 156, 49, 0.2)',
        'rgba(11, 156, 49, 0.2)',
        'rgba(11, 156, 49, 0.2)',
        'rgba(11, 156, 49, 0.2)'
      ],
      borderColor: [
        'rgb(11, 156, 49,1)',
        'rgb(11, 156, 49,1)',
        'rgb(11, 156, 49,1)',
        'rgb(11, 156, 49,1)',
        'rgb(11, 156, 49,1)',
        'rgb(11, 156, 49,1)',
        'rgb(11, 156, 49,1)',
        'rgb(11, 156, 49,1)',
        'rgb(11, 156, 49,1)'
      ],
      borderWidth: 1,
      data: <?php echo json_encode($sum_sale) ?>
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "cow producyion"
    }
  }
});

new Chart("myChart2", {
  type: "bar",
  data: {
    labels: <?php echo json_encode($p_date) ?>,
    datasets: [{
      label: 'PRODUCTION BY COW',
      backgroundColor: [
        'rgba(255,105,180,0.5)',
        'rgba(255,105,180,0.5)',
        'rgba(255,105,180,0.5)',
        'rgba(255,105,180,0.5)',
        'rgba(255,105,180,0.5)',
        'rgba(255,105,180,0.5)',
        'rgba(255,105,180,0.5)',
        'rgba(255,105,180,0.5)',
        'rgba(255,105,180,0.5)',
        'rgba(255,105,180,0.5)',
        'rgba(255,105,180,0.5)'
      ],
      borderColor: [
        'rgba(255,20,147,0.5)',
        'rgba(255,20,147,0.5)',
        'rgba(255,20,147,0.5)',
        'rgba(255,20,147,0.5)',
        'rgba(255,20,147,0.5)',
        'rgba(255,20,147,0.5)',
        'rgba(255,20,147,0.5)',
        'rgba(255,20,147,0.5)',
        'rgba(255,20,147,0.5)',
        'rgba(255,20,147,0.5)',
        'rgba(255,20,147,0.5)'
      ],
      borderWidth: 1,
      data: <?php echo json_encode($sum_quantity_cow) ?>
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "cow producyion"
    }
  }
});


new Chart("myChart3", {
  type: "bar",
  data: {
    labels: <?php echo json_encode($p_date) ?>,
    datasets: [{
      label: 'PRODUCTION BY BUFFALO',
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
      data: <?php echo json_encode($sum_quantity_buff) ?>
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "cow producyion"
    }
  }
});



var xValues = <?php echo json_encode($p_date_all) ?>;
var yValues =<?php echo json_encode($sum_quantity) ?>

new Chart("myChart4", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
        label: 'TOTAL PRODUCTION',
      fill: false,
      lineTension: 0,
      backgroundColor: 'rgba(11, 156, 49, 0.2)',
      borderColor: 'rgba(11, 156, 49, 0.2)',
      data: yValues
    }]
  },
  options: {
    scales: {
      yAxes: [{ticks: {min: 6, max:16}}],
    }
  }
});



new Chart("myChart5", {
  type: "line",
  data: {
    labels: <?php echo json_encode($p_date) ?>,
    datasets: [{
        label: ' COW',
      data: <?php echo json_encode($sum_quantity_cow) ?>,
      borderColor: "PINK",
      fill: false
    },{
        label: ' BUFFALO',
      data: <?php echo json_encode($sum_quantity_buff) ?>,
      borderColor: "BLUE",
      fill: false
    },{
        label: ' TOTAL',
      data: <?php echo json_encode($sum_quantity) ?>,
      borderColor: "GREEN",
      fill: false
    }]
  },
  options: {
    legend: {display: false}
  }
});


</script>

</body>
</html>