<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details View</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css">
    <style>
        .main{
            padding-bottom: 80px;
        }
        input{
            width: 100% !important;
            margin: auto;
            height: 45px !important;
        }
    </style>
</head>
<body>
    <?php
        session_start();
        include_once("db.php");
        if(isset($_GET['id'])){ 
                
                ?>
                    <?php 
                        // Update & Insert 
                        if(isset($_POST["vote"])){
                            if(!empty($_POST["password"])){
                                $query = sprintf("SELECT * FROM password_generator WHERE password='%s'", $_POST['password']);
                                // $query = sprintf("SELECT * FROM password_used WHERE vehicle_id='%s' AND password='%s'", $_GET['id'], $_POST['password']);
                                $query_run = mysqli_query($conn, $query); 
                                $row = mysqli_fetch_assoc($query_run);  
                                if($row){
                                    $query = sprintf("SELECT * FROM password_used WHERE vehicle_id='%s' AND password='%s'", $_GET['id'], $_POST['password']);
                                    $query_run = mysqli_query($conn, $query); 
                                    $row = mysqli_fetch_assoc($query_run); 
                                    if(!$row){
                                        $password = $_POST["password"]; 
                                        $id = $_GET["id"]; 
                                        $query = sprintf("SELECT * FROM vehicles WHERE id='".$_GET['id']."'");
                                        $query_run = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($query_run) > 0){
                                            $row = mysqli_fetch_assoc($query_run);
                                             // Update On Vehicles 
                                            $vote = $row['vote_status'] + 1;
                                            $updateQuery = "UPDATE `vehicles` SET `vote_status`=$vote WHERE id='".$_GET['id']."'";
                                            mysqli_query($conn, $updateQuery);
    
                                            // Update On Password Generator
                                            $sql = "INSERT INTO password_used(password, vehicle_id) VALUES ('$password', '$id')";
                                            mysqli_query($conn, $sql);
                                            
                                            
                                            // Insert Votes 
                                            $user_id = $_GET["id"];
                                            $insertSql = "INSERT INTO vote(vehicle_id, password) VALUES ('$user_id','$password')";
                                            mysqli_query($conn, $insertSql);
    
                                            $_SESSION['msg']="Successfully Voted";
                                        } 
                                    }else{
                                        $_SESSION['err']="You have already voted to the vehicle.";
                                    }
                                }else{
                                    $_SESSION['err']="Invalid password";
                                }
                            }else{
                                $_SESSION['err']="Please fill the field with passwords";
                            }
                        }                            
                    ?>
                    <div class="container">
                        <div class="main">
                            <h1 class="text-center">Vote This Category</h1>
                            <div class="row">
                               <div class="col-md-12"><div class="form-img text-center">
                                        <img src="./images/form.png" alt="" style="width:30%; margin:auto;">
                                    </div></div>
                                <div class="col-md-6  offset-md-3">
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
                                    
                                    <div class="form-submit">
                                        <form novalidate action="" method="POST"> 
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="text" class="form-control" id="password" name="password" required placeholder="Enter Password" />
                                                    <small class="text-light">You will get the password from admin.</small>
                                                </div>
                                                <button type="submit" name="vote" class="btn btn-warning">Vote Now</button> 
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
             <?php 
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