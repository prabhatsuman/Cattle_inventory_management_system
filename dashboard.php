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
  $con = new mysqli('localhost','root','','cattle_inventory_system');
  $query1 = $con->query("
  SELECT SUM(sale),s_date from sales GROUP BY s_date;
  ");

  foreach($query1 as $data)
  {
    $sum_sale[] = $data['SUM(sale)'];
    $s_date[] = $data['s_date'];
  }


  $query2 = $con->query("
  SELECT SUM(quantity),p_date FROM production where c_id LIKE 'C%'GROUP BY p_date;
  ");
  foreach($query2 as $data2)
  {
    $sum_quantity_cow[] = $data2['SUM(quantity)'];
    $p_date[] = $data2['p_date'];
  }


  $query3 = $con->query("
  SELECT SUM(quantity),p_date FROM production where c_id LIKE 'B%'GROUP BY p_date;
  ");
  foreach($query3 as $data3)
  {
    $sum_quantity_buff[] = $data3['SUM(quantity)'];
    $p_date_c[] = $data3['p_date'];
  }

  $query4 = $con->query("
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
 
<script>
  // === include 'setup' then 'config' above ===
  const labels = <?php echo json_encode($s_date) ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'SALES',
      data: <?php echo json_encode($sum_sale) ?>,
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
      borderWidth: 1
    }]
  };

  const config = {
    type: 'bar',
    data: data,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  };

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );

  // === include 'setup' then 'config' above ===
  const labels2 = <?php echo json_encode($p_date) ?>;
  const data2 = {
    labels: labels2,
    datasets: [{
      label: 'PRODUCTION BY COW',
      data: <?php echo json_encode($sum_quantity_cow) ?>,
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
      borderWidth: 1
    }]
  };


  const config2 = {
    type: 'bar',
    data:data2,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  };

  var myChart2 = new Chart(
    document.getElementById('myChart2'),
    config2
  );



  const data3 = {
    labels: labels2,
    datasets: [{
      label: 'PRODUCTION BY BUFFALO',
      data: <?php echo json_encode($sum_quantity_buff) ?>,
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
      borderWidth: 1
    }]
  };

  const config3 = {
    type: 'bar',
    data:data3,
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
  };

  var myChart3 = new Chart(
    document.getElementById('myChart3'),
    config3
  );


var xValues = <?php echo json_encode($p_date_all) ?>;
var yValues =<?php echo json_encode($sum_quantity) ?>

new Chart("myChart4", {
  type: "line",
  label:"TOTAL PRODUCTION",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: 'rgba(11, 156, 49, 0.2)',
      borderColor: 'rgba(11, 156, 49, 0.2)',
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 6, max:16}}],
    }
  }
});



</script>

</body>
</html>