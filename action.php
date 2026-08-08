<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
<div class="container">
    <div class="row well alert alert-success">
        <?php 
            session_start();
            include_once("db.php");
            require_once("phpqrcode/qrlib.php");

            $path = 'images/';
            $qrcode = $path.time().'.png';
            $qrimage = time().'.png';

            // Database Store Code Start
            if(!empty($_POST["name"]) && !empty($_POST["address"]) && !empty($_POST["phone"]) && !empty($_POST["vehicle_maker"]) && !empty($_POST["vehicle_model"]) && !empty($_POST["vehicle_year"]) && !empty($_POST["checkbox"]) ){
                if(isset($_POST["submit"])){
                    $name = $_POST["name"];
                    $address = $_POST["address"];
                    $phone = $_POST["phone"];
                    $vehicle_maker = $_POST["vehicle_maker"];
                    $vehicle_model = $_POST["vehicle_model"];
                    $vehicle_year = $_POST["vehicle_year"];
                    $category = $_POST["category"];
                    $my_date = date("Y-m-d H:i:s");
                    $checkbox = "yes";


                    // Image Upload Code 
                    
                    // $singature=$_FILES['signature']['name']; 
                    // $singatureArr=explode('.',$singature); 
                    // $rand=rand(10000,99999);
                    // $newSingatureName=$singatureArr[0].$rand.'.'.$singatureArr[1];
                    // $uploadPath="images/".$newSingatureName;
                    // $isUploaded=move_uploaded_file($_FILES["signature"]["tmp_name"],$uploadPath);


                    // Password Generator
                    // $passRam = openssl_random_pseudo_bytes(2);
                    // $password = bin2hex($passRam);
    
    
                    $sql = "INSERT INTO vehicles(name, address, phone, vehicle_maker, vehicle_model, vehicle_year, category, checkbox, qrcode, created_date) VALUES ('$name','$address','$phone','$vehicle_maker','$vehicle_model','$vehicle_year','$category','$checkbox','$qrimage','$my_date')";
                    if(mysqli_query($conn, $sql)){
                        $_SESSION['msg']="Thanks, Your data has been recorded successfully.";
                        header("Location: index.php");
                    }else{
                        $_SESSION['msg']="Please Try Again!!";
                    }

                    // Current Inserted ID 
                    $curr_id = mysqli_insert_id($conn);

                    // Get Base Url 
                    $base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "off") ? "https" : "http");
                    $base_url .= "://".$_SERVER['HTTP_HOST'];
                    $base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

                    // Data For QRCode
                    $data = $base_url."vote.php?id=".$curr_id;

                    header( "Location: view.php?id={$curr_id}" );
                    mysqli_close($conn);
                }
            }else{
                $_SESSION["err"]= "Please Fill The All Field !!";
                header("Location: index.php");
            } 
            // Database Store Code End
            echo $base_url;
            QRcode ::png($data , $qrcode , 'H',4 , 4);
            // echo '<img src="'.$qrcode.'">';

            
        ?>
    </div>
</div>