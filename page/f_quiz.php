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


$target = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // to press Save button
  if (isset($_POST["add"])) {
    //$emp_id_no = 4
    
    $ass_name = $_POST["ass_name"];
    $duedate = $_POST["due_date"];
    $total_q = $_POST["Total_q"];
		$subject = $_POST["subject"];
		$fac_id = $_SESSION["user_id"];
    
    
    // move uploaded pic from temp folder to permanent folder
    
    // database connection
    
    $conn = OpenCon();
    
    $sql = "INSERT INTO assessment ( fk_fac_id,f_sub, ass_name, ass_due_date, Total_q) VALUES ('$fac_id','$subject' ,'$ass_name', '$duedate', '$total_q')";
		
    if ($conn->query($sql) == TRUE) {
      echo '<script>
			window.alert("Assessment added");
			</script>';

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
	}
	if (isset($_POST["del_sub"])) {
    //$emp_id_no = 4
    
    $del_sub = $_POST["Delete_sub"];
    $fac_id = $_SESSION["user_id"];
    
    
    // move uploaded pic from temp folder to permanent folder
    
    // database connection
    
    $conn = OpenCon();
    
    $sql = "DELETE FROM assessment WHERE ass_id = $del_sub";
    if ($conn->query($sql) == TRUE) {
      echo '<script> alert("Data successfully deleted.") </script>';
      echo '<script> window.location.href="/Student eval/page/f_quiz.php" </script>';
    }
		$conn->close();
	}
	if (isset($_POST["add_quest"])) {
    //$emp_id_no = 4
    
    $add_q = $_POST["add_question"];
    $fac_id = $_SESSION["user_id"];
    
    
    // move uploaded pic from temp folder to permanent folder
    
    // database connection
    
    
    $con = mysqli_connect('localhost','root','',"spe_website");
    $sql = mysqli_query($con, "SELECT ass_id, Total_q, status FROM assessment WHERE ass_id = '$add_q'");
		$row = mysqli_fetch_array($sql);
		$total_q = $row['Total_q'];
		$status = $row['status'];
		$_SESSION['ass_id'] = $row['ass_id'];
    
		if($status == 'No question')
		{
		if($total_q == 5){
		
			echo '<script> window.location.href="/Student eval/page/f_quiz_5.php" </script>';
		} elseif ($total_q == 10){
			echo '<script> window.location.href="/Student eval/page/f_quiz_10.php" </script>';
		}  elseif ($total_q == 20){
			echo '<script> window.location.href="/Student eval/page/f_quiz_20.php" </script>';
		}
		
		$conn->close();
		}
		else{
			echo '<script>
			window.alert("Questions already added");
			</script>';
		}
	}
	if (isset($_POST["add_act"])) {

		$act_name = $_POST["act_title"];
		$duedate = $_POST["due_date1"];
	
		$subject = $_POST["subject1"];
		$fac_id = $_SESSION["user_id"];
		
		
		// move uploaded pic from temp folder to permanent folder
		
		// database connection
		
		$conn = OpenCon();
		$sql = "INSERT INTO activity ( fr_fac_id,fr_sub, act_title, act_d_date ) VALUES ('$fac_id','$subject' ,'$act_name', '$duedate')";
		if ($conn->query($sql) == TRUE) {
			echo '<script>
			window.alert("Activity added");
			</script>';

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

	}
	if (isset($_POST["del_act"])) {
    //$emp_id_no = 4
    
    $del_act = $_POST["remove_act"];
    $fac_id = $_SESSION["user_id"];
    
    
    // move uploaded pic from temp folder to permanent folder
    
    // database connection
    
    $conn = OpenCon();
    
    $sql = "DELETE FROM activity WHERE act_id = $del_act";
    if ($conn->query($sql) == TRUE) {
      echo '<script> alert("Data successfully deleted.") </script>';
      echo '<script> window.location.href="/Student eval/page/f_quiz.php" </script>';
    }
		$conn->close();
	}
	if (isset($_POST["add_ins"])) {

		$fact_id = $_POST['ins_code'];
		$ins_desc = $_POST['ins_desc'];
		$conn = OpenCon();

		$sql = "INSERT INTO act_ins ( fact_id, ins_title) VALUES ('$fact_id','$ins_desc' )";
		if ($conn->query($sql) == TRUE) {
   
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$c_value = $_POST['c_value'];
		$c_title = $_POST['c_title'];
		$c_desc = $_POST['c_desc'];

		$sql = "INSERT INTO ins_criteria ( f_act_ins, cri_title, cri_desc, cri_value ) VALUES ((SELECT ins_id FROM act_ins WHERE ins_title = '$ins_desc'),'$c_title' ,'$c_desc', '$c_value')";
		if ($conn->query($sql) == TRUE) {
   
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		if($_POST['c_value2'] != NULL){
			$c_value2 = $_POST['c_value2'];
			$c_title2 = $_POST['c_title2'];
			$c_desc2 = $_POST['c_desc2'];

			$sql = "INSERT INTO ins_criteria ( f_act_ins, cri_title, cri_desc, cri_value ) VALUES ((SELECT ins_id FROM act_ins WHERE ins_title = '$ins_desc'),'$c_title2' ,'$c_desc2', '$c_value2')";
			if ($conn->query($sql) == TRUE) {
		
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		if($_POST['c_value3'] != NULL){
			$c_value3 = $_POST['c_value3'];
			$c_title3 = $_POST['c_title3'];
			$c_desc3 = $_POST['c_desc3'];

			$sql = "INSERT INTO ins_criteria ( f_act_ins, cri_title, cri_desc, cri_value ) VALUES ((SELECT ins_id FROM act_ins WHERE ins_title = '$ins_desc'),'$c_title3' ,'$c_desc3', '$c_value3')";
			if ($conn->query($sql) == TRUE) {
		
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		if($_POST['c_value4'] != NULL){
			$c_value4 = $_POST['c_value4'];
			$c_title4 = $_POST['c_title4'];
			$c_desc4 = $_POST['c_desc4'];

			$sql = "INSERT INTO ins_criteria ( f_act_ins, cri_title, cri_desc, cri_value ) VALUES ((SELECT ins_id FROM act_ins WHERE ins_title = '$ins_desc'),'$c_title4' ,'$cri_desc4', '$c_value4')";
			if ($conn->query($sql) == TRUE) {
		
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		if($_POST['c_value5'] != NULL){
			$c_value5 = $_POST['c_value5'];
			$c_title5 = $_POST['c_title5'];
			$c_desc5 = $_POST['c_desc5'];

			$sql = "INSERT INTO ins_criteria ( f_act_ins, cri_title, cri_desc, cri_value ) VALUES ((SELECT ins_id FROM act_ins WHERE ins_title = '$ins_desc'),'$c_title5' ,'$cri_desc5', '$c_value5')";
			if ($conn->query($sql) == TRUE) {
		
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		if($_POST['c_value6'] != NULL){
			$c_value6 = $_POST['c_value6'];
			$c_title6 = $_POST['c_title6'];
			$c_desc6 = $_POST['c_desc6'];

			$sql = "INSERT INTO ins_criteria ( f_act_ins, cri_title, cri_desc, cri_value ) VALUES ((SELECT ins_id FROM act_ins WHERE ins_title = '$ins_desc'),'$c_title6' ,'$cri_desc6', '$c_value6')";
			if ($conn->query($sql) == TRUE) {
		
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		$sql = "UPDATE activity SET status = 'Instruction ready'  WHERE act_id = '$fact_id'";
		if ($conn->query($sql) == TRUE) {
		
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		


	}
}
	
?>

<script>

	document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    M.Modal.init(elems);
  });

  // Or with jQuery
	$(document).ready( function () {
    $('#student-table').DataTable();		
} );
$(document).ready( function () {
    $('#student-table1').DataTable();		
} );

  $(document).ready(function(){
    $('.modal').modal();
  });

	document.addEventListener('DOMContentLoaded', function() {
    var elems1 = document.querySelectorAll('.datepicker');
    M.Datepicker.init(elems1);
  });

	$('#textarea1').val('New Text');
  M.textareaAutoResize($('#textarea1'));

  // Or with jQuery

 

	

	
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
    <li><a href="/Student eval/page/f_home.php" class="waves-effect" >Home</a></li>
		<li><div class="divider"></div></li>
		<li><a href="/Student eval/page/f_account.php" class="waves-effect">Account</a></li>
    <li><div class="divider"></div></li>
		<li><a href="/Student eval/page/f_student_list.php" class="waves-effect" >Student List</a></li>
    <li><div class="divider"></div></li>
    <li><a href="/Student eval/page/f_records.php" class="waves-effect">Records</a></li>
    <li><div class="divider"></div></li>
    <li><a href="#" class="waves-effect" disabled>Quiz/Activities/Assignments</a></li>
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

	<form action="f_quiz.php" method="post" novalidate>
				<div class="recipes container grey-text text-darken-1">
					<div class="card-panel recipe_re white row">
						<?php  if (isset($_SESSION['user_name'])) { ?>
							<h5>Welcome <?php echo $_SESSION["user_name"]; ?></h5> <?php } ?>
								<br>
								<div></div>
								
								<div class="box2">
								<button  id="rem_student"  data-target="modal1" class="btn modal-trigger" > Add Quiz</button>
								<button  id="rem_ass"  data-target="modal2" class="btn modal-trigger" > Remove Quiz</button>
								<button  id="add_quest"  data-target="modal3" class="btn modal-trigger" > Add Question</button>
							
							
								</div>
								<br>
								<div></div>
								<br>
								<div class="box-table">
									<h6> Quiz List </h6>
										<table  class="responsive-table" id="student-table">
											<thead>
												<tr>
													<th>
													Quiz Code
													</th>
													<th>Faculty ID</th>
													<th>Subject Code</th>
													<th>Assessment Name</th>
													<th>Due Date</th>
													<th>Total Question</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<?php
												//include '../db_con.php';
												
												$conn = OpenCon();
											

												$sql = "SELECT * FROM assessment WHERE fk_fac_id = '$_SESSION[user_id]'";
												$result = $conn->query($sql);
												
												if ($result->num_rows > 0) {
													while ($row = $result->fetch_assoc()) {
														echo "<tr row_id='" . $row["ass_id"] . "'><td>" . $row["ass_id"] . "</td><td>" . $row["fk_fac_id"] . "</td></td>". "<td>" . $row["f_sub"] . "</td></td>" . "<td>" . $row["ass_name"] . "</td></td>"  . "<td>" . $row["ass_due_date"] . "</td></td>" . "<td id='total'>".$row["Total_q"] . "</td><td>" . $row["status"] . "</td>";
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
								<div id="modal1" class="modal">
										<div class="modal-content">
											<div class="txt_fld">
											<h4>Assessment</h4>
												<input type="text" name="ass_name" required>
													<span></span>
													<label>Quiz name</label>
											</div>
											<div class="txt_fld">
												<input type="datetime-local" name="due_date" required>
													<span></span>
													<label>Due Date</label>
											</div>
											<div class="input_field" >
												<select class='dropdown-trigger btn' name ="Total_q">
													<option selected disabled>Total Number of Questions</option>
													<option value ="5">5</option>
													<option value="10">10</option>
													<option value="20">20</option>
												</select>
											</div>
											<br>
											<div>
												<select class='dropdown-trigger btn' name="subject"> 
														<option selected  disabled> Choose the Subject</option>
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
												<button name="add" class="modal-close waves-effect waves-green btn-flat">Add Quiz</a>
											</div>
							
										</div>
									</div>
								<div id="modal2" class="modal">
										<div class="modal-content">
											<h4>Remove Quiz</h4>
											<div class="txt_fld">
												<input type="number" name="Delete_sub" required>
													<span></span>
													<label>Input Quiz Code</label>
											</div>
											
										</div>
										<div class="modal-footer">
											<button name="del_sub" class="modal-close waves-effect waves-green btn-flat">Delete Quiz</a>
										</div>
									</div>
									<div id="modal3" class="modal">
										<div class="modal-content">
											<h4>Add Question</h4>
											<div class="txt_fld">
												<input type="number" name="add_question" required>
													<span></span>
													<label>Input Quiz Code</label>
											</div>
											
										</div>
										<div class="modal-footer">
											<button name="add_quest" class="modal-close waves-effect waves-green btn-flat">Add Question</a>
										</div>
									</div>
									
						
					</div>
				</div>
			</form>
			<form action="f_quiz.php" method="post" novalidate>
				<div class="recipes container grey-text text-darken-1">
					<div class="card-panel recipe_re white row">
					<div class="box2">
								<button  id="add_act1"  data-target="modal4" class="btn modal-trigger" > Create Activity</button>
								<button  id="rem_act1"  data-target="modal5" class="btn modal-trigger" > Remove Activity</button>
								<button  id="add_ins"  data-target="modal6" class="btn modal-trigger" > Add Instruction</button>				
					</div>
					<br>
					<div></div>
					<div class="box-table">
									<h6> Activity List </h6>
										<table  class="responsive-table" id="student-table1">
											<thead>
												<tr>
													<th>
													Activity Code
													</th>
													<th>Subject Code</th>
													<th>Activity Title</th>
													
													<th>Due Date</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<?php
												//include '../db_con.php';
												
												$conn = OpenCon();
											

												$sql = "SELECT * FROM activity WHERE fr_fac_id = '$_SESSION[user_id]'";
												$result = $conn->query($sql);
												
												if ($result->num_rows > 0) {
													while ($row = $result->fetch_assoc()) {
														echo "<tr row_id='" . $row["act_id"] . "'><td>" . $row["act_id"] . "</td><td>" . $row["fr_sub"] . "</td></td>" . "<td>" . $row["act_title"] . "</td></td>"  . "<td>" . $row["act_d_date"] . "</td></td>" . "<td>" . $row["status"] . "</td>";
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
								<br>
								<div></div>
								<div id="modal4" class="modal">
										<div class="modal-content">
											<div class="txt_fld">
											<h4>Activity</h4>
												<input type="text" name="act_title" required>
													<span></span>
													<label>Activity Title</label>
											</div>
											<div class="txt_fld">
												<input type="datetime-local" name="due_date1" required>
													<span></span>
													<label>Due Date</label>
											</div>
											<br>
											<div>
												<select class='dropdown-trigger btn' name="subject1"> 
														<option selected  disabled> Choose the Subject</option>
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
												<button name="add_act" class="modal-close waves-effect waves-green btn-flat">Create Activity</a>
											</div>
							
										</div>
									</div>
									<br>
									<div></div>
									<div id="modal5" class="modal">
										<div class="modal-content">
											<h4>Remove Activity</h4>
											<div class="txt_fld">
												<input type="number" name="remove_act" required>
													<span></span>
													<label>Input Activity Code</label>
											</div>
											
										</div>
										<div class="modal-footer">
											<button name="del_act" class="modal-close waves-effect waves-green btn-flat">Delete Acivity</a>
										</div>
									</div>
									<div id="modal6" class="modal" data-backdrop="static">
										<div class="modal-content">
											<h4>Add Instructions</h4>
											<div class="txt_fld">
												<input type="number" name="ins_code" required>
													<span></span>
													<label>Input Activity Code</label>
											</div>
											<div class="input-field col s12">
												<textarea id="textarea1" class="materialize-textarea" name="ins_desc"></textarea>
												<label for="textarea1">Instruction</label>
											</div>
											<br>
											<br>
											
											<h4>Create Criteria</h4>
											<div id='TextBoxesGroup'>
												<div id="TextBoxDiv1">
														<div class="txt_fld">
															<input type="number" name="c_value" required>
																<span></span>
																<label>Criteria Value</label>
														</div>
														<div class="txt_fld">
															<input type="text" name="c_title" required>
																<span></span>
																<label>Criteria Name</label>
														</div>
														<div class="txt_fld">
															<input type="text" name="c_desc" required>
																<span></span>
																<label>Criteria Description</label>
														</div>
														
													</div>
												</div>
												<button name="modal6" id="addButton" class="modal-trigger waves-effect waves-green btn" onclick='return false'>Add Criteria</a>
												
											
										</div>
										<div class="modal-footer">
											<button name="add_ins" class="modal-close waves-effect waves-green btn-flat">Add Instruction</a>
										</div>
									</div>
									

					</div>
				</div>
			</form>
<script>
  $(document).ready(function() {
    $('#uploadfile').change(function(e) {
      var formData = new FormData($('#pic-upload')[0]);
      //codes in AJAX for uploading of picture
      $.ajax({
        type: 'POST',
        url: 'upload_pic.php',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(result) {
          if (result.ok) {
            $('#pic-box').html('');
            $('#pic-box').append("<img src='" + result.temp_path + "' style='width:100%'/>");
            $('#picpath').val(result.temp_path);
          } else {
            alert('Error encountered while trying to upload the picture!');
          }
        }
      });
      return false;
    });
  });
</script>

<script type="text/javascript">

			$(document).ready(function(){

					var counter = 2;
					
					$("#addButton").click(function () {
							
				if(counter>6){
									alert("Only 6 textboxes allow");
									return false;
				}   
					
				var newTextBoxDiv = $(document.createElement('div'))
						.attr("id", 'TextBoxDiv' + counter);
											
				newTextBoxDiv.after().html('<div class="txt_fld">'+
															'<input type="number" name="c_value'+counter+'" required>'+
															'	<span></span>'+
															'	<label>Criteria Value</label>'+
														'</div>'+
														'<div class="txt_fld">'+
														'	<input type="text" name="c_title'+counter+'" required>'+
														'		<span></span>'+
															'	<label>Criteria Name</label>'+
													'	</div>'+
														'<div class="txt_fld">'+
															'<input type="text" name="c_desc'+counter+'" required>'+
																'<span></span>'+
																'<label>Criteria Description</label>'+
														'</div>');
									
				newTextBoxDiv.appendTo("#TextBoxesGroup");

							
				counter++;
					});
			});			
</script>		

  <script  src="/Student eval/js/app.js"></script>
</body>
</html>