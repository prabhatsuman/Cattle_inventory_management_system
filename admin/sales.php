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
        DELETE FROM sales 
        WHERE s_id = '" . $_GET["code"] . "' 
       
        ";
        $statement = $connect->prepare($query);
        $statement->execute();
        header('location:sales.php');
    }
}
if (isset($_POST["sales"])) {
    $formdata = array();

    if (empty($_POST["dealer_id"])) {
        $error .= '<li>Dealer ID required</li>';
    } else {
        $formdata['dealer_id'] = $_POST['dealer_id'];
    }
    if (empty($_POST["cattle_type"])) {
        $error .= '<li>Cattle type is required</li>';
    } else {
        $formdata['cattle_type'] = trim($_POST["cattle_type"]);
    }
    if (empty($_POST["quantity"])) {
        $error .= '<li>Milk Quantity is required</li>';
    } else {
        $formdata['quantity'] = $_POST['quantity'];
    }
    if ($error == '') {


        $data = array(
            ':dealer_id' => $formdata['dealer_id'],
            ':cattle_type' => $formdata['cattle_type'],
            ':quantity' => $formdata['quantity'],
            ':price' => $formdata['quantity']

        );


        if($formdata['cattle_type'] == 'COW'){
            $data[':price'] = $formdata['quantity'] * 40;
        }else if($formdata['cattle_type'] == 'BUFFALO'){
            $data[':price'] = $formdata['quantity'] * 50;
        }
        $query = "INSERT INTO sales (d_id, s_date, c_type, quantity,sale) VALUES (:dealer_id,curdate(),:cattle_type,:quantity,:price);
        ";
        $statement = $connect->prepare($query);
        $statement->execute($data);
        header('location:sales.php');
    }
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



// else if($_GET['action'] == 'delete')
// {
//     $query = "DELETE FROM expenses WHERE e_id = '".$_GET["code"]."'";
//     $statement = $connect->prepare($query);
//     $statement->execute();
//     // header('location:expenses.php');
// }

?>
<?php

$query = "SELECT * FROM sales ORDER BY s_id ASC;";


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
                <i class="fas fa-user-plus"></i> Sales Information
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="row">

                        <div class="col-md-4">
                            <label class="form-label">Select Dealer</label>
                            <select name="dealer_id" id="dealer_id" class="form-control">
                                <?php echo fill_Dealer_ID($connect); ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Cattle Type</label>
                            <select name="cattle_type" id="cattle_type" class="form-control">
                                <option value="none" selected disabled hidden>Select Cattle Type</option>
                                <option value="COW">Cow</option>
                                <option value="BUFFALO">Buffalo</option>
                            </select>

                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Quantity of Milk</label>
                                <!-- input date in form -->
                                <input type="text" name="quantity" id="quantity" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 mb-3 text-center">
                        <input type="submit" name="sales" class="btn btn-success" value="Add" />
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
                    <i class="fas fa-table me-1"></i> Sales Information
                </div>
                <div class="col col-md-6" align="right">
                <?php if($_SESSION['admin_id']==102){?>
                    <a href="sales.php?action=add" class="btn btn-success btn-sm">Add</a>
                    <?php }?>
                </div>
            </div>
        </div>
        <div class="table-responsive p-1">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S No.</th>
                        <th>Dealer ID</th>
                        <th>Date</th>
                        <th>Cattle Type</th>
                        <th>Quantity of Milk</th>
                        <th>Sale Amount</th>
                        <?php if($_SESSION['admin_id']==102){?>
                        <th>Action</th>
                        <?php }?>
                    </tr>
                </thead>
                <tfoot>

                    <tr>
                        <th>S No.</th>
                        <th>Dealer ID</th>
                        <th>Date</th>
                        <th>Cattle Type</th>
                        <th>Quantity of Milk</th>
                        <th>Sale Amount</th>
                        <?php if($_SESSION['admin_id']==102){?>
                        <th>Action</th>
                        <?php }?>
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
                            <td><?php echo $row['d_id']; ?></td>
                            <td><?php echo $row['s_date']; ?></td>
                            <td><?php echo $row['c_type']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['sale']; ?></td>
                            <?php if($_SESSION['admin_id']==102){?>
                            <td>
                                <button type="button" name="delete" class="btn btn-danger btn-xs delete" onclick="delete_data(<?php echo $row['s_id'] ?>)">Delete</button>
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
                window.location.href = "sales.php?action=delete&code=" + code;
            } else {
                return false;
            }
        }
    </script>