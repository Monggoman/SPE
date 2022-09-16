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
		<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	
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

//error_reporting(0);
//ini_set('display_errors', 0);

include '../db_con.php';
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



	
if ($_SERVER["REQUEST_METHOD"] == "POST") {	

	if(isset($_POST['fac']))
	{
		echo "hello world";
    $del_fac1 = $_POST['del_fac'];
   
    
    $conn = OpenCon();
    
  
		$sql = "DELETE FROM 'faculty' WHERE 'fuser_id' = '$del_fac1'";
    if ($conn->query($sql) == TRUE) {
			echo '<script> alert("Data successfully deleted.") </script>';
		
    }else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$conn->close();
		
	}
	
}


 


?>

<script>
		document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    M.Modal.init(elems);
  });
	$(document).ready(function(){
    $('.modal').modal();
  });


$(document).ready( function () {
    $('#student-table').DataTable();		
} );

$(document).ready( function () {
    $('#student-table1').DataTable();		
} );

</script>

<body class="grey lighten-4">

  <!-- top nav -->
  <nav class="z-depth-0">
    <div class="nav-wrapper container">
      <a href="/Student eval/page/admin.php">Student<span>Performance</span>Evaluator</a>
			

      <span class="right grey-text text-darken-1">
 <i class="material-icons sidenav-trigger" data-target="side-menu">menu</i>
      </span>
    </div>
  </nav>

<!-- side nav -->
<ul id="side-menu" class="sidenav side-menu">
    
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


	<form action="/Student eval/page/admin.php" method="POST" novalidate>
			<div class="recipes container grey-text text-darken-1">
				<div class="card-panel recipe1 white row">

					<div>
								<a href="/Student eval/page/register1.php" class="btn">Add user</a>
								<button  id="add_quest" name="remove"  data-target="modal1" class="btn modal-trigger" > Remove user</button>
					</div>	
					<br>
					<div></div>

					<div class="box-table">
							<h6> Faculty List </h6>
								<table  class="responsive-table" id="student-table">
									<thead>
										<tr>
											<th>
											Faculty Code
											</th>
											<th>username</th>
											<th>First Name</th>
											<th>Middle Name</th>
											<th>Last Name</th>
											<th>Email</th>
											
											
										</tr>
									</thead>
									<tbody>
										<?php
										//include '../db_con.php';
										
										$conn = OpenCon();
									

										$sql = "SELECT `user_id`, `username`, `user_fname`, `user_mname`, `user_lname`, `user_email`  FROM `user`  WHERE `user_type` = 'Faculty'";
										$result = $conn->query($sql);
										
										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
												echo "<tr row_id='" . $row["user_id"] . "'><td>" . $row["user_id"] . "</td><td>" . $row["username"] . "</td></td>" . "<td>" . $row["user_fname"] . "</td></td>" . "<td>" . $row["user_mname"] . "</td></td>". "<td>" . $row["user_lname"] . "</td></td>". "<td>" . $row["user_email"] . "</td></td>";
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
							<div>
							
							</div>	
					<br>
					<div></div>
						<div class="box-table">
							<h6> Parent List </h6>
								<table  class="responsive-table" id="student-table1">
									<thead>
										<tr>
											<th>
											Parent Code
											</th>
											<th>username</th>
											<th>First Name</th>
											<th>Middle Name</th>
											<th>Last Name</th>
											<th>Email</th>
											
											
										</tr>
									</thead>
									<tbody>
										<?php
										//include '../db_con.php';
										
										$conn = OpenCon();
									

										$sql = "SELECT `user_id`, `username`, `user_fname`, `user_mname`, `user_lname`, `user_email`  FROM `user`  WHERE `user_type` = 'Parent'";
										$result = $conn->query($sql);
										
										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
												echo "<tr row_id='" . $row["user_id"] . "'><td>" . $row["user_id"] . "</td><td>" . $row["username"] . "</td></td>" . "<td>" . $row["user_fname"] . "</td></td>" . "<td>" . $row["user_mname"] . "</td></td>". "<td>" . $row["user_lname"] . "</td></td>". "<td>" . $row["user_email"] . "</td></td>";
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
							<div>
								
							</div>	
					<br>
					<div></div>
					<div class="box-table">
							<h6> Student List </h6>
								<table  class="responsive-table" id="student-table1">
									<thead>
										<tr>
											<th>
											Student Code
											</th>
											<th>username</th>
											<th>First Name</th>
											<th>Middle Name</th>
											<th>Last Name</th>
											<th>Email</th>
											
											
										</tr>
									</thead>
									<tbody>
										<?php
										//include '../db_con.php';
										
										$conn = OpenCon();
									

										$sql = "SELECT `user_id`, `username`, `user_fname`, `user_mname`, `user_lname`, `user_email`  FROM `user`  WHERE `user_type` = 'Student'";
										$result = $conn->query($sql);
										
										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
												echo "<tr row_id='" . $row["user_id"] . "'><td>" . $row["user_id"] . "</td><td>" . $row["username"] . "</td></td>" . "<td>" . $row["user_fname"] . "</td></td>" . "<td>" . $row["user_mname"] . "</td></td>". "<td>" . $row["user_lname"] . "</td></td>". "<td>" . $row["user_email"] . "</td></td>";
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
									<input type="number" name="del_fac">
										<span></span>
										<label>Input Faculty code</label>
								</div>
								<div class="modal-footer">
									<button name="fac" type="button" class="modal-close waves-effect waves-green btn-flat">Remove User</a>
								</div>
							</div>
					</div>
					
</form>

		
	

				
    
  













<script  src="/Student eval/js/app.js"></script>
</body>
</html>