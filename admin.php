<?php
	require("connection.php");
	if(isset($_POST['submit'])){
		$query = "DELETE FROM questions WHERE 1";
		mysqli_query($con, $query);
		for($i = 1; $i <= 10; $i++){
			$query = 'INSERT INTO questions(ques, op1, op2, op3, op4, ans) VALUES("'.$_POST['t'.$i];
				for($j = 1; $j <= 4; $j++)
					$query = $query.'", "'.$_POST['q'.$i.'o'.$j];
				$query = $query.'", "'.$_POST['a'.$i].'")';
			mysqli_query($con, $query);
		}
	}
?>

<html style="overflow-y: auto;">
	<head>
		<title>Examination Portal</title>
		<meta charset="utf-8">
		<link href="home.css" type="text/css" rel="stylesheet"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
		
	</head>
	
	<body>
		<nav class="navbar navbar-expand-sm bg-dark header d-flex justify-content-between">
			<h1 class = "title">Examination Portal</h1>
			<?php echo '<span id="rollno" style="text-align: right;">Administration Login <a href="logout.php"><button class="btn btn-primary" style="margin: 5px;">Log out</button></a></span>'; ?>
		</nav>
		
		<div class="container">
			<div class="col-lg-12">
				<button class="btn btn-primary" id="b1" onclick="showQ()">Question Update</button>
				<button class="btn btn-primary off" id="b2" onclick="showR()">Result</button>
			</div>
			<div class="col-lg-12 bg-light shadow-lg" id="d1" style="margin: 10px; padding: 10px;">
				<form action="admin.php" method="post">
					<?php
						$query = "SELECT * FROM questions";
						$result = mysqli_query($con, $query);
						$i = 1;
						while($row = mysqli_fetch_array($result)){
							echo '<h3 style="text-align:left;">Question '.$i.'</h3>';
							echo '<div class="row d-flex justify-content-center">
									<textarea name="t'.$i.'" row="3" style="width: 90%;">'.$row['ques'].'</textarea>
								</div><br>';
								
							for($j = 1; $j <= 4; $j++){
								echo '<div class="row">
										<div class="col-3" style="text-align:right;">';
											echo 'Option '.$j.': ';
									echo '</div>
										<div class="col-9">';
											echo '<input type="text" name="q'.$i.'o'.$j.'" value="'.$row['op'.$j].'" style="width: 90%;">';
									echo '</div>
									</div>';
							}
							echo '<br><div class="row">
									<div class="col-3" style="text-align:right;">
										Correct Answer: 
									</div>
									<div class="col-9">
										<input type="number" name="a'.$i.'" width="50%" value="'.$row['ans'].'" style="width: 90%;">
									</div>
								</div><br><br>';
							$i++;
						}
					?>
					<input type="submit" value="Update Questions" class="btn btn-primary" name="submit">
				</form>
			</div>
			<div class="col-lg-12 bg-light shadow-lg" id="d2" style="margin: 10px; padding: 10px; display: none;">
				<table width="100%" border="1px" cellpadding="2px">
					<tr>
						<th width="34%">Name</th>
						<th width="33%">Roll No</th>
						<th width="33%">Marks</th>
					</tr>
					<?php
						$query = "SELECT * FROM student";
						$result = mysqli_query($con, $query);
						while($row = mysqli_fetch_array($result)){
							echo '<tr>
									<td>'.$row['name'].'</td>
									<td>'.$row['rollno'].'</td>
									<td>'.$row['marks'].'</td>
								</tr>';
						}
					?>
				</table>
			</div>
		</div>
		
		<script>
			function showQ(){
				var b1 = document.getElementById('b1');
				var b2 = document.getElementById('b2');
				var d1 = document.getElementById('d1');
				var d2 = document.getElementById('d2');
				d2.style.display = "none";
				d1.style.display = "block";
				b2.classList.add("off");
				b1.classList.remove("off");
			}
			function showR(){
				var b1 = document.getElementById('b1');
				var b2 = document.getElementById('b2');
				var d1 = document.getElementById('d1');
				var d2 = document.getElementById('d2');
				d1.style.display = "none";
				d2.style.display = "block";
				b1.classList.add("off");
				b2.classList.remove("off");
			}
		</script>
	</body>
</html>

<style>
	.off{
		background-color: #999;
		border-color: black;
	}
	.off:hover{
		background-color: #aaa;
		border-color: black;
	}
</style>