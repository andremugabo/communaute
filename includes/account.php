<?php 

include('db.php');

session_start();




$action=$_GET['action'];

switch ($action) {
	case 'login':
		
		 extract($_POST);

		 $check_user=mysqli_query($db,"SELECT * FROM users WHERE users.u_phone='$username' AND users.u_password='".md5($password)."' AND users.u_status='active'");
		

		 if ((mysqli_num_rows($check_user))>0) {

		 	$_SESSION['logged']=mysqli_fetch_assoc($check_user);
		 	$u_role=$_SESSION['logged']['u_role'];
            

		 	switch ($u_role) {
		 		case 'IT':
		 			header("location:../admin/dashboard");
		 			break;
		 		case 'MD':
		 			header("location:../admin/dashboard");
		 			break;
		 		case 'SVOL':
		 			header("location:../admin/dashboard");
		 			break;
		 		default:
		 			header("location:../admin/dashboard");
		 			break;
		 	}
		 }else{
				echo "<script>alert('Wrong credential')</script>";
				echo "<script>window.location.href='../index.php'</script>";
         }



		break;
	
	default:
		# code...
		break;
}







 ?>