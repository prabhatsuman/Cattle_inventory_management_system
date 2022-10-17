<?php
include '../database_connection.php';
include '../php_includes/functions.php';


if (!is_admin_login()) {
    header('location:../login.php');
}
$message = '';

$error = '';
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete') {
        $query = "
        DELETE FROM production 
        WHERE p_id = '" . $_GET["code"] . "' 
       
        ";
        $statement = $connect->prepare($query);
        $statement->execute();
        header('location:production.php');
    }
}
if (isset($_POST["production"])) {
    $formdata = array();

    if (empty($_POST["cattle_id"])) {
        $error .= '<li>Cattle is required</li>';
    } else {
        $formdata['cattle_id'] = $_POST['cattle_id'];
    }
    if (empty($_POST["quantity"])) {
        $error .= '<li>Milk Quantity is required</li>';
    } else {
        $formdata['quantity'] = $_POST['quantity'];
    }
    if ($error == '') {
        $data = array(
            ':cattle_id' => $formdata['cattle_id'],
            ':quantity' => $formdata['quantity']

        );
        $query = "INSERT INTO production (c_id,quantity,p_date) VALUES (:cattle_id,:quantity,curdate());
        ";
        $statement = $connect->prepare($query);
        $statement->execute($data);
        header('location:production.php');
        // $message = '<label class="text-success">Expense Added</label>';
    }



    // if ($error == '') {
    //     $data = array(
    //         ':cattle_id'        =>    $formdata['cattle_id'],
    //         ':cattle_type'        =>    $formdata['cattle_type'],
    //         ':date_of_birth'    =>    $formdata['date_of_birth'],
    //         ':Gender'            =>    $formdata['Gender'],
    //         ':Vaccination'        =>    $formdata['Vaccination'],
    //         ':milk_status'        =>    $formdata['milk_status'] == "YES" ? 1 : 0,

    //     );

    //     $query = "INSERT INTO cattle (cattle_id, cattle_type, sex, DOB, vaccination, milk_status) VALUES (:cattle_id, :cattle_type, :Gender, :date_of_birth, :Vaccination, :milk_status);";

    //     $statement = $connect->prepare($query);

    //     $statement->execute($data);


}

// else if($_GET['action'] == 'delete')
// {
//     $query = "DELETE FROM expenses WHERE e_id = '".$_GET["code"]."'";
//     $statement = $connect->prepare($query);
//     $statement->execute();
//     // header('location:expenses.php');
// }

?>
<?php

$query = "SELECT * FROM production ORDER BY p_id ASC;";


$statement = $connect->prepare($query);

$statement->execute();

include '../php_includes/header.php';

?>
<?php
if (isset($_GET["action"])) {
    if ($_GET['action'] == 'add') {
        if ($error != '') {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"><ul class="list-unstyled">' . $error . '</ul> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }


?>

        <div class="card mb-4 p-1">
            <div class="card-header">
                <i class="fas fa-user-plus"></i> Production Information
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="row">

                        <div class="col-md-6">
                            <label class="form-label">Select Cattle</label>
                            <select name="cattle_id" id="cattle_id" class="form-control">
                                <?php echo fill_cattle_ID($connect); ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Quantity of Milk</label>
                                <!-- input date in form -->
                                <input type="text" name="quantity" id="qunatity" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 mb-3 text-center">
                        <input type="submit" name="production" class="btn btn-success" value="Add" />
                    </div>
                </form>
            </div>
        </div>


    <?php
    }
} else {
    ?>

    <div class="card mb-4 p-1">
        <div class="card-header">
            <div class="row">
                <div class="col col-md-6">
                    <i class="fas fa-table me-1"></i> Production Information
                </div>
                <div class="col col-md-6" align="right">
                    <?php if ($_SESSION['admin_id'] == 101) { ?>
                        <a href="production.php?action=add" class="btn btn-success btn-sm">Add</a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="table-responsive p-1">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S No.</th>
                        <th>Cattle ID</th>
                        <th>Date</th>
                        <th>Qunatity of Milk</th>
                        <?php if ($_SESSION['admin_id'] == 101) { ?>
                            <th>Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tfoot>

                    <tr>
                        <th>S No.</th>
                        <th>Cattle ID</th>
                        <th>Date</th>
                        <th>Quantity of Milk</th>
                        <?php if ($_SESSION['admin_id'] == 101) { ?>
                            <th>Action</th>
                        <?php } ?>

                    </tr>
                </tfoot>
                <tbody>

                    <?php
                    $result = $statement->fetchAll();
                    $count = 1;
                    foreach ($result as $row) {

                    ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $row['c_id']; ?></td>
                            <td><?php echo $row['p_date']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <?php if ($_SESSION['admin_id'] == 101) { ?>
                            <td>
                                <button type="button" name="delete" class="btn btn-danger btn-xs delete" onclick="delete_data(<?php echo $row['p_id'] ?>)">Delete</button>
                            </td>
                            <?php }?>


                        </tr>





                    <?php
                        $count++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php
}
    ?>
    <script>
        function delete_data(code) {
            if (confirm("Are you sure you want to delete?")) {
                window.location.href = "production.php?action=delete&code=" + code;
            } else {
                return false;
            }
        }
    </script>