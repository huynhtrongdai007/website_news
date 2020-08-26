<?php include 'header.php'; ?>
<?php $id = $_GET['cid']; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                         <?php 
                            require 'config.php';
                                 $limit_page = 3;
                                if (isset($_GET['page'])) {
                                 $page = $_GET['page'];
                                } else {
                                  $page = 1;
                                }
                                
                                $offset = ($page  - 1) * $limit_page;

                                $sql = "SELECT * FROM post JOIN category as cat 
                                 on post.category = cat.category_id JOIN user
                                 ON post.author = user.user_id where post.post_id = '$id'  
                                        ";

                                $result = mysqli_query($conn,$sql) or die("Query Failed");
                                if (mysqli_num_rows($result) > 0) {
                                   while ($row = mysqli_fetch_assoc($result)) {                              
                             ?>
                        <div class="post-content single-post">
                                <h3><?php echo $row['title']; ?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                  <a href='category.php?cid=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>  
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php'><?php echo $row['username']; ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $row['post_date']; ?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="./admin/upload/<?php echo $row['post_img'];?>" alt=""/>
                            <p class="description">
                              <?php echo $row['description']; ?>
                            </p>
                        </div>
                        <?php
                               } 
                              } else {
                                echo "<h3>khong co du lieu</h3>";
                              }
                             ?>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
