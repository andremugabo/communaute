<?php $msg='Brother&nbsp;And&nbsp;Sisters'; $msgl='B&S';?>
<?php  include('../../includes/header.php') ?>
<link rel="stylesheet" type="text/css" href="../../css/bands.css">
<div class="innerright">
	<div class="users_title">
		<div class="link_users">
			<ul class="<?php if($msgl=='B&S'){echo'pad';} ?> disp">
				<li><a href="#" id='<?php if($msgl=="B&S"){echo"active";}?>'>B&S</a></li>
				<!-- <li><a href="volunteerss.php" id='<?php if($msg=="Volunteerss"){echo"active";}?>'>Volunteer&nbsp;Supervisors</a></li>
				<li><a href="volunteers.php" id='<?php if($msg=="Volunteers"){echo"active";}?>'>Volunteers</a></li> -->
			</ul>
		</div>	
		<div class="menu">
			<ul>
				<li><button>Menu</button></li>
			</ul>
			<div class="link_users1 "  >
			<ul class="<?php if($msgl=='B&S'){echo'pad';} ?> disp1 " >
				<li><a href="#" id='<?php if($msgl=="B&S"){echo"active";}?>'>B&S</a></li>
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
     $bsid=$_GET['d'];
     $update_brothers=mysqli_query($db,"UPDATE bands SET bands.bs_status='active' WHERE bands.bs_id='$bsid'");

     if ($update_brothers) {
     	$get_updated_brother=mysqli_query($db,"SELECT * FROM bands WHERE bands.bs_id='$bsid' ");
     	while ($update_brother=mysqli_fetch_assoc($get_updated_brother)) {
     		$brother=$update_brother['bs_lname']." ".$update_brother['bs_fname'];
     	}

     $insert_metric=mysqli_query($db,"INSERT INTO metric VALUES(NULL,'$user_id','Active $brother to List of Brothers  on ',current_timestamp())");
     	echo "<script>alert('ACTIVE $brother TO LIST OF BROTHERS')</script>";

     	}	
    }
	 ?>
	<!-- <div class="insert_user">
		<button class="open"><img src="../../photo/kiko.png"></button>
	</div>	 -->
	<div class="innerright_table">
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Names</th>
					<th>Community</th>
					<th>Parish</th>
					<th>Diocese</th>
					<th>Telephone</th>
					<?php if ($user_role=='MD' || $user_role=='IT') {?>
					<th>Action</th>
					 <?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php 
                $num=0;

   $display_brother=mysqli_query($db,"SELECT bands.*,community.*,parish.*,diocese.* FROM bands JOIN  community ON bands.bs_cid=community.c_id JOIN parish ON bands.bs_pid=parish.p_id JOIN diocese ON bands.bs_did=diocese.d_id WHERE bands.bs_status='deleted'");

                while ($row=mysqli_fetch_assoc($display_brother)) {
                	$num++;
                	$names=$row['bs_lname']." ".$row['bs_fname'];
                	$id=$row['bs_id'];
                	echo "<tr>";
                	echo "<td>".$num."</td>";
                	echo "<td>".$names."</td>";
                	echo "<td>".$row['c_name']."</td>";
                	echo "<td>".$row['p_name']."</td>";
                	echo "<td>".$row['d_name']."</td>";
                	echo "<td>".$row['bs_phone']."</td>"; ?>
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
<div class="modal" id="to_open" >
	<div class="modal_dialogue">
		<div class="modal_content" class="bandscontent">
			<div class="modal_header">
				<button class="close">X</button>
			</div>
			<p>Brother&nbsp;And&nbsp;Sisters&nbsp;Registration&nbsp;Form</p>
			<div class="body">
				
				<form action="api_bands.php" method="POST" class="bandsform">
					<table class="bandstable">
					<!-- <label>Community:</label> -->
					<!-- <input type="text" name="p_name" placeholder="Community" required> -->
					<!-- <label>Parish:</label> -->
					<!-- <input type="text" name="p_spatron" placeholder="Saint&nbsp;Patron" required> -->
					<!-- <label>Telephone:</label>
					<input type="number" name="u_phone" placeholder="Telephone" required> -->
					<tr><td><label>Diocese:</label>
					<select required name="bs_did" onchange="getParish(this.value)">
						<option disabled selected>Choose&nbsp;Diocese</option>
						<?php 
                        $get_diocese=mysqli_query($db,"SELECT * FROM diocese WHERE diocese.d_status='active'");
                        while ($diocese=mysqli_fetch_assoc($get_diocese)) {?>
                        	<option value="<?=$diocese['d_id']?>"><?=$diocese['d_name']?></option>
                       <?php }

						 ?>												
					</select></td>
					<td><label>Parish:</label>
                    <select required name="bs_pid" id="parish" onchange="getCommunity(this.value)">
                    <option selected disabled value=" ">Parish</option>
                    </select></td>
                    <td><label>Community:</label>
                    <select required name="bs_cid" id="community">
                    <option selected disabled value=" " >Choose&nbsp;Community</option>
                    </select></td></tr>
                    <tr><td><label>LastName:</label>
					<input type="text" name="bs_lname" placeholder="LastName" required></td>
                    <td><label>FirstName:</label>
					<input type="text" name="bs_fname" placeholder="FirstName" required></td>
                    <td><label>Designation:</label>
					<select required name="bs_role">
                    <option selected disabled >Choose&nbsp;Designation</option>
                    <option>COMMUNITY&nbsp;MEMBER</option>
                    <option>PRIEST</option>
                    <option>BROTHER</option>
                    <option>SISTER</option>
                    <option>GUEST</option>
                    </select></td></tr>
                    <tr><td><label>ID&nbsp;NUMBER:</label>
					<input type="text" name="bs_idnumber" placeholder="ID&nbsp;NUMBER" required></td>
                    <td> <label>Telephone:</label>
					<input type="text" name="bs_phone" placeholder="Telephone" required></td>
                    <td><label>Village:</label>
					<input type="text" name="bs_village" placeholder="Village" required></td></tr>
                    <tr><td><label>Cell:</label>
					<input type="text" name="bs_cell" placeholder="Cell" required></td>
                    <td><label>Sector:</label>
					<input type="text" name="bs_sector" placeholder="Sector" required></td>
                    <td><label>District:</label>
					<input type="text" name="bs_district" placeholder="District" required></td></tr>

					<tr><td colspan="3"><input type="submit" name="enter_brother" value="REGISTER"></td></tr>
					</table>
				</form>
			</div>
			<div class="modal_footer">
				<button class="close">Close</button>
			</div>
		</div>
	</div>
</div>
<script src="../../js/direct_brother.js"></script>
<?php  include('../../includes/footer.php') ?>