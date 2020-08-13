
<html>
	<head>
		<title>Examination Portal</title>
		<meta charset="utf-8">
		<link href="home.css" type="text/css" rel="stylesheet"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
		
	</head>
	
	<body>
		<nav class="navbar navbar-expand-sm bg-dark header d-flex justify-content-between">
			<h1 class = "title">Examination Portal</h1>
			<?php echo '<span id="rollno" style="text-align: right;">Administration Login <a href="home.php"><button class="btn btn-primary" style="margin: 5px;">Home</button></a></span>'; ?>
		</nav>
		
		<div class="container d-flex justify-content-center">
		<div class="col-lg-6 col-md-8 col-sm-10 col-xs-12 myDiv bg-light shadow-lg">
			<form action="adminLogin.php" method="post">
			<div class="form-group">
				<label for="password">Enter Admin Password: </label>
				<input type="password" name="aPass" class="form-control form-control-sm">
				<div id="msg" class="Invalid-feedBack">
					Invalid Password!
				</div>
			</div>
			<div class="form-group">
				<input type="submit" name="aSubmit" class="form-controls btn btn-primary">
			</div>
			</form>
		</div>
		</div>
		
	</body>
</html>
<?php
	require("connection.php");
	if(isset($_POST['aSubmit'])){
		if($_POST['aPass'] != 'khulJaSimSim')
			echo '<script>
					document.getElementsByName("aPass")[0].classList.add("is-invalid");
				</script>';
		else
			header("location: admin.php");
	}
?>

<style>
	.myDiv{
		margin: 10px;
		padding: 10px;
		border-radius: 5px;
	}
</style>