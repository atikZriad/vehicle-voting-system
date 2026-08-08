<?php
session_start();
ob_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';
include_once("../db.php");
include BASE_PATH . '/includes/header.php';

?>

<?php 
        // Create Password
        if(isset($_GET["createpass"])){ 
            
            // Password Generator
            $passRam = openssl_random_pseudo_bytes(2);
            $password = 'vote'.date('ids');

            $sql = "INSERT INTO password_generator(password) VALUES ('$password')";
            if(mysqli_query($conn, $sql)){
                header("Location: password_view.php");
            }else{
                $_SESSION['err']="Please Try Again!!";
            }
        }
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
                <h1>Passwrod Generator</h1>
                <a href="password_view.php?createpass=true" class="btn btn-primary">Create</a>
            </div>
        </div>
    </div>
    <?php include BASE_PATH . '/includes/flash_messages.php';?>

    <!-- Table -->
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th width="13%">Password</th>
                <th width="13%">Status</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            include_once("../db.php");
            $select_query = "SELECT * FROM password_generator";
            if($result = mysqli_query($conn, $select_query)){
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                    ?>
                        <tr>
                            <td><?php echo $row['password'] ?></td>
                            <td>
                                <span class="label label-success">Active</span>
                            </td>
                        </tr>
                    <?php 
                    }
                }else{
                    ?>
                        <tr>
                            <td colspan="7" align="center">
                                No Data Found
                            </td>
                        </tr>
                    <?php
                }
            }
        ?>
        </tbody>
    </table>
    <!-- //Table -->
</div>
<!-- //Main container -->
<?php include BASE_PATH . '/includes/footer.php';?>
