<?php $msg='Eucharist'; $msgl='Children Details';?>
<?php  include('../../includes/header.php') ?>
<?php 
    if (isset($_GET['del'])) {
    	$participant_id=$_GET['del'];


       $get_ref=mysqli_query($db,"SELECT * FROM eucharistc_details WHERE eucharistc_details.edc_id='$participant_id'");
    	while ($get=mysqli_fetch_assoc($get_ref)) {
    		$reference_p=$get['edc_eref'];
    	}


    	$delete=mysqli_query($db,"DELETE FROM eucharistc_details WHERE eucharistc_details.edc_id='$participant_id'");

    	
    	

    	if ($delete) {
    		$insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$login_user','Participant deleted',current_timestamp())");
                         // echo $logged_id;
          echo "<script>alert('PARTICIPANT DELETED')</script>";
          // echo $reference_p;
          echo "<script>window.location.href='eucharistc_details.php?d=$reference_p'</script>";
    	}else{
    		echo "<script>alert('FAILED TO DELETE PARTICIPANT')</script>";
          echo "<script>window.location.href='eucharistc_details.php?d=$reference_p'</script>";
    	}
    }


	 ?>	
<?php $eref=$_GET['d']; ?>
<div class="innerright">
	<div class="users_title">
		<div class="link_users">
			<ul class="<?php if($msgl=='Eucharist'){echo'pad';} ?> disp">
				<li><a href="eucharist_details.php?d=<?=$eref?>" id='<?php if($msgl=="Eucharist"){echo"active";}?>'>EUCHARIST</a></li>
				<li><a href="#" id='<?php if($msgl=="Children Details"){echo"active";}?>'>Child&nbsp;Details</a></li>
				<!-- <li><a href="volunteers.php" id='<?php if($msg=="Volunteers"){echo"active";}?>'>Volunteers</a></li> -->
			</ul>
		</div>	
		<div class="menu">
			<ul>
				<li><button>Menu</button></li>
			</ul>
			<div class="link_users1 "  >
			<ul class="<?php if($msgl=='Eucharist'){echo'pad';} ?> disp1 " >
				<li><a href="eucharist_details.php?d=<?=$eref?>" id='<?php if($msgl=="Eucharist"){echo"active";}?>'>EUCHARIST</a></li>
				<!-- <li><a href="volunteerss.php" id='<?php if($msg=="Volunteerss"){echo"active";}?>'>Volunteer&nbsp;Supervisors</a></li>
				<li><a href="volunteers.php" id='<?php if($msg=="Volunteers"){echo"active";}?>'>Volunteers</a></li> -->
			</ul>
		</div>
		</div>
		<p><?php echo $msgl; ?></p>
		<div class="link_back">
		<?php  if ($msgl!='Diocese') { ?>
			<button onclick="window.location.href='index.php'">Back</button>
		<?php }	 ?>
		</div>	
	</div>
	<!-- <div class="insert_user">
		<button class="open"><img src="../../photo/add.png"></button>
	</div>	 -->
	<div class="innerright_table">
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Reference</th>
					<th>Names</th>
					<th>Telephone</th>
					<th>Status</th>
					<th>Date</th>
					<?php if ($user_role=='MD' || $user_role=='IT' || $user_role=='SVOL') {?>
					<th>Action</th>
					 <?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php 
                $num=0;
   // $eref=$_GET['d'];
   $display_deucharist=mysqli_query($db,"SELECT eucharistc_details.*,children.*,eucharist.* FROM eucharistc_details  JOIN  children ON eucharistc_details.edc_chid=children.ch_id JOIN eucharist ON eucharistc_details.edc_eref=eucharist.e_ref WHERE eucharistc_details.edc_eref='$eref' ");

                while ($row=mysqli_fetch_assoc($display_deucharist)) {
                	$num++;
                	$names=$row['ch_lname']." ".$row['ch_fname'];
                	$id=$row['edc_id'];
                	echo "<tr>";
                	echo "<td>".$num."</td>";
                	echo "<td>".$row['e_ref']."</td>";
                	echo "<td>".$names."</td>";
                	echo "<td>".$row['edc_bsphone']."</td>";
                	echo "<td>".$row['edc_description']."</td>";
                	echo "<td>".$row['e_date']."</td>"; ?>
                	<?php if ($user_role=='MD' || $user_role=='IT') {?>
                	 <td><button onclick="window.location.href='?del=<?=$id?>'"><img src="../../photo/Delete.png"></button></td>
                	 <?php } ?>

                	 <?php
                	echo "</tr>";
                }
                 




				 ?>
			</tbody>
		</table>
	</div>
</div>
<div class="modal" id="to_open" >
	<div class="modal_dialogue">
		<div class="modal_content" class="bandscontent">
			<div class="modal_header">
				<button class="close">X</button>
			</div>
			<p>Enter&nbsp;Participant</p>
			<div class="body">
				
				<form action="api_participant.php" method="POST" class="bandsform">
					<label>Status:</label>
                    <select required name="ed_description">
                    <option selected disabled value=" ">Choose&nbsp;Status</option>
                    <option>Adult</option>
                    <option>Child</option>
                    </select>					
                    <label>Telephone:</label>
					<input type="text" name="ed_eref" value="<?=$eref?>" placeholder="Telephone" required style='display: none;'>
					<input type="text" name="ed_bsphone"  placeholder="Telephone" required>
                    <!-- <label>Names:</label>
					<input type="text" name="ed_bsid" id="names" placeholder="Names" required>
                    <label>ID&nbsp;Number:</label>
					<input type="text" name="idnumber" id="id" placeholder="ID&nbsp;Number" required> -->
                    
                    <?php 
                    	$check_max=mysqli_query($db,"SELECT * FROM eucharist WHERE eucharist.e_ref='$eref'");
                    			while ($get_eu=mysqli_fetch_assoc($check_max)) {
                    				$number_of_seat=$get_eu['e_numberofseat'];
                    			}

                    $count_eu=mysqli_num_rows(mysqli_query($db,"SELECT * FROM eucharist_details WHERE eucharist_details.ed_eref='$eref'"));
                   $count_euc=mysqli_num_rows(mysqli_query($db,"SELECT * FROM eucharistc_details WHERE eucharistc_details.edc_eref='$eref'"));

                    	$max_number=$count_eu+$count_euc;

                     ?>

                     <?php if ($max_number<$number_of_seat) { ?>                     	             
					<input type="submit" name="verify_participant" value="VERIFY">
					 <?php } ?>
				</form>
			</div>
			<div class="modal_footer">
				<button class="close">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- <script src="../../js/direct_participant.js"></script> -->
<?php  include('../../includes/footer.php') ?>