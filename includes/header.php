<?php session_start(); ?>
<?php include'db.php' ?>
<?php 

$login_user=$_SESSION['logged']['u_id'];
// echo $login_user;

if (isset($login_user)) {
	$users=mysqli_query($db,"SELECT * FROM users WHERE  users.u_id='$login_user'");

while ($row_user=mysqli_fetch_array($users)) {
	$user_id=$row_user['u_id'];
	$user_name=$row_user['u_lname']." ".$row_user['u_fname'];
	$user_role=$row_user['u_role'];
	$User_phone=$row_user['u_phone'];
}
}else{
	header('location:../../');
}



 ?>
 <?php  
if (isset($_GET['logout'])) {
	session_destroy();
	header('location:../../');
}

  ?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$msg?></title>
	<link rel="stylesheet" type="text/css" href="../../css/general.css">
	<meta charset="utf-8" >
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="left">
<div class="left_title">
	<img src="../../photo/logo.png">
	<p>
		<h3>ROMAN-CATHOLIC</h3>
	</p>
</div>
<div class="left_link">
	<ul>
		<li><a href="../../admin/dashboard/index.php" id='<?php if($msg=="Dashboard"){echo"active";}?>'><img src="../../photo/Dashboard1.png">Dashboard</a></li>
		<?php if ($user_role=='MD' || $user_role=='IT') {?>
			<li><a href="../../admin/users/index.php" id='<?php if($msg=="Users"){echo"active";}?>'><img src="../../photo/User12.png">Users</a></li>
		<?php } ?>
		<?php if ($user_role=='MD' || $user_role=='IT' || $user_role=='SVOL') {?>
			<li><a href="../../admin/diocese/index.php"  id='<?php if($msg=="Diocese"){echo"active";}?>'><img src="../../photo/cathedral.png">Diocese</a></li>
		<?php } ?>		
		<?php if ($user_role=='MD' || $user_role=='IT' || $user_role=='SVOL') {?>
			<li><a href="../../admin/parish/index.php" id='<?php if($msg=="Parish"){echo"active";}?>'><img src="../../photo/parish.png">Parish</a></li>
		<?php } ?>
		<?php if ($user_role=='MD' || $user_role=='IT' || $user_role=='SVOL') {?>
			<li><a href="../../admin/community/index.php" id='<?php if($msg=="Community"){echo"active";}?>'><img src="../../photo/kiko.png">Neo&nbsp;Catechumenal&nbsp;Way</a></li>
		<?php } ?>
		<?php if ($user_role=='MD' || $user_role=='IT' || $user_role=='SVOL') {?>
			<li><a href="../../admin/b&s/index.php" id='<?php if($msg=="Brother&nbsp;And&nbsp;Sisters"){echo"active";}?>'><img src="../../photo/people1.png">Brother&Sisters</a></li>
		<?php } ?>
		<?php if ($user_role=='MD' || $user_role=='IT' || $user_role=='SVOL') {?>
			<li><a href="../../admin/children/index.php" id='<?php if($msg=="Children"){echo"active";}?>'><img src="../../photo/Children1.png">Children</a></li>
		<?php } ?>
		<?php if ($user_role=='MD' || $user_role=='IT' || $user_role=='SVOL' || $user_role=='Volunteer') {?>
			<li><a href="../../admin/eucharist/index.php" id='<?php if($msg=="Eucharist"){echo"active";}?>'><img src="../../photo/Euch3.png">Eucharist</a></li>
		<?php } ?>
		<!-- <?php if ($user_role=='MD' || $user_role=='IT' || $user_role=='SVOL') {?>
			<li><a href="../../admin/celebration_word/index.php" id='<?php if($msg=="Celebration Word"){echo"active";}?>'><img src="../../photo/Bible.png">Celebration&nbsp;Word</a></li>
		<?php } ?> -->
		<!-- <?php if ($user_role=='MD' || $user_role=='IT' || $user_role=='SVOL') {?>
			<li><a href="#"><img src="../../photo/meeting.png">Convivence</a></li>
		<?php } ?> -->

		<?php if ($user_role=='MD' || $user_role=='IT' || $user_role=='SVOL') {?>
			<li><a href="../../admin/Report/index.php" id='<?php if($msg=="Report"){echo"active";}?>'><img src="../../photo/Report.png">Report</a></li>
		<?php } ?>

		<?php if ($user_role=='MD' || $user_role=='IT' || $user_role=='SVOL'|| $user_role=='Volunteer') {?>
			<li><a href="../../admin/Setting/index.php" id='<?php if($msg=="Setting"){echo"active";}?>'><img src="../../photo/Settings.png">Setting</a></li>
		<?php } ?>

		<?php if ($user_role=='MD' || $user_role=='IT' || $user_role=='SVOL') {?>
			<li><a href="../../admin/trash/index.php" id='<?php if($msg=="Trash"){echo"active";}?>'><img src="../../photo/Delete.png">Trash</a></li>
		<?php } ?>
		<!--  -->
		
		
	</ul>	
</div>
</div>
<div class="right">
	<div class="right_head">
		<div class="head_img"><img src="../../photo/Back.png" class="img1"><img src="../../photo/Menu.png" class="img2"></div>
		<div class="head_logout">
			<img src="../../photo/pic.png">
			<div class="name"><?=$user_name?></div>
			<div class="log"><a href="?logout=1">Logout</a></div>
		</div>
	</div>
	<div class="right_body">
		
	