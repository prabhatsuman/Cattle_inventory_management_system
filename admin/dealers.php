<?php
include '../database_connection.php';
include '../php_includes/functions.php';


if (!is_admin_login()) {
    header('location:../login.php');
}
$message = '';

$error = '';

if (isset($_POST["add_dealer"])) {
    $formdata = array();

    if (empty($_POST["dealer_id"])) {
        $error .= '<li>Dealer ID is required</li>';
    } else {
        $formdata['dealer_id'] = trim($_POST["dealer_id"]);
    }

    if (empty($_POST["dealer_name"])) {
        $error .= '<li>Dealer Name is required</li>';
    } else {
        $formdata['dealer_name'] = trim($_POST["dealer_name"]);
    }

    if (empty($_POST["d_address"])) {
        $error .= '<li>Address is required</li>';
    } else {
        $formdata['d_address'] = trim($_POST["d_address"]);
    }

    if (empty($_POST["p_number"])) {
        $error .= '<li>Phone Number is required</li>';
    } else {
        $formdata['p_number'] = trim($_POST["p_number"]);
    }
    if (!empty($_POST['dealer_id'])) {
        $query1 = "SELECT * FROM dealers WHERE dealer_id = '" . $formdata['dealer_id'] . "'";
        $check = $connect->prepare($query1);
        $check->execute();


        if ($check->rowCount() > 0) {
            $error .= '<li>Dealer ID exist</li>';
        }
    }
    



    if ($error == '') {
        $data = array(
            ':dealer_id'        =>    $formdata['dealer_id'],
            ':dealer_name'        =>    $formdata['dealer_name'],
            ':d_address'    =>    $formdata['d_address'],
            ':p_number'            =>    $formdata['p_number'],


        );

        $query = "INSERT INTO dealers (dealer_id, dealer_name, d_address, p_number) VALUES (:dealer_id, :dealer_name, :d_address,:p_number);";

        $statement = $connect->prepare($query);

        $statement->execute($data);

        header('location:dealers.php');
    }
}
if (isset($_POST["edit"])) {
    $formdata = array();
    $formdata[':dealer_id'] = trim($_POST['dealer_id']);
    $formdata[':d_address'] = trim($_POST['d_address']);
    $formdata[':p_number'] = trim($_POST['p_number']);
    $query = "UPDATE dealers SET d_address = :d_address, p_number = :p_number WHERE dealer_id = :dealer_id";
    $statement = $connect->prepare($query);
    $statement->execute($formdata);
    header('location:dealers.php');
}

?>
<?php

$query = "SELECT * FROM dealers;";


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

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user-plus"></i> Add Dealer
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Dealer ID</label>
                                <input type="text" name="dealer_id" id="dealer_id" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Dealer Name</label>
                                <input type="text" name="dealer_name" id="dealer_name" class="form-control" />
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <!-- input date in form -->
                                <input type="text" name="d_address" id="d_address" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <!-- select gender -->
                                <input type="text" name="p_number" id="p_number" class="form-control" />

                            </div>
                        </div>
                    </div>

                    <div class="mt-4 mb-3 text-center">
                        <input type="submit" name="add_dealer" class="btn btn-success" value="Add" />
                    </div>
                </form>
            </div>
        </div>


        <?php
    } else if ($_GET["action"] == 'edit') {
        $dealer_id = $_GET['code'];


        $query = "
           SELECT * FROM dealers 
        WHERE dealer_id = '" . $dealer_id . "'";

        $dealer_info = $connect->query($query);

        foreach ($dealer_info as $row) {
        ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-user-plus"></i> Edit Dealer Details
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Dealer ID</label>
                                    <input type="text" name="dealer_id" id="dealer_id" class="form-control" value="<?php echo $row['dealer_id'] ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="d_address" id="d_address" class="form-control" value="<?php echo $row['d_address'] ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" name="p_number" id="p_number" class="form-control" value="<?php echo $row['p_number'] ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 mb-3 text-center">
                            <input type="submit" name="edit" class="btn btn-danger" value="Edit" />
                        </div>
                    <?php
                }
                    ?>
                <?php
            }
        } else {
                ?>

                <div class="card mb-4 p-1">
                    <div class="card-header">
                        <div class="row">
                            <div class="col col-md-6">
                                <i class="fas fa-table me-1"></i> Dealer Information
                            </div>
                            <div class="col col-md-6" align="right">
                                <a href="dealers.php?action=add" class="btn btn-success btn-sm">Add</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive p-1">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Dealer ID</th>
                                    <th>Dealer Name</th>
                                    <th>Address</th>
                                    <th>Phone Number</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Dealer ID</th>
                                    <th>Dealer Name</th>
                                    <th>Address</th>
                                    <th>Phone Number</th>

                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                foreach ($statement->fetchAll() as $row) {
                                ?>

                                    <tr>
                                        <td><?php echo $row['dealer_id']; ?></td>
                                        <td><?php echo $row['dealer_name']; ?></td>
                                        <td><?php echo $row['d_address']; ?></td>
                                        <td><?php echo $row['p_number']; ?></td>

                                        <td><a href="dealers.php?action=edit&code=<?php echo ($row['dealer_id']) ?>" class="btn btn-sm btn-primary">Edit</a></td>
                                    </tr>




                                <?php

                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php
            }
                ?>