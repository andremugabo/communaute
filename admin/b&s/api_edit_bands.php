<?php
 include'../../includes/db.php';  
session_start();

// echo $logged_id;

if (isset($_POST['edit_brother'])) {
	extract($_POST);
 //     echo $bs_cid;
 //     echo $bs_pid;
	// echo $bs_did;
     $logged_id=$_SESSION['logged']['u_id'];
     $lastname=strtoupper($bs_lname); 
     $firstname=ucfirst($bs_fname);
     $village=ucfirst($bs_village);
     $cell=ucfirst($bs_cell);
     $sector=ucfirst($bs_sector);
     $district=ucfirst($bs_district);
     

     $check_bands=mysqli_query($db,"SELECT * FROM bands WHERE bands.bs_phone='$bs_phone'");
     // var_dump($check_community);
     $check=mysqli_num_rows($check_bands);
// echo $lastname;
     if ($check==1) {
         
         $edit_bands=mysqli_query($db,"UPDATE bands SET bs_lname='$lastname',bs_fname='$firstname',bs_role='$bs_role',bs_idnumber='$bs_idnumber',bs_phone='$bs_phone',bs_cid='$bs_cid',bs_pid='$bs_pid',bs_did='$bs_did',bs_village='$bs_village',bs_cell='$bs_cell',bs_sector='$bs_sector',bs_district='$bs_district' WHERE bands.bs_id='$bs_id'");
         // var_dump($edit_bands);

     if ($edit_bands) {
          $insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$logged_id',' $lastname $firstname Registered on ',current_timestamp())");
          echo "<script>alert('$lastname $firstname INFORMATION UPDATED')</script>";
          echo "<script>window.location.href='index.php'</script>";
     }

     }else{
          echo "<script>alert('PHONE NUMBER ALLREADY REGISTERED')</script>";
          echo "<script>window.location.href='index.php'</script>";
     }

     

}






 ?>