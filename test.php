<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include 'database_connection.php';
    include 'functions.php';
    $var = $_POST["cattle_id"];
    $query1 = "SELECT * FROM cattle WHERE cattle_id = ?";
    $check = $connect->prepare($query1);
    $check->execute($var);

    ?>
</body>

</html>