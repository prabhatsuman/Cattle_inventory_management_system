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
        DELETE FROM expenses 
        WHERE expenses_id = '" . $_GET["code"] . "'
        ";
        $statement = $connect->prepare($query);
        $statement->execute();
        header('location:expenses.php');
    }
}
if (isset($_POST["expenses"])) {
    $formdata = array();

    if (empty($_POST["e_type"])) {
        $error .= '<li>Expense Type is required</li>';
    } else {
        $formdata['e_type'] = $_POST['e_type'];
    }
    if (empty($_POST["money_spent"])) {
        $error .= '<li>Expense Amount is required</li>';
    } else {
        $formdata['money_spent'] = $_POST['money_spent'];
    }
    if ($error == '') {
        $data = array(
            ':e_type' => $formdata['e_type'],
            ':money_spent' => $formdata['money_spent']

        );
        $query = "
        INSERT INTO expenses (e_date,e_type, money_spent) 
        VALUES (curdate(),:e_type, :money_spent)
        ";
        $statement = $connect->prepare($query);
        $statement->execute($data);
        $message = '<label class="text-success">Expense Added</label>';
        header('location:expenses.php');
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

$query = "SELECT * FROM expenses ORDER BY expenses_id ASC;";


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
                <i class="fas fa-user-plus"></i> Expenses
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Expense Type</label>
                                <input type="text" name="e_type" id="e_type" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Money Spent</label>
                                <!-- input date in form -->
                                <input type="text" name="money_spent" id="money_spent" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 mb-3 text-center">
                        <input type="submit" name="expenses" class="btn btn-success" value="Add" />
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
                    <i class="fas fa-table me-1"></i> Expense Information
                </div>
                <div class="col col-md-6" align="right">
                    <?php if ($_SESSION['admin_id'] == 103) { ?>
                        <a href="expenses.php?action=add" class="btn btn-success btn-sm">Add</a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="table-responsive p-1">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S No.</th>

                        <th>Expense Date</th>
                        <th>Expense Type</th>
                        <th>Money Spent</th>
                        <?php if ($_SESSION['admin_id'] == 103) { ?>
                            <th>Action</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>S No.</th>

                        <th>Expense Date</th>
                        <th>Expense Type</th>
                        <th>Money Spent</th>
                        <?php if ($_SESSION['admin_id'] == 103) { ?>
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
                            <td><?php echo $row['e_date']; ?></td>
                            <td><?php echo $row['e_type']; ?></td>
                            <td><?php echo $row['money_spent']; ?></td>
                            <?php if ($_SESSION['admin_id'] == 103) { ?>
                                <td>
                                    <button type="button" name="delete" class="btn btn-danger btn-xs delete" onclick="delete_data(<?php echo $row['expenses_id'] ?>)">Delete</button>
                                </td>
                            <?php } ?>




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
                window.location.href = "expenses.php?action=delete&code=" + code;
            } else {
                return false;
            }
        }
    </script>