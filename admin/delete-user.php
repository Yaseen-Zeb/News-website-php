<?php
if ($_SESSION["user_role"] == 0) {
    header("Location: ./post.php");
    
    }
include "config.php";
$id= $_GET["id"];
$query = "DELETE FROM user WHERE user_id = '$id'";
$data = mysqli_query($conn, $query);
// $close = close_connection();
header("Location: ./users.php");

?>