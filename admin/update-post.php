<?php include "header.php";
    // session_start();
    include "config.php";
    $id = $_GET["id"];
    $query3 = "SELECT author FROM post WHERE post_id = '$id'";
    $data3 = mysqli_query($conn,$query3);
    $row3 = mysqli_fetch_assoc($data3);
    if ( $_SESSION["user_role"] == 0) {
    if ($row3["author"] != $_SESSION["user_id"]) {
        ?>
        <script>
            window.open("./post.php","_self");
        </script>
        <?php
        }
}
?>
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
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
        <?php 
        
        $query = "SELECT * FROM post INNER JOIN category ON post.category = category.category_id WHERE post_id = '$id'";
        $data = mysqli_query($conn,$query);
        if (mysqli_num_rows($data) > 0) {
            $row = mysqli_fetch_assoc($data);
        ?>
        <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $id ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row["title"]; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                <?php echo $row["description"]; ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                <?php 
                $query1 = "SELECT * FROM category";
                $data1 = mysqli_query($conn , $query1);
                while ($row1 = mysqli_fetch_assoc($data1)) {
                    if ($row["category"] == $row1["category_id"]) {
                        $selected = "selected";
                    }else{
                        $selected = "";
                    }
                ?>
                <option <?php echo $selected ?> value="<?php echo $row1['category_id']; ?>"><?php echo $row1["category_name"] ?>
            
            
                <?php
                 
                }
                ?>
                </select>

            </div></option><input type="hidden" name="old_category" class="form-control" value="<?php echo $row["category"]; ?>">


            
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $row["post_img"]; ?>" height="150px">
                <input type="hidden" name="old-image" value="">
            </div>
            
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
           
        </form>
        <div id="none" class='none'> This extansion file is not allowed.!<span class="span">PLEASE upload a jpg or png file.</span> </div>
                  <div id="none1" class='none1'> The file size must be 2MB or lower. </div>
        <?php
        }
        if (isset($_POST["submit"])) {
            if (isset($_FILES["new-image"])) {
               $name = $_FILES["new-image"]["name"];
               $size = $_FILES["new-image"]["size"];
               $tmp_name = $_FILES["new-image"]["tmp_name"];
               $type = $_FILES["new-image"]["type"];
               $seperator = explode(".",$name);
               $last = end($seperator);
               $arr = ["jpg","png"];
               if (in_array($last,$arr) === false) {
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
              }elseif ($size > 2097152) {
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
            }else {
                $uniq = time()."-".$name;
                move_uploaded_file($tmp_name,"upload/".$uniq);
            }






               
            }
            $p_id = mysqli_real_escape_string($conn,$_POST["post_id"]);
            $p_title = mysqli_real_escape_string($conn,$_POST["post_title"]);
            $p_dec = mysqli_real_escape_string($conn,$_POST["postdesc"]);
            $p_cat = mysqli_real_escape_string($conn,$_POST["category"]);
            $p_old_cat = $_POST["old_category"];
            $query2 = "UPDATE post set title = '$p_title', description = '$p_dec', category = '$p_cat', post_img = '$uniq' WHERE post_id = '$p_id';";
            if ($p_old_cat != $p_cat) {
                $query2 .= "UPDATE category set post= post-1 WHERE category_id = '$p_old_cat';";
                $query2 .= "UPDATE category set post= post+1 WHERE category_id = '$p_cat';";
            }
            
            $data2 = mysqli_multi_query($conn,$query2);
            if ($data2) {
                ?>
                <script>
                    window.open("http://localhost/News-project/admin/post.php","_self");
                </script>

                <?php
            }else{
                echo "Query Failed.!";
            }
        }
       
        ?>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
