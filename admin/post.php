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
                          include 'config.php';
                          $sql = "SELECT * FROM post JOIN category 
                          on post.category = category.category_id
                          JOIN user 
                          on post.author = user.user_id
                           ORDER BY post_id";
                            $result = mysqli_query($conn,$sql);
                            if (mysqli_num_rows($result)) {
                                while ($items = mysqli_fetch_assoc($result)) {

                         ?>
                          <tr>
                              <td class='id'><?php echo $items['post_id']; ?></td>
                              <td><?php echo $items['title']; ?></td>
                              <td><?php echo $items['category_name']; ?></td>
                              <td><?php echo $items['post_date']; ?></td>
                              <td><?php echo $items['username']; ?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $items['post_id'] ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $items['post_id'] ?>&catid=<?php echo $items['category'];?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                         <?php 
                          }
                        }
                           ?>
                      </tbody>
                  </table>
                  <ul class='pagination admin-pagination'>
                      <li class="active"><a>1</a></li>
                      <li><a>2</a></li>
                      <li><a>3</a></li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
