<?php 
include 'config.php';
	$id = $_GET["id"];
	$sql = "DELETE FROM user WHERE user_id = '$id'";
	$result = mysqli_query($conn,$sql);
	if($result == true)
	{
		 header("location:http://localhost:8080/website_news/admin/users.php"); 
          exit();
	} else {
		echo "<p style='color:red; margin:10px 0;'>Can't Delete the User Record.</p>";
	}

	mysqli_close($conn);
 ?>