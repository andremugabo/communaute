<?php $msg='Trash'; $msgl='Trash Parish';?>
<?php  include('../../includes/header.php') ?>
<div class="innerright">
	<div class="users_title">
		<div class="link_users">
			<ul class="<?php if($msgl=='Parish'){echo'pad';} ?> disp">
				<li><a href="#" id='<?php if($msgl=="Trash Parish"){echo"active";}?>'>Trash&nbsp;Parish</a></li>
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
				<li><a href="#" id='<?php if($msgl=="Trash Parish"){echo"active";}?>'>Trash&nbsp;Parish</a></li>
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
     $pid=$_GET['d'];
     $update_parishs=mysqli_query($db,"UPDATE parish SET parish.p_status='active' WHERE parish.p_id='$pid'");

     if ($update_parishs) {
     	$get_updated_parishs=mysqli_query($db,"SELECT * FROM parish WHERE parish.p_id='$pid' ");
     	while ($update_parish=mysqli_fetch_assoc($get_updated_parishs)) {
     		$parish=$update_parish['p_name'];
     	}
     	$insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$user_id','Active $parish to parish  on ',current_timestamp())");
     	echo "<script>alert('ACTIVE $parish TO PARISH')</script>";
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
					<th>Parish</th>
					<th>Saint&nbsp;Patron</th>
					<th>Diocese</th>
					<?php if ($user_role=='MD' || $user_role=='IT') {?>
					<th>Action</th>
					 <?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php 
                $num=0;

                $display_parish=mysqli_query($db,"SELECT parish.*,diocese.* FROM parish JOIN diocese ON parish.p_did=diocese.d_id WHERE parish.p_status='deleted'");

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