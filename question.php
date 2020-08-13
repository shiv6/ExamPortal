<?php
	session_start();
	require "connection.php";
	if(!isset($_SESSION['roll']))
		header("location: home.php");
	if($_SESSION['visited'] == 1)
		header("location: result.php");
	$t = time();
	if($_SESSION['started'] == 0){
		$query = "UPDATE student SET visited = '1', starts_at = '".$t."' WHERE rollno = '".$_SESSION['roll']."'";
		mysqli_query($con, $query);
		$_SESSION['started'] = 1;
	}
	$q = "SELECT starts_at FROM student WHERE rollno = '".$_SESSION['roll']."'";
	$res = mysqli_query($con, $q);
	$tm = mysqli_fetch_array($res);
?>

<html lang = "en">
	<head>
		<title>Questions</title>
		<meta charset="utf-8">
		<link href="question.css" type="text/css" rel="stylesheet"/>
		<link href="customRadio.css" type="text/css" rel="stylesheet"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	</head>
	<body onload="timer(<?php echo $tm['starts_at'];?>)">
		<nav class="navbar navbar-expand-sm d-flex justify-content-between bg-dark header">
			<h1 class = "title">Examination Portal</h1>
			<?php echo '<span id="rollno" style="text-align: right;">Logged in as '.$_SESSION['roll'].'<button class="btn btn-primary" style="margin: 5px;" onclick="conf()">Log out</button></span>'; ?>
		</nav>
		
		<div class="container">
			<div class="row">
				<div class="col top-ins bg-light shadow-lg" id="timer">
					Timer
				</div>
			</div>
		</div>
		
		<div class="container">
			<div class="top-ins row">
				<div class="question-button unatempted"></div>
				<div class="question-label">Unseen Questions</div>
				<div class="question-button atempted"></div>
				<div class="question-label">Atempted Questions</div>
				<div class="question-button skipped"></div>
				<div class="question-label">Skipped Questions</div>
			</div>
		</div>
		
		<div class="container">
			<form action="result.php" method="post">
			<div class="row justify-content-between">
				<div class="col-3 top-ins bg-light shadow-lg">
				<div class="row">
					<?php
						$i = 2;
						echo "<div class='question-button skipped current-question' id='1' onclick='changeQuestion(this)'> 1 </div>";
						while($i <= 10){
							echo "<div class='question-button unatempted' id='$i' onclick='changeQuestion(this)'> $i </div>";
							$i++;
						}
					?>
				</div>
				</div>
				<div class="col-8 top-ins bg-light shadow-lg">
					<div class="ques-container" id="ques-ans">
					<?php
						$query = "SELECT * FROM questions";
						$result = mysqli_query($con, $query);
						$row = mysqli_fetch_array($result);
						echo "<div class='question-block' style='display:block;' id='q1'>
									<h5 id='q1'>Q1: ".$row['ques']."</h5>
									<label class='rad-container'>".$row['op1']."
										<input type='radio' value='1' name='radio1' onclick='markat(1)'>
										<span class='checkmark'></span>
									</label>
									<label class='rad-container'>".$row['op2']."
										<input type='radio' value='2' name='radio1' onclick='markat(1)'>
										<span class='checkmark'></span>
									</label>
									<label class='rad-container'>".$row['op3']."
										<input type='radio' value='3' name='radio1' onclick='markat(1)'>
										<span class='checkmark'></span>
									</label>
									<label class='rad-container'>".$row['op4']."
										<input type='radio' value='4' name='radio1' onclick='markat(1)'>
										<span class='checkmark'></span>
									</label>
								</div>";
						$_SESSION['ans1'] = $row['ans'];
						$i = 2;
						while($i <= 10){
							$row = mysqli_fetch_array($result);
							echo "<div class='question-block' id='q$i'>
									<h5 id='q$i'>Q$i:". $row['ques']."</h5>
									<label class='rad-container'>".$row['op1']."
										<input type='radio' value='1' name='radio$i' onclick='markat($i)'>
										<span class='checkmark'></span>
									</label>
									<label class='rad-container'>".$row['op2']."
										<input type='radio' value='2' name='radio$i' onclick='markat($i)'>
										<span class='checkmark'></span>
									</label>
									<label class='rad-container'>".$row['op3']."
										<input type='radio' value='3' name='radio$i' onclick='markat($i)'>
										<span class='checkmark'></span>
									</label>
									<label class='rad-container'>".$row['op4']."
										<input type='radio' value='4' name='radio$i' onclick='markat($i)'>
										<span class='checkmark'></span>
									</label>
								</div>";
							$i++;
						}
					?>
					</div>
					<div class="row justify-content-between">
						<div class="col">
							<button type="button" class="btn btn-primary" onclick="getPrev()">Prev</button><span id="detector" style="display:none;">q1</span>
						</div>
						<div class="col" style="text-align: right;">
							<button type="button" class="btn btn-primary" onclick="getNext()">Next</button>
						</div>
					
					</div>
				</div>
			</div>
			
			<div class="row top-ins justify-content-center">
				<button type="submit" name="submit" class="btn btn-primary" id="done">Submit</button>
			</div>
			</form>
			
		</div>
		
		<!--<div class="modal fade" id="confirmation-modal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="Modal-header">
						<h2 class="modal-title">Recheck your answers please</h2>
						<button type="button" class="close" data-dismiss="modal">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body" id="conf-modal-body">
						abc
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Submit</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal">Correction</button>
					</div>
				</div>
			</div>
		</div>-->
		
		<script src="question.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
	</body>
</html>