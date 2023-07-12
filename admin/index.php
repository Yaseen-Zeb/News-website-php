<?php

session_start();
if (isset($_SESSION["password"])) {
    header("Location: ./post.php");
}
?>
<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" co-ntent="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
        <style>
            .none {
    color: red;
    display: none;
    font-size: 19px;
    text-align:center;
}
.span{

}

        </style>
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <img class="logo" src="images/news.jpg">
                        <h3 class="heading">Admin</h3>
                        <!-- Form Start -->
                        <form  action="<?php $_SERVER["PHP_SELF"] ?>" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <div id="none" class='none'> Username and Password are not mached! <span class="span">PLEASE TRY AGAIN.</span> </div>
                        <?php
                        if (isset($_POST["login"])) {
                            // include "config.php";
                            $conn = mysqli_connect("localhost","root","","News-project");
                            $username =mysqli_real_escape_string($conn,$_POST["username"]);
                            $password =mysqli_real_escape_string($conn,$_POST["password"]);
                            $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
                            $data = mysqli_query($conn, $query);
                          
                            if (mysqli_num_rows($data) > 0) {
                                $row = mysqli_fetch_assoc($data);
                                session_start();
                                $_SESSION["username"] = $row["username"];
                                $_SESSION["user_id"] = $row["user_id"];
                                $_SESSION["user_role"] = $row["role"];
                                $_SESSION["password"] = $row["password"];
                               header("Location: http://localhost/News-project/admin/post.php");
                            } else{
                            
                                    ?>
                                <script>
                                    let div = document.querySelector("#none");
                                    div.style.display="block"
                                setTimeout(() => {
                                    div.style.display="none"
                               }, 5000);
                                </script> 
                            <?php
                            }
                        }
                        ?>
                        <!-- /Form  End --a6bb4faacdff9dcdcb6f6e22bc51eac9--2d85f6d29d18a877dc99c9a3e32f8494 -->

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
