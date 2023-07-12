<?php
if ($_SESSION["user_role"] == 0) {
    header("Location: ./post.php");
    
    }
include "config.php";
echo $id = $_GET["id"];
$query = "DELETE FROM category WHERE category_id = '$id'";
$data = mysqli_query($conn, $query);
header("Location: ./category.php");
?>