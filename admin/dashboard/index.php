<?php $msg='Dashboard' ?>
<?php  include('../../includes/header.php') ?>
<!-- =====================
		COUNT USER
 =======================-->
 <?php 
$get_user=mysqli_query($db,"SELECT * FROM users  WHERE users.u_status='active'");
$count_users=mysqli_num_rows($get_user);
 ?>
 <!-- ==================
     END COUNT USER
  ======================-->

<!-- =====================
		COUNT DIOCESE
 =======================-->
 <?php 
$get_diocese=mysqli_query($db,"SELECT * FROM diocese  WHERE diocese.d_status='active'");
$count_diocese=mysqli_num_rows($get_diocese);
 ?>
 <!-- ==================
     END COUNT DIOCESE
  ======================-->


<!-- =====================
		COUNT PARISH
 =======================-->
 <?php 
$get_parish=mysqli_query($db,"SELECT * FROM parish  WHERE parish.p_status='active'");
$count_parish=mysqli_num_rows($get_parish);
 ?>
 <!-- ==================
     END COUNT PARISH
  ======================-->


<!-- =====================
		COUNT B&S
 =======================-->
 <?php 
$get_bands=mysqli_query($db,"SELECT * FROM bands  WHERE bands.bs_status='active'");
$count_bands=mysqli_num_rows($get_bands);
 ?>
 <!-- ==================
     END COUNT B&S
  ======================-->

	<div class="innerright">
		<div class="dashboard">
			<div class="upper_dashboard_info">

				<div class="info_in_upper_dash">
					<div class="dash_title">
						<p>REGISTERED&nbsp;USERS</p>
					</div>
					<div class="dash_info">
						<div class="dash_count">
							<span><?=$count_users?></span>
						</div>
						<div class="dash_image">
							<img src="../../photo/User1.png">
						</div>
					</div>
				</div>


				<div class="info_in_upper_dash">
					<div class="dash_title">
						<p>REGISTERED&nbsp;DIOCESE</p>
					</div>
					<div class="dash_info">
						<div class="dash_count">
							<span><?=$count_diocese?></span>
						</div>
						<div class="dash_image">
							<img src="../../photo/cathedral.png">
						</div>
					</div>
				</div>


				<div class="info_in_upper_dash">
					<div class="dash_title">
						<p>REGISTERED&nbsp;PARISH</p>
					</div>
					<div class="dash_info">
						<div class="dash_count">
							<span><?=$count_parish?></span>
						</div>
						<div class="dash_image">
							<img src="../../photo/parish2.png">
						</div>
					</div>
				</div>


				<div class="info_in_upper_dash">
					<div class="dash_title">
						<p>REGISTERED&nbsp;B&S</p>
					</div>
					<div class="dash_info">
						<div class="dash_count">
							<span><?=$count_bands?></span>
						</div>
						<div class="dash_image">
							<img src="../../photo/people2.png">
						</div>
					</div>
				</div>

			</div>
		</div>	
	</div>
<?php  include('../../includes/footer.php') ?>