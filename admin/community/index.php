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
		<?php  if ($msgl!='Community') { ?>
			<button onclick="window.location.href='index.php'">Back</button>
		<?php }	 ?>
		</div>	
	</div>
	<?php 
    if (isset($_GET['d'])) {
     $cid=$_GET['d'];
     $update_communities=mysqli_query($db,"UPDATE community SET community.c_status='deleted' WHERE community.c_id='$cid'");

     if ($update_communities) {
     	$get_updated_community=mysqli_query($db,"SELECT * FROM community WHERE community.c_id='$cid' ");
     	while ($update_community=mysqli_fetch_assoc($get_updated_community)) {
     		$community=$update_community['c_name'];
     	}

     $insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$user_id','Deleted $community from community  on ',current_timestamp())");
     	echo "<script>alert('DELETE $community FROM USERS')</script>";

     	}	
    }
	 ?>
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
                	 <td><button onclick="window.location.href='edit_community.php?d=<?=$id?>'"><img src="../../photo/EditUser.png"></button>&nbsp;<button onclick="window.location.href='?d=<?=$id?>'"><img src="../../photo/Delete.png"></button></td>
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
			<p>Community&nbsp;Registration&nbsp;Form</p>
			<div class="body">
				
				<form action="api_community.php" method="POST">
					<!-- <label>Community:</label> -->
					<!-- <input type="text" name="p_name" placeholder="Community" required> -->
					<!-- <label>Parish:</label> -->
					<!-- <input type="text" name="p_spatron" placeholder="Saint&nbsp;Patron" required> -->
					<!-- <label>Telephone:</label>
					<input type="number" name="u_phone" placeholder="Telephone" required> -->
					<label>Diocese:</label>
					<select required name="c_did" onchange="getParish(this.value)">
						<option disabled selected>Choose&nbsp;Diocese</option>
						<?php 
                        $get_diocese=mysqli_query($db,"SELECT * FROM diocese WHERE diocese.d_status='active'");
                        while ($diocese=mysqli_fetch_assoc($get_diocese)) {?>
                        	<option value="<?=$diocese['d_id']?>"><?=$diocese['d_name']?></option>
                       <?php }

						 ?>												
					</select>
					<label>Parish:</label>
                    <select required name="c_pid" id="parish">
                    <option selected disabled value=" ">Parish</option>
                    </select>
                    <label>Community:</label>
                    <select required name="c_name">
                    <option selected disabled >Choose&nbsp;Community</option>
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
					<input type="submit" name="enter_community" value="REGISTER&nbsp;COMMUNITY">
					
				</form>
			</div>
			<div class="modal_footer">
				<button class="close">Close</button>
			</div>
		</div>
	</div>
</div>
<script src="../../js/direct_choose.js"></script>
<?php  include('../../includes/footer.php') ?>