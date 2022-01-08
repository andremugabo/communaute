<?php
 include'../../includes/db.php';  
session_start();

// echo $logged_id;

if (isset($_POST['enter_children'])) {
	extract($_POST);
	
     $logged_id=$_SESSION['logged']['u_id'];
     $lastname=strtoupper($ch_lname);   
     $firstname=ucfirst($ch_fname);
     $dob=date_create($ch_dob);
     $date=date('Y-m-d');
     $acdate=date_create($date);
     $diff=date_diff($dob,$acdate);
       // echo $diff -> format('%y%');

     $check_child=mysqli_query($db,"SELECT * FROM children WHERE children.ch_lname='$lastname' AND children.ch_fname='$firstname' AND children.ch_bsphone='$ch_bsphone'");
     $check=mysqli_num_rows($check_child);

     if ($check==0) {

           if (($diff -> format('%y%'))>=6) {

               $get_parent_id=mysqli_query($db,"SELECT * FROM bands WHERE bands.bs_phone='$ch_bsphone'");
               while ($get_parent=mysqli_fetch_assoc($get_parent_id)) {
                    $parent_id=$get_parent['bs_id'];
               }

     $insert_children=mysqli_query($db,"INSERT INTO children VALUES(NULL,'$lastname','$firstname','$ch_dob','$parent_id','$ch_bsphone','active')");
     if ($insert_children) {
          $insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$logged_id',' $lastname $firstname Registered on ',current_timestamp())");
          echo "<script>window.location.href='index.php'</script>";
     }
           }else{
               
          echo "<script>alert('TOO YOUNG TO PARTICIPATE IN A CELEBRATION')</script>";
          echo "<script>window.location.href='index.php'</script>";

           }
         
    

     }else{
          echo "<script>alert('CHILDREN ALLREADY REGISTERED')</script>";
          echo "<script>window.location.href='index.php'</script>";
     }

     

}






 ?>