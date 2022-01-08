<?php 
 include'../../includes/db.php';  

 

if (isset($_GET['cat'])) {
	$diocese=$_GET['cat'];

$get_parish=mysqli_query($db,"SELECT * FROM parish WHERE p_did='$diocese' AND p_status='active'");

if (mysqli_num_rows($get_parish)>0) {
	echo "<option>SELECT PARISH</option>";
	
	while ($parish=mysqli_fetch_array($get_parish)) {

		echo "<option value=".$parish['p_id'].">".$parish['p_name']."</option>";		
	}
}else{
	echo "<option selected disabled value='' >THE PARISH IS NOT GIVEN</option>";
}

}


if (isset($_GET['com'])) {
	$parish=$_GET['com'];

$get_community=mysqli_query($db,"SELECT * FROM community WHERE c_pid='$parish' AND c_status='active'");

if (mysqli_num_rows($get_community)>0) {
	echo "<option>SELECT COMMUNITY</option>";
	
	while ($community=mysqli_fetch_array($get_community)) {

		echo "<option value=".$community['c_id'].">".$community['c_name']."</option>";		
	}
}else{
	echo "<option selected disabled value='' >THE COMMUNITY IS NOT GIVEN</option>";
}

}


 ?>
 

 