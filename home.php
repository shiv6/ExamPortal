<?php
		session_start();
		require "connection.php";
		if(isset($_SESSION['roll']))
			header("location: instructions.php");
		$flag = 0;
		if(isset($_COOKIE['roll'])){
			$_SESSION['roll'] = $_COOKIE['roll'];
			$_SESSION['visited'] = 0;
			$_SESSION['started'] = 1;
			header("location: question.php");
		}
		if(isset($_POST['register'])){
			$name = $_POST['name'];
			$roll = $_POST['rollno'];
			$email = $_POST['email'];
			$pass = $_POST['password'];
			$course = $_POST['course'];
			$sem = $_POST['sem'];
			
			$query='INSERT INTO student(name, course, semester, rollno, email, password) VALUES("'.$name.'","'.$course.'","'.$sem.'","'.$roll.'","'.$email.'","'.$pass.'")';
			if(mysqli_query($con,$query)){
				echo '<script>alert("registeration successful\nLogin for exam.");</script>';
				$flag = 1;
			}else{
				echo '<script>alert("Something went wrong.\nTry again.");</script>';
			}
		}
		if(isset($_POST['login'])){
			$email = $_POST['email'];
			$pass = $_POST['password'];
			
			$query = 'SELECT * FROM student WHERE email = "'.$email.'" AND password = "'.$pass.'"';
			$r = mysqli_query($con, $query);
			$n = 0;
			if($r)
				$n = mysqli_num_rows($r);
			if($n == 0)
				echo '<script>alert("invalid credentials")</script>';
			else{
				$row = mysqli_fetch_array($r);
				$_SESSION['roll'] = $row['rollno'];
				$_SESSION['visited'] = 0;
				$_SESSION['started'] = 0;
				if($row['visited'] == '1'){
					$_SESSION['visited'] = 1;
					header("location: result.php");
				}
				else{
					setcookie('roll', $row['rollno'], time()+600, '/');
					header("location: instructions.php");
				}
			}	
		}
?>
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
			<a href="adminLogin.php"><button class="btn btn-primary">Administration</button></a>
		</nav>
		
		<div class="box d-flex justify-content-center">
		
		<div class="front form-reg col-sm-8 col-md-6 col-lg-4 bg-light shadow-lg">
			<form action="home.php" method="post" onsubmit="return validate()" id = "f1" novalidate>
				<div class="form-group">
					<label for="name">Name:</label>
					<input type="text" name="name" id="nm" class="form-control form-control-sm" required>
					<div class="invalid-feedback">
						Name can not be leaved empty!
					</div>
				
			
					<label for="course">Course:</label>
					<select name="course" onchange="setSemester()" class="form-control form-control-sm">
						<option value="sel">--select--</option>
						<option value="mca">MCA</option>
						<option value="mtech">M.Tech.</option>
						<option value="btech">B.Tech.</option>
					</select>
					<div class="invalid-feedback">
						Please select a course!
					</div>
				
					<label for="sem">Semester:</label>
					<select name="sem" id="semester" class="form-control form-control-sm">
						<option value="sel">--select--</option>
					</select>
				
					<label for="rollno">Roll Number:</label>
					<input type="text" name="rollno" class="form-control form-control-sm" required>
					<div class="invalid-feedback">
						Roll Number can not be leaved empty!
					</div>
				
					<label for="email">Email ID:</label>
					<input type="email" name="email" class="form-control form-control-sm" required>
					<div class="invalid-feedback">
						You must have to enter a valid email!
					</div>
				
					<label for="phone">Password:</label>
					<input type="password" name="password" class="form-control form-control-sm" required>
					<div class="invalid-feedback">
						Password must be 6-20 characters long and must contain atleast one alphabate and one number!
					</div>
				</div>
				<div class="form-group">
					<input type="submit" name="register" class="btn btn-primary" value="Register">
				</div>
			</form>
		</div>
		
		<div class="back form-reg bg-light shadow-lg">
			<form action="home.php" method = "post" class="needs-validation" novalidate>
				<div class="form-group">
					<label for="email">Email ID:</label>
					<input type="email" name="email" class="form-control form-control-sm">
				</div>
				<div class="form-group">
					<label for="phone">Password:</label>
					<input type="password" name="password" class="form-control form-control-sm">
				</div>
				<div class="form-group">
					<input type="submit" name ="login" class="btn btn-primary" value="Login">
				</div>
			</form>
		</div>
		
		</div>
		
		<div class="lower-button d-flex justify-content-center col-md-6 col-lg-4 col-sm-8">
			<div id="login">
				Already Registered !
				<input type="button" value="Login" onclick="getBack()" class="btn btn-primary">
			</div>
			<div id="signup" style="display:none">
				Not Registered !
				<input type="button" value="Register" onclick="getFront()" class="btn btn-primary">
			</div>
		</div>
		
		
		<script src="home.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
	
		<?php
			if(isset($_POST['register'])){
				if($flag == 1)
					echo '<script>getBack();</script>';
			}
		?>
	</body>
</html>