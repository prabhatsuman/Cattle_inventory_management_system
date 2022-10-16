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
    $sum_quantity_buff[] = $data2['SUM(quantity)'];
    $p_date_c[] = $data2['p_date'];
  }

?>


<div style="width: 500px;">
  <canvas id="myChart"></canvas>
</div>

<div style="width: 500px;">
  <canvas id="myChart2"></canvas>
</div>
 
<script>
  // === include 'setup' then 'config' above ===
  const labels = <?php echo json_encode($p_date) ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'production',
      data: <?php echo json_encode($sum_quantity_buff) ?>,
      backgroundColor: [
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
  var myChart2 = new Chart(
    document.getElementById('myChart2'),
    config
  );


  
</script>
//cow graph

</body>
</html>