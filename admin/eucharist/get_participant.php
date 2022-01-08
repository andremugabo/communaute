<?php 
 include'../../includes/db.php';  

 

if (isset($_GET['pat'])) {
	$participant=$_GET['pat'];

	if ($participant=='Adult') {


		if (isset($_GET['tel'])) {
			$telephone=$_GET['tel'];

			$get_bands=mysqli_query($db,"SELECT * FROM bands WHERE bands.bs_phone='$telephone' AND bands.bs_status='active'");

			if (mysqli_num_rows($get_bands)>0) {

				while ($bands=mysqli_fetch_assoc($get_bands)) {

					echo "<input type='text'  value=".$bands['bs_lname']." ".$bands['bs_fname'].">";
				}
				
			}

		}

		


}elseif ($participant=='Child') {
	# code...
}else{
	echo "<input type='text'  placeholder='THERE IS NO CORRESPODANT PARTICIPANT' required >";
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