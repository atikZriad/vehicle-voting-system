<?php
session_start();
ob_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';
include_once("../db.php");
$id = $_GET['id'];

// Get Vehicle
$vehicleSql = "SELECT * FROM `vehicles` WHERE id = '$id'";
$vehicleQuery = mysqli_query($conn, $vehicleSql);
$vehicle = mysqli_fetch_assoc($vehicleQuery);

// Costumers class
include BASE_PATH . '/includes/header.php';
?>
<style>
    label{
        font-size: 16px !important;
    }
    p{
        font-size: 18px !important;
    }
    .flex-page-header{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
<!-- Main container -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header flex-page-header">
                <h1>Update Vehicle</h1>
                <a href="customers.php" class="btn btn-primary">View</a>
            </div>
        </div>
    </div>
    <form action="" method="POST">
        <fieldset>
            <div class="form-group">
                <label for="vehicles">Name</label>
                <input type="text" name="name" value="<?php echo $vehicle['name']; ?>" class="form-control">
            </div> 
            <div class="form-group">
                <label for="vehicles">Address</label>
                <input type="text" name="address" value="<?php echo $vehicle['address']; ?>" class="form-control">
            </div> 
            <div class="form-group">
                <label for="vehicles">Phone</label>
                <input type="text" name="phone" value="<?php echo $vehicle['phone']; ?>" class="form-control">
            </div> 
            <div class="form-group">
                <label for="vehicles">Vehicle Maker</label>
                <input type="text" name="vehicle_maker" value="<?php echo $vehicle['vehicle_maker']; ?>" class="form-control">
            </div> 
            <div class="form-group">
                <label for="vehicles">Vehicle Model</label>
                <input type="text" name="vehicle_model" value="<?php echo $vehicle['vehicle_model']; ?>" class="form-control">
            </div> 
            <div class="form-group">
                <label for="vehicles">Vehicle Year</label>
                <input type="text" name="vehicle_year" value="<?php echo $vehicle['vehicle_year']; ?>" class="form-control">
            </div> 
            <div class="form-group">
                <label for="vehicles">Category</label>
                <input type="text" name="category" value="<?php echo $vehicle['category']; ?>" class="form-control">
            </div> 
            <div class="form-group">
                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-info">Update</button>
                </div>
            </div>
        </fieldset>
    </form>


    <?php 
        // Create Password
        if(isset($_POST["submit"])){
            $name = $_POST["name"];
            $address = $_POST["address"];
            $phone = $_POST["phone"];
            $vehicle_maker = $_POST["vehicle_maker"];
            $vehicle_model = $_POST["vehicle_model"];
            $vehicle_year = $_POST["vehicle_year"];
            $category = $_POST["category"];

            $sql = "UPDATE `vehicles` SET `name`='$name', `address`='$address', `phone`='$phone', `vehicle_maker`='$vehicle_maker', `vehicle_model`='$vehicle_model', `vehicle_year`='$vehicle_year', `category`='$category' WHERE id = '$id'";
            if(mysqli_query($conn, $sql)){
                $_SESSION['success']="Vehicle Updated Successful!";
                header('Location: customers.php');
            }else{
                $_SESSION['failure']="Please Try Again!!";
            }
        }
    ?>
</div>
<!-- //Main container -->
<?php include BASE_PATH . '/includes/footer.php';?>
