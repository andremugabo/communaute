<?php
 include'../../includes/db.php';  
session_start();

// echo $logged_id;

if (isset($_POST['enter_parish'])) {
	extract($_POST);
	
     $logged_id=$_SESSION['logged']['u_id'];
     $pname=strtoupper($p_name); 
     $pspatron=ucfirst($p_spatron);  
     // $firstname=ucfirst($fname);
     // $u_password='123'; 

     $check_parish=mysqli_query($db,"SELECT * FROM parish WHERE parish.p_name='$pname'");
     $check=mysqli_num_rows($check_parish);

     if ($check==0) {
         echo $d_id;
         echo $pname;
         echo $pspatron;
         $insert_parishs=mysqli_query($db,"INSERT INTO parish VALUES(NULL,'$pname','$pspatron','$d_id','active')");
         var_dump($insert_parishs);
     if ($insert_parishs) {

 $insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$logged_id','Inserted $pname as Parish on ',current_timestamp())");
 
var_dump($insert_metric);

           echo "<script>window.location.href='index.php'</script>";
     }else{
         echo "<script>alert('FAILED TO REGISTER PARISH')</script>"; 
     }

     }else{
          echo "<script>alert('PARISH ALLREADY REGISTERED')</script>";
          echo "<script>window.location.href='index.php'</script>";
     }

     

}






 ?>