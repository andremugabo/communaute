<!DOCTYPE html>
<html>
<head>
	<title>REGISTRATION</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<meta charset="utf-8" >
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="info_form">
	
	<div class="info">
		<img src="photo/logo.png">
		<p>
		<h1>ROMAN-CATHOLIC</h1>
		<h2>KIGALI-DIOCESE</h2>
		</p>
	</div>
	<div class="form_in">
	<div class="screen">
		<img src="photo/logo.png">
		<p>
		<h5>ROMAN-CATHOLIC</h5>
		<h6>KIGALI-DIOCESE</h6>
		</p>
	</div>
		<span>LOGIN</span>
		<form class="topm" action="includes/account.php?action=login" method="POST">
			
			<div class="label_input">
				<label><img src="photo/user1.png"></label>
				<input type="text" name="username" placeholder="TELEPHONE">
			</div>
			<div class="label_input">
				<label><img src="photo/password.png"></label>
				<input type="password" name="password" placeholder="PASSWORD">
			</div>
			<div class="label_input topm">				
				<input type="submit" name="login" value="LOGIN">
			</div>
		</form>
	</div>
</div>
</body>
</html>