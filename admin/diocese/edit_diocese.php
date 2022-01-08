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
<?php 
if (isset($_POST['edit_diocese'])) {
extract($_POST);
$dname=strtoupper($d_name);   
$update_diocese=mysqli_query($db,"UPDATE diocese SET d_name='$d_name' WHERE diocese.d_id='$d_id' ");
if ($update_diocese) {
		$insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$user_id','Update  information of $d_name  on ',current_timestamp())");
     	// header('location:index.php');
     	echo "<script>alert('UPDATE $d_name INFORMATIONS')</script>";
     	echo "<script>window.location.href='index.php'</script>";
	}	
}
 ?>
<?php 
if (isset($_GET['d'])) {

  $id=$_GET['d'];
  $get_diocese=mysqli_query($db,"SELECT * FROM diocese WHERE diocese.d_id='$id'");
  while ($getdiocese=mysqli_fetch_assoc($get_diocese)) {
  		$Diocese_id=$getdiocese['d_id'];
  		$Diocesename=$getdiocese['d_name'];
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
					<input type="text" name="d_id" value="<?=$Diocese_id?>" style='display: none;'>
					<label>Diocese:</label>
					<input type="text" name="d_name" placeholder="Diocese" value="<?=$Diocesename?>" required>
					<!-- <label>FirstName:</label>
					<input type="text" name="fname" placeholder="FirstName" value="<?=$Firstname?>" required>
					<label>Telephone:</label>
					<input type="number" name="u_phone" placeholder="Telephone"  value="<?=$Phone?>" required>
					<label>Designation:</label>
					<select required name="u_role">
						<option disabled selected><?=$Role?></option>
						<option>IT</option>
						<option>MD</option>
						<option>Volunteer Supervisor</option>
						<option>Volunteer</option>
					</select> -->
					<input type="submit" name="edit_diocese" value="EDIT&nbsp;DIOCESE">
					
				</form>
			</div>
			<div class="modal_footer">
				<button onclick="window.location.href='index.php'">Close</button>
			</div>
		</div>
	</div>
</div>
<?php  include('../../includes/footer.php') ?>