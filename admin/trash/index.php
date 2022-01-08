<?php $msg='Trash'; $msgl='Users';?>
<link rel="stylesheet" type="text/css" href="../../css/trash.css">
<?php  include('../../includes/header.php') ?>
<div class="trash_inner">
	<a href='trash_users.php' class="trash_disp">
		<div class="trash_left">
			<p><h1>Users</h1></p>
			<span>
					<?php 
					$count_deleted_user=mysqli_query($db,"SELECT * FROM users WHERE users.u_status='deleted'");
                    $count=mysqli_num_rows($count_deleted_user); 
                    echo $count;
				    ?>			 	
			 </span>
			<p><h4>Trash</h4></p>
		</div>
		<div class="trash_right">
			<img src="../../photo/pic.png">
		</div>
	</a>
	<a href='trash_diocese.php' class="trash_disp">
		<div class="trash_left">
			<p><h1>Diocese</h1></p>
			<span>
					<?php 
					$count_deleted_diocese=mysqli_query($db,"SELECT * FROM diocese WHERE diocese.d_status='deleted'");
                    $count=mysqli_num_rows($count_deleted_diocese); 
                    echo $count;
				    ?>			 	
			 </span>
			<p><h4>Trash</h4></p>
		</div>
		<div class="trash_right">
			<img src="../../photo/cathedral.png">
		</div>
	</a>
	<a href='trash_parish.php' class="trash_disp">
		<div class="trash_left">
			<p><h1>Parish</h1></p>
			<span>
					<?php 
					$count_deleted_parish=mysqli_query($db,"SELECT * FROM parish WHERE parish.p_status='deleted'");
                    $count=mysqli_num_rows($count_deleted_parish); 
                    echo $count;
				    ?>			 	
			 </span>
			<p><h4>Trash</h4></p>
		</div>
		<div class="trash_right">
			<img src="../../photo/parish.png">
		</div>
	</a>
	<a href='trash_bands.php' class="trash_disp">
		<div class="trash_left">
			<p><h3 style="color: black;">Brother&nbsp;And</h3><h4>Sister</h4></p>
			<span>
					<?php 
					$count_deleted_bands=mysqli_query($db,"SELECT * FROM bands WHERE bands.bs_status='deleted'");
                    $count=mysqli_num_rows($count_deleted_bands); 
                    echo $count;
				    ?>			 	
			 </span>
			<p><h4>Trash</h4></p>
		</div>
		<div class="trash_right">
			<img src="../../photo/people1.png">
		</div>
	</a>

	<a href='trash_community.php' class="trash_disp">
		<div class="trash_left">
			<p ><h3 style="color: black;">Neo&nbsp;Catechumenal</h3><h4>Way</h4></p>
			<span>
					<?php 
					$count_deleted_community=mysqli_query($db,"SELECT * FROM community WHERE community.c_status='deleted'");
                    $count=mysqli_num_rows($count_deleted_community); 
                    echo $count;
				    ?>			 	
			 </span>
			<p><h4>Trash</h4></p>
		</div>
		<div class="trash_right">
			<img src="../../photo/kiko.png">
		</div>
	</a>

	<a href='trash_children.php' class="trash_disp">
		<div class="trash_left">
			<p ><h1>Children</h1></p>
			<span>
					<?php 
					$count_deleted_children=mysqli_query($db,"SELECT * FROM children WHERE children.ch_status='deleted'");
                    $count=mysqli_num_rows($count_deleted_children); 
                    echo $count;
				    ?>			 	
			 </span>
			<p><h4>Trash</h4></p>
		</div>
		<div class="trash_right">
			<img src="../../photo/Children1.png">
		</div>
	</a>	
</div>
<?php  include('../../includes/footer.php') ?>
