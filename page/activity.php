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

if (isset($_GET['id'])) {
  $id = trim($_GET['id']);	
	$_SESSION['act_id']=$id;
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
      <a href="/Student eval/page/home.php">Student<span>Performance</span>Evaluator</a>
			

      <span class="right grey-text text-darken-1">
        <i class="material-icons sidenav-trigger" data-target="side-menu">menu</i>
      </span>
    </div>
  </nav>

<!-- side nav -->
<ul id="side-menu" class="sidenav side-menu">
    <li><a class="subheader">Student Performance Evaluator</a></li>
    <li><a href="#" class="waves-effect" disabled>Home</a></li>
		<li><div class="divider"></div></li>
		<li><a href="/Student eval/page/account.php" class="waves-effect">Account</a></li>
    <li><div class="divider"></div></li>
    <li><a href="/Student eval/page/subject.php" class="waves-effect">Subject</a></li>
    <li><div class="divider"></div></li>
    <li><a href="/Student eval/page/quiz.php" class="waves-effect">Quiz/Activities/Assignments</a></li>
    <li><div class="divider"></div></li>
		<li><a href="#" class="waves-effect">Result List</a></li>
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

  
    

	<form action="activity.php" method="POST" enctype="multipart/form-data">   
  <div class="recipes container grey-text text-darken-1">
	
    <div class="card-panel recipe1 white row">
			<?php

					$conn = OpenCon();
					$sql = "SELECT act_id, act_title FROM activity WHERE act_id = '$id'";
					$result = mysqli_query($conn, $sql);
					while($row = mysqli_fetch_array($result)){
						$act_title = $row['act_title'];	
						$act_id = $row['act_id'];
					}
					echo "<h4> $act_title</h4>";

			?>
			<br>
			<div></div>
			<?php

					$conn = OpenCon();
					$sql = "SELECT ins_id, ins_title FROM act_ins WHERE fact_id = '$id'";
					$result = mysqli_query($conn, $sql);
					while($row = mysqli_fetch_array($result)){
						$ins_title = $row['ins_title'];	
						$ins_id = $row['ins_id'];	
					}
					echo "<p> $ins_title </p>";

			?>
			<br>
			<div></div>
			<div class="box-table">
					<h6> Criteria </h6>
						<table  class="responsive-table" >
							<thead>
								<tr>
									<th>
									Value
									</th>
								
									<th>Criteria Title</th>
									<th>Description</th>
									
									
									
								</tr>
							</thead>
							<tbody>
								<?php
								//include '../db_con.php';
								
								$conn = OpenCon();
							

								$sql = "SELECT * FROM ins_criteria WHERE f_act_ins = '$ins_id'";
								$result = $conn->query($sql);
								
								if ($result->num_rows > 0) {
									while ($row = $result->fetch_assoc()) {
										echo "<tr row_id='" . $row["cri_id"] . "'><td>" . $row["cri_value"] . "</td><td>" . $row["cri_title"] . "</td></td>" . "<td>" . $row["cri_desc"] . "</td></td>" ;
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
	
    <div >
			<h6>Upload File</h6>
      <div class="btn">
        <span>File</span>
        <input type="file" name="file" required>
      </div>
      
    </div>
  
	<br>
	<div></div>
	<button   name="sub_act"  class="btn " > Submit Activity</button>
	
	
	</div>
	

</div>
</form>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['sub_act'])) { // If isset upload button or not
		// Declaring Variables
		$conn = OpenCon();
		$location = "uploads/";
		$file_new_name = date("dmy") . time() . $_FILES["file"]["name"]; // New and unique name of uploaded file
		$file_name = $_FILES["file"]["name"]; // Get uploaded file name
		$file_temp = $_FILES["file"]["tmp_name"]; // Get uploaded file temp
		$file_size = $_FILES["file"]["size"]; // Get uploaded file size

		$fuser_id = $_SESSION["user_id"];
		$fact_id = $_SESSION['act_id'];

		/*
		How we can get mb from bytes
		(mb*1024)*1024

		In my case i'm 10 mb limit
		(10*1024)*1024
		*/
		if ($file_size > 10485760) { // Check file size 10mb or not
			echo "<script>alert('Woops! File is too big. Maximum file size allowed for upload 10 MB.')</script>";
		}	else{
			$sql = "INSERT INTO act_history ( fuser_id, f_act_id, file_name1, file_new_name) VALUES ('$fuser_id','$fact_id','$file_name', '$file_new_name')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				move_uploaded_file($file_temp, $location . $file_new_name);
				echo "<script>alert('Wow! File uploaded successfully.')</script>";
				$sql = "UPDATE s_get_act SET status = 'Done' WHERE fuser_id = '$fuser_id' AND fact_id = '$fact_id'";
				if ($conn->query($sql) == TRUE) {

				}
				echo '<script> window.location.href="/Student eval/page/quiz.php" </script>';
			}else {
				echo "<script>alert('Woops! Something wong went.')</script>";
			}

		}
	}
}

?>

<script  src="/Student eval/js/app.js"></script>
</body>
</html>