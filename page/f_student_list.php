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
			.card-panel.recipe_re{
          border-radius: 8px;
          padding: 10px;
          box-shadow: 0px 1px 3px rgba(90,90,90,0.1);
          display: grid;
          grid-template-columns: 2fr 2fr 1fr;
          grid-template-rows: 2fr;
          grid-template-areas: "image details delete";
					column-gap: 5px;
					row-gap: 5px;
          
        }

				.box-table{
						grid-column-start: 1;
						grid-column-end: 4;
						grid-row-start: 3;
						grid-row-end: 4;
				}

				.box2{
						grid-column-start: 1;
						grid-column-end: 4;
						grid-row-start: 2;
						grid-row-end: 3;
				}
				
				table.responsive-table tr:hover {
					cursor: pointer;
				}

				table thead {
					background: #FF8816;
				}

				table thead tr th {
					color: #fff;
				}
	

      </style>
</head>
<script>

	document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    M.Modal.init(elems);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('.modal').modal();
  });

</script>

<?php

error_reporting(0);
ini_set('display_errors', 0);

session_start();
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

include '../db_con.php';
$target = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // to press Save button
  
	if (isset($_POST["remove_st"])) {
    //$emp_id_no = 4
    
    $stud_id = $_POST["stud_id"];
    $sub_name = $_POST['sub_name'];
    
    
    // move uploaded pic from temp folder to permanent folder
    
    // database connection
    
    $conn = OpenCon();
    
    $sql = "DELETE FROM records WHERE fstud_id = '$stud_id' AND subj_name = '$sub_name'";
    if ($conn->query($sql) == TRUE) {
      echo '<script> alert("Data successfully deleted.") </script>';
      echo '<script> window.location.href="/Student eval/page/f_student_list.php" </script>';
    }else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$conn->close();
	}
}

?>



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
    <li><a href="/Student eval/page/f_home.php" class="waves-effect" >Home</a></li>
		<li><div class="divider"></div></li>
		<li><a href="/Student eval/page/f_account.php" class="waves-effect">Account</a></li>
    <li><div class="divider"></div></li>
		<li><a href="#" class="waves-effect" disabled>Student List</a></li>
    <li><div class="divider"></div></li>
    <li><a href="/Student eval/page/f_records.php" class="waves-effect">Records</a></li>
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

			<form action="f_student_list.php" method="post" novalidate>
				<div class="recipes container grey-text text-darken-1">
					<div class="card-panel recipe_re white row">
						<?php  if (isset($_SESSION['user_name'])) { ?>
							<h5>Welcome <?php echo $_SESSION["user_name"]; ?></h5> <?php } ?>
								<br>
								<div></div>
								
								<div class="box2">
								<button  id="rem_student"  data-target="modal1" class="btn modal-trigger" > Remove Student</button>
							
								</div>
								<br>
								<div></div>
								<br>
								<div class="box-table">
									<h6> Student List </h6>
										<table  class="responsive-table"id="student-table">
											<thead>
												<tr>
													<th>
													Subject
													</th>
													<th>Student ID</th>
													<th>First Name</th>
													<th>Last Name</th>
													<th>Section</th>
												</tr>
											</thead>
											<tbody>
												<?php
												//include '../db_con.php';
												
												$conn = OpenCon();
											

												$sql = "SELECT subj_name, fstud_id, Fname, Lname, sec_name FROM records WHERE fac_id = '$_SESSION[user_id]'";
												$result = $conn->query($sql);
												if ($result->num_rows > 0) {
													while ($row = $result->fetch_assoc()) {
														echo "<tr row_id='" . $row["subj_name"] . "'><td>" . $row["subj_name"] . "</td><td>" . $row["fstud_id"] . "</td></td>" . "<td>" . $row["Fname"] . "</td></td>" . "<td>" . $row["Lname"] . "</td></td>" . "<td>" . $row["sec_name"] . "</td>";
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
				
					<div id="modal1" class="modal">
						<div class="modal-content">
							<div class="txt_fld">
							<h4>Remove Student</h4>
								<input type="number" name="stud_id" required>
									<span></span>
									<label>Input Student Code</label>
							</div>
							<div class="txt_fld">
								<input type="text" name="sub_name" required>
									<span></span>
									<label>Input Subject</label>
							</div>
							
							<div class="modal-footer">
								<button name="remove_st" class="modal-close waves-effect waves-green btn-flat">Remove Student</a>
							</div>
							
						</div>
						
					</div>
				
			</form>

  <script  src="/Student eval/js/app.js"></script>
	<script  src="/Student eval/js/ui.js"></script>
</body>
</html>