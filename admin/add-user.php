<?php include "header.php"; 
if ($_SESSION["user_role"] == 0) {
    header("Location: ./post.php");
    
    }
if (isset($_POST["save"])) {
    include "config.php";
    $first_name =mysqli_real_escape_string($conn,$_POST["fname"]);
    $last_name =mysqli_real_escape_string($conn,$_POST["lname"]);
    $user_name =mysqli_real_escape_string($conn,$_POST["user"]);
    $password =mysqli_real_escape_string($conn,$_POST["password"]);
    $role =mysqli_real_escape_string($conn,$_POST["role"]);

    $query = "SELECT username FROM user WHERE username = '$user_name'";
    $data = mysqli_query($conn, $query);

    if (mysqli_num_rows($data) > 0) {
        echo "<p style='color:red, margin:10px 0px, text-align:center'> UserName already exists </p>";
    }else{
        $query1 = "INSERT INTO user(first_name, last_name, username, password, role)
        VALUES('$first_name', '$last_name', '$user_name', '$password', '$role')";
        $data1 = mysqli_query($conn, $query1);
        if ($data1) {
            header("Location: ./users.php");
        }


    }
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
