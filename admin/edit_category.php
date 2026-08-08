<?php
session_start();
ob_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';
include_once("../db.php");
$id = $_GET['id'];

// Get Category
$categorySql = "SELECT * FROM `category` WHERE id = '$id'";
$categoryQuery = mysqli_query($conn, $categorySql);
$category = mysqli_fetch_assoc($categoryQuery);

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
                <h1>Update Categories</h1>
                <a href="categories.php" class="btn btn-primary">View</a>
            </div>
        </div>
    </div>
    <form action="" method="POST">
        <fieldset>
            <div class="form-group">
                <label for="vehicles">Category Name</label>
                <input type="text" name="name" value="<?php echo $category['name']; ?>" class="form-control">
            </div> 
            <div class="form-group">
                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-info">Update Category</button>
                </div>
            </div>
        </fieldset>
    </form>


    <?php 
        // Create Password
        if(isset($_POST["submit"])){
            $name = $_POST["name"];

            $sql = "UPDATE `category` SET `name`='$name' WHERE id = '$id'";
            if(mysqli_query($conn, $sql)){
                $_SESSION['success']="Category Updated Successful!";
                header('Location: categories.php');
            }else{
                $_SESSION['failure']="Please Try Again!!";
            }
        }
    ?>
</div>
<!-- //Main container -->
<?php include BASE_PATH . '/includes/footer.php';?>
