<?php include "header.php"; 
if ($_SESSION["user_role"] == 0) {
    header("Location: ./post.php");

    }
    ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <?php
                include "config.php";
                $limit = 3;
                
                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                }else{
                    $page =1;
                }
                $offset = ($page - 1)*$limit;
                $query = "SELECT * FROM category ORDER BY category_id DESC LIMIT $offset,$limit";
                $data = mysqli_query($conn, $query);
                if (mysqli_num_rows($data) > 0) {
                ?>
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($data)) {
                        ?>
                        <tr>
                            <td class='id'><?php echo $row["category_id"] ?></td>
                            <td><?php echo $row["category_name"] ?></td>
                            <td><?php echo $row["post"] ?></td>
                            <td class='edit'><a href='update-category.php?id=<?php echo $row["category_id"] ?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id=<?php echo $row["category_id"] ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php
                        }
                      ?>
                    </tbody>
                </table>
                <?php
                }
                $query1 = "SELECT * FROM category";
                $data1 = mysqli_query($conn, $query1);
                
                if (mysqli_num_rows($data1) > 0) {
                    
                    $total_rows =  mysqli_num_rows($data1);
                    $total_pages = ceil(($total_rows/$limit));
                    echo "<ul class='pagination admin-pagination'>";
                    if ($page > 1) {
                        echo "<li><a href='category.php?page=".($page-1)."'>Prev</a></li>";
                    }
                   
                   
                    for ($i=1; $i<=$total_pages ; $i++) { 
                        if ($page == $i) {
                            $active = "active";
                        }else{
                            $active = "";
                        }
                       echo "<li class='".$active."'><a href='category.php?page=".$i."'>".$i."</a></li>";
                    }
                    if ($total_pages > $page) {
                        // echo $page;
                        // echo $total_pages;
                        echo "<li><a href='category.php?page=".($page+1)."'>Next</a></li>";
                    }
                   
                    
                    echo "</ul>";
                }
                ?>
                
                     <!-- <li class="active"><a>1</a></li> -->
                    
                    
                
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
