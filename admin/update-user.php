<?php include "header.php"; 
if ($_SESSION["user_role"] == 0) {
    header("Location: ./post.php");
    
    }?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <?php 
                  include "config.php";
                  if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                  }else {
                    $id = null;
                        echo "<h1 style='color:red'>Some thing went WRONG !</h1>";
                    }
                  
                  
                  $query = "SELECT * FROM user WHERE user_id = '$id'";
                  $data = mysqli_query($conn, $query);
                  if (mysqli_num_rows($data) > 0) {
                      while ($row = mysqli_fetch_assoc($data)) {
                  ?>
                  <form  action="<?php $_SERVER['PHP_SELF'] ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                          <?php
                          if ($row["role"] == 1) {
                                  echo "<option value='0'>normal User</option>
                              <option value='1' selected>Admin</option>";
                              }else{
                                echo "<option value='0' selected>normal User</option>
                                <option value='1'>Admin</option>";
                              }
                              ?>
                              
                          </select>
                      </div>
                      <input type="submit" name="btn" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php
                      }
                    }

  


                    if (isset($_POST["btn"])) {
                         $first_name =mysqli_real_escape_string($conn,$_POST["f_name"]);
                        $last_name =mysqli_real_escape_string($conn,$_POST["l_name"]);
                        $user =mysqli_real_escape_string($conn,$_POST["username"]);
                    //  $password =mysqli_real_escape_string($conn,md5($_POST["password"]) );
                        $role =mysqli_real_escape_string($conn,$_POST["role"]);
                        
                        $query1 = "UPDATE user set first_name='$first_name', last_name='$last_name', username='$user', role='$role' WHERE user_id='$id' ";
                        $data1 = mysqli_query($conn, $query1);
                         if ($data1) {
                            ?>
                            <script>
                            window.open("./users.php","_self")
                            </script>
                            <?php
                            
                         }else{
                             echo "<h1> fail </h1>";
                         }
                        
                   
                }
                    
                  ?>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>

