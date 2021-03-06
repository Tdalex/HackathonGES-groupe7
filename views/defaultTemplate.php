<!DOCTYPE html>
<html>
<head>
	<title>Hackaton Gfi</title>
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

	<link rel="stylesheet" type="text/css" href="/dist/build/app.bundle.css">
	<script src="/src/js/script.js"></script>
	<!--<script src="/dist/build/js/app.bundle.js"></script>-->
	<link rel="stylesheet" type="text/css" href="/dist/build/css/app.bundle.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
</head>
<body>
	<?php if(isset($_SESSION['id_user'])){ ?>
		<form action='/index/logout' method='POST'>
			<button type='submit' class="btn gfi-btn gfi-btn-second home-btn" style="float: right; margin-bottom: 20px; margin-right: 15px;">
			  <span class="gfi-btn-span firstspan">Deconnexion</span>
			  <span class="gfi-btn-span secondspan">Deconnexion</span>
			</button>
		</form>
	<?php } ?>
	<?php include $this->v;?>

</body>
</html>
