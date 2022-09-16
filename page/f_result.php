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

?>
<script>

$(document).ready( function () {
    $('#student-table').DataTable();		
} );

</script>

<body class="grey lighten-4">

  <!-- top nav -->
  <nav class="z-depth-0">
    <div class="nav-wrapper container">
      <a href="/Student eval/page/f_home.php">Student<span>Performance</span>Evaluator</a>
			

      <span class="right grey-text text-darken-1">
        <i class="material-icons sidenav-trigger" data-target="side-menu">menu</i>
      </span>
    </div>
  </nav>

<!-- side nav -->
<ul id="side-menu" class="sidenav side-menu">
<li><a class="subheader">Student Performance Evaluator</a></li>
    <li><a href="/Student eval/page/f_home.php" class="waves-effect" disabled>Home</a></li>
		<li><div class="divider"></div></li>
		<li><a href="/Student eval/page/f_account.php" class="waves-effect">Account</a></li>
    <li><div class="divider"></div></li>
		<li><a href="/Student eval/page/f_student_list.php" class="waves-effect">Student List</a></li>
    <li><div class="divider"></div></li>
    <li><a href="#" class="waves-effect">Records</a></li>
    <li><div class="divider"></div></li>
    <li><a href="/Student eval/page/f_quiz.php" class="waves-effect">Quiz/Activities/Assignments</a></li>
    <li><div class="divider"></div></li>
		<li><a href="/Student eval/page/f_result.php" class="waves-effect">Result List</a></li>
    <li><div class="divider"></div></li>
    <li><a href="/Student eval/page/f_evaluator.php" class="waves-effect">Performance Evaluator</a></li>
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

  
    

    
  <div class="recipes container grey-text text-darken-1">
	
    <div class="card-panel recipe1 white row">
     
			<div> 
				<h4>Quiz Result</h4>
			</div>
			<br>
			<div>
			</div>
			<div class="box-table">
					<h6> Quiz List </h6>
						<table  class="responsive-table" id="student-table">
							<thead>
								<tr>
									<th>
									Subject Code
									</th>
								
									<th>Assessment Name</th>
									<th>First Name</th>
									<th>Middle Name</th>
									<th>Last Name</th>
									<th>Score</th>
									<th>Mistakes</th>
									<th>Total Question</th>
									
									
								</tr>
							</thead>
							<tbody>
								<?php
								//include '../db_con.php';
								
								$conn = OpenCon();
							

								$sql = "SELECT assessment.f_sub, assessment.ass_name, user.user_fname, user.user_mname, user_lname, score, mistakes, assessment.Total_q  FROM history LEFT JOIN assessment ON history.f_ass_id = assessment.ass_id LEFT JOIN user ON history.f_user_id = user.user_id";
								$result = $conn->query($sql);
								
								if ($result->num_rows > 0) {
									while ($row = $result->fetch_assoc()) {
										echo "<tr row_id='0' ><td>" . $row["f_sub"] . "</td><td>" . $row["ass_name"] . "</td></td>" . "<td>" . $row["user_fname"] . "</td></td>". "<td>" . $row["user_mname"] . "</td></td>". "<td>" . $row["user_lname"] . "</td></td>". "<td>" . $row["score"] . "</td></td>" . "<td>" . $row["mistakes"] . "</td></td>". "<td>" . $row["Total_q"] . "</td></td>";
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
    </div>
</div>

<div class="recipes container grey-text text-darken-1">
	
	<div class="card-panel recipe1 white row">
			<div class="box-table">
					<h6> Activity List </h6>
						<table  class="responsive-table" id="student-table">
							<thead>
								<tr>
									<th>
									Subject Code
									</th>
								
									<th>Activity Name</th>
									<th>First Name</th>
									<th>Middle Name</th>
									<th>Last Name</th>
									<th>Score</th>
									<th>Status</th>
								
									
									
								</tr>
							</thead>
							<tbody>
								<?php
								//include '../db_con.php';
								
								$conn = OpenCon();
							

								$sql = "SELECT activity.act_id, activity.fr_sub, activity.act_title, user.user_fname, user.user_mname, user_lname, score, status1 FROM act_history LEFT JOIN activity ON act_history.f_act_id = activity.act_id LEFT JOIN user ON act_history.fuser_id = user.user_id";
								$result = $conn->query($sql);
								
								if ($result->num_rows > 0) {
									while ($row = $result->fetch_assoc()) {
										echo "<tr row_id='" . $row["act_id"] . "'><td>" . $row["fr_sub"] . "</td><td>" . $row["act_title"] . "</td></td>" . "<td>" . $row["user_fname"] . "</td></td>". "<td>" . $row["user_mname"] . "</td></td>". "<td>" . $row["user_lname"] . "</td></td>". "<td>" . $row["score"] . "</td></td>" . "<td>" . $row["status1"] . "</td></td>";
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

	</div>
	</div>


<script type="text/javascript">
											$(document).ready(function() {
												$('table tr').click(function() {
													var id = $(this).attr('row_id');
											
												//	window.open("/Student eval/page/activity.php?id=" + id);
												 if(id == '0'){
													window.location.href="/Student eval/page/f_result.php";
												 }else{
													
													window.location.href="/Student eval/page/f_activity.php?id=" +id;
												 }
												});
											});
										
</script>

<script  src="/Student eval/js/app.js"></script>
</body>
</html>