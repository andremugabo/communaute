<?php $msg='Parish'; $msgl='Parish';?>
<?php  include('../../includes/header.php') ?>
<div class="innerright">
	<div class="users_title">
		<div class="link_users">
			<ul class="<?php if($msgl=='Parish'){echo'pad';} ?> disp">
				<li><a href="#" id='<?php if($msgl=="Parish"){echo"active";}?>'>Parish</a></li>
				<!-- <li><a href="volunteerss.php" id='<?php if($msg=="Volunteerss"){echo"active";}?>'>Volunteer&nbsp;Supervisors</a></li>
				<li><a href="volunteers.php" id='<?php if($msg=="Volunteers"){echo"active";}?>'>Volunteers</a></li> -->
			</ul>
		</div>	
		<div class="menu">
			<ul>
				<li><button>Menu</button></li>
			</ul>
			<div class="link_users1 "  >
			<ul class="<?php if($msgl=='Parish'){echo'pad';} ?> disp1 " >
				<li><a href="#" id='<?php if($msgl=="Parish"){echo"active";}?>'>Parish</a></li>
				<!-- <li><a href="volunteerss.php" id='<?php if($msg=="Volunteerss"){echo"active";}?>'>Volunteer&nbsp;Supervisors</a></li>
				<li><a href="volunteers.php" id='<?php if($msg=="Volunteers"){echo"active";}?>'>Volunteers</a></li> -->
			</ul>
		</div>
		</div>
		<p><?php echo $msgl; ?></p>
		<div class="link_back">
		<?php  if ($msgl!='Parish') { ?>
			<button onclick="window.location.href='index.php'">Back</button>
		<?php }	 ?>
		</div>	
	</div>
	<div class="insert_user">
		<button class="open"><img src="../../photo/parish.png"></button>
	</div>	
	<div class="innerright_table">
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Names</th>
					<!-- <th>Telephone</th>
					<th>Designation</th> -->
					<?php if ($user_role=='MD' || $user_role=='IT') {?>
					<th>Action</th>
					 <?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php 
                $num=0;

                $display_parish=mysqli_query($db,"SELECT parish.*,diocese.* FROM parish JOIN diocese ON parish.p_did=diocese.d_id WHERE parish.p_status='active'");

                while ($row=mysqli_fetch_assoc($display_parish)) {
                	$num++;
                	// $names=$row['u_lname']." ".$row['u_fname'];
                	$id=$row['p_id'];
                	echo "<tr>";
                	echo "<td>".$num."</td>";
                	echo "<td>".$row['p_name']."</td>";
                	echo "<td>".$row['p_spatron']."</td>";
                	echo "<td>".$row['d_name']."</td>"; ?>
                	<?php if ($user_role=='MD' || $user_role=='IT') {?>
                	 <td><button onclick="window.location.href='edit_diocese.php?d=<?=$id?>'"><img src="../../photo/EditUser.png"></button>&nbsp;<button onclick="window.location.href='?d=<?=$id?>'"><img src="../../photo/Delete.png"></button></td>
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
if (isset($_POST['edit_parish'])) {
extract($_POST);
$pname=strtoupper($p_name);   
$update_diocese=mysqli_query($db,"UPDATE parish SET p_name='$p_name',p_spatron='$p_spatron',p_did='$d_id' WHERE parish.p_id='$p_id' ");
if ($update_diocese) {
		$insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$user_id','Update  information of $p_name  on ',current_timestamp())");
     	// header('location:index.php');
     	echo "<script>alert('UPDATE $p_name INFORMATIONS')</script>";
     	echo "<script>window.location.href='index.php'</script>";
	}	
}
 ?>
<?php 
if (isset($_GET['d'])) {

  $id=$_GET['d'];
  $get_parish=mysqli_query($db,"SELECT parish.*,diocese.* FROM parish JOIN diocese ON parish.p_did=diocese.d_id WHERE parish.p_id='$id'");
  while ($getparish=mysqli_fetch_assoc($get_parish)) {
  		$Parish_id=$getparish['p_id'];
  		$Parishname=$getparish['p_name'];
  		$Parishpatron=$getparish['p_spatron'];
  		$Diocesename=$getparish['d_name'];
  		// $Lastname=$getuser['u_lname'];
  		// $Phone=$getuser['u_phone'];
  		// $Role=$getuser['u_role'];
  	}	
}
 ?>
<div class="modal" id="to_open" style="display:flex;">
	<div class="modal_dialogue">
		<div class="modal_content">
			<div class="modal_header">
				<button onclick="window.location.href='index.php'">X</button>
			</div>
			<p>Users&nbsp;Registration&nbsp;Form</p>
			<div class="body">
				
				<form action="" method="POST">
					<input type="text" name="p_id" value="<?=$Parish_id?>" style='display: none;'>
					<label>Parish:</label>
					<input type="text" name="p_name"  value="<?=$Parishname?>" required>
					<label>Saint&nbsp;Patron:</label>
					<input type="text" name="p_spatron" value="<?=$Parishpatron?>" required>
					<!-- <label>Telephone:</label>
					<input type="number" name="u_phone" placeholder="Telephone" required> -->
					<label>Diocese:</label>
					<select required name="d_id">
						<option disabled selected><?=$Diocesename?></option>
						<?php 
                        $get_diocese=mysqli_query($db,"SELECT * FROM diocese WHERE diocese.d_status='active'");
                        while ($diocese=mysqli_fetch_assoc($get_diocese)) {?>
                        	<option value="<?=$diocese['d_id']?>"><?=$diocese['d_name']?></option>
                       <?php }

						 ?>
												
					</select>
					<input type="submit" name="edit_parish" value="EDIT&nbsp;PARISH">
					
				</form>
			</div>
			<div class="modal_footer">
				<button onclick="window.location.href='index.php'">Close</button>
			</div>
		</div>
	</div>
</div>
<?php  include('../../includes/footer.php') ?>