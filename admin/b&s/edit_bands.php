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
	<div class="insert_user">
		<button class="open"><img src="../../photo/kiko.png"></button>
	</div>	
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

   $display_brother=mysqli_query($db,"SELECT bands.*,community.*,parish.*,diocese.* FROM bands JOIN  community ON bands.bs_cid=community.c_id JOIN parish ON bands.bs_pid=parish.p_id JOIN diocese ON bands.bs_did=diocese.d_id WHERE bands.bs_status='active'");

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

<?php 
if (isset($_GET['d'])) {
$bands_id=$_GET['d'];
$get_brother=mysqli_query($db,"SELECT bands.*,community.*,parish.*,diocese.* FROM bands JOIN  community ON bands.bs_cid=community.c_id JOIN parish ON bands.bs_pid=parish.p_id JOIN diocese ON bands.bs_did=diocese.d_id WHERE bands.bs_id='$bands_id'");
while ($brother_desp=mysqli_fetch_assoc($get_brother)) {
	$brother_id=$brother_desp['bs_id'];
	$diocese_name=$brother_desp['d_name'];
	$parish_name=$brother_desp['p_name'];
	$community_name=$brother_desp['c_name'];
	$bands_lname=$brother_desp['bs_lname'];
	$bands_fname=$brother_desp['bs_fname'];
	$bands_role=$brother_desp['bs_role'];
	$bands_idn=$brother_desp['bs_idnumber'];
	$bands_phone=$brother_desp['bs_phone'];
	$bands_village=$brother_desp['bs_village'];
	$bands_cell=$brother_desp['bs_cell'];
	$bands_sector=$brother_desp['bs_sector'];
	$bands_district=$brother_desp['bs_district'];
}

}
 ?>
<div class="modal" id="to_open" style="display: flex;">
	<div class="modal_dialogue">
		<div class="modal_content" class="bandscontent">
			<div class="modal_header">
				<button  onclick="window.location.href='index.php'">X</button>
			</div>
			<p>Brother&nbsp;And&nbsp;Sisters&nbsp;Edit&nbsp;Form</p>
			<div class="body">
				
				<form action="api_edit_bands.php" method="POST" class="bandsform">
					<table class="bandstable">
					<!-- <label>Community:</label> -->
					<!-- <input type="text" name="p_name" placeholder="Community" required> -->
					<!-- <label>Parish:</label> -->
					<!-- <input type="text" name="p_spatron" placeholder="Saint&nbsp;Patron" required> -->
					<!-- <label>Telephone:</label>
					<input type="number" name="u_phone" placeholder="Telephone" required> -->
					<tr><td><label>Diocese:</label>
					<select required name="bs_did" onchange="getParish(this.value)" required>
						<option disabled selected><?=$diocese_name?></option>
						<?php 
                        $get_diocese=mysqli_query($db,"SELECT * FROM diocese WHERE diocese.d_status='active'");
                        while ($diocese=mysqli_fetch_assoc($get_diocese)) {?>
                        	<option value="<?=$diocese['d_id']?>"><?=$diocese['d_name']?></option>
                       <?php }

						 ?>												
					</select></td>
					<td><label>Parish:</label>
                    <select required name="bs_pid" id="parish" onchange="getCommunity(this.value)" required>
                    <option selected disabled value=" "><?=$parish_name?></option>
                    </select></td>
                    <td><label>Community:</label>
                    <select required name="bs_cid" id="community" required>
                    <option selected disabled value=" " ><?=$community_name?></option>
                    </select></td></tr>
                    <tr><td><label>LastName:</label>
					<input type="text" name="bs_lname" placeholder="LastName" value="<?=$bands_lname?>" required></td>
                    <td><label>FirstName:</label>
					<input type="text" name="bs_fname" placeholder="FirstName" value="<?=$bands_fname?>" required></td>
                    <td><label>Designation:</label>
					<select required name="bs_role" required>
                    <option selected disabled  ><?=$bands_role?></option>
                    <option>COMMUNITY&nbsp;MEMBER</option>
                    <option>PRIEST</option>
                    <option>BROTHER</option>
                    <option>SISTER</option>
                    <option>GUEST</option>
                    </select></td></tr>
                    <tr><td><label>ID&nbsp;NUMBER:</label>
					<input type="text" name="bs_idnumber" placeholder="ID&nbsp;NUMBER" value="<?=$bands_idn?>" required></td>
                    <td> <label>Telephone:</label>
					<input type="text" name="bs_phone" placeholder="Telephone" value="<?=$bands_phone?>" required></td>
                    <td><label>Village:</label>
					<input type="text" name="bs_village" placeholder="Village" value="<?=$bands_village?>" required></td></tr>
                    <tr><td><label>Cell:</label>
					<input type="text" name="bs_cell" placeholder="Cell" value="<?=$bands_cell?>" required></td>
                    <td><label>Sector:</label>
					<input type="text" name="bs_sector" placeholder="Sector" value="<?=$bands_sector?>" required></td>
                    <td><label>District:</label>
					<input type="text" name="bs_district" placeholder="District" value="<?=$bands_district?>" required></td>
					<td style="display: none;"><input type="text" name="bs_id"  value="<?=$brother_id?>" ></td>
				    </tr>

					<tr><td colspan="3"><input type="submit" name="edit_brother" value="EDIT"></td></tr>
					</table>
				</form>
			</div>
			<div class="modal_footer">
				<button onclick="window.location.href='index.php'">Close</button>
			</div>
		</div>
	</div>
</div>
<script src="../../js/direct_brother.js"></script>
<?php  include('../../includes/footer.php') ?>