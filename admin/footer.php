<!-- Footer -->
<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php 
                        include "config.php";
                        $query = "SELECT * FROM settings";
                        $data = mysqli_query($conn, $query);
                        $row = mysqli_fetch_assoc($data);
                        ?>
                <span><?php echo $row["w_des"] ?><a href="">Zeb</a></span>
            </div>
        </div>
    </div>
</div>
<!-- /Footer -->
</body>
</html>
