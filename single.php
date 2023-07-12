<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                  <?php 
                  include "config.php";
                  $id = $_GET["pid"];
                  $query = "SELECT * FROM post INNER JOIN category on post.category = category.category_id
                  INNER JOIN user on post.author = user.user_id 
                  WHERE post_id = '$id'";
                  $data = mysqli_query($conn, $query);
                   $row = mysqli_fetch_assoc($data);
                  ?>
                    <div class="post-container">
                        <div class="post-content single-post">
                            <h3><?php echo $row["title"]; ?></h3>
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
                            <img class="single-feature-image" src="admin/upload/<?php echo $row["post_img"] ?>" alt=""/>
                            <p class="description">
                            <?php echo $row["description"] ?>
                            </p>
                        </div>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
