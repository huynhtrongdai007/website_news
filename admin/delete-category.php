<?php 
	include 'config.php';

	$id = $_GET['id'];
	
	$sql = "DELETE FROM category WHERE category_id = '$id';";

	

	if (mysqli_query($conn,$sql)) {
		
		 header("location:{$host}/admin/category.php"); 
          exit();
	} else {
		echo "<p class='alert alert-danger'>Can't Delete the Category Record.</p>";
	}
mysqli_close($conn);
 ?>