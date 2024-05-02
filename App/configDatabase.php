<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "learn";


try {
    $conn = mysqli_connect($host, $user, $password, $db);
 
} catch (Exception $e) {
    echo $e->getMessage();
}
