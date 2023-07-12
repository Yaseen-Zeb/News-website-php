<!DOCTYPE html>
<?php
include "config.php";
$page = basename($_SERVER["PHP_SELF"]);
switch ($page) {
    case 'category.php':
        if (isset($_GET["cid"])) {
            $getter = $_GET["cid"];
        }
        $query = "SELECT * FROM category WHERE category_id ='$getter'";
        $data = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($data);
        $title = $row["category_name"] ." ". "News";
        break;
        case 'single.php':
            if (isset($_GET["pid"])) {
                $getter = $_GET["pid"];
            }
        $query = "SELECT * FROM post WHERE post_id ='$getter'";
        $data = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($data);
        $title = $row["title"] ." ". "News";
            break;
            case 'author.php':
                if (isset($_GET["aid"])) {
                    $getter = $_GET["aid"];
                }
        
        $query = "SELECT * FROM user WHERE user_id ='$getter'";
        $data = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($data);
        $title = "News by"." ". $row["username"];
                break;
                case 'search.php':
                    if (isset($_GET["search"])) {
                        $getter = $_GET["search"];
                    }
        
        $query = "SELECT * FROM post WHERE title LIKE '%$getter%' OR  description LIKE '%$getter%'";
        $data = mysqli_query($conn, $query);
        $title = $getter ." " ."News";
                    break;
    
    default:
        $title  = "News Site";
        break;
}


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title  ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <?php 
                        include "config.php";
                        $query = "SELECT * FROM settings";
                        $data = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($data);
                        if ($row["w_logo"] === "") {
                            echo '<a href="post.php"><h1>'.$row["w_name"].' </h1></a>';
                        }else {
                            echo '<div class=" col-md-offset-4 col-md-4">';
                            echo '<a href="index.php" id="logo"><img src="admin/upload/'. $row["w_logo"] .'"></a>';
                            echo '</div>';
                        }
                        ?>
            
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php include "config.php";
                
                if (isset($_GET["cid"])) {
                    $cid = $_GET["cid"];
                }else {
                    $cid = 1;
                }
                $query = "SELECT * FROM category WHERE post > 0";
                $data = mysqli_query($conn, $query);
                if (mysqli_num_rows($data) > 0) {
                ?>
                <ul class='menu'>
                <li><a class="<?php echo $active ?>" href='index.php'>Home</a></li>
                    <?php   while ($row = mysqli_fetch_assoc($data)) { 
                        if ($row["category_id"] == $cid) {
                            $active = "active";
                        }else {
                            $active = "";
                        }
                        ?>
                        
                    <li><a class="<?php echo $active ?>" href='category.php?cid=<?php echo $row["category_id"] ?>'><?php echo $row["category_name"] ?></a></li>
                    <?php } ?>
                </ul>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
