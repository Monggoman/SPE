<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPE</title>
		<link rel="icon" href="/Student eval/img/logo1.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link type="text/css" href="/student eval/css/materialize.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" href="/student eval/css/style.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <script type="text/javascript" src="/student eval/js/materialize.min.js"></script>
    <script  src="../js/ui.js"></script>
    <link rel="manifest" href="/student eval/manifest.json">

    <link rel="apple-touch-icon" href="/student eval/img/icons/icon-96x96.png">
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

      .txt_fld{
          position: relative;

          margin: 30px 0;
        }


        .card-panel1.recipe{
          border-radius: 8px;
          padding: 50px;
          box-shadow: 0px 1px 3px rgba(90,90,90,0.1);
          display: grid;
          grid-template-columns: 2fr;
          grid-template-rows: 2fr;
          grid-template-areas: "image details delete";
          
        }

        h2{
          text-align: left;
        }
				
				.dropdown-content{
					width: auto;
				}
       
  
      </style>



</head>
<?php
error_reporting(0);
ini_set('display_errors', 0);
$target = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // to press Save button
  if (isset($_POST["sign_up"])) {
    //$emp_id_no = 4
    
    $user_name = $_POST["user_name"];
    $user_pass = $_POST["user_pass"];
    $user_email = $_POST["user_email"];
    $user_type = $_POST["user_type"];
    $user_fname = $_POST["user_fname"];
    $user_mname = $_POST["user_mname"];
    $user_lname = $_POST["user_lname"];
    
    // move uploaded pic from temp folder to permanent folder
    
    // database connection
    include '../db_con.php';
    $conn = OpenCon();
    
    $sql = "INSERT INTO user ( username, user_pass, user_email, user_type, user_fname, user_mname, user_lname) VALUES ('$user_name', '$user_pass', '$user_email', '$user_type', '$user_fname', '$user_mname', '$user_lname')";
		
    if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
	//	$con = mysqli_connect('localhost','root','',"spe_website");
		$q = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user_name' AND user_pass = '$user_pass'");
		$row = mysqli_fetch_array($q);
		$user_type = $row['user_type'];
		$user_id = $row['user_id'];
		

		$isexist1 = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user_name' AND user_pass= '$user_pass'");
		$check_user = mysqli_num_rows($isexist1);

		if($check_user==1){
			$_SESSION["user_id"] = $row['user_id'];
			$_SESSION["user_type"] = $row['user_type'];
			$_SESSION["username"] = $row['username'];

			if($user_type == "Admin"){
				echo '<script> alert("LOGIN AS ADMIN")</script>';
				echo '<script> window.location.href = "/Student eval/admin.php"</script>';
			}elseif($user_type == "Faculty"){
				$sql = "INSERT INTO faculty ( fuser_id ) VALUE ( '$user_id')";
				if ($conn->query($sql) == TRUE) {
					'<script> alert("Registration of Faculty Success!")</script>';
					$check_user= 0;
		
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}elseif($user_type == "Student"){
				$sql = "INSERT INTO student ( fuser_id_stud ) VALUE ( '$user_id')";
				if ($conn->query($sql) == TRUE) {
					'<script> alert("Registration of Student Success!")</script>';
					$check_user= 0;
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}elseif($user_type == "Parent"){
				$sql = "INSERT INTO parent ( fkuser_id_par ) VALUE ( '$user_id')";
				if ($conn->query($sql) == TRUE) {
					'<script> alert("Registration of Parent Success!")</script>';
					$check_user= 0;
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}else{
				echo '<script> alert("Invalid username")</script>';
			}
		}

		// close database connection
	
    $conn->close();
  } 
}
?>
<body class="grey lighten-4">

  <!-- top nav -->
  <nav class="z-depth-0">
		<form action="register.php" method="POST">
				<div class="nav-wrapper container">
					<a href="/student eval/">Student<span>Performance</span>Evaluator</a>
					
				</div>
			</nav>
			<div class="recipes container grey-text text-darken-1">
				<div class="card-panel1 recipe white row">
						<h2>Register</h2>
						<h2></h2>
						
						<h2></h2>
						<div class="txt_fld">
							<input type="text" name="user_name" required>
								<span></span>
								<label>Username</label>
						</div>
						<h2></h2>
						<h2></h2>
						<div class="txt_fld">
							<input type="password" name="user_pass" required>
								<span></span>
								<label>Password</label>
						</div>
						<h2></h2>
						<h2></h2>
						<div class="txt_fld">
							<input type="text"  name="user_email" required>
								<span></span>
								<label>Email</label>
						</div>
						<h2></h2>
						<h2></h2>
						<div class="txt_fld">
							<input type="text"  name="user_fname" required>
								<span></span>
								<label>First Name</label>
						</div>
						<h2></h2>
						<h2></h2>
						<div class="txt_fld">
							<input type="text"  name="user_mname" required>
								<span></span>
								<label>Middle Name</label>
						</div>
						<h2></h2>
						<h2></h2>
						<div class="txt_fld">
							<input type="text"  name="user_lname" required>
								<span></span>
								<label>Last name</label>
						</div>
						<h2></h2>
						<h2></h2>
						<div  >
							<select class='dropdown-trigger btn' name="user_type" data-target='dropdown1'>Drop Me!
							<option value="" selected disabled>Choose user type</option>
								<option value="Faculty" name="user_type" id="user_type">Faculty</option>
								<option value="Student" name="user_type" id="user_type">Student</option>
								<option value="Parent" name="user_type" id="user_type">Parent</option>
							</select>

						</div>
						<!--<a href="#" class="btn red accent-1 dropdown-trigger" data-target="dropdown1">What user are you?</a>
						<ul class="dropdown-content" id="dropdown1">
							<li><a href="#">Teacher</a></li>
							<li><a href="#">Student</a></li>
							<li><a href="#">Parent</a></li>
						</ul>-->
						<h2></h2>
						<h2></h2>

						<button  id="sign_up" name="sign_up" class="btn red "> Sign up </button>
						<h2></h2>
						<h2></h2>
						

						
					
						


				</div>
			</div>
		</form>
		

  




  
  <script  src="/student eval/js/app.js"></script>
</body>
</html>