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
      <a href="/Student eval/page/f_home.php">Student<span>Performance</span>Evaluator</a>
			

      <span class="right grey-text text-darken-1">
        <i class="material-icons sidenav-trigger" data-target="side-menu">menu</i>
      </span>
    </div>
  </nav>

<!-- side nav -->


  
    

	<form action="f_activity.php" method="POST" enctype="multipart/form-data">   
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
			<h6> Download file </h6>
			<br>
			<div></div>
					<div class="download">
                <?php 
								$conn = OpenCon();
                    
                $sql = "SELECT * FROM act_history WHERE f_act_id='$id'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    if ($row = mysqli_fetch_assoc($result)) {
                ?>
                <a href="uploads/<?php echo $row['file_new_name']; ?>" download="<?php echo $row['file_name1']; ?>" class="download_link"><?php echo $row['file_name1']; ?></a>
                <?php
                    }
                }
                
                ?>
            </div>
			<br>
			<div></div>
			<div class="txt_fld">
				<input type="number" name="score" required>
					<span></span>
					<label>Input Score</label>
			</div>
			<br>
			<div></div>
			<button name="sub_sco" class="modal-close waves-effect waves-green btn-flat">Submit Score</a>
	
	</div>
	

</div>
</form>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['sub_sco'])) { // If isset upload button or not
		// Declaring Variables
		$conn = OpenCon();
		$score = $_POST['score'];
		$fact_id = $_SESSION['act_id'];

		$sql = "UPDATE act_history SET score = '$score' , status1 = 'CHECKED' WHERE f_act_id = '$fact_id'";
		if ($conn->query($sql) == TRUE) {
      echo '<script> alert("Data successfully Updated.") </script>';
			echo '<script> window.location.href="/Student eval/page/f_result.php" </script>';
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		
	}
}

?>

<script  src="/Student eval/js/app.js"></script>
</body>
</html>