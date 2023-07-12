<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                  <?php 
                  include "config.php";
                  if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                  }else{
                      $page = 1;
                  }
                  
                  $limit = 3;
                  $offset = ($page - 1)*$limit;
                  
                  if ($_SESSION["user_role"] == 1) {
                    $query = "SELECT * FROM post INNER JOIN category on post.category = category.category_id
                    INNER JOIN user on post.author = user.user_id ORDER BY post_id DESC LIMIT $offset,$limit";
                  }elseif($_SESSION["user_role"] == 0){
                    $query = "SELECT * FROM post INNER JOIN category on post.category = category.category_id
                    INNER JOIN user on post.author = user.user_id 
                    WHERE post.author = {$_SESSION['user_id']}
                    ORDER BY post_id DESC
                    LIMIT $offset,$limit";
                  }
               $data = mysqli_query($conn, $query);
                  if (mysqli_num_rows($data) > 0) {
                 
                  ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                       <?php
                       $count = $offset;
                       while ($row = mysqli_fetch_assoc($data)) {
                      $count++
                       ?>
                          <tr>
                              <td class='id'><?php echo $count ?></td>
                              <td><?php echo $row["title"] ?></td>
                              <td><?php echo $row["category_name"] ?></td>
                              <td><?php echo $row["post_date"] ?></td>
                              <td><?php echo $row["username"] ?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $row["post_id"] ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $row["post_id"]?>&cid=<?php echo $row["category_id"]?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                        <?php
                       }
                        ?>
                      </tbody>
                  </table>
                  <?php
                  }
                  if ($_SESSION["user_role"] == 1) {
                    $query1 = "SELECT * FROM post"; 
                  }elseif ($_SESSION["user_role"] == 0) {
                    $query1 = "SELECT * FROM post WHERE author = {$_SESSION['user_id']} " ; 
                  }
                  
                  $data1 = mysqli_query($conn , $query1);
                  $total_rows = mysqli_num_rows($data1);
                  $total_pages = ceil(($total_rows/$limit));
                  
                   ?>
                  <ul class='pagination admin-pagination'>
                      <?php
                 if ($page > 1) {
                     ?>
                    <li><a href="post.php?page=<?php echo $page - 1?>">Prev</a></li>
                    <?php
                 }
                
                      for ($i=1; $i <= $total_pages ; $i++) { 
                        if ($i == $page) {
                            $active = "active";
                        }else{
                         $active = "";
                        }
                       echo "<li class='".$active."'><a href='post.php?page=".$i."'>".$i."</a></li>";
                      }

                if ($total_pages > $page) {
                        ?>
                       <li><a href="post.php?page=<?php echo $page + 1?>">Next</a></li>
                       <?php
                    }

                   
                       
                    
                   ?>

                     
                      <!-- <li class="active"><a>1</a></li>  -->
                      
                      
                  </ul>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
