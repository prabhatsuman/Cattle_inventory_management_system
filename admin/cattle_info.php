<?php
include '../database_connection.php';
include '../php_includes/functions.php';


if (!is_admin_login()) {
    header('location:../login.php');
}
$message = '';

$error = '';

if (isset($_POST["add_cattle"])) {
    $formdata = array();

    if (empty($_POST["cattle_id"])) {
        $error .= '<li>Cattle ID is required</li>';
    } else {
        $formdata['cattle_id'] = trim($_POST["cattle_id"]);
    }

    if (empty($_POST["cattle_type"])) {
        $error .= '<li>Cattle type is required</li>';
    } else {
        $formdata['cattle_type'] = trim($_POST["cattle_type"]);
    }

    if (empty($_POST["date_of_birth"])) {
        $error .= '<li>Date of Birth is required</li>';
    } else {
        $formdata['date_of_birth'] = trim($_POST["date_of_birth"]);
    }

    if (empty($_POST["Gender"])) {
        $error .= '<li>Gender is required</li>';
    } else {
        $formdata['Gender'] = trim($_POST["Gender"]);
    }

    if (empty($_POST["Vaccination"])) {
        $error .= '<li>Vaccination Status is required</li>';
    } else {
        $formdata['Vaccination'] = trim($_POST["Vaccination"]);
    }
    if (empty($_POST["milk_status"])) {
        $error .= '<li>Milk Production Status is required</li>';
    } else {
        $formdata['milk_status'] = trim($_POST["milk_status"]);
    }
    if (!empty($_POST['cattle_id'])) {
        $query1 = "SELECT * FROM cattle WHERE cattle_id = '" . $formdata['cattle_id'] . "'";
        $check = $connect->prepare($query1);
        $check->execute();
        if ($check->rowCount() > 0) {
            $error .= '<li>Cattle ID exist</li>';
        }
    }





    if ($error == '') {
        $data = array(
            ':cattle_id'        =>    $formdata['cattle_id'],
            ':cattle_type'        =>    $formdata['cattle_type'],
            ':date_of_birth'    =>    $formdata['date_of_birth'],
            ':Gender'            =>    $formdata['Gender'],
            ':Vaccination'        =>    $formdata['Vaccination'],
            ':milk_status'        =>    $formdata['milk_status'] == "YES" ? 1 : 0,

        );

        $query = "INSERT INTO cattle (cattle_id, cattle_type, sex, DOB, vaccination, milk_status) VALUES (:cattle_id, :cattle_type, :Gender, :date_of_birth, :Vaccination, :milk_status);";

        $statement = $connect->prepare($query);

        $statement->execute($data);

        header('location:cattle_info.php');
    }
}
if (isset($_POST["edit"])) {
    $formdata = array();
    $formdata[':cattle_id'] = trim($_POST['cattle_id']);
    $formdata[':vaccination'] = trim($_POST['Vaccination']);
    $formdata[':milk_status'] = trim($_POST['milk_status'] == 'YES' ? 1 : 0);
    $query = "UPDATE cattle SET vaccination = :vaccination, milk_status = :milk_status WHERE cattle_id = :cattle_id";
    $statement = $connect->prepare($query);
    $statement->execute($formdata);
    header('location:cattle_info.php');
}

?>
<?php

$query = "SELECT * FROM cattle;";


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
                <i class="fas fa-user-plus"></i> Add Cattle
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Cattle ID</label>
                                <input type="text" name="cattle_id" id="cattle_id" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Cattle Type</label>
                                <select name="cattle_type" id="cattle_type" class="form-control">
                                    <option value="none" selected disabled hidden>Select Cattle Type</option>
                                    <option value="COW">Cow</option>
                                    <option value="BUFFALO">Buffalo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date Of Birth</label>
                                <!-- input date in form -->
                                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <!-- select gender -->
                                <select name="Gender" id="Gender" class="form-control">
                                    <option value="none" selected disabled hidden>Select Gender</option>
                                    <option value="M">M</option>
                                    <option value="F">F</option>
                                </select>


                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Vaccination Status</label>
                                <!-- select gender -->
                                <select name="Vaccination" id="Vaccination" class="form-control">
                                    <option value="none" selected disabled hidden>Select Vaccination Status</option>
                                    <option value="YES">YES</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Milk Production Status</label>
                                <!-- select gender -->
                                <select name="milk_status" id="milk_status" class="form-control">
                                    <option value="none" selected disabled hidden>Select Milk Status</option>
                                    <option value="YES">YES</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 mb-3 text-center">
                        <input type="submit" name="add_cattle" class="btn btn-success" value="Add" />
                    </div>
                </form>
            </div>
        </div>


        <?php
    } else if ($_GET["action"] == 'edit') {
        $cattle_id = $_GET['code'];


        $query = "
           SELECT * FROM cattle 
        WHERE cattle_id = '" . $cattle_id . "'";

        $cattle_info = $connect->query($query);

        foreach ($cattle_info as $row) {
        ?>

            <div class="card mb-4 p-1">
                <div class="card-header">
                    <i class="fas fa-user-plus"></i> Edit Cattle Details
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Cattle ID</label>
                                    <input type="text" name="cattle_id" id="cattle_id" class="form-control" value="<?php echo $row['cattle_id'] ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Vaccination Status</label>
                                    <!-- select gender -->
                                    <select name="Vaccination" id="Vaccination" class="form-control">
                                        <!-- <option value="none" selected disabled hidden>Select Vaccination Status</option> -->
                                        <option value="YES">YES</option>
                                        <option value="NO" <?php if ($row['vaccination'] == 'NO') echo ' selected="selected"'; ?>>NO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Milk Production Status</label>
                                    <!-- select gender -->
                                    <select name="milk_status" id="milk_status" class="form-control">
                                        <!-- <option value="none" selected disabled hidden>Select Milk Status</option> -->
                                        <option value="YES">YES</option>
                                        <option value="NO" <?php if ($row['milk_status'] == 0)  echo ' selected="selected"'; ?>>NO</option>
                                    </select>
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
                                <i class="fas fa-table me-1"></i> Cattle Information
                            </div>
                            <div class="col col-md-6" align="right">
                                <?php if($_SESSION['admin_id']==101) echo ' <a href="cattle_info.php?action=add" class="btn btn-success btn-sm">Add</a>'?>
                                
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive p-1">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Cattle ID</th>
                                    <th>Cattle Type</th>
                                    <th>Date of Birth</th>
                                    <th>Gender</th>
                                    <th>Vaccination Status</th>
                                    <th>Milk Production Status</th>
                                    <?php if($_SESSION['admin_id']==101){?>
                                    <th>Action</th>
                                    <?php }?>               
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Cattle ID</th>
                                    <th>Cattle Type</th>
                                    <th>Date of Birth</th>
                                    <th>Gender</th>
                                    <th>Vaccination Status</th>
                                    <th>Milk Production Status</th>
                                    <?php if($_SESSION['admin_id']==101){?>
                                    <th>Action</th>
                                    <?php }?>
                                </tr>
                            </tfoot>
                            <tbody>

                                <?php
                                $result = $statement->fetchAll();
                                foreach ($result as $row) {
                                    $milk_status1 = '';
                                    if ($row['milk_status']) {
                                        $milk_status1 = '<div class="badge bg-success">YES</div>';
                                    } else {
                                        $milk_status1 = '<div class="badge bg-danger">NO</div>';
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $row['cattle_id']; ?></td>
                                        <td><?php echo $row['cattle_type']; ?></td>
                                        <td><?php echo $row['DOB']; ?></td>
                                        <td><?php echo $row['sex']; ?></td>
                                        <td><?php echo $row['vaccination']; ?></td>
                                        <td><?php echo $milk_status1; ?></td>
                                        <?php if($_SESSION['admin_id']==101){?>
                                        <td><a href="cattle_info.php?action=edit&code=<?php echo ($row['cattle_id']) ?>" class="btn btn-sm btn-primary">Edit</a></td>
                                        <?php }?>
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