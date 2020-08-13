<html>
	<head>
		<title>Examination Portal</title>
		<meta charset="utf-8">
		<link href="home.css" type="text/css" rel="stylesheet"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
		
	</head>
	
	<body>
		<?php
			$name = $_POST['name'];
			$roll = $_POST['rollno'];
			$email = $_POST['email'];
			$pass = $_POST['password'];
			$course = $_POST['course'];
			$sem = $_POST['sem'];
			$con = mysqli_connect("localhost", "root", "", "examportal");
			$q = "insert into student(name, course, semester, rollno, email, password) values('$name','$course','$sem','$roll','$email','$pass')";
			$r = mysqli_query($con, $q);
			if($r == 1)
				echo "<div class='col-6 justify-content-center'>
					<div class='alert alert-success'>
						Registration Successfull!
					</div>
				</div>";
			else 
				echo "<div class='d-flex justify-content-center'>
					<div class='col-6 alert alert-danger'>
						You are already registered!
					</div>
				</div>";
		?>
	
		<script src="home.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
	</body>
</html>