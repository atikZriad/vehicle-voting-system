<?php
    $conn = mysqli_connect('localhost', 'root', '', 'phpform');
    if (!$conn) {
        die('Could not connect my sql file'. mysqli_connect_error());
    }
?>