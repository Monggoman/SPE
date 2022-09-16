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

<?php


error_reporting(0);
ini_set('display_errors', 0);

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

$conn = OpenCon();
$user_id = $_SESSION["user_id"];


$conn = OpenCon();
$user_id = $_SESSION["user_id"];
$sec = $_POST['section'];



if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$subject = $_POST["subject"];
	if (isset($_POST["show"])) {
		$query = "SELECT ass_name, f_sub, history.score,section.sec_name, assessment.Total_q FROM history LEFT JOIN assessment ON history.f_ass_id = assessment.ass_id LEFT JOIN section ON history.f_user_id = section.fuser_id WHERE f_sub = '$subject'  AND section.sec_name = '$sec'";
		$result = mysqli_query($conn,$query);

		foreach ($result as $row) {
			$quiz[]= $row['ass_name'];
			$score[] = $row['score'];
			$total[] = $row['Total_q'];
		}
	
	}
	if (isset($_POST["show_act"])) {
		$query = "SELECT act_title, fr_sub, act_history.score, section.sec_name FROM act_history LEFT JOIN activity ON act_history.f_act_id = activity.act_id LEFT JOIN section ON act_history.fuser_id = section.fuser_id WHERE fr_sub = '$subject' AND section.sec_name = '$sec' ";
		$result1 = mysqli_query($conn,$query);
	
		foreach ($result1 as $row1) {
			$quiz[]= $row1['act_title'];
			$score[] = $row1['score'];
		}
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
    <li><a href="#" class="waves-effect" disabled>Home</a></li>
		<li><div class="divider"></div></li>
		<li><a href="/Student eval/page/f_account.php" class="waves-effect">Account</a></li>
    <li><div class="divider"></div></li>
		<li><a href="/Student eval/page/f_student_list.php" class="waves-effect">Student List</a></li>
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

 
    

  <form action="f_home.php" method="POST">  
  <div class="recipes container grey-text text-darken-1">
	
    <div class="card-panel recipe1 white row">
      <h4>Section</h4>
			<br><div></div>
      <select class='dropdown-trigger btn' name="section" id="subject"> 
					<option selected disabled> Choose Section</option>
					<option value="Einstein" name="user_type" id="user_type">Einstein</option>
					<option value="Socrates" name="user_type" id="user_type">Socrates</option>
					<option value="Aristotle" name="user_type" id="user_type">Aristotle</option>
			</select>
			<br><div></div>
			<div>
				<select class='dropdown-trigger btn' name="subject" id="subject"> 
					<option selected disabled> Choose the Subject</option>
					<?php
					$conn = OpenCon();
					$get_opt= "select * from subject "; 
						$run_opt=mysqli_query($conn, $get_opt); 
						While ($row_cats=mysqli_fetch_array($run_opt)){ 
								$sub_id=$row_cats['sub_id']; 
								$sub_name=$row_cats['sub_name']; 
								Echo "<option value='$sub_id'>$sub_name</option>"; 
						}
					?> 
			</select>
			</div>
			<br><div></div>
			<button  id="update" name="show" class="btn red" > Show Quiz Graph</button>
			<br><div></div>
		<button  id="update" name="show_act" class="btn red" > Show Activity Graph</button>
    </div>
</div>
<div class="recipes container grey-text text-darken-1">
		<div class="card-panel recipe1 white row">
        
            <canvas id="myChart"></canvas>
    
    </div>
	</div>
</form>

<script>
let myChart= document.getElementById('myChart').getContext('2d');
    let massPopChart = new Chart(myChart,{
        type: 'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
        data:{
            labels:<?php echo json_encode($quiz) ?>,
            datasets:[{
                label: 'Quiz/Activity',
                data:<?php echo json_encode($score) ?>,
								
                backgroundColor: [
                    '#FF8816',
                    '#f5a75e',
                    '#eedd44'
                ],
                borderWidth:1,
                borderColoer: '#777',
                hoverBorderWidth: 3,
                hoverBorderColor: 'black'
            },{
									label: 'Line Dataset',
									data: <?php echo json_encode($total) ?>,
									type: 'bar',
									// this dataset is drawn on top
									order: 1
							}]

        },
				
        options:{}
    });
</script>

<script  src="/Student eval/js/app.js"></script>
</body>
</html>