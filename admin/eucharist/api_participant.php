<?php $msg='Eucharist'; $msgl='Eucharist';?>
<?php  include('../../includes/header.php') ?>

<div class="innerright">
	<div class="users_title">
		<div class="link_users">
			<ul class="<?php if($msgl=='Eucharist'){echo'pad';} ?> disp">
				<li><a href="#" id='<?php if($msgl=="Eucharist"){echo"active";}?>'>EUCHARIST</a></li>
				<!-- <li><a href="volunteerss.php" id='<?php if($msg=="Volunteerss"){echo"active";}?>'>Volunteer&nbsp;Supervisors</a></li>
				<li><a href="volunteers.php" id='<?php if($msg=="Volunteers"){echo"active";}?>'>Volunteers</a></li> -->
			</ul>
		</div>	
		<div class="menu">
			<ul>
				<li><button>Menu</button></li>
			</ul>
			<div class="link_users1 "  >
			<ul class="<?php if($msgl=='Eucharist'){echo'pad';} ?> disp1 " >
				<li><a href="#" id='<?php if($msgl=="Eucharist"){echo"active";}?>'>EUCHARIST</a></li>
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
	<div class="insert_user">
		<button class="open"><img src="../../photo/add.png"></button>
	</div>	
	<div class="innerright_table">
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Reference</th>
					<th>Names</th>
					<th>Telephone</th>
					<th>ID&nbsp;Number</th>
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
   $eref=$_GET['d'];
   $display_deucharist=mysqli_query($db,"SELECT eucharist_details.*,bands.*,eucharist.* FROM eucharist_details  JOIN  bands ON eucharist_details.ed_bsid=bands.bs_id JOIN eucharist ON eucharist_details.ed_eref=eucharist.e_ref WHERE eucharist_details.ed_eref='$eref'");

                while ($row=mysqli_fetch_assoc($display_deucharist)) {
                	$num++;
                	$names=$row['bs_lname']." ".$row['bs_fname'];
                	$id=$row['ed_id'];
                	echo "<tr>";
                	echo "<td>".$num."</td>";
                	echo "<td>".$row['e_ref']."</td>";
                	echo "<td>".$names."</td>";
                	echo "<td>".$row['ed_bsphone']."</td>";
                	echo "<td>".$row['bs_idnumber']."</td>";
                	echo "<td>".$row['ed_description']."</td>";
                	echo "<td>".$row['e_date']."</td>"; ?>
                	<?php if ($user_role=='MD' || $user_role=='IT') {?>
                	 <td><button onclick="window.location.href='edit_parish.php?d=<?=$id?>'"><img src="../../photo/EditUser.png"></button>&nbsp;<button onclick="window.location.href='?d=<?=$id?>'"><img src="../../photo/Delete.png"></button></td>
                	 <?php } ?>

                	 <?php
                	echo "</tr>";
                }
                 




				 ?>
			</tbody>
		</table>
	</div>
</div>
<?php 
if (isset($_POST['verify_participant'])) {
	extract($_POST);
	$getted_status=$ed_description;

	if ($getted_status=='Adult') {

		$get_bands=mysqli_query($db,"SELECT * FROM bands WHERE bands.bs_phone='$ed_bsphone'");
		// var_dump($get_bands);


		if (mysqli_num_rows($get_bands)>0) {
			
			while ($get_participant=mysqli_fetch_assoc($get_bands)) {
		$participant_names=$get_participant['bs_lname']." ".$get_participant['bs_fname'];
		$participant_id=$get_participant['bs_id'];
		$participant_phone=$get_participant['bs_phone'];
		$participant_idnumber=$get_participant['bs_idnumber'];
		// echo $participant_id;

	                                           }?>

    <div class="modal" id="to_open" style="display: flex;" >
	<div class="modal_dialogue">
		<div class="modal_content" class="bandscontent">
			<div class="modal_header">
				<button class="close">X</button>
			</div>
			<p>Enter&nbsp;Participant</p>
			<div class="body">
				
				<form action="api_enter_participant.php" method="POST" class="bandsform">

					<label>Status:<?=$ed_description?></label>
					<input type="text" name="ed_description" value="<?=$ed_description?>" style='display: none;'>
                    <label>Telephone:<?=$ed_bsphone?></label>
					<input type="text" name="ed_bsphone" value="<?=$ed_bsphone?>" style='display: none;'>
					<input type="text" name="ed_eref" value="<?=$ed_eref?>" style='display: none;'>
                    <label>Names:<?=$participant_names?></label>
					<input type="text" name="ed_bsid" value="<?=$participant_id?>" style='display: none;'>
                    <label>ID&nbsp;Number:<?=$participant_idnumber?></label>
                    

					<input type="submit" name="enter_eucharist" value="ENTER">
					
				</form>
			</div>
			<div class="modal_footer">
				<button class="close">Close</button>
			</div>
		</div>
	</div>
</div>


		<?php }else{
			echo "<script>alert('PARTICIPANT NOT REGISTERED')</script>";
          echo "<script>window.location.href='eucharist_details.php?d=$ed_eref'</script>";
		}

	
	}elseif ($getted_status=='Child') {
		
        $get_child=mysqli_query($db,"SELECT * FROM children WHERE children.ch_bsphone='$ed_bsphone'");
		// var_dump($get_child);


		if (mysqli_num_rows($get_child)>0) {
			
			while ($get_children=mysqli_fetch_assoc($get_child)) {
		$child_namesc=$get_children['ch_lname']." ".$get_children['ch_fname'];
		$child_idc=$get_children['ch_id'];
		$child_phonec=$get_children['ch_bsphone'];
		// echo $participant_id;

	                                           }?>

	<div class="modal" id="to_open" style="display: flex;" >
	<div class="modal_dialogue">
		<div class="modal_content" class="bandscontent">
			<div class="modal_header">
				<button class="close">X</button>
			</div>
			<p>Enter&nbsp;Participant</p>
			<div class="body">
				
				<form action="api_enter_participant.php" method="POST" class="bandsform">

					<label>Status:<?=$ed_description?></label>
					<input type="text" name="ed_description" value="<?=$ed_description?>" style='display: none;'>
                    <label>Telephone:<?=$child_phonec?></label>
					<input type="text" name="ed_bsphone" value="<?=$child_phonec?>" style='display: none;'>
					<input type="text" name="ed_eref" value="<?=$ed_eref?>" style='display: none;'>
					<label>Names:</label>
					<select name="ed_chid">
						<option selected disabled >Choose&nbsp;Child</option>
					<?php 

					     $get_childc=mysqli_query($db,"SELECT * FROM children WHERE children.ch_bsphone='$ed_bsphone'");
							while ( $get_child=mysqli_fetch_assoc($get_childc)) { ?>

								<option value="<?=$get_child['ch_id']?>" ><?=$get_child['ch_lname']." ".$get_child['ch_fname']?></option>

								
							<?php }


					 ?>
					 </select>
                   

					<input type="submit" name="enter_child_eucharist" value="ENTER&nbsp;CHILD">
					
				</form>
			</div>
			<div class="modal_footer">
				<button class="close">Close</button>
			</div>
		</div>
	</div>
</div>                                      

		<?php }else{
			echo "<script>alert('CHILD NOT REGISTERED')</script>";
          echo "<script>window.location.href='eucharist_details.php?d=$ed_eref'</script>";
		}

	
	
 }else{
 	echo "<script>alert('FATAL ERROR')</script>";
          echo "<script>window.location.href='eucharist_details.php?d=$ed_eref'</script>";
 }


 ?>

<?php  } ?> 
<?php  include('../../includes/footer.php') ?>