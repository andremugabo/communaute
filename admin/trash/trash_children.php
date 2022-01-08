<?php $msg='Trash'; $msgl='Trash Children';?>
<?php  include('../../includes/header.php') ?>
<div class="innerright">
	<div class="users_title">
		<div class="link_users">
			<ul class="<?php if($msgl=='Trash Children'){echo'pad';} ?> disp">
				<li><a href="#" id='<?php if($msgl=="Trash Children"){echo"active";}?>'>Trash&nbsp;Children</a></li>
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
				<li><a href="#" id='<?php if($msgl=="Trash Children"){echo"active";}?>'>Trash&nbsp;Children</a></li>
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
     $chid=$_GET['d'];
     $update_children=mysqli_query($db,"UPDATE children SET children.ch_status='active' WHERE children.ch_id='$chid'");

     if ($update_children) {
     	$get_updated_children=mysqli_query($db,"SELECT * FROM children WHERE children.ch_id='$chid' ");
     	while ($update_child=mysqli_fetch_assoc($get_updated_children)) {
     		$children=$update_child['ch_lname']." ".$update_child['ch_fname'];
     	}
     	$insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$user_id','Active $children to children  on ',current_timestamp())");
     	echo "<script>alert('ACTIVE $children TO CHILDREN LIST')</script>";
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
					<th>Names</th>
					<th>Date&nbsp;Of&nbsp;Birth</th>
					<th>Parent&nbsp;Names</th>
					<th>Parent&nbsp;Phone</th>
					<?php if ($user_role=='MD' || $user_role=='IT') {?>
					<th>Action</th>
					 <?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php 
                $num=0;

                $display_children=mysqli_query($db,"SELECT children.*,bands.* FROM children JOIN bands ON children.ch_bsid=bands.bs_id WHERE children.ch_status='deleted'");

                while ($row=mysqli_fetch_assoc($display_children)) {
                	$num++;
                	$names=$row['ch_lname']." ".$row['ch_fname'];
                	$namesp=$row['bs_lname']." ".$row['bs_fname'];
                	$id=$row['ch_id'];
                	echo "<tr>";
                	echo "<td>".$num."</td>";
                	echo "<td>".$names."</td>";
                	echo "<td>".$row['ch_dob']."</td>";
                	echo "<td>".$namesp."</td>";
                	echo "<td>".$row['ch_bsphone']."</td>"; ?>
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