<?php include "header.php"; ?>
<?php
  include 'config.php';
 if ($_SESSION['user_role']==0) {
     header("location:{$hostname}/admin/post.php");
     exit();
 }
 ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php 
                        $limit_page = 3;
                        if (isset($_GET['page'])) {
                         $page = $_GET['page'];
                        } else {
                          $page = 1;
                        }
                        
                        $offset = ($page  - 1) * $limit_page;


                          $sql = "SELECT * FROM user ORDER BY user_id DESC LIMIT {$offset},{$limit_page}";
                          $result = mysqli_query($conn,$sql) or die("Query Failed");
                          if(mysqli_num_rows($result) > 0) {

                              while ($items = mysqli_fetch_assoc($result)) {
                         
                         ?>
                          <tr>
                              <td class='id'><?php echo $items['user_id']; ?></td>
                              <td><?php echo $items['first_name'] ." ". $items['last_name'] ?></td>
                              <td><?php echo $items['username'] ?></td>
                              <td><?php 
                                if ($items['role']==1) {
                                  echo"Admin";
                                } else {
                                  echo "Normal";
                                }
                              ?></td>
                              <td class='edit'><a href='update-user.php?id=<?php echo $items['user_id'] ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo $items['user_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php 
                              }
                            }
                           ?>
                      </tbody>
                  </table>
                  <?php 
                    $sql1 = "SELECT * FROM user";
                    $result1 = mysqli_query($conn,$sql1) or die ("Query Failed");

                    if(mysqli_num_rows($result1) > 0){
                      $total_records = mysqli_num_rows($result1);
                      $limit = 3;
                      $total_pages = ceil($total_records / $limit); 
                    }
                   
                  ?>
                   
                  <ul class='pagination admin-pagination'>
                    <?php if($page > 1){ ?>
                   <li><a href="users.php?page=<?php echo ($page-1); ?>">Prev</a></li>
                   <?php } ?> 
                   <?php  for ($i=1; $i <= $total_pages; $i++) {
                      if ($i == $page) {
                        $active = "active";
                      } else {
                        $active="";
                      }

                     ?>
                      <li class="<?php echo $active; ?>">
                        <a  href="users.php?page=<?php echo $i; ?>"><?php echo $i;?></a>
                      </li>
                    <?php
                         } 
                      if($total_pages >$page) {
                    ?>
                      <li><a href="users.php?page=<?php echo ($page + 1); ?>">Next</a></li>
                      <?php } ?> 
                  </ul>
                  
              </div>
          </div>
      </div>
  </div>
<?php include "header.php"; ?>
