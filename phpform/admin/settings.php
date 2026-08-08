<?php
session_start();
ob_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';
include_once("../db.php");

// Costumers class
include BASE_PATH . '/includes/header.php';

$setting = "SELECT * FROM settings";
$query = mysqli_query($conn, $setting);
$getData = mysqli_fetch_assoc($query);
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
    .form-control{
        height: 38px !important;
    }
</style>
<!-- Main container -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-header flex-page-header">
                <h1>Settings</h1>
            </div>
        </div>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
        <fieldset>
            <div class="form-group">
                <label for="vehicles">Logo</label>
                <input type="file" name="logo" class="form-control">
                <input type="hidden" name="logo_old" value="<?php echo $getData['logo']; ?>">
                <img src="assets/upload/<?php echo $getData['logo']; ?>" alt="" width="100">
            </div> 
            <div class="form-group">
                <div class="text-left">
                    <button type="submit" name="submit" class="btn btn-info">Upload Logo</button>
                </div>
            </div>
        </fieldset>
    </form>


    <?php 
        // Create Password
        if(isset($_POST["submit"])){
            // Image Upload Code  
            if(isset($_FILES['logo']['name']) &&  !empty($_FILES['logo']['name'])){
                $logoImg = $_FILES['logo']['name'];
                $logo_tmp_name = $_FILES['logo']['tmp_name'];
                $destination = "assets/upload/".$logoImg;
                move_uploaded_file($logo_tmp_name, $destination);
            }else{
                $logoImg = $_POST['logo_old'];
            }

            $sql = "UPDATE `settings` SET `logo`='$logoImg' WHERE id = '1'";
            if(mysqli_query($conn, $sql)){
                $_SESSION['success']="Logo Updated Successful!";
                header('Location: settings.php');
            }else{
                $_SESSION['failure']="Please Try Again!!";
            }
        }
    ?>
</div>
<!-- //Main container -->
<?php include BASE_PATH . '/includes/footer.php';?>
