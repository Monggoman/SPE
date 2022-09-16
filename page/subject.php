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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST["join_sub"])) {
		$sub_id = $_POST['subject'];
		$id = trim($_SESSION['user_id']);
		$sql1 = mysqli_query($conn,"SELECT * FROM records WHERE fsub_id = '$sub_id' AND fstud_id = '$id'");
		$check_user = mysqli_num_rows($sql1);

		if($check_user==0){
		
		$sql = "INSERT INTO records ( fsub_id, subj_name, fstud_id, fac_id, Fname, Lname, sec_name ) 	VALUE (	'$sub_id',(SELECT sub_name FROM subject WHERE sub_id = '$sub_id'),'$id',(SELECT fk_fac_id FROM subject WHERE sub_id = '$sub_id'),(SELECT user_fname FROM user WHERE user_id = '$id' ),(SELECT user_lname FROM user WHERE user_id = '$id' ),(SELECT sec_name FROM section WHERE fuser_id= '$id' ))";
		if ($conn->query($sql) == TRUE) {
      echo '<script> alert("Data successfully Updated.") </script>';
      echo '<script> window.location.href="/Student eval/page/subject.php" </script>';
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
	}else{
		echo '<script> alert("Subject Already Registered.") </script>';
	}
	}
}


?>

<script>
	document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.fixed-action-btn');
    M.FloatingActionButton.init(elems);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('.fixed-action-btn').floatingActionButton();
  });

	document.addEventListener('DOMContentLoaded', function() {
    var elems1 = document.querySelectorAll('.modal');
    M.Modal.init(elems1);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('.modal').modal();
  });
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
				<li><a href="/Student eval/page/home.php" class="waves-effect">Home</a></li>
				<li><div class="divider"></div></li>
				<li><a href="/Student eval/page/account.php" class="waves-effect" disabled>Account</a></li>
				<li><div class="divider"></div></li>
				<li><a href="#" class="waves-effect">Subject</a></li>
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
			<form action="subject.php" method="post">
				<div class="recipes container grey-text text-darken-1">
					<div class="card-panel1 recipe white row">
					<?php  if (isset($_SESSION['user_name'])) { ?>
						<h5>Welcome <?php echo $_SESSION["user_name"]; ?></h5> <?php } ?>
							<br>
							<div></div>
							
							<div class="box2">
							<button  id="add_sub"  data-target="modal1" class="btn modal-trigger" > Join Class</button>
							</div>
							<br>
							<div></div>
							<div>
								<h6> Class joined </h6>
							</div>
							<br>
							<div></div>
							<div class="box-table">
										<table class="responsive-table">
											<thead>
												<tr>
													<th>Record code</th>
													<th>Subject code</th>
													<th>subject</th>
													
												</tr>
											</thead>
											<tbody>
												<?php
												//include '../db_con.php';
												
												$conn = OpenCon();

												$sql = "SELECT * FROM records WHERE fstud_id = '$_SESSION[user_id]'";
												$result = $conn->query($sql);
												if ($result->num_rows > 0) {
													while ($row = $result->fetch_assoc()) {
														echo "<tr row_id='" . $row["rec_id"] . "'><td>" . $row["rec_id"] . "</td><td>" . $row["fsub_id"] . "</td></td>" . "<td>" . $row["subj_name"] . "</td>";
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
				
				<div class="fixed-action-btn modal-trigger" href="#modal1">
					<a class="btn-floating btn-large red">
						<i class="large material-icons">add</i>
					</a>
				</div>
					<div id="modal1" class="modal">
						<div class="modal-content">
							<div class="txt_fld">
							<h4>Join Class</h4>
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
							<div class="modal-footer">
								<button name="join_sub" class="modal-close waves-effect waves-green btn-flat">Join Subject</a>
							</div>
							
						</div>
						
					</div>
			
				
			</form>
		

  




  
  <script  src="/student eval/js/app.js"></script>
</body>
</html>