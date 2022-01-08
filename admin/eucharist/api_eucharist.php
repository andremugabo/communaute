<?php
 include'../../includes/db.php';  
session_start();



if (isset($_POST['create_eucharist'])) {
	extract($_POST);
 //     echo $bs_cid;
 //     echo $bs_pid;
	// echo $bs_did;
     $logged_id=$_SESSION['logged']['u_id'];

     $eucharist_num=mysqli_query($db,"SELECT * FROM eucharist ");

     $count=((mysqli_num_rows($eucharist_num))+1);

     $e_ref="Euch/".$count."/".date('Y-m-d');

     if ($count<10000) {
          if ($count<10) {
     $e_ref="Euch/"."0000".$count."/".date('Y-m-d');
               
          }elseif ($count<100) {
     $e_ref="Euch/"."000".$count."/".date('Y-m-d');
               
          }elseif ($count<1000) {
     $e_ref="Euch/"."00".$count."/".date('Y-m-d');
             
          }else{
     $e_ref="Euch/"."0".$count."/".date('Y-m-d');

          }
     }else{
     $e_ref="Euch/".$count."/".date('Y-m-d');
     }
     

     $check_eucharist=mysqli_query($db,"SELECT * FROM eucharist WHERE eucharist.e_ref='$e_ref'");
     // var_dump($check_eucharist);
     $check=mysqli_num_rows($check_eucharist);

     if ($check==0) {
         
         $insert_eucharist=mysqli_query($db,"INSERT INTO eucharist VALUES(NULL,'$e_ref','$logged_id','$e_cid','$e_pid','$e_did','$e_numberofseat',current_timestamp(),'active')");
     if ($insert_eucharist) {
          $insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$logged_id',' Create a Mass with reference number $e_ref',current_timestamp())");
          echo "<script>alert('MASS WITH REFERENCE $e_ref CREATED')</script>";
          echo "<script>window.location.href='index.php'</script>";
     }

     }else{
          echo "<script>alert('MASS ALLREADY CREATED')</script>";
          echo "<script>window.location.href='index.php'</script>";
     }

     

}






 ?>