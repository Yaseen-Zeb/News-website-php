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
                 <h1 class="admin-heading">Website Settings</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form -->
                  <?php
                  include "config.php";
                  $query = "SELECT * FROM settings";
                  $data = mysqli_query($conn, $query);
                  if (mysqli_num_rows($data) > 0) {
                     ?>
                 <form  action='<?php $_SERVER['PHP_SELF']?>' method="POST" enctype="multipart/form-data">
                 <?php
                 while ($row = mysqli_fetch_assoc($data)) {
                  ?>
                 
                      <div class="form-group">
                          <label for="post_title">Website Name</label>
                          <input type="text" value="<?php echo $row["w_name"] ?>" name="w_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Website logo</label>
                          <input type="file" name="file" required>
                          <img  src="upload/<?php echo $row["w_logo"]; ?>" height="150px">
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Footer Description</label>
                          <textarea name="w_desc" class="form-control" rows="5"  required><?php echo $row["w_des"] ?></textarea>
                      </div>
                      <?php
                 }
                      ?>
                      
                      <input type="submit" name="change" class="btn btn-primary" value="Change" required />
                  </form>
                  <div id="none" class='none'> This extansion file is not allowed.!<span class="span">PLEASE upload a jpg or png file.</span> </div>
                  <div id="none1" class='none1'> The file size must be 2MB or lower. </div>

                  
                  
                  <?php
                  }
                if (isset($_POST["change"])) {

                    if (isset($_FILES["file"])) {
                        $f_name = $_FILES["file"]["name"];
                        
                        $f_size = $_FILES["file"]["size"];
                        $f_tmp = $_FILES["file"]["tmp_name"];
                        $f_type = $_FILES["file"]["type"];

                        $exp = explode(".",$f_name);
                        $seprator = end($exp);
                        $chk_arr = ["jpg" , "png"];

                        if (in_array($seprator,$chk_arr) === false) {
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
                      }elseif ($f_size > 2097152) {
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
                        move_uploaded_file($f_tmp,"upload/".$f_name);
                    }

                    $w_name = mysqli_real_escape_string($conn,$_POST["w_title"]);
                    $w_des = mysqli_real_escape_string($conn,$_POST["w_desc"]);
                    $query1 = "UPDATE settings SET w_name = '$w_name', w_logo = '$f_name', w_des = '$w_des'";
                    $data1 = mysqli_query($conn, $query1);
                    if ($data1 ) {
                        ?>
                        <script>
                      window.open("http://localhost/News-project/admin/setting.php","_self");
                        </script>
                       <?php
                    } else {
                        echo "Query fail";
                    }
                    
                    
                }
                   
            } 
                  ?>

              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
