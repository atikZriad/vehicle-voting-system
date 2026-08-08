<?php
session_start();
ob_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

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
                <h1>Create Passwrod</h1>
                <a href="password_view.php" class="btn btn-primary">View</a>
            </div>
        </div>
    </div>
    <form action="" method="POST">
        <fieldset>
            <div class="form-group">
                <label for="vehicles">Select Vehicles</label>
                <select name="vehicles" class="form-control" id="vehicles">
                    <option hidden>Select Vehicles</option>
                    <?php 
                        include_once("../db.php");
                        $select_query = "SELECT * FROM vehicles";
                        if($result = mysqli_query($conn, $select_query)){
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
                                ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                <?php 
                                }
                            }
                        }
                    ?>
                </select>
            </div> 
            <div class="form-group">
                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-info">Create Password</button>
                </div>
            </div>
        </fieldset>
    </form>

    <?php
        if(isset($_SESSION['msg'])){ 
    ?>
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
            <?php echo $_SESSION['msg'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php 
        unset($_SESSION["msg"]);
        }
    ?>

    <?php
        if(isset($_SESSION['err'])){ 
    ?>
        <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
            <?php echo $_SESSION['err'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php 
        unset($_SESSION["err"]);
        }
    ?>


    <?php 
        // Create Password
        if(isset($_POST["submit"])){
            $user_id = $_POST["vehicles"];
            
            // Password Generator
            $passRam = openssl_random_pseudo_bytes(2);
            $password = bin2hex($passRam);

            $sql = "INSERT INTO password_generator(user_id, password) VALUES ('$user_id','$password')";
            if(mysqli_query($conn, $sql)){
                $_SESSION['msg']="Password Generate Successful!";
                header("Location: password_view.php");
            }else{
                $_SESSION['err']="Please Try Again!!";
            }
        }
    ?>
</div>
<!-- //Main container -->
<?php include BASE_PATH . '/includes/footer.php';?>
