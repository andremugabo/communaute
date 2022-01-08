<?php
 include'../../includes/db.php';  
session_start();

// echo $logged_id;

if (isset($_POST['enter_community'])) {
	extract($_POST);
	
     $logged_id=$_SESSION['logged']['u_id'];
     // $cname=strtoupper($c_name); 
     // echo $cname;  
     // echo $c_pid;  
     // echo $c_did;  
     // $firstname=ucfirst($fname);
     // $u_password='123'; 

     $check_community=mysqli_query($db,"SELECT community.*,parish.*,diocese.* FROM community JOIN parish ON community.c_pid=parish.p_id JOIN diocese ON community.c_did=diocese.d_id WHERE community.c_name='$c_name' AND community.c_pid='$c_pid' AND community.c_did='$c_did'");
     // var_dump($check_community);
     $check=mysqli_num_rows($check_community);

     if ($check==0) {
         
         $insert_community=mysqli_query($db,"INSERT INTO community VALUES(NULL,'$c_name','$c_pid','$c_did','active')");
     if ($insert_community) {
          $insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$logged_id','Inserted $c_name as Diocese on ',current_timestamp())");
          echo "<script>window.location.href='index.php'</script>";
     }

     }else{
          echo "<script>alert('COMMUNITY ALLREADY REGISTERED')</script>";
          echo "<script>window.location.href='index.php'</script>";
     }

     

}






 ?>