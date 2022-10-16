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


?>


<div style="width: 500px;">
  <canvas id="myChart"></canvas>
</div>
<p id="test"></p>
 
<script>

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

</script>

</body>
</html>