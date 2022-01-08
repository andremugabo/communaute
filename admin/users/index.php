<?php $msg='Users'; $msgl='Users';?>
<?php  include('../../includes/header.php') ?>
<div class="innerright">
	<div class="users_title">
		<div class="link_users">
			<ul class="<?php if($msgl=='Users'){echo'pad';} ?> disp">
				<li><a href="#" id='<?php if($msgl=="Users"){echo"active";}?>'>Users</a></li>
				<li><a href="volunteerss.php" id='<?php if($msg=="Volunteerss"){echo"active";}?>'>Volunteer&nbsp;Supervisors</a></li>
				<li><a href="volunteers.php" id='<?php if($msg=="Volunteers"){echo"active";}?>'>Volunteers</a></li>
			</ul>
		</div>	
		<div class="menu">
			<ul>
				<li><button>Menu</button></li>
			</ul>
			<div class="link_users1 "  >
			<ul class="<?php if($msgl=='Users'){echo'pad';} ?> disp1 " >
				<li><a href="#" id='<?php if($msgl=="Users"){echo"active";}?>'>Users</a></li>
				<li><a href="volunteerss.php" id='<?php if($msg=="Volunteerss"){echo"active";}?>'>Volunteer&nbsp;Supervisors</a></li>
				<li><a href="volunteers.php" id='<?php if($msg=="Volunteers"){echo"active";}?>'>Volunteers</a></li>
			</ul>
		</div>
		</div>
		<p><?php echo $msgl; ?></p>
		<div class="link_back">
		<?php  if ($msgl!='Users') { ?>
			<button>Back</button>
		<?php }	 ?>
		</div>	
	</div>
	<?php 
    if (isset($_GET['d'])) {
     $uid=$_GET['d'];
     $update_users=mysqli_query($db,"UPDATE users SET users.u_status='deleted' WHERE users.u_id='$uid'");

     if ($update_users) {
     	$get_updated_users=mysqli_query($db,"SELECT * FROM users WHERE users.u_id='$uid' ");
     	while ($update_user=mysqli_fetch_assoc($get_updated_users)) {
     		$user=$update_user['u_lname']." ".$update_user['u_fname'];
     	}
     	$insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$user_id','Deleted $user from users  on ',current_timestamp())");
     	echo "<script>alert('DELETE $user FROM USERS')</script>";
     	}	
    }
	 ?>
	<div class="insert_user">
		<button class="open"><img src="../../photo/AddUser.png"></button>
	</div>	
	<div class="innerright_table">
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Names</th>
					<th>Telephone</th>
					<th>Designation</th>
					<?php if ($user_role=='MD' || $user_role=='IT') {?>
					<th>Action</th>
					 <?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php 
                $num=0;

                $display_users=mysqli_query($db,"SELECT * FROM users WHERE users.u_status='active'");

                while ($row=mysqli_fetch_assoc($display_users)) {
                	$num++;
                	$names=$row['u_lname']." ".$row['u_fname'];
                	$id=$row['u_id'];
                	echo "<tr>";
                	echo "<td>".$num."</td>";
                	echo "<td>".$names."</td>";
                	echo "<td>".$row['u_phone']."</td>";
                	echo "<td>".$row['u_role']."</td>"; ?>
                	<?php if ($user_role=='MD' || $user_role=='IT') {?>
                	 <td><button onclick="window.location.href='edit_users.php?d=<?=$id?>'"><img src="../../photo/EditUser.png"></button>&nbsp;<button onclick="window.location.href='?d=<?=$id?>'"><img src="../../photo/Delete.png"></button></td>
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
			<p>Users&nbsp;Registration&nbsp;Form</p>
			<div class="body">
				
				<form action="api_users.php" method="POST">
					<label>LastName:</label>
					<input type="text" name="lname" placeholder="LastName" required>
					<label>FirstName:</label>
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
					</select>
					<input type="submit" name="enter_user" value="REGISTER&nbsp;USER">
					
				</form>
			</div>
			<div class="modal_footer">
				<button class="close">Close</button>
			</div>
		</div>
	</div>
</div>
<?php  include('../../includes/footer.php') ?>