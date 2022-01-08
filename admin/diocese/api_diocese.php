<?php
 include'../../includes/db.php';  
session_start();

// echo $logged_id;

if (isset($_POST['enter_diocese'])) {
	extract($_POST);
	
     $logged_id=$_SESSION['logged']['u_id'];
     $dname=strtoupper($d_name);   
     // $firstname=ucfirst($fname);
     // $u_password='123'; 

     $check_diocese=mysqli_query($db,"SELECT * FROM diocese WHERE diocese.d_name='$dname'");
     $check=mysqli_num_rows($check_diocese);

     if ($check==0) {
         
         $insert_dioceses=mysqli_query($db,"INSERT INTO diocese VALUES(NULL,'$dname','active')");
     if ($insert_dioceses) {
          $insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$logged_id','Inserted $dname as Diocese on ',current_timestamp())");
          header('location:index.php');
     }

     }else{
          echo "<script>alert('DIOCESE ALLREADY REGISTERED')</script>";
          echo "<script>window.location.href='index.php'</script>";
     }

     

}






 ?>