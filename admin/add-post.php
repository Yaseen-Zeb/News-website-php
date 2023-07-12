<?php include "header.php"; ?>
<head>
<style>
            .none {
    color: red;
    display: none;
    font-size: 19px;
    text-align:center;
}
            .none1 {
    color: red;
    display: none;
    font-size: 19px;
    text-align:center;
}


        </style>
</head>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Post</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form -->
                  <form  action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Description</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                         
                          <select name="category" class="form-control">
                          <option  seclected > Select Category</option>
                          <?php 
                          include "config.php";
                          $query = "SELECT * FROM category";
                          $data = mysqli_query($conn, $query);
                          while ($row = mysqli_fetch_assoc($data)) {
                              
                          
                          ?>
                              <option value="<?php echo $row["category_id"] ?>" > <?php echo $row["category_name"] ?></option>
                              <?php
                          }
                              ?>
                          </select>

                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="fileToUpload" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <div id="none" class='none'> This extansion file is not allowed.!<span class="span">PLEASE upload a jpg or png file.</span> </div>
                  <div id="none1" class='none1'> The file size must be 2MB or lower. </div>
                  <!--/Form -->
                  <?php
                  
                  if (isset($_POST["submit"])) {
                      if (isset($_FILES["fileToUpload"])) {
                          

                          $file_name = $_FILES["fileToUpload"]["name"];
                          $file_size = $_FILES["fileToUpload"]["size"];
                          $file_tmp = $_FILES["fileToUpload"]["tmp_name"];
                          $file_type = $_FILES["fileToUpload"]["type"];
                          $file_ext = strtolower(end(explode(".",$file_name)));
                          $extansions = ["jpg" , "png"];

                          if (in_array($file_ext,$extansions) === false) {
                            ?>
                            <script>
                                let div = document.querySelector("#none");
                                div.style.display="block"
                            setTimeout(() => {
                                div.style.display="none"
                           }, 5000);
                            </script> 
                        <?php
                        die();
                          }elseif ($file_size > 2097152) {
                            ?>
                            <script>
                                let div1 = document.querySelector("#none1");
                                div1.style.display="block"
                            setTimeout(() => {
                                div1.style.display="none"
                           }, 5000);
                            </script> 
                        <?php
                        die(); 
                          }else{
                              $uniq = time()."-".$file_name;
                              move_uploaded_file($file_tmp,"upload/".$uniq);
                          }
                          
                        }
                    //   session_start();
                      $title =mysqli_real_escape_string($conn, $_POST["post_title"]);
                      $discrip =mysqli_real_escape_string($conn, $_POST["postdesc"]);
                      $cat =mysqli_real_escape_string($conn, $_POST["category"]);
                      $date = date("d, M, Y");
                      $auther =mysqli_real_escape_string($conn, $_SESSION["user_id"]);
                    //   $img = $_POST["fileToUpload"];
                    $query = "INSERT INTO post(title, description, category, post_date, author, post_img)
                    VALUES('$title','$discrip','$cat','$date','$auther','$uniq');";
                    $query .= "UPDATE category set post = post + 1 WHERE category_id = '$cat'";
                    $data = mysqli_multi_query($conn,$query);
                    if ($data) {
                        ?>
                        <script>
                            window.open("./post.php","_self");
                        </script>
                        <?php
                    }else{
                        echo "<div style='color:red;'> Query failed..! </div>";
                    }
                  }
                  
                  ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
