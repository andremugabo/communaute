<?php
 include'../../includes/db.php';  
session_start();

// echo $logged_id;

if (isset($_POST['enter_brother'])) {
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

     if ($check==0) {
         
         $insert_bands=mysqli_query($db,"INSERT INTO bands VALUES(NULL,'$lastname','$firstname','$bs_role','$bs_idnumber','$bs_phone','$bs_cid','$bs_pid','$bs_did','$village','$cell','$sector','$district','active')");
     if ($insert_bands) {
          $insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$logged_id',' $lastname $firstname Registered on ',current_timestamp())");
          echo "<script>window.location.href='index.php'</script>";
     }

     }else{
          echo "<script>alert('ALLREADY REGISTERED')</script>";
          echo "<script>window.location.href='index.php'</script>";
     }

     

}






 ?>