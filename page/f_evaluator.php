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

	

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$user_id = $_POST['student'];

	
	

	if (isset($_POST["show_gen"])) {
		$query = "	SELECT subject.sub_name, SUM(score)*100/ SUM(assessment.Total_q) AS percent FROM history
								LEFT JOIN assessment ON
								assessment.ass_id = history.f_ass_id
								LEFT JOIN subject ON
								assessment.f_sub = subject.sub_id
								WHERE f_user_id = '$user_id' GROUP BY subject.sub_id";
		$result2 = mysqli_query($conn,$query);
		foreach ($result2 as $row2) {
			$quiz1[]= $row2['sub_name'];
			$score1[] = $row2['percent'];
			
		}

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
    <li><a href="#" class="waves-effect">Performance Evaluator</a></li>
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
			<form action="f_evaluator.php" method="POST">
			

	<div class="recipes container grey-text text-darken-1">
	
		<div class="card-panel recipe1 white row">	
			<div>
			<select class='dropdown-trigger btn' name="student" > 
									<option selected disabled> Choose Student</option>
									<?php
									$conn = OpenCon();
									$get_opt= "select fuser_id_stud, `user`.user_fname from `student` Left JOIN `user` ON `user`.user_id = `student`.fuser_id_stud; "; 
										$run_opt=mysqli_query($conn, $get_opt); 
										While ($row_cats=mysqli_fetch_array($run_opt)){ 
												$sub_id=$row_cats['fuser_id_stud']; 
												$sub_name=$row_cats['user_fname']; 
												Echo "<option value='$sub_id'>$sub_name</option>"; 
										}
									?> 
							</select>
		</div>	
		<br>
		<div></div>			
								<button  id="show_gen" name="show_gen"   class="btn " > Show Graph per Subject</button>
					
		<br>
		<div></div>
				<button    data-target="modal5" class="btn orange modal-trigger" > Generate Analysis</button>
		<br>
		<div></div>
		<div >
					<canvas id="perChart"></canvas></div>
		
		<br>
		<div></div>
		</div>
	</div>
				<div id="modal5" class="modal">
						<div class="modal-content">
							<div >
								
									<label>Performance Analysis</label>
									<?php
									$min = min($score1);
										
											for($y=0;$y<count($score1);$y+=1){
												if($score1[$y]==$min){
													$min_t = $quiz1[$y]; ?>
														<p>Lowest Subject: <?php echo $min_t; ?> </p> <?php
												}
											}
										
									?>
									<p>	<?php echo min($score1),"%";?></p>
									<?php
									$min = max($score1);
										
											for($y=0;$y<count($score1);$y+=1){
												if($score1[$y]==$min){
													$min_t = $quiz1[$y]; ?>
														<p>Highest Subject: <?php echo $min_t; ?> </p> <?php
												}
											}
										
									?>
									<p>	<?php echo max($score1),"%";?></p>
									
						</div>
							<div class="modal-footer">
								<button  class="modal-close waves-effect waves-green btn-flat">Close</a>
							</div>
					</div>
				</div>  
										

    
  
</form>



<script>



document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.tooltipped');
    var instances = M.Tooltip.init(elems, options);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('.tooltipped').tooltip();
  });


</script>

<script>
const labels = <?php echo json_encode($quiz1) ?>;
const data = {
  labels: labels,
  datasets: [{
    label: 'Percentage per subject',
    data: <?php echo json_encode($score1) ?>,
    backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
    borderWidth: 1
  }]
};


const config = {
  type: 'bar',
  data: data,
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  },
};





</script>

<script>
  const myChart1 = new Chart(
    document.getElementById('perChart'),
    config
  );
</script>





<script  src="/Student eval/js/app.js"></script>
</body>
</html>