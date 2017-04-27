<!DOCTYPE html>
<html>
<head>
	<title>Hackaton Gfi</title>
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script src="/dist/build/app.bundle.js"></script>
	
	<link rel="stylesheet" type="text/css" href="/dist/build/app.bundle.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
</head>
<body>
	<?php if(isset($_SESSION['id_user'])){ ?>
		<a href='/index/logout'>deconnexion</a>
	<?php } ?>
	<?php include $this->v;?>
	
</body>
</html>
