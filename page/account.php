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

      .txt_fld{
          position: relative;

          margin: 30px 0;
        }


        .card-panel1.recipe{
          border-radius: 8px;
          padding: 10px;
          box-shadow: 0px 1px 3px rgba(90,90,90,0.1);
          display: grid;
          grid-template-columns: 2fr;
          grid-template-rows: 2fr;
          grid-template-areas: "image details delete";
          
        }

        h3{
          margin:auto;
        }
				
				.dropdown-content{
					width: auto;
				}
       
  
      </style>



</head>

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
$conn = OpenCon();

if (isset($_SESSION['user_id'])) {
  $id = trim($_SESSION['user_id']);

  $user_fname = [];
  $sql = "SELECT * FROM user WHERE user_id = $id";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
			$user_fname['user_fname'] = $row['user_fname'];
			$user_fname['user_mname'] = $row['user_mname'];
			$user_fname['user_lname'] = $row['user_lname'];
		}
	}
	$sql = "SELECT * FROM student WHERE fuser_id_stud = $id";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
			$user_fname['age'] = $row['Age'];
			$user_fname['gender'] = $row['Gender'];
			$user_fname['mother'] = $row['Mother'];
			$user_fname['father'] = $row['Father'];
		
		}
	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST["update"])) {
		$s_age = $_POST['age'];
		$s_gender = $_POST['gender'];
		$s_mother = $_POST['mother'];
		$s_father = $_POST['father'];
		$s_section = $_POST['section'];
		$id = trim($_SESSION['user_id']);
		$sql = "UPDATE student SET Age = '$s_age' , Gender = '$s_gender', Mother = '$s_mother', Father = '$s_father' WHERE fuser_id_stud = '$id'";
		if ($conn->query($sql) == TRUE) {
      

			$sql1 = "INSERT INTO section (fuser_id, sec_name)value('$id','$s_section')";
			if ($conn->query($sql1) == TRUE) {
				echo '<script> alert("Data successfully Updated.") </script>';
				echo '<script> window.location.href="/Student eval/page/account.php" </script>';
			}
      
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
	}
}


?>

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
				<li><a href="/Student eval/page/home.php" class="waves-effect">Home</a></li>
				<li><div class="divider"></div></li>
				<li><a href="#" class="waves-effect" disabled>Account</a></li>
				<li><div class="divider"></div></li>
				<li><a href="/Student eval/page/subject.php" class="waves-effect">Subject</a></li>
				<li><div class="divider"></div></li>
				<li><a href="/Student eval/page/quiz.php" class="waves-effect">Quiz/Activities/Assignments</a></li>
				<li><div class="divider"></div></li>
				<li><a href="/Student eval/page/result.php" class="waves-effect">Result List</a></li>
    <li><div class="divider"></div></li>
				<li><a href="/Student eval/page/evaluator.php" class="waves-effect">Performance Evaluator</a></li>
				<li><div class="divider"></div></li>
				<li style="padding: 0 32px;">
					<?php  if (isset($_SESSION['user_name'])) { ?>
						<div class="chip" name="user_name" >
							<?php echo $_SESSION["user_name"]; echo $_SESSION["user_id"]; ?>	
						</div>
						<div class="chip" name="logout" >
							<a href="/Student eval/index.php">logout</a>
						</div>
						<?php } ?>
				</li>
				
			</ul>
					
				</div>
			</nav>
			<form action="account.php" method="post">
				<div class="recipes container grey-text text-darken-1">
					<div class="card-panel1 recipe white row">
							<div>
								<h3>Profile</h3>
							</div>
							<br>
							<div></div>
							<div class="input-field" style="padding-right: 8px;">
								<input type="text" id="fname" value="<?php echo $user_fname['user_fname']; ?>" >
								<label for="fname">Firstname</label>
							</div>
							<br>
							<div></div>
							<div class="input-field" style="padding-right: 8px;">
								<input type="text" id="mname" value="<?php echo $user_fname['user_mname']; ?>"  >
								<label for="mname">Middle name</label>
							</div>
							<br>
							<div></div>
							<div class="input-field">
								<input type="text" id="lname" value="<?php echo $user_fname['user_lname']; ?>"  >
								<label for="lname">Last name</label>
							</div>
							<br>
							<div></div>
							<div class="input-field">
								<input type="number" id="age" name="age" value ="<?php echo $user_fname['age']; ?>">
								<label for="age">Age</label>
							</div>
							<br>
							<div></div>
							<div >
								<select class='dropdown-trigger btn' name="gender" data-target='dropdown1'>
									<option value="" selected disabled>Gender</option>
									
									<option value="Male" name="user_type" id="user_type">Male</option>
									<option value="Female" name="user_type" id="user_type">Female</option>
									
								</select>
							</div>
							<br>
							<div></div>
							<div class="input-field">
								<input type="text" id="mother" name="mother" value ="<?php echo $user_fname['mother']; ?>">
								<label for="mother">Mother's name</label>
							</div>
							<br>
							<div></div>
							<div class="input-field">
								<input type="text" id="father" name="father" value ="<?php echo $user_fname['father']; ?>">
								<label for="father">Father's name</label>
							</div>
							<br>
							<div></div>
							<div >
								<select class='dropdown-trigger btn' name="section" data-target='dropdown1'>
									<option value="" selected disabled>Section</option>
									<option value="Einstein" name="user_type" id="user_type">Einstein</option>
									<option value="Socrates" name="user_type" id="user_type">Socrates</option>
									<option value="Aristotle" name="user_type" id="user_type">Aristotle</option>
									
								</select>
							</div>
							<br>
							<div></div>
							<div class="input-field">
							<button  id="update" name="update" class="btn red" > Update Profile</button>
							</div>
					</div>
				</div>
			</form>
		

  




  
  <script  src="/student eval/js/app.js"></script>
</body>
</html>