<?php $msg='Eucharist'; $msgl='Eucharist';?>
<?php  include('../../includes/header.php') ?>

<div class="innerright">
	<div class="users_title">
		<div class="link_users">
			<ul class="<?php if($msgl=='Eucharist'){echo'pad';} ?> disp">
				<li><a href="#" id='<?php if($msgl=="Eucharist"){echo"active";}?>'>EUCHARIST</a></li>
				<!-- <li><a href="volunteerss.php" id='<?php if($msg=="Volunteerss"){echo"active";}?>'>Volunteer&nbsp;Supervisors</a></li>
				<li><a href="volunteers.php" id='<?php if($msg=="Volunteers"){echo"active";}?>'>Volunteers</a></li> -->
			</ul>
		</div>	
		<div class="menu">
			<ul>
				<li><button>Menu</button></li>
			</ul>
			<div class="link_users1 "  >
			<ul class="<?php if($msgl=='Eucharist'){echo'pad';} ?> disp1 " >
				<li><a href="#" id='<?php if($msgl=="Eucharist"){echo"active";}?>'>EUCHARIST</a></li>
				<!-- <li><a href="volunteerss.php" id='<?php if($msg=="Volunteerss"){echo"active";}?>'>Volunteer&nbsp;Supervisors</a></li>
				<li><a href="volunteers.php" id='<?php if($msg=="Volunteers"){echo"active";}?>'>Volunteers</a></li> -->
			</ul>
		</div>
		</div>
		<p><?php echo $msgl; ?></p>
		<div class="link_back">
		<?php  if ($msgl!='Eucharist') { ?>
			<button onclick="window.location.href='index.php'">Back</button>
		<?php }	 ?>
		</div>	
	</div>
	<div class="insert_user">
		<?php if ($user_role=='MD' || $user_role=='IT' || $user_role=='SVOL') {?>
		<button class="open"><img src="../../photo/Euch3.png"></button>
		 <?php } ?>
	</div>	
	<div class="innerright_table">
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Reference</th>
					<!-- <th>Created&nbsp;BY</th> -->
					<th>Community</th>
					<th>Parish</th>
					<th>Diocese</th>
					<th>Averable&nbsp;Places</th>
					<th>Created&nbsp;On</th>
					<?php if ($user_role=='MD' || $user_role=='IT' || $user_role=='SVOL' || $user_role=='Volunteer') {?>
					<th>Action</th>
					 <?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php 
                $num=0;
                $date=date('Y-m-d');

   $display_brother=mysqli_query($db,"SELECT eucharist.*,users.*,community.*,parish.*,diocese.* FROM eucharist JOIN users ON eucharist.e_uid=users.u_id  JOIN  community ON eucharist.e_cid=community.c_id JOIN parish ON eucharist.e_pid=parish.p_id JOIN diocese ON eucharist.e_did=diocese.d_id WHERE eucharist.e_status='active' AND eucharist.e_date='$date'");

                while ($row=mysqli_fetch_assoc($display_brother)) {
                	$num++;
                	$names=$row['u_lname']." ".$row['u_fname'];
                	$ref=$row['e_ref'];
                	echo "<tr>";
                	echo "<td>".$num."</td>";
                	echo "<td>".$row['e_ref']."</td>";
                	// echo "<td>".$names."</td>";
                	echo "<td>".$row['c_name']."</td>";
                	echo "<td>".$row['p_name']."</td>";
                	echo "<td>".$row['d_name']."</td>";
                	echo "<td>".$row['e_numberofseat']."</td>";
                	echo "<td>".$row['e_date']."</td>"; ?>
                	<?php if ($user_role=='MD' || $user_role=='IT' || $user_role=='SVOL' || $user_role=='Volunteer') {?>
                	 <td><button onclick="window.location.href='eucharist_details.php?d=<?=$ref?>'"><img src="../../photo/add.png"></button></td>
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
			<p>Create&nbsp;A&nbsp;Eucharistic&nbsp;Celebration</p>
			<div class="body">
				
				<form action="api_eucharist.php" method="POST" class="bandsform">
					<label>Diocese:</label>
					<select required name="e_did" onchange="getParish(this.value)">
						<option disabled selected>Choose&nbsp;Diocese</option>
						<?php 
                        $get_diocese=mysqli_query($db,"SELECT * FROM diocese WHERE diocese.d_status='active'");
                        while ($diocese=mysqli_fetch_assoc($get_diocese)) {?>
                        	<option value="<?=$diocese['d_id']?>"><?=$diocese['d_name']?></option>
                       <?php }

						 ?>												
					</select>
					<label>Parish:</label>
                    <select required name="e_pid" id="parish" onchange="getCommunity(this.value)">
                    <option selected disabled value=" ">Parish</option>
                    </select>
                    <label>Community:</label>
                    <select required name="e_cid" id="community">
                    <option selected disabled value=" " >Choose&nbsp;Community</option>
                    </select>
                    <label>Available&nbsp;Places:</label>
					<input type="text" name="e_numberofseat" placeholder="Available&nbsp;Places" required>
                    

					<input type="submit" name="create_eucharist" value="CREATE">
					
				</form>
			</div>
			<div class="modal_footer">
				<button class="close">Close</button>
			</div>
		</div>
	</div>
</div>
<script src="../../js/direct_eucharist.js"></script>
<?php  include('../../includes/footer.php') ?>