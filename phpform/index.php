<?php 
    session_start();
    include_once("db.php");
    // Setting Query 
    $settingSql = "SELECT * FROM `settings` WHERE id = 1";
    $settingQuery = mysqli_query($conn, $settingSql);
    $setting = mysqli_fetch_assoc($settingQuery);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Vehicle Vote Contest</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
        <div class="main">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="form-img">
                        <img src="./admin/assets/upload/<?php echo $setting['logo']; ?>" alt="" class="card-img-top">
                    </div>
                </div>
                <div class="col-md-6">
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
                        <form id="regiration_form" novalidate action="action.php" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <h2 class="text-center">Step 1: Add User Details</h2>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required placeholder="Enter Your Name" />
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" required placeholder="Enter Your Address" />
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="number" class="form-control" id="phone" name="phone" required placeholder="Enter Your Phone" />
                                </div>
                                <input type="button" name="password" class="next btn btn-dark" value="Next" />
                            </fieldset>
                            <fieldset>
                                <h2 class="text-center">Step 2: Add Vehicles Details</h2>
                                <div class="form-group">
                                    <label for="vehicle_maker">Vehicle Brand</label>
                                    <input type="text" class="form-control" name="vehicle_maker" id="vehicle_maker" required placeholder="Enter Vehicle Maker" />
                                </div>
                                <div class="form-group">
                                    <label for="vehicle_model">Vehicle Model</label>
                                    <input type="text" class="form-control" name="vehicle_model" id="vehicle_model" required placeholder="Enter Vehicle Model" />
                                </div>
                                <div class="form-group">
                                    <label for="vehicle_year">Vehicle Year</label>
                                    <input type="text" class="form-control" name="vehicle_year" id="vehicle_year" required placeholder="Enter Vehicle Year" />
                                </div>
                                <input type="button" name="previous" class="previous btn btn-light" value="Previous" />
                                <input type="button" name="next" class="next btn btn-dark" value="Next" />
                            </fieldset>
                            <fieldset>
                                <h2 class="text-center">Step 3: Agree Details</h2>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select name="category" id="category" class="form-control">
                                        <option>Select Category</option>
                                        <?php 
                                            $category_query = "SELECT * FROM category";
                                            if($cat_result = mysqli_query($conn, $category_query)){
                                                if(mysqli_num_rows($cat_result) > 0){
                                                    while($cat_row = mysqli_fetch_array($cat_result)){
                                                    ?>
                                                        <option value="<?php echo $cat_row['name'] ?>"><?php echo $cat_row['name'] ?></option>
                                                    <?php 
                                                    }
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="checkbox">
                                    <span style="color:white;">I (We) confirm that the information provided is correct and agree to follow all rules and guidelines of the vehicle voting contest.</span>
                                </div>
                                <input type="button" name="previous" class="previous btn btn-light" value="Previous" />
                                <input type="submit" name="submit" class="submit btn btn-dark" value="Submit" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
          $(document).ready(function(){
          var current = 1,current_step,next_step,steps;
          steps = $("fieldset").length;
            $(".next").click(function(){
              current_step = $(this).parent();
              next_step = $(this).parent().next();
              next_step.show();
              current_step.hide();
              setProgressBar(++current);
            });
            $(".previous").click(function(){
              current_step = $(this).parent();
              next_step = $(this).parent().prev();
              next_step.show();
              current_step.hide();
              setProgressBar(--current);
            });
            setProgressBar(current);
            // Change progress bar action
            function setProgressBar(curStep){
              var percent = parseFloat(100 / steps) * curStep;
              percent = percent.toFixed();
              $(".progress-bar")
                .css("width",percent+"%")
                .html(percent+"%");   
            }
          });
        </script>
    </body>
</html>
