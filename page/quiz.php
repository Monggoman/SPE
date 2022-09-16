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

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
  
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

    <style>
      @media screen and (min-width: 300px){
        .Cboc{
        width: 96%;
        height: 96%;
        margin:auto;
        }

      }
      </style>
</head>

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


$target = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // to press Save button
  if (isset($_POST["add"])) {
    //$emp_id_no = 4
    $ass_id = $_POST["ass_id"];
    
    
		$fuser_id = $_SESSION["user_id"];
    
    
    // move uploaded pic from temp folder to permanent folder
    
    // database connection
    
    $conn = OpenCon();
    
    $sql = "INSERT INTO student_get_quiz ( fuser_id, fass_id, f_ass_name) VALUES ('$fuser_id', '$ass_id', (SELECT ass_name FROM assessment WHERE ass_id = '$ass_id' ))";
		
    if ($conn->query($sql) == TRUE) {
      echo '<script>
			window.alert("Quiz added");
			</script>';

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
	}
	if (isset($_POST["del_sub"])) {
    //$emp_id_no = 4
    
    $del_sub = $_POST["Delete_sub"];
    $fac_id = $_SESSION["user_id"];
    
    
    // move uploaded pic from temp folder to permanent folder
    
    // database connection
    
    $conn = OpenCon();
    
    $sql = "DELETE FROM student_get_quiz WHERE fass_id = $del_sub";
    if ($conn->query($sql) == TRUE) {
      echo '<script> alert("Data successfully deleted.") </script>';
      echo '<script> window.location.href="/Student eval/page/quiz.php" </script>';
    }
		$conn->close();
	}
	if (isset($_POST["start_quiz"])) {
    //$emp_id_no = 4
    
    $add_id = $_POST["start_q"];
    $fac_id = $_SESSION["user_id"];
    $_SESSION['get_id'] = $_POST["start_q"];
    
    // move uploaded pic from temp folder to permanent folder
    
    // database connection
    
    
    $con = mysqli_connect('localhost','root','',"spe_website");
    $sql = mysqli_query($con, "SELECT ass_id, Total_q, ass_name, status FROM assessment WHERE ass_id = '$add_id'");
		$row = mysqli_fetch_array($sql);
		

		$sql1 =  mysqli_query($con,"SELECT ans_status FROM student_get_quiz WHERE fuser_id = '$_SESSION[user_id]' AND fass_id = '$add_id'");
		$row1 = mysqli_fetch_array($sql1);

		$total_q = $row['Total_q'];
		$status = $row1['ans_status'];
		$_SESSION['ass_id'] = $row['ass_id'];
		$_SESSION['ass_name1'] = $row['ass_name'];
    
		if($status == 'Not initiated')
		{
			if($total_q == 5){
				echo '<script> window.location.href="/Student eval/page/quiz_5.php" </script>';
			} elseif ($total_q == 10){
				echo '<script> window.location.href="/Student eval/page/quiz_10.php" </script>';
			}  elseif ($total_q == 20){
				echo '<script> window.location.href="/Student eval/page/quiz_20.php" </script>';
			}
		
	
		}else{
			echo '<script> alert("Quiz already taken!") </script>';
		}
		
	}
	if (isset($_POST["add_act"])) {
    //$emp_id_no = 4
    $act_id = $_POST["act_id"];
    
    
		$fuser_id = $_SESSION["user_id"];
    
    
    // move uploaded pic from temp folder to permanent folder
    
    // database connection
    
    $conn = OpenCon();
    
    $sql = "INSERT INTO s_get_act ( fuser_id, fact_id, f_act_title) VALUES ('$fuser_id', '$act_id', (SELECT act_title FROM activity WHERE act_id = '$act_id' ))";
		
    if ($conn->query($sql) == TRUE) {
      echo '<script>
			window.alert("Activity added");
			</script>';

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
	}
}
	
?>

<script>

	document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    M.Modal.init(elems);
  });

  // Or with jQuery
	$(document).ready( function () {
    $('#student-table').DataTable();		
} );
$(document).ready( function () {
    $('#student-table1').DataTable();		
} );

  $(document).ready(function(){
    $('.modal').modal();
  });

	document.addEventListener('DOMContentLoaded', function() {
    var elems1 = document.querySelectorAll('.datepicker');
    M.Datepicker.init(elems1);
  });

  // Or with jQuery



	

	
</script>

<body class="grey lighten-4">

  <!-- top nav -->
  <nav class="z-depth-0">
    <div class="nav-wrapper container">
      <a href="/Student eval/page/home.php">Student<span>Performance</span>Evaluator</a>
      <span class="right grey-text text-darken-1">
        <i class="material-icons sidenav-trigger" data-target="side-menu">menu</i>
      </span>
    </div>
  </nav>

<!-- side nav -->
<ul id="side-menu" class="sidenav side-menu">
<li><a class="subheader">Student Performance Evaluator</a></li>
    <li><a href="/Student eval/page/home.php" class="waves-effect" >Home</a></li>
		<li><div class="divider"></div></li>
		<li><a href="/Student eval/page/account.php" class="waves-effect">Account</a></li>
    <li><div class="divider"></div></li>
    <li><a href="/Student eval/page/subject.php" class="waves-effect">Subject</a></li>
    <li><div class="divider"></div></li>
    <li><a href="#" class="waves-effect" disabled>Quiz/Activities/Assignments</a></li>
    <li><div class="divider"></div></li>
		<li><a href="/Student eval/page/result.php" class="waves-effect">Result List</a></li>
    <li><div class="divider"></div></li>
    <li><a href="/Student eval/page/evaluator.php" class="waves-effect">Performance Evaluator</a></li>
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

	<form action="/Student eval/page/quiz.php" method="post" novalidate>
				<div class="recipes container grey-text text-darken-1">
					<div class="card-panel recipe_re white row">
						<?php  if (isset($_SESSION['user_name'])) { ?>
							<h5>Welcome <?php echo $_SESSION["user_name"]; ?></h5> <?php } ?>
								<br>
								<div></div>
								
								<div class="box2">
								<button  id="rem_student"  data-target="modal1" class="btn modal-trigger" > Add Quiz</button>
								<button  id="rem_ass"  data-target="modal2" class="btn modal-trigger" > Remove Quiz</button>
								<button  id="add_quest"  data-target="modal3" class="btn modal-trigger" > Start Quiz</button>
							
								</div>
								<br>
								<div></div>
								<br>
								<div class="box-table">
									<h6> Quiz List </h6>
										<table  class="responsive-table" id="student-table">
											<thead>
												<tr>
													<th>
													Quiz Code
													</th>
												
													<th>Assessment Name</th>
													<th>Status</th>
													
													
												</tr>
											</thead>
											<tbody>
												<?php
												//include '../db_con.php';
												
												$conn = OpenCon();
											

												$sql = "SELECT * FROM student_get_quiz WHERE fuser_id = '$_SESSION[user_id]'";
												$result = $conn->query($sql);
												
												if ($result->num_rows > 0) {
													while ($row = $result->fetch_assoc()) {
														echo "<tr row_id='0'><td>" . $row["fass_id"] . "</td><td>" . $row["f_ass_name"] . "</td></td>" . "<td>" . $row["ans_status"] . "</td></td>" ;
													}

													echo "</table";
												} else {
													echo "0 results";
												}
												$conn->close();
												?>
											</tbody>
										</table>
								</div>
								<div id="modal1" class="modal">
										<div class="modal-content">
											<div class="txt_fld">
											<h4>Assessment</h4>
												<input type="text" name="ass_id" required>
													<span></span>
													<label>Quiz code</label>
											</div>
											
											

											<div class="modal-footer">
												<button name="add" class="modal-close waves-effect waves-green btn-flat">Add Quiz</a>
											</div>
							
								</div>
											</div>
								<div id="modal2" class="modal">
										<div class="modal-content">
											<h4>Remove Quiz</h4>
											<div class="txt_fld">
												<input type="number" name="Delete_sub" required>
													<span></span>
													<label>Input Quiz Code</label>
											</div>
											
										</div>
										<div class="modal-footer">
											<button name="del_sub" class="modal-close waves-effect waves-green btn-flat">Delete Quiz</a>
										</div>
									</div>
									<div id="modal3" class="modal">
										<div class="modal-content">
											
											<div class="txt_fld">
												<input type="number" name="start_q" required>
													<span></span>
													<label>Input Quiz Code</label>
											</div>
											
										</div>
										<div class="modal-footer">
											<button name="start_quiz" class="modal-close waves-effect waves-green btn-flat">Start Quiz</a>
										</div>
									</div>
						
					</div>
				</div>

				<div class="recipes container grey-text text-darken-1">
					<div class="card-panel recipe_re white row">
					<div class="box2">
								<button  id="rem_student"  data-target="modal4" class="btn modal-trigger" > Add Activity</button>
								<button  id="rem_ass"  data-target="modal5" class="btn modal-trigger" > Remove Activity</button>
							
							
								</div>
								<br>
					<div>

									<script type="text/javascript">
											$(document).ready(function() {
												$('table tr').click(function() {
													var id = $(this).attr('row_id');
													if(id != '0'){
												//	window.open("/Student eval/page/activity.php?id=" + id);
													window.location.href="/Student eval/page/activity.php?id=" +id;
													}
													else{
														window.location.href="/Student eval/page/quiz.php";
													}
												});
											});
										</script>
										

					</div>
								<div class="box-table">
									<h6> Activity List </h6>
										<table  class="responsive-table" id="student-table1">
											<thead>
												<tr>
													<th>
													Activity Code
													</th>
												
													<th>Activity Name</th>
													<th>Status</th>
													
													
												</tr>
											</thead>
											<tbody>
												<?php
												//include '../db_con.php';
												
												$conn = OpenCon();
												

													$sql = "SELECT * FROM s_get_act WHERE fuser_id = '$_SESSION[user_id]'";
													$result = $conn->query($sql);
													
													if ($result->num_rows > 0) {
														while ($row = $result->fetch_assoc()) {
															echo "<tr row_id='" . $row["fact_id"] . "'><td>" . $row["fact_id"] . "</td><td>" . $row["f_act_title"] . "</td></td>" . "<td>" . $row["status"] . "</td></td>" ;
														}

														echo "</table";
													} else {
														echo "0 results";
													}
												
												$conn->close();
												?>
											</tbody>
										</table>
								</div>
								<div id="modal4" class="modal">
										<div class="modal-content">
											<div class="txt_fld">
											<h4>ACTIVITY</h4>
												<input type="text" name="act_id" required>
													<span></span>
													<label>Activity code</label>
											</div>
											<div class="modal-footer">
												<button name="add_act" class="modal-close waves-effect waves-green btn-flat">Add Activity</a>
											</div>
										</div>
										</div>
								<div id="modal5" class="modal">
										<div class="modal-content">
											<div class="txt_fld">
												<input type="text" name="del_act" required>
													<span></span>
													<label>Input Activity code</label>
											</div>
											<div class="modal-footer">
												<button name="rem_act" class="modal-close waves-effect waves-green btn-flat">Remove Activity</a>
											</div>
								</div>
								</div>
								
								
					</div>
				</div>
			</form>

  <script  src="/Student eval/js/app.js"></script>
</body>
</html>