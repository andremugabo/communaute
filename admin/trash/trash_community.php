<?php $msg='Trash'; $msgl='Trash Community';?>
<?php  include('../../includes/header.php') ?>
<div class="innerright">
	<div class="users_title">
		<div class="link_users">
			<ul class="<?php if($msgl=='Community'){echo'pad';} ?> disp">
				<li><a href="#" id='<?php if($msgl=="Trash Community"){echo"active";}?>'>Trash&nbsp;Community</a></li>
				<!-- <li><a href="volunteerss.php" id='<?php if($msg=="Volunteerss"){echo"active";}?>'>Volunteer&nbsp;Supervisors</a></li>
				<li><a href="volunteers.php" id='<?php if($msg=="Volunteers"){echo"active";}?>'>Volunteers</a></li> -->
			</ul>
		</div>	
		<div class="menu">
			<ul>
				<li><button>Menu</button></li>
			</ul>
			<div class="link_users1 "  >
			<ul class="<?php if($msgl=='Trash'){echo'pad';} ?> disp1 " >
				<li><a href="#" id='<?php if($msgl=="Trash Community"){echo"active";}?>'>Trash&nbsp;Community</a></li>
				<!-- <li><a href="volunteerss.php" id='<?php if($msg=="Volunteerss"){echo"active";}?>'>Volunteer&nbsp;Supervisors</a></li>
				<li><a href="volunteers.php" id='<?php if($msg=="Volunteers"){echo"active";}?>'>Volunteers</a></li> -->
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
     $cid=$_GET['d'];
     $update_communities=mysqli_query($db,"UPDATE community SET community.c_status='active' WHERE community.c_id='$cid'");

     if ($update_communities) {
     	$get_updated_communities=mysqli_query($db,"SELECT * FROM community WHERE community.c_id='$cid' ");
     	while ($update_community=mysqli_fetch_assoc($get_updated_communities)) {
     		$community=$update_community['c_name'];
     	}
     	$insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$user_id','Active $community to community  on ',current_timestamp())");
     	echo "<script>alert('ACTIVE $community TO PARISH')</script>";
     	}	
    }
	 ?>
	<!-- <div class="insert_user">
		<button class="open"><img src="../../photo/AddUser.png"></button>
	</div> -->	
	<div class="innerright_table">
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Community</th>
					<th>Parish</th>
					<th>Diocese</th>
					<?php if ($user_role=='MD' || $user_role=='IT') {?>
					<th>Action</th>
					 <?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php 
                $num=0;

                 $display_community=mysqli_query($db,"SELECT community.*,parish.*,diocese.* FROM community JOIN parish ON community.c_pid=parish.p_id JOIN diocese ON community.c_did=diocese.d_id WHERE community.c_status='deleted'");


                while ($row=mysqli_fetch_assoc($display_community)) {
                	$num++;
                	// $names=$row['u_lname']." ".$row['u_fname'];
                	$id=$row['c_id'];
                	echo "<tr>";
                	echo "<td>".$num."</td>";
                	echo "<td>".$row['c_name']."</td>";
                	echo "<td>".$row['p_name']."</td>";
                	echo "<td>".$row['d_name']."</td>"; ?>
                	<?php if ($user_role=='MD' || $user_role=='IT') {?>
                	 <td><button onclick="window.location.href='?d=<?=$id?>'"><img src="../../photo/Ok1.png"></button></td>
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