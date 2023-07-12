<?php include "header.php"; 
if ($_SESSION["user_role"] == 0) {
    header("Location: ./post.php");
    
    }?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <?php 
                  include "config.php";
                  $id = $_GET["id"];
                  $query = "SELECT * FROM category WHERE category_id = '$id'";
                  $data = mysqli_query($conn, $query);
                   ?>
                  <form action="<?php $_SERVER["PHP_SELF"] ?>" method ="POST">
                      <div class="form-group">
                          <?php   
                          if ($data) {
                              $row = mysqli_fetch_assoc($data);
                          ?>
                         <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row['category_id'] ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name'] ?>"  placeholder="" required>
                      </div>
                      <?php
                          }
                         ?>
                      <input type="submit" name="btn" class="btn btn-primary" value="Update" required />
                  </form>
                </div>
              </div>
            </div>
          </div>
          <?php
          if (isset($_POST['btn'])) {
              $c_name =mysqli_real_escape_string($conn,$_POST["cat_name"]);
              $query1 = "UPDATE category SET category_name = '$c_name' WHERE category_id = '$id'";
              $data1 = mysqli_query($conn, $query1);
              header("Location: http://localhost/News-project/admin/category.php");         
              
          }
          ?>
<?php include "footer.php"; ?>
