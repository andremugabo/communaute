<?php $msg='Users'; $msgl='Volunteers';?>
<?php  include('../../includes/header.php') ?>
<div class="innerright">
	<div class="users_title">
		<div class="link_users">
			<ul class="<?php if($msgl=='Users'){echo'pad';} ?> disp">
				<li><a href="index.php" id='<?php if($msgl=="Users"){echo"active";}?>'>Users</a></li>
				<li><a href="volunteerss.php" id='<?php if($msg=="Volunteers_Supervisors"){echo"active";}?>'>Volunteer&nbsp;Supervisors</a></li>
				<li><a href="#" id='<?php if($msgl=="Volunteers"){echo"active";}?>'>Volunteers</a></li>
			</ul>
		</div>	
		<div class="menu">
			<ul>
				<li><button>Menu</button></li>
			</ul>
			<div class="link_users1 "  >
			<ul class="<?php if($msgl=='Users'){echo'pad';} ?> disp1 " >
				<li><a href="index.php" id='<?php if($msgl=="Users"){echo"active";}?>'>Users</a></li>
				<li><a href="volunteerss.php" id='<?php if($msg=="Volunteers_Supervisors"){echo"active";}?>'>Volunteer&nbsp;Supervisors</a></li>
				<li><a href="#" id='<?php if($msgl=="Volunteers"){echo"active";}?>'>Volunteers</a></li>
			</ul>
		</div>
		</div>
		<p><?php echo $msgl; ?></p>
		<div class="link_back">
		<?php  if ($msgl!='Users') { ?>
			<button onclick="window.location.href='index.php'">Back</button>
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

                $display_users=mysqli_query($db,"SELECT * FROM users WHERE users.u_status='active' AND users.u_role='Volunteer'");

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
<?php  include('../../includes/footer.php') ?>