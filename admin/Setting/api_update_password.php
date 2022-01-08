<?php 
include('../../includes/db.php');
session_start();

$current_password=$_SESSION['logged']['u_password'];
$users_id=$_SESSION['logged']['u_id'];
// echo $users_id;

if (isset($_POST['update_password'])) {
	
	extract($_POST);

	$cript_current_password=md5($u_password);
	// echo $cript_current_password;

    if ($current_password==$cript_current_password) {
    	
    	$new_password=$nu_password;
    	$confirm_password=$cnu_password;

    	// echo $new_password;
    	// echo $confirm_password;

    	if ($new_password==$confirm_password) {

    		$cript_new_password=md5($nu_password);

    		$up_date_password=mysqli_query($db,"UPDATE users SET u_password='$cript_new_password' WHERE  u_id='$users_id'");    


    		 if ($up_date_password) {
    		 			
    		 $insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$users_id',' UPDATED PASSWORD ',current_timestamp())");
          					echo "<script>alert('PASSWORD UPDATE SECCESSFULLY')</script>";
          						echo "<script>window.location.href='index.php'</script>";
    		 		}		

    	}else{
    		echo "<script>alert('NEW PASSWORD DON'T MATCH)</script>";
    		echo "<script>window.location.href='index.php'</script>";
    	}

    }else{
    	echo "<script>alert('CURRENT PASSWORD IS INCORRECT')</script>";
    	echo "<script>window.location.href='index.php'</script>";
    }

}




 ?>