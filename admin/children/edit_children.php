<?php $msg='Children'; $msgl='Children';?>
<?php  include('../../includes/header.php') ?>
<div class="innerright">
	<div class="users_title">
		<div class="link_users">
			<ul class="<?php if($msgl=='Children'){echo'pad';} ?> disp">
				<li><a href="#" id='<?php if($msgl=="Children"){echo"active";}?>'>Children</a></li>
				<!-- <li><a href="volunteerss.php" id='<?php if($msg=="Volunteerss"){echo"active";}?>'>Volunteer&nbsp;Supervisors</a></li>
				<li><a href="volunteers.php" id='<?php if($msg=="Volunteers"){echo"active";}?>'>Volunteers</a></li> -->
			</ul>
		</div>	
		<div class="menu">
			<ul>
				<li><button>Menu</button></li>
			</ul>
			<div class="link_users1 "  >
			<ul class="<?php if($msgl=='Children'){echo'pad';} ?> disp1 " >
				<li><a href="#" id='<?php if($msgl=="Children"){echo"active";}?>'>Children</a></li>
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
		<button class="open"><img src="../../photo/Children1.png"></button>
	</div>	
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

                $display_children=mysqli_query($db,"SELECT children.*,bands.* FROM children JOIN bands ON children.ch_bsid=bands.bs_id WHERE children.ch_status='active'");

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
<!-- <?php 
if (isset($_POST['edit_children'])) {
extract($_POST);

$get_parent=mysqli_query($db,"SELECT * FROM bands WHERE bands.bs_id='$ch_bsid'");
  
$update_community=mysqli_query($db,"UPDATE community SET c_name='$c_name',c_pid='$c_pid',c_did='$c_did' WHERE community.c_id='$c_id' ");
if ($update_community) {
		$insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$user_id','Update  information of $c_name  on ',current_timestamp())");
     	// header('location:index.php');
     	echo "<script>alert('UPDATE $c_name INFORMATIONS')</script>";
     	echo "<script>window.location.href='index.php'</script>";
	}	
}
 ?> -->
<?php 
if (isset($_GET['d'])) {

  $id=$_GET['d'];
  $get_children=mysqli_query($db,"SELECT children.*,bands.* FROM children JOIN bands ON children.ch_bsid=bands.bs_id WHERE children.ch_id='$id'");
  while ($getchildren=mysqli_fetch_assoc($get_children)) {
  		$Children_id=$getchildren['ch_id'];
  		$Childrelnname=$getchildren['ch_lname'];
  		$Childrefnname=$getchildren['ch_fname'];
  		$Dob=$getchildren['ch_dob'];
  		$Parentname=$getchildren['bs_lname']." ".$getchildren['bs_fname'];
  		$Parentid=$getchildren['ch_bsid'];
  		$Parentphone=$getchildren['ch_bsphone'];
  		
  	}	
}
 ?>
<div class="modal" id="to_open" style="display:flex;">
	<div class="modal_dialogue">
		<div class="modal_content">
			<div class="modal_header">
				<button onclick="window.location.href='index.php'">X</button>
			</div>
			<p>Children&nbsp;Edit&nbsp;Form</p>
			<div class="body">
				
				<form action="api_edit_children.php" method="POST">
					<label>LastName:</label>
					<input type="text" name="ch_bsid" value="<?=$Parentid?>" style="display: none;">
					<input type="text" name="ch_id" value="<?=$Children_id?>" style="display: none;">
					<input type="text" name="ch_lname" value="<?=$Childrelnname?>" placeholder="LastName" required>
					<label>FirstName:</label>
					<input type="text" name="ch_fname" value="<?=$Childrefnname?>" placeholder="FirstName" required>
					<label>Date&nbsp;Of&nbsp;Birth:</label>
					<input type="date" name="ch_dob" value="<?=$Dob?>" required>
					<label>Telephone:</label>
					<input type="text" name="ch_bsphone" value="<?=$Parentphone?>" placeholder="Telephone" required>

					<input type="submit" name="edit_children" value="EDIT&nbsp;CHILDREN">
					
				</form>
			</div>
			<div class="modal_footer">
				<button onclick="window.location.href='index.php'">Close</button>
			</div>
		</div>
	</div>
</div>
<?php  include('../../includes/footer.php') ?>