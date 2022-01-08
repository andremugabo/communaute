<?php
 include'../../includes/db.php';  
session_start();

// echo $logged_id;

if (isset($_POST['enter_user'])) {
	extract($_POST);
	
     $logged_id=$_SESSION['logged']['u_id'];
     $lastname=strtoupper($lname);   
     $firstname=ucfirst($fname);
     $u_password='123'; 


     $check_user=mysqli_query($db,"SELECT * FROM users WHERE users.u_phone='$u_phone'");
     $check=mysqli_num_rows($check_diocese);


     if ($check==0) {
          $insert_users=mysqli_query($db,"INSERT INTO users VALUES(NULL,'$firstname','$lastname','$u_phone','".md5($u_password)."','$u_role','active')");
     if ($insert_users) {
          $insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$logged_id','Inserted $lastname as User on ',current_timestamp())");
          header('location:index.php');
     }
     }else{
           echo "<script>alert('USER ALLREADY REGISTERED')</script>";
           echo "<script>window.location.href='index.php'</script>";
     }


     


}






 ?>