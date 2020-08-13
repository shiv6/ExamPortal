<?php
	session_start();
	require "connection.php";
	if(!isset($_SESSION['roll']))
		header("location: home.php");
	if(isset($_POST['submit'])){
		$query = "INSERT INTO answers(rollno, a1, a2, a3, a4, a5, a6, a7, a8, a9, a10) values ('".$_SESSION['roll']."'";
		for($i = 1; $i <= 10; $i++){
			if(isset($_POST['radio'.$i]))
				$query = $query.", '".$_POST['radio'.$i]."'";
			else $query = $query.", '0'";
		}
		$query = $query.")";
		mysqli_query($con, $query);
		setcookie('roll','',time()-1000,'/');
	}
	$_SESSION['visited'] = 1;
?>

<html style="overflow-y: auto;">
	<head>
		<title>Examination Portal</title>
		<meta charset="utf-8">
		<link href="home.css" type="text/css" rel="stylesheet"/>
		<link href="customRadio.css" type="text/css" rel="stylesheet"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
		
	</head>
	
	<body>
		<nav class="navbar navbar-expand-sm d-flex justify-content-between bg-dark header">
			<h1 class = "title">Examination Portal</h1>
			<?php echo '<span id="rollno" style="text-align: right;">Logged in as '.$_SESSION['roll'].'<a href="logout.php"><button class="btn btn-primary" style="margin: 5px;">Log out</button></a></span>'; ?>
		</nav>
		
		<div class="container d-flex justify-content-center">
			<div class="col-sm-10 col-md-8 col-lg-6 bg-light shadow-lg" style="margin: 10px; border-radius: 5px;">
				<?php
					$query = "SELECT * FROM questions";
					$result = mysqli_query($con, $query);
					
					$ticks = mysqli_query($con, "SELECT * FROM answers WHERE rollno = '".$_SESSION['roll']."'");
					$answers = mysqli_fetch_array($ticks);
					
					$countC = 0;
					$countI = 0;
					$countU = 0;
					for($i = 1; $i <= 10; $i++){
						$row = mysqli_fetch_array($result);
						if($answers['a'.$i] != 0){ 
							if($answers['a'.$i] == $row['ans'])
								$countC++;
							else $countI++;
						}
						else $countU++;
					}
					$marks = ($countC * 2) - ($countI * 0.5);
					$up_query = "UPDATE student SET marks = '".$marks."' WHERE rollno = '".$_SESSION['roll']."'";
					mysqli_query($con, $up_query);
				?>
				<div class = "row" style="padding: 5px;"> <h2>Your Result</h2></div>
				<div class = "row" style="padding: 7px; vertical-aligh: baseline;">
					<img src="media/yes.png" class="icon">Correct : <?php echo $countC; ?>
				</div>
				<div class = "row" style="padding: 7px; vertical-aligh: baseline;">
					<img src="media/no.png" class="icon">Incorrect : <?php echo $countI; ?>
				</div>
				<div class = "row" style="padding: 7px; vertical-aligh: baseline;">
					<img src="media/ok.png" class="icon">Unattempted : <?php echo $countU; ?>
				</div>
				<div class = "row" style="padding: 7px; vertical-aligh: baseline;">
					<h4>Total Marks: <?php echo $marks; ?> </h4>
				</div>
			</div>
		</div>
		
		<!--<div class="container d-flex justify-content-center">
			<div class="col-sm-10 col-md-8 col-lg-6 bg-light shadow-lg" style="margin: 10px; border-radius: 5px;">
				<?php
					$query = "SELECT * FROM questions";
					$result = mysqli_query($con, $query);
				
					$i = 1;
					while($i <= 10){
							$row = mysqli_fetch_array($result);
							echo "<div class='question-block' id='q$i'>
									<h5 class='disp-ques'";
							if(isset($_POST['radio'.$i])){
								if($_POST['radio'.$i] == $_SESSION['ans'.$i])
									echo " style='background-color: #8f8;'";
								else echo " style='background-color: #f88;'";
							}
							else echo "style='background-color: #ff8;'";
							echo ">Q$i:". $row['ques']."</h5>";
							for($j = 1; $j <= 4; $j++){
								echo "<label class='rad-container'>".$row['op'.$j]."
										<input type='radio' value='".$j."' name='radio$i'";
								if(isset($_POST['radio'.$i]) && $j == $_POST['radio'.$i])
									echo "checked";
								echo " disabled>
										<span class='checkmark'></span>
									</label>";
							}
							$i++;
							echo "</div>";
					}
				?>
			</div>
		</div>-->
		
		<div class="container d-flex justify-content-center">
			<div class="col-sm-10 col-md-8 col-lg-6 bg-light shadow-lg" style="margin: 10px; border-radius: 5px;">
				<?php
					$query = "SELECT * FROM questions";
					$result = mysqli_query($con, $query);
					
					$ticks = mysqli_query($con, "SELECT * FROM answers WHERE rollno = '".$_SESSION['roll']."'");
					$answers = mysqli_fetch_array($ticks);
					
					$i = 1;
					while($i <= 10){
							$row = mysqli_fetch_array($result);
							echo "<div class='question-block' id='q$i'>
									<h5 class='disp-ques'";
									
							if(sizeof($answers) != 0 && $answers['a'.$i] != '0'){
								if($answers['a'.$i] == $row['ans'])
									echo " style='background-color: #8f8;'";
								else echo " style='background-color: #f88;'";
							}
							else echo "style='background-color: #ff8;'";
							echo ">Q$i:". $row['ques']."</h5>";
							for($j = 1; $j <= 4; $j++){
								echo "<label class='rad-container'>".$row['op'.$j]."
										<input type='radio' value='".$j."' disabled>";
								echo "<span class='checkmark'";
								if($j == $row['ans'])
											echo " style='background-color: white; border: 5px #0a0 solid;'";
								if($answers['a'.$i] != 0){
									if($j == $answers['a'.$i])
										echo " style='background-color: white; border: 5px #c00 solid;'";
								}
								echo "></span>
									</label>";
							}
							$i++;
							echo "</div>";
					}
				?>
			</div>
		</div>
		
		<script src="home.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
	</body>
</html>
<style>
	.icon{
		width: 20px;
		height: 20px;
		margin: 5px;
	}
	.rad-container {
	  display: block;
	  position: relative;
	  padding-left: 35px;
	  margin-bottom: 12px;
	  cursor: pointer;
	  -webkit-user-select: none;
	  -moz-user-select: none;
	  -ms-user-select: none;
	  user-select: none;
	}

	.checkmark {
	  position: absolute;
	  top: 0;
	  left: 0;
	  height: 20px;
	  width: 20px;
	  background-color: #eee;
	  border: 1px solid blue;
	  border-radius: 50%;
	}
	.disp-ques{
		padding: 5px;
		margin-top: 5px;
		border-radius: 5px;
	}
</style>