<?php
session_start();
ob_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';
include_once("../db.php");
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
                <h1>Vehicles Of <?php echo $_GET['cat']; ?></h1>
                <a href="categories.php" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <?php include BASE_PATH . '/includes/flash_messages.php';?>

    <!-- Table -->
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th width="13%">Name</th>
                <th width="13%">Model</th>
                <th width="13%">Vote</th>
                <th width="13%">Category</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            include_once("../db.php");
            $id = $_GET['cat'];
            $select_query = "SELECT * FROM vehicles WHERE category='$id'";
            if($result = mysqli_query($conn, $select_query)){
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                    ?>
                        <tr>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['vehicle_model'] ?></td>
                            <td><?php echo $row['vote_status'] ?></td>
                            <td><?php echo $row['category'] ?></td>
                        </tr>
                    <?php 
                    }
                }else{
                    ?>
                        <tr>
                            <td colspan="7" align="center">
                                No Related Data Found
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
