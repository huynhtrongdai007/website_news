<?php include "header.php"; ?>
<?php include 'config.php'; ?>

<?php 
  if(isset($_POST['submit']))
  {
    $id = mysqli_real_escape_string($conn,$_POST['user_id']);
    $fname = mysqli_real_escape_string($conn,$_POST['f_name']);
    $lname = mysqli_real_escape_string($conn,$_POST['l_name']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $role = mysqli_real_escape_string($conn,$_POST['role']);

     $sql = "UPDATE user SET first_name = '$fname',last_name = '$lname' ,username = '$username', role = '$role' WHERE user_id = '$id'";

    if (mysqli_query($conn,$sql)) {
          header("location:http://localhost:8080/website_news/admin/users.php"); 
          exit();
          }      
    }
  
 ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <?php 
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM user WHERE user_id = '$id'";
                    $result = mysqli_query($conn,$sql) or die("Query Failed");
                    if(mysqli_num_rows($result)) {
                      while ($item = mysqli_fetch_assoc($result)) {
                      
                   ?>
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $item['user_id'] ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $item['first_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $item['last_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $item['first_name']. '' . $item['last_name'] ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                            <?php if($item['role']==1): ?>
                              <option value="0">normal User</option>
                              <option selected value="1">Admin</option>
                          
                            <?php else: ?>
                              <option selected value="0">normal User</option>
                              <option  value="1">Admin</option>
                            <?php endif ; ?>
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php
                     } 
                    }
                   ?>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
