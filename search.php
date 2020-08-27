<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">

                    <?php 
                       require 'config.php';
                        if (isset($_GET['search'])) {
                        $search_term = mysqli_real_escape_string($conn,$_GET['search']);
                       }
                     ?>
                     <h2 class="page-heading">Search : <?php echo $search_term; ?></h2>
                <?php 
                   
                  
                         $limit_page = 3;
                        if (isset($_GET['page'])) {
                         $page = $_GET['page'];
                        } else {
                          $page = 1;
                        }
                        
                        $offset = ($page  - 1) * $limit_page;

                        $sql1 = "SELECT * FROM post join user on post.author = user.user_id join category 
                        on post.category = category.category_id where post.title  like  '%{$search_term}%' OR  post.description  like  '%{$search_term}%'   ORDER BY  post.post_id DESC LIMIT {$offset},{$limit_page}";
                              $result1 = mysqli_query($conn,$sql1) or die ("Query Failed");
                              $row1  = mysqli_fetch_assoc($result1);
                         

                        $result = mysqli_query($conn,$sql1) or die("Query Failed");
                        if (mysqli_num_rows($result) > 0) {
                           while ($row = mysqli_fetch_assoc($result)) {                              
                     ?>
                
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?cid=<?php echo $row['post_id']; ?>"><img src="admin/upload/<?php echo $row1['post_img']; ?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?cid=<?php echo $row1['post_id'] ?>'><?php echo $row1['title']; ?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $row['category']; ?>'><?php echo $row1['category_name']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?aid=<?php echo $row1['author'] ?>'><?php echo $row1['username']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                           <?php echo $row1['post_date']; ?>
                                        </span>
                                    </div>
                                    <p class="description">
                                       <?php echo substr($row1['description'],0,130) . '...'; ?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?cid=<?php echo $row1['post_id']; ?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php
                               } 
                              } else {
                                echo "<h3>khong co du lieu</h3>";
                              }
                             //code phan trang
                            
                                $sql1 = "SELECT * FROM post where post.title like '%{$search_term}%' OR post.description like '%{$search_term}%' ";
                                $result1 = mysqli_query($conn,$sql1) or die("Query Failed");
                   


                              if(mysqli_num_rows($result1) > 0){

                                $total_records =mysqli_num_rows($result1);
                                $limit = 3;
                                $total_pages = ceil($total_records / $limit); 
                          
                             
                            ?>
                    <ul class='pagination admin-pagination'>
                      <?php if($page > 1) { 
                            echo' <li><a href="index.php?search='.$search_term.'&page='.($page-1).'">Prev</a></li>';
                        }   
                       ?>
                       <?php
                       for ($i=1; $i <= $total_pages; $i++) {
                        if ($i == $page) {
                          $active = "active";
                        } else {
                          $active="";
                        }                      
                         echo'<li class="'.$active.'"><a  href="index.php?search='.$search_term.'&page='.$i.'">'.$i.'</a></li>';
                        }
                         ?>
                         <?php
                            if($total_pages > $page) 
                            {
                                echo '<li><a href="index.php?search='.$search_term.'&page='.($page + 1).'">Next</a></li>';
                            }
                                }else {
                                    echo "";
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
