<?php $msg='Diocese'; $msgl='Diocese';?>
<?php  include('../../includes/header.php') ?>
<div class="innerright">
	<div class="users_title">
		<div class="link_users">
			<ul class="<?php if($msgl=='Diocese'){echo'pad';} ?> disp">
				<li><a href="#" id='<?php if($msgl=="Diocese"){echo"active";}?>'>Diocese</a></li>
				<!-- <li><a href="volunteerss.php" id='<?php if($msg=="Volunteerss"){echo"active";}?>'>Volunteer&nbsp;Supervisors</a></li>
				<li><a href="volunteers.php" id='<?php if($msg=="Volunteers"){echo"active";}?>'>Volunteers</a></li> -->
			</ul>
		</div>	
		<div class="menu">
			<ul>
				<li><button>Menu</button></li>
			</ul>
			<div class="link_users1 "  >
			<ul class="<?php if($msgl=='Diocese'){echo'pad';} ?> disp1 " >
				<li><a href="#" id='<?php if($msgl=="Diocese"){echo"active";}?>'>Diocese</a></li>
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
	<?php 
    if (isset($_GET['d'])) {
     $did=$_GET['d'];
     $update_diocese=mysqli_query($db,"UPDATE diocese SET diocese.d_status='deleted' WHERE diocese.d_id='$did'");

     if ($update_diocese) {
     	$get_updated_diocese=mysqli_query($db,"SELECT * FROM diocese WHERE diocese.d_id='$did' ");
     	while ($update_diocese=mysqli_fetch_assoc($get_updated_diocese)) {
     		$diocese=$update_diocese['d_name'];
     	}
     	$insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$user_id','Deleted $diocese from diocese  on ',current_timestamp())");
     	echo "<script>alert('DELETE $diocese FROM USERS')</script>";
     	}	
    }
	 ?>
	<div class="insert_user">
		<button class="open"><img src="../../photo/cathedral.png"></button>
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

                $display_diocese=mysqli_query($db,"SELECT * FROM diocese WHERE diocese.d_status='active'");

                while ($row=mysqli_fetch_assoc($display_diocese)) {
                	$num++;
                	// $names=$row['u_lname']." ".$row['u_fname'];
                	$id=$row['d_id'];
                	echo "<tr>";
                	echo "<td>".$num."</td>";
                	// echo "<td>".$names."</td>";
                	echo "<td>".$row['d_name']."</td>";
                	//echo "<td>".$row['u_role']."</td>"; ?>
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
<div class="modal" id="to_open">
	<div class="modal_dialogue">
		<div class="modal_content">
			<div class="modal_header">
				<button class="close">X</button>
			</div>
			<p>Diocese&nbsp;Registration&nbsp;Form</p>
			<div class="body">
				
				<form action="api_diocese.php" method="POST">
					<label>Diocese:</label>
					<input type="text" name="d_name" placeholder="Diocese" required>
					<!-- <label>FirstName:</label>
					<input type="text" name="fname" placeholder="FirstName" required>
					<label>Telephone:</label>
					<input type="number" name="u_phone" placeholder="Telephone" required>
					<label>Designation:</label>
					<select required name="u_role">
						<option disabled selected>Choose&nbsp;Designation</option>
						<option>IT</option>
						<option>MD</option>
						<option>Volunteer&nbsp;Supervisor</option>
						<option>Volunteer</option>
					</select> -->
					<input type="submit" name="enter_diocese" value="REGISTER&nbsp;DIOCESE">
					
				</form>
			</div>
			<div class="modal_footer">
				<button class="close">Close</button>
			</div>
		</div>
	</div>
</div>
<?php  include('../../includes/footer.php') ?>