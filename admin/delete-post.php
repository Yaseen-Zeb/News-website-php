<?php
include "config.php";
$id= $_GET["id"];
$cid= $_GET["cid"];
$query1 = "SELECT * FROM post WHERE post_id = '$id'";
$data1 = mysqli_query($conn, $query1);
$row = mysqli_fetch_assoc($data1);
unlink("upload/".$row["post_img"]);
$query = "DELETE FROM post WHERE post_id = '$id';";
$query .= "UPDATE category SET post = post-1 WHERE category_id = '$cid'";
$data = mysqli_multi_query($conn, $query);
header("Location: ./post.php");
?>