<?php include 'header.php'; ?>
    <div id="main-content">

        <div class="container">
            
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">
                        <?php
                         
                         include "config.php";
                         if (isset($_GET["page"])) {
                           $page = $_GET["page"];
                         }else{
                             $page = 1;
                         }
                         
                         $limit = 3;
                         $offset = ($page - 1)*$limit;
                         
                         
                           $query = "SELECT * FROM post INNER JOIN category on post.category = category.category_id
                           INNER JOIN user on post.author = user.user_id ORDER BY post_id DESC LIMIT $offset,$limit";
                         
                         
                      $data = mysqli_query($conn, $query);
                         if (mysqli_num_rows($data) > 0) {
                            while ($row = mysqli_fetch_assoc($data)) {
                         ?>

                        
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?pid=<?php echo $row["post_id"] ?>"><img src="admin/upload/<?php echo $row["post_img"] ?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?pid=<?php echo $row["post_id"] ?>'><?php echo $row["title"] ?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cid=<?php echo $row["category"] ?>'><?php echo $row["category_name"] ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?aid=<?php echo $row["user_id"] ?>'><?php echo $row["username"] ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row["post_date"] ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                        <?php 
                                        if (strlen($row["description"]) >= 170) {
                                          echo substr($row["description"],0,170) . "..." ; 
                                        }else{
                                            echo $row["description"];
                                        }
                                        
                                        ?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?pid=<?php echo $row["post_id"] ?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        }
                    
                      $query1 = "SELECT * FROM post"; 

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
                          
                         echo "<li class='".$active."'><a href='index.php?page=".$i."'>".$i."</a></li>";
                        }
  
                  if ($total_pages > $page) {
                          ?>
                         <li><a href="post.php?page=<?php echo $page + 1?>">Next</a></li>
                         <?php
                      }
  
                     ?>
                        
                    </ul>
   
                    </div><!-- /post-container -->
                </div> 
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>


