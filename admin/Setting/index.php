<?php $msg='Setting'; $msgl='Setting';?>
<?php  include('../../includes/header.php') ?>
<div class="innerright">
	<div class="setting">
		<form action="api_update_password.php" method="POST">
			<div class="update_pass">
				<h1>UPDATE YOUR PASSWORD</h1>
			</div>
			<div class="setting_label_input">
				<label>Current Username</label>
				<input type="text" name="" value="<?=$User_phone?>">
			</div>

			<div class="setting_label_input">
				<label>Current Password</label>
				<input type="text" name="u_password" placeholder="ENTER CURRENT PASSWORD" required>
			</div>

			<div class="setting_label_input">
				<label>New Password</label>
				<input type="password" name="nu_password" placeholder="ENTER NEW PASSWORD" required>
			</div>

			<div class="setting_label_input">
				<label>Confirm New Password</label>
				<input type="password" name="cnu_password" placeholder="CONFIRM NEW PASSWORD" required>
			</div>

			<div class="submit">
				<input type="submit" name="update_password" value="UPDATE PASSWORD">
			</div>

		</form>
	</div>
</div>
<?php  include('../../includes/footer.php') ?>
