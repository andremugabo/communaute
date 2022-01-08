<?php
 include'../../includes/db.php';  
session_start();



if (isset($_POST['enter_eucharist'])) {
	extract($_POST);
 
     $logged_id=$_SESSION['logged']['u_id'];
     // echo $logged_id;

     $check_participant=mysqli_query($db,"SELECT * FROM eucharist_details WHERE eucharist_details.ed_bsphone='$ed_bsphone' AND eucharist_details.ed_eref='$ed_eref'");
     // var_dump($check_participant);

     if (mysqli_num_rows($check_participant)==0) {

                    $insert_participant=mysqli_query($db,"INSERT INTO eucharist_details VALUES(NULL,'$ed_eref','$ed_bsphone','$ed_bsid','$ed_description',current_timestamp())");
                    // echo $ed_eref;
                    // echo $ed_bsphone;
                    // var_dump($insert_participant);
                    // echo $ed_bsid;
                    
                    // echo $ed_description;
                    
                    mysqli_error($db);
                    if ($insert_participant) {
                         $insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$logged_id','Participant With $ed_bsphone Phone Number Registered ',current_timestamp())");
                         // echo $logged_id;
          echo "<script>alert('PARTICIPANT WITH $ed_bsphone PHONE NUMBER REGISTERED')</script>";
          echo "<script>window.location.href='eucharist_details.php?d=$ed_eref'</script>";
                    }
          
     }else{
          echo "<script>alert('ALLREADY REGISTERED')</script>";
          echo "<script>window.location.href='eucharist_details.php?d=$ed_eref'</script>";
     }

    

}

if (isset($_POST['enter_child_eucharist'])) {
     extract($_POST);
 
     $loggedc_id=$_SESSION['logged']['u_id'];

     $check_child=mysqli_query($db,"SELECT * FROM eucharistc_details WHERE eucharistc_details.edc_bsphone='$ed_bsphone' AND eucharistc_details.edc_chid='$ed_chid' AND eucharistc_details.edc_eref='$ed_eref'");

     if (mysqli_num_rows($check_child)==0) {

                    $insert_child=mysqli_query($db,"INSERT INTO eucharistc_details VALUES(NULL,'$ed_eref','$ed_bsphone','$ed_chid','$ed_description',current_timestamp())");
                    if ($insert_child) {
                         $insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$loggedc_id','Child With Parent Phone Number  $ed_bsphone   Registered ',current_timestamp())");
          echo "<script>alert('CHILD WITH PARENT PHONE NUMBER  $ed_bsphone  REGISTERED')</script>";
          echo "<script>window.location.href='eucharist_details.php?d=$ed_eref'</script>";
                    }
          
     }else{
          echo "<script>alert('ALLREADY REGISTERED')</script>";
          echo "<script>window.location.href='eucharist_details.php?d=$ed_eref'</script>";
     }

    

}





 ?>