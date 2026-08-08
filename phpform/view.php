<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details View</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
    <style>   
        @page {
            margin: none;
        }     
        .right-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
        }
        .left-content{
            float: right;
        }
        .label-title h4{
            font-weight: bold;
        }
        @media print {
            #printPageButton {
                display: none;
            }
        }
    </style>
</head>
<body>
    <?php
        session_start();
        include_once("db.php");
        if(isset($_GET['id'])){
            $query = sprintf("SELECT * FROM vehicles WHERE id='".$_GET['id']."'");
            $query_run = mysqli_query($conn, $query);
            if(mysqli_num_rows($query_run) > 0){
                foreach($query_run as $row){
                    ?>
                        <div class="container py-5">
                            <div class="text-center">
                                <img src="./images/view_logo.jpg" alt="">
                                <h1 class="mt-3 h4 font-weight-bold">VEHICLE IDENTIFICATION</h1>
                            </div>
                            <div class="row align-items-center mt-4">
                                <div class="col-md-7">
                                    <div class="right-content">
                                        <div class="label-title">
                                            <h4>Make:</h4>
                                        </div>
                                        <div class="label-data">
                                            <h4><?php echo $row['vehicle_maker'] ?></h4>
                                        </div>
                                    </div>
                                    <div class="right-content">
                                        <div class="label-title">
                                            <h4>Model:</h4>
                                        </div>
                                        <div class="label-data">
                                            <h4><?php echo $row['vehicle_model'] ?></h4>
                                        </div>
                                    </div>
                                    <div class="right-content">
                                        <div class="label-title">
                                            <h4>Year:</h4>
                                        </div>
                                        <div class="label-data">
                                            <h4><?php echo $row['vehicle_year'] ?></h4>
                                        </div>
                                    </div>
                                    <div class="right-content">
                                        <div class="label-title">
                                            <h4>Owner:</h4>
                                        </div>
                                        <div class="label-data">
                                            <h4><?php echo $row['name'] ?></h4>
                                        </div>
                                    </div>
                                    <div class="right-content">
                                        <div class="label-title">
                                            <h4>City / State:</h4>
                                        </div>
                                        <div class="label-data">
                                            <h4><?php echo $row['address'] ?></h4>
                                        </div>
                                    </div>
                                    <div class="right-content">
                                        <div class="label-title">
                                            <h4>Class / Category:</h4>
                                        </div>
                                        <div class="label-data">
                                            <h4><?php echo $row['category'] ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="left-content">
                                        <img src="images/<?php echo $row['qrcode'] ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <h1><span class="font-weight-bold">Voting Password:</span> 
                                        <?php 
                                            $sql = "SELECT password FROM  password_generator ORDER BY RAND() LIMIT 1";
                                            $result = $conn->query($sql);

                                            $randomPassword = "";

                                            if ($result && $result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                $randomPassword = $row['password'];
                                            }
                                            echo $randomPassword;
                                        ?>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    <?php 
                }
            }
            if(mysqli_num_rows($query_run) > 0){
                foreach($query_run as $row){
                    ?>
                        <div class="container py-5">
                            <div class="text-center">
                                <img src="./images/view_logo.jpg" alt="">
                                <h1 class="mt-3 h4 font-weight-bold">VEHICLE IDENTIFICATION</h1>
                            </div>
                            <div class="row align-items-center mt-4">
                                <div class="col-md-7">
                                    <div class="right-content">
                                        <div class="label-title">
                                            <h4>Make:</h4>
                                        </div>
                                        <div class="label-data">
                                            <h4><?php echo $row['vehicle_maker'] ?></h4>
                                        </div>
                                    </div>
                                    <div class="right-content">
                                        <div class="label-title">
                                            <h4>Model:</h4>
                                        </div>
                                        <div class="label-data">
                                            <h4><?php echo $row['vehicle_model'] ?></h4>
                                        </div>
                                    </div>
                                    <div class="right-content">
                                        <div class="label-title">
                                            <h4>Year:</h4>
                                        </div>
                                        <div class="label-data">
                                            <h4><?php echo $row['vehicle_year'] ?></h4>
                                        </div>
                                    </div>
                                    <div class="right-content">
                                        <div class="label-title">
                                            <h4>Owner:</h4>
                                        </div>
                                        <div class="label-data">
                                            <h4><?php echo $row['name'] ?></h4>
                                        </div>
                                    </div>
                                    <div class="right-content">
                                        <div class="label-title">
                                            <h4>City / State:</h4>
                                        </div>
                                        <div class="label-data">
                                            <h4><?php echo $row['address'] ?></h4>
                                        </div>
                                    </div>
                                    <div class="right-content">
                                        <div class="label-title">
                                            <h4>Class / Category:</h4>
                                        </div>
                                        <div class="label-data">
                                            <h4><?php echo $row['category'] ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="left-content">
                                        <img src="images/<?php echo $row['qrcode'] ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center py-5">
                            <a href="index.php" id="printPageButton" class="btn btn-dark">Go Home</a>
                            <a href="" onclick="window.print()" id="printPageButton" class="btn btn-info">Print</a>
                        </div>
                    <?php 
                }
            }
        }else{
            ?>
                <div class="text-center mt-5">
                    <p>NO DATA FOUND!!!!</p>
                    <a href="index.php" class="btn btn-info">Go To Home</a>
                </div>
            <?php
        }
        
    ?>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>