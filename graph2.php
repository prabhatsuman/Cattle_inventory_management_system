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


  

  $profit1 = $connect->query("select sum(sales.sale),month(sales.s_date) as profit FROM sales GROUP by month(sales.s_date) ORDER BY month(sales.s_date) ASC;");
  $profit_result = $profit1->fetchAll();
  $profit2 = $connect->query("select sum(expenses.money_spent),month(expenses.e_date) as profit FROM expenses GROUP by month(expenses.e_date) ORDER by month(expenses.e_date) asc;");
  $profit_result1 = $profit2->fetchAll();
  $sale=array(
    'sales'=>$profit_result['sum(sales.sale)'],
    's_month'=>$profit_result['month(sales.s_date)']
  );
  $exp=array(
    'exp'=>$profit_result1['sum(expenses.money_spent)'],
    'e_month'=>$profit_result1['month(expenses.e_date)']
  );

?>


<div style="width: 500px;">
  <canvas id="myChart8"></canvas>
</div>
<p id="test"></p>
 
<script>
 const a1 = <?php echo json_encode($sale) ?>;
    const a2 = <?php echo json_encode($exp) ?>;
    const values = [];
  for(i=0;i<12;i++)
    values.push(a1.sales[i]-a2.exp[i]);
   
    // for(;i<a1.length;i++){
    //     values.push(a1[i]);
    // }
    // for(;i<a2.length;i++){
    //     values.push(-a2[i]);
    // }

    //create month array with all months name
    const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const color = [];
    for (let i = 0; i < values.length; i++) {
        if (values[i] >= 0) {
            color.push('green');
        } else {
            color.push('red');
        }
    }
    const temp_month = [];
    const temp_values = <?php echo json_encode($profit_month); ?>;
    for (let i = 0; i < temp_values.length; i++) {
        temp_month.push(months[temp_values[i] - 1]);
    }
    var ctx = document.getElementById("myChart8").getContext("2d");

    var data = {
        labels: temp_month,
        datasets: [{
                label: "Earnings",
                backgroundColor: color,
                data: values
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

</script>

</body>
</html>