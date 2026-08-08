<?php 
    session_start();
    ob_start();
    include_once("../db.php");
    $id = $_GET['id'];
    // sql to delete a record
    $sql = "DELETE FROM category WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success']="Record deleted successfully";
        header("Location: categories.php");
    }else{
        $_SESSION['failure']="Please Try Again!!";
    }
?>