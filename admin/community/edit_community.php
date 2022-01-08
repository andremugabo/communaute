<?php $msg='Community'; $msgl='Community';?>
<?php  include('../../includes/header.php') ?>
<div class="innerright">
	<div class="users_title">
		<div class="link_users">
			<ul class="<?php if($msgl=='Community'){echo'pad';} ?> disp">
				<li><a href="#" id='<?php if($msgl=="Community"){echo"active";}?>'>Community</a></li>
				<!-- <li><a href="volunteerss.php" id='<?php if($msg=="Volunteerss"){echo"active";}?>'>Volunteer&nbsp;Supervisors</a></li>
				<li><a href="volunteers.php" id='<?php if($msg=="Volunteers"){echo"active";}?>'>Volunteers</a></li> -->
			</ul>
		</div>	
		<div class="menu">
			<ul>
				<li><button>Menu</button></li>
			</ul>
			<div class="link_users1 "  >
			<ul class="<?php if($msgl=='Community'){echo'pad';} ?> disp1 " >
				<li><a href="#" id='<?php if($msgl=="Community"){echo"active";}?>'>Community</a></li>
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
		<button class="open"><img src="../../photo/kiko.png"></button>
	</div>	
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

                $display_community=mysqli_query($db,"SELECT community.*,parish.*,diocese.* FROM community JOIN parish ON community.c_pid=parish.p_id JOIN diocese ON community.c_did=diocese.d_id WHERE community.c_status='active'");

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
if (isset($_POST['edit_community'])) {
extract($_POST);
// $cname=strtoupper($c_name);   
$update_community=mysqli_query($db,"UPDATE community SET c_name='$c_name',c_pid='$c_pid',c_did='$c_did' WHERE community.c_id='$c_id' ");
if ($update_community) {
		$insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$user_id','Update  information of $c_name  on ',current_timestamp())");
     	// header('location:index.php');
     	echo "<script>alert('UPDATE $c_name INFORMATIONS')</script>";
     	echo "<script>window.location.href='index.php'</script>";
	}	
}
 ?>
<?php 
if (isset($_GET['d'])) {

  $id=$_GET['d'];
  $get_community=mysqli_query($db,"SELECT community.*,parish.*,diocese.* FROM community JOIN parish ON community.c_pid=parish.p_id JOIN diocese ON community.c_did=diocese.d_id WHERE community.c_id='$id'");
  while ($getcommunity=mysqli_fetch_assoc($get_community)) {
  		$Community_id=$getcommunity['c_id'];
  		$Diocesename=$getcommunity['d_name'];
  		$Communityname=$getcommunity['c_name'];
  		$Parishname=$getcommunity['p_name'];
  		
  	}	
}
 ?>
<div class="modal" id="to_open" style="display:flex;">
	<div class="modal_dialogue">
		<div class="modal_content">
			<div class="modal_header">
				<button onclick="window.location.href='index.php'">X</button>
			</div>
			<p>Community&nbsp;Edit&nbsp;Form</p>
			<div class="body">
				
				<form action="" method="POST">
					<!-- <label>Community:</label> -->
					<!-- <input type="text" name="p_name" placeholder="Community" required> -->
					<!-- <label>Parish:</label> -->
					<!-- <input type="text" name="p_spatron" placeholder="Saint&nbsp;Patron" required> -->
					<!-- <label>Telephone:</label>
					<input type="number" name="u_phone" placeholder="Telephone" required> -->
					<label>Diocese:</label>
					<select required name="c_did"  onchange="getParish(this.value)">
						<option disabled selected><?=$Diocesename?></option>
						<?php 
                        $get_diocese=mysqli_query($db,"SELECT * FROM diocese WHERE diocese.d_status='active'");
                        while ($diocese=mysqli_fetch_assoc($get_diocese)) {?>
                        	<option value="<?=$diocese['d_id']?>"><?=$diocese['d_name']?></option>
                       <?php }

						 ?>												
					</select>
					<input type="text" name="c_id" value="<?=$Community_id?>" style='display: none;'>
					<label>Parish:</label>
                    <select required name="c_pid" id="parish">
                    <option selected disabled value=" "><?=$Parishname?></option>
                    </select>
                    <label>Community:</label>
                    <select required name="c_name">
                    <option selected disabled ><?=$Communityname?></option>
                    <option>1st&nbsp;COMMUNITY</option>
                    <option>2nd&nbsp;COMMUNITY</option>
                    <option>3rd&nbsp;COMMUNITY</option>
                    <option>4th&nbsp;COMMUNITY</option>
                    <option>5th&nbsp;COMMUNITY</option>
                    <option>6th&nbsp;COMMUNITY</option>
                    <option>7th&nbsp;COMMUNITY</option>
                    <option>8th&nbsp;COMMUNITY</option>
                    <option>9th&nbsp;COMMUNITY</option>
                    <option>10th&nbsp;COMMUNITY</option>
                    <option>11th&nbsp;COMMUNITY</option>
                    <option>12th&nbsp;COMMUNITY</option>
                    <option>13th&nbsp;COMMUNITY</option>
                    <option>GUEST</option>
                    </select>
					<input type="submit" name="edit_community" value="EDIT&nbsp;COMMUNITY">
					
				</form>
			</div>
			<div class="modal_footer">
				<button onclick="window.location.href='index.php'">Close</button>
			</div>
		</div>
	</div>
</div>
<script src="../../js/direct_choose.js"></script>
<?php  include('../../includes/footer.php') ?>