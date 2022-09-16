<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPE</title>
		<link rel="icon" href="/Student eval/img/logo1.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link type="text/css" href="/Student eval/css/materialize.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" href="/Student eval/css/style.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <script type="text/javascript" src="/Student eval/js/materialize.min.js"></script>
    <script  src="/Student eval/js/ui.js"></script>
    <link rel="manifest" href="/Student eval/manifest.json">

    <link rel="apple-touch-icon" href="/Student eval/img/icons/icon-96x96.png">
    <meta name="app-mobile-web-app-status-bar" content="#aa7700">
    <meta name="theme-color" content="#FF8816">

    <style>
      @media screen and (min-width: 300px){
        .Cboc{
        width: 96%;
        height: 96%;
        margin:auto;
        }

      }
			.card-panel.recipe1{
          border-radius: 8px;
          padding: 10px;
          box-shadow: 0px 1px 3px rgba(90,90,90,0.1);
          display: grid;
          grid-template-columns: 2fr;
          grid-template-rows: 2fr;
          grid-template-areas: "image details delete";
          
        }
      </style>
</head>
<script>
		document.addEventListener('DOMContentLoaded', function() {
    var elems2 = document.querySelectorAll('.collapsible');
    var instances = M.Collapsible.init(elems2);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('.collapsible').collapsible();
  });
</script>

<?php

error_reporting(0);
ini_set('display_errors', 0);

session_start();
include '../db_con.php';
$con = mysqli_connect('localhost','root','',"spe_website");
// If the session variable is empty, this
// means the user is yet to login
// User will be sent to 'login.php' page
// to allow the user to login
if (!isset($_SESSION['user_name'])) {
	$_SESSION['msg'] = "You have to log in first";
	header('location: /Student eval/index.php');
}

// Logout button will destroy the session, and
// will unset the session variables
// User will be headed to 'login.php'
// after logging out
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user_name']);
	header("location: /Student eval/index.php");
}

if (isset($_POST["sub_quiz"])) {

	$conn = OpenCon();
	$ass_id = $_SESSION['get_id'];
	$mark = 0;
	$mis = 0;
	$stud_id = $_SESSION['user_id'];
    
	$sql = "SELECT ans_opt FROM quiz_question WHERE f_ass_id = '$ass_id' AND que_no = '1'";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result)){
		$ans = $row['ans_opt'];	

	}
	if($ans == $_POST['1q']){
		$mark = $mark + 1;
	}else{
		$mis = $mis +1;
	}
	$sql = "SELECT ans_opt FROM quiz_question WHERE f_ass_id = '$ass_id' AND que_no = '2'";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result)){
		$ans = $row['ans_opt'];	
	}
	if($ans == $_POST['2q']){
		$mark = $mark + 1;
	}else{
		$mis = $mis +1;
	}
	$sql = "SELECT ans_opt FROM quiz_question WHERE f_ass_id = '$ass_id' AND que_no = '3'";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result)){
		$ans = $row['ans_opt'];	
	}
	if($ans == $_POST['3q']){
		$mark = $mark + 1;
	}else{
		$mis = $mis +1;
	}
	$sql = "SELECT ans_opt FROM quiz_question WHERE f_ass_id = '$ass_id' AND que_no = '4'";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result)){
		$ans = $row['ans_opt'];	
	}
	if($ans == $_POST['4q']){
		$mark = $mark + 1;
	}else{
		$mis = $mis +1;
	}
	$sql = "SELECT ans_opt FROM quiz_question WHERE f_ass_id = '$ass_id' AND que_no = '5'";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result)){
		$ans = $row['ans_opt'];	
	}
	if($ans == $_POST['5q']){
		$mark = $mark + 1;
	}else{
		$mis = $mis +1;
	}

	$sql = "INSERT INTO history ( f_user_id, f_ass_id, score, mistakes) VALUES ('$stud_id', '$ass_id', '$mark', '$mis')";
	if ($conn->query($sql) == TRUE) {
		echo '<script>
		window.alert("Congrats your score is '.$mark.' ");
		</script>';
		$sql = "UPDATE student_get_quiz SET ans_status = 'Already Answered' WHERE fass_id = '$ass_id'";
		$result = mysqli_query($conn, $sql);
		echo '<script> window.location.href="/Student eval/page/quiz.php" </script>';

	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	}
	

?>

<body class="grey lighten-4">

  <!-- top nav -->
  <nav class="z-depth-0">
    <div class="nav-wrapper container">
      <a href="/Student eval/page/home.php">Student<span>Performance</span>Evaluator</a>
			

      <span class="right grey-text text-darken-1">
       
      </span>
    </div>
  </nav>

<!-- side nav -->
<ul id="side-menu" class="sidenav side-menu">
    <li><a class="subheader">Student Performance Evaluator</a></li>
    <li><a href="/Student eval/page/home.php" class="waves-effect" disabled>Home</a></li>
		<li><div class="divider"></div></li>
		<li><a href="/Student eval/page/account.php" class="waves-effect">Account</a></li>
    <li><div class="divider"></div></li>
    <li><a href="/Student eval/page/subject.php" class="waves-effect">Subject</a></li>
    <li><div class="divider"></div></li>
    <li><a href="/Student eval/page/quiz.php" class="waves-effect">Quiz/Activities/Assignments</a></li>
    <li><div class="divider"></div></li>
		<li><a href="/Student eval/page/result.php" class="waves-effect">Result List</a></li>
    <li><div class="divider"></div></li>
    <li><a href="evaluator.html" class="waves-effect">Performance Evaluator</a></li>
    <li><div class="divider"></div></li>
		<li style="padding: 0 32px;">
		<?php  if (isset($_SESSION['user_name'])) { ?>
      <div class="chip" >
				<?php echo $_SESSION["user_name"]; echo $_SESSION["user_id"];  ?>	
			</div>
			<div class="chip" name="logout" >
				<a href="/Student eval/index.php">logout</a>
			</div>
			<?php } ?>
		</li>
		


  </ul>
	<form action = "quiz_5.php" method= "POST">
  <div class="recipes container grey-text text-darken-1">
		<div class="card-panel recipe1 white row">
			
			<h3> <?php 
					$ass_n = $_SESSION['ass_name1'];
					echo $ass_n; ?> </h3>
			<br>
			<div>
		</div>
				

			<ul class="collapsible">
				<li>
					<div class="collapsible-header"><i class="material-icons">quiz</i>1st Question</div>
					<div class="collapsible-body"><span>
					<?php

							$ass_id = $_SESSION['get_id'];

							$conn = OpenCon();
							$sql = "SELECT que_id, que_title FROM quiz_question WHERE f_ass_id = '$ass_id' AND que_no = '1'";
							$result = mysqli_query($conn, $sql);
							while($row = mysqli_fetch_array($result)){
								$q_id = $row['que_id'];
								$q_title = $row['que_title'];
								echo "<b>1.) $q_title</b><br>";
							}
					?>
					<select class='dropdown-trigger btn' name="1q"> 
       			<option selected disabled> Choose the correct Answer</option>
						 <?php
							$get_opt= "select * from q_option WHERE qque_id = '$q_id' "; 
								$run_opt=mysqli_query($conn, $get_opt); 
								While ($row_cats=mysqli_fetch_array($run_opt)){ 
										$opt_id=$row_cats['opt_position']; 
										$opt_title=$row_cats['opt_title']; 
										Echo "<option value='$opt_id'>$opt_title</option>"; 
								}
						?> 
					</select>
						
					
							
					</span></div>
				</li>
				<li>
					<div class="collapsible-header"><i class="material-icons">quiz</i>2nd Question</div>
					<div class="collapsible-body"><span>
					<?php

						$ass_id = $_SESSION['get_id'];

						$conn = OpenCon();
						$sql = "SELECT que_id, que_title FROM quiz_question WHERE f_ass_id = '$ass_id' AND que_no = '2'";
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_array($result)){
							$q_id = $row['que_id'];
							$q_title = $row['que_title'];
							echo "<b>2.) $q_title</b><br>";
						}
						?>
						<select class='dropdown-trigger btn' name="2q"> 
						<option selected  disabled> Choose the correct Answer</option>
						<?php
						$get_opt= "select * from q_option WHERE qque_id = '$q_id' "; 
							$run_opt=mysqli_query($conn, $get_opt); 
							While ($row_cats=mysqli_fetch_array($run_opt)){ 
									$opt_id=$row_cats['opt_position']; 
									$opt_title=$row_cats['opt_title']; 
									Echo "<option value='$opt_id'>$opt_title</option>"; 
							}
						?> 
						</select>
					</span></div>
				</li>
				<li>
					<div class="collapsible-header"><i class="material-icons">quiz</i>3rd Question</div>
					<div class="collapsible-body"><span>
					<?php

						$ass_id = $_SESSION['get_id'];

						$conn = OpenCon();
						$sql = "SELECT que_id, que_title FROM quiz_question WHERE f_ass_id = '$ass_id' AND que_no = '3'";
						$result = mysqli_query($conn, $sql);
						while($row = mysqli_fetch_array($result)){
							$q_id = $row['que_id'];
							$q_title = $row['que_title'];
							echo "<b>3.) $q_title</b><br>";
						}
						?>
						<select class='dropdown-trigger btn' name="3q"> 
						<option selected  disabled> Choose the correct Answer</option>
						<?php
						$get_opt= "select * from q_option WHERE qque_id = '$q_id' "; 
							$run_opt=mysqli_query($conn, $get_opt); 
							While ($row_cats=mysqli_fetch_array($run_opt)){ 
									$opt_id=$row_cats['opt_position']; 
									$opt_title=$row_cats['opt_title']; 
									Echo "<option value='$opt_id'>$opt_title</option>"; 
							}
						?> 
						</select>
					</span></div>
				</li>
				<li>
					<div class="collapsible-header"><i class="material-icons">quiz</i>4th Question</div>
					<div class="collapsible-body"><span>
					<?php

							$ass_id = $_SESSION['get_id'];

							$conn = OpenCon();
							$sql = "SELECT que_id, que_title FROM quiz_question WHERE f_ass_id = '$ass_id' AND que_no = '4'";
							$result = mysqli_query($conn, $sql);
							while($row = mysqli_fetch_array($result)){
								$q_id = $row['que_id'];
								$q_title = $row['que_title'];
								echo "<b>4.) $q_title</b><br>";
							}
							?>
							<select class='dropdown-trigger btn' name="4q"> 
							<option selected  disabled> Choose the correct Answer</option>
							<?php
							$get_opt= "select * from q_option WHERE qque_id = '$q_id' "; 
								$run_opt=mysqli_query($conn, $get_opt); 
								While ($row_cats=mysqli_fetch_array($run_opt)){ 
										$opt_id=$row_cats['opt_position']; 
										$opt_title=$row_cats['opt_title']; 
										Echo "<option value='$opt_id'>$opt_title</option>"; 
								}
							?> 
							</select>
					</span></div>
				</li>
				<li>
					<div class="collapsible-header"><i class="material-icons">quiz</i>5th Questiono</div>
					<div class="collapsible-body"><span>

					<?php

							$ass_id = $_SESSION['get_id'];

							$conn = OpenCon();
							$sql = "SELECT que_id, que_title FROM quiz_question WHERE f_ass_id = '$ass_id' AND que_no = '5'";
							$result = mysqli_query($conn, $sql);
							while($row = mysqli_fetch_array($result)){
								$q_id = $row['que_id'];
								$q_title = $row['que_title'];
								echo "<b>5.) $q_title</b><br>";
							}
					?>
					<select class='dropdown-trigger btn' name = "5q"> 
       			<option selected  disabled> Choose the correct Answer</option>
						 <?php
							$get_opt= "select * from q_option WHERE qque_id = '$q_id' "; 
								$run_opt=mysqli_query($conn, $get_opt); 
								While ($row_cats=mysqli_fetch_array($run_opt)){ 
										$opt_id=$row_cats['opt_position']; 
										$opt_title=$row_cats['opt_title']; 
										Echo "<option value='$opt_id'>$opt_title</option>"; 
								}
						?> 
					</select>
					</span></div>
				</li>
			</ul>
			
      <br>
			<div></div>    
			<button  id="signup" name="sub_quiz" class="btn red modal-trigger" data-target="modal1"> Submit Quiz </button>
    </div>
	</div>
	</form>
    

<script  src="/Student eval/js/app.js"></script>
</body>
</html>