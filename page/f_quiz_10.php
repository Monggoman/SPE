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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // to press Save button
  if (isset($_POST["submit_q"])) {
		$conn = OpenCon();

		$ass_id = $_SESSION['ass_id'];
		//1stquestion
		$first_q = $_POST['first_q'];
		//choices
		$first_a_ch = $_POST['1_first_ch'];
		$first_b_ch = $_POST['1_second_ch'];
		$first_c_ch = $_POST['1_third_ch'];
		$first_d_ch = $_POST['1_fourth_ch'];
		//position
		$a_pos = 'A' ;
		$b_pos = 'B';
		$c_pos = 'C';
		$d_pos = 'D';

		$q_1 = '1';
		$q_2 = '2';
		$q_3 = '3';
		$q_4 = '4';
		$q_5 = '5';
		$q_6 = '6';
		$q_7 = '7';
		$q_8 = '8';
		$q_9 = '9';
		$q_10 = '10';
		//answer
		$first_answer = $_POST['1st_answer'];


		//First question
		$sql = "INSERT INTO quiz_question (f_ass_id, que_title, ans_opt, que_no) value ('$ass_id','$first_q','$first_answer', '$q_1')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$first_q'),'$first_a_ch','$a_pos')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$first_q'),'$first_b_ch','$b_pos')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$first_q'),'$first_c_ch','$c_pos')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$first_q'),'$first_d_ch','$d_pos')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

		//2stquestion
		$second_q = $_POST['second_q'];
		//choices
		$second_a_ch = $_POST['2_first_ch'];
		$second_b_ch = $_POST['2_second_ch'];
		$second_c_ch = $_POST['2_third_ch'];
		$second_d_ch = $_POST['2_fourth_ch'];
		//position
		
		//answer
		$second_answer = $_POST['2nd_answer'];

		//2nd question
		$sql = "INSERT INTO quiz_question (f_ass_id, que_title, ans_opt, que_no) value ('$ass_id','$second_q','$second_answer', '$q_2')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$second_q'),'$second_a_ch','$a_pos')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$second_q'),'$second_b_ch','$b_pos')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$second_q'),'$second_c_ch','$c_pos')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$second_q'),'$second_d_ch','$d_pos')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

		//3rdquestion
		$third_q = $_POST['third_q'];
		//choices
		$third_a_ch = $_POST['3_first_ch'];
		$third_b_ch = $_POST['3_second_ch'];
		$third_c_ch = $_POST['3_third_ch'];
		$third_d_ch = $_POST['3_fourth_ch'];
		//position
		
		//answer
		$third_answer = $_POST['3rd_answer'];

		//3rd question
		$sql = "INSERT INTO quiz_question (f_ass_id, que_title, ans_opt, que_no) value ('$ass_id','$third_q','$third_answer','$q_3')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$third_q'),'$third_a_ch','$a_pos')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$third_q'),'$third_b_ch','$b_pos')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$third_q'),'$third_c_ch','$c_pos')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$third_q'),'$third_d_ch','$d_pos')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

		//3rdquestion
		$fourth_q = $_POST['fourth_q'];
		//choices
		$fourth_a_ch = $_POST['4_first_ch'];
		$fourth_b_ch = $_POST['4_second_ch'];
		$fourth_c_ch = $_POST['4_third_ch'];
		$fourth_d_ch = $_POST['4_fourth_ch'];
		//position
		
		//answer
		$fourth_answer = $_POST['4th_answer'];

		$sql = "INSERT INTO quiz_question (f_ass_id, que_title, ans_opt, que_no) value ('$ass_id','$fourth_q','$fourth_answer', '$q_4')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$fourth_q'),'$fourth_a_ch','$a_pos')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$fourth_q'),'$fourth_b_ch','$b_pos')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$fourth_q'),'$fourth_c_ch','$c_pos')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$fourth_q'),'$fourth_d_ch','$d_pos')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

		//5thquestion
		$fifth_q = $_POST['fifth_q'];
		//choices
		$fifth_a_ch = $_POST['5_first_ch'];
		$fifth_b_ch = $_POST['5_second_ch'];
		$fifth_c_ch = $_POST['5_third_ch'];
		$fifth_d_ch = $_POST['5_fourth_ch'];
		//position
		
		//answer
		$fifth_answer = $_POST['5th_answer'];

		$sql = "INSERT INTO quiz_question (f_ass_id, que_title, ans_opt, que_no) value ('$ass_id','$fifth_q','$fifth_answer', '$q_5')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$fifth_q'),'$fifth_a_ch','$a_pos')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$fifth_q'),'$fifth_b_ch','$b_pos')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$fifth_q'),'$fifth_c_ch','$c_pos')";
		if ($conn->query($sql) == TRUE) {
      

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$fifth_q'),'$fifth_d_ch','$d_pos')";
		if ($conn->query($sql) == TRUE) {
			

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

		//6stquestion
		$sixth_q = $_POST['sixth_q'];
		//choices
		$sixth_a_ch = $_POST['6_first_ch'];
		$sixth_b_ch = $_POST['6_second_ch'];
		$sixth_c_ch = $_POST['6_third_ch'];
		$sixth_d_ch = $_POST['6_fourth_ch'];
		
		
		//answer
		$sixth_answer = $_POST['6th_answer'];


		//sixth question
		$sql = "INSERT INTO quiz_question (f_ass_id, que_title, ans_opt, que_no) value ('$ass_id','$sixth_q','$sixth_answer', '$q_6')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$sixth_q'),'$sixth_a_ch','$a_pos')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$sixth_q'),'$sixth_b_ch','$b_pos')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$sixth_q'),'$sixth_c_ch','$c_pos')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$sixth_q'),'$sixth_d_ch','$d_pos')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		//7thquestion
		$seventh_q = $_POST['seventh_q'];
		//choices
		$seventh_a_ch = $_POST['7_first_ch'];
		$seventh_b_ch = $_POST['7_second_ch'];
		$seventh_c_ch = $_POST['7_third_ch'];
		$seventh_d_ch = $_POST['7_fourth_ch'];
		//position
		
		//answer
		$seventh_answer = $_POST['7th_answer'];

		//7th question
		$sql = "INSERT INTO quiz_question (f_ass_id, que_title, ans_opt, que_no) value ('$ass_id','$seventh_q','$seventh_answer', '$q_7')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$seventh_q'),'$seventh_a_ch','$a_pos')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$seventh_q'),'$seventh_b_ch','$b_pos')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$seventh_q'),'$seventh_c_ch','$c_pos')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$seventh_q'),'$seventh_d_ch','$d_pos')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		//8thquestion
		$eigth_q = $_POST['eigth_q'];
		//choices
		$eigth_a_ch = $_POST['8_first_ch'];
		$eigth_b_ch = $_POST['8_second_ch'];
		$eigth_c_ch = $_POST['8_third_ch'];
		$eigth_d_ch = $_POST['8_fourth_ch'];
		//position
		
		//answer
		$eigth_answer = $_POST['8th_answer'];

		//8th question
		$sql = "INSERT INTO quiz_question (f_ass_id, que_title, ans_opt, que_no) value ('$ass_id','$eigth_q','$eigth_answer', '$q_8')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$eigth_q'),'$eigth_a_ch','$a_pos')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$eigth_q'),'$eigth_b_ch','$b_pos')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$eigth_q'),'$eigth_c_ch','$c_pos')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$eigth_q'),'$eigth_d_ch','$d_pos')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		//9thquestion
		$ninth_q = $_POST['ninth_q'];
		//choices
		$ninth_a_ch = $_POST['9_first_ch'];
		$ninth_b_ch = $_POST['9_second_ch'];
		$ninth_c_ch = $_POST['9_third_ch'];
		$ninth_d_ch = $_POST['9_fourth_ch'];
		//position
		
		//answer
		$ninth_answer = $_POST['9th_answer'];

		$sql = "INSERT INTO quiz_question (f_ass_id, que_title, ans_opt, que_no) value ('$ass_id','$ninth_q','$ninth_answer', '$q_9')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$ninth_q'),'$ninth_a_ch','$a_pos')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$ninth_q'),'$ninth_b_ch','$b_pos')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$ninth_q'),'$ninth_c_ch','$c_pos')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$ninth_q'),'$ninth_d_ch','$d_pos')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}

		//10thquestion
		$tenth_q = $_POST['tenth_q'];
		//choices
		$tenth_a_ch = $_POST['10_first_ch'];
		$tenth_b_ch = $_POST['10_second_ch'];
		$tenth_c_ch = $_POST['10_third_ch'];
		$tenth_d_ch = $_POST['10_fourth_ch'];
		//position
		
		//answer
		$tenth_answer = $_POST['10th_answer'];

		$sql = "INSERT INTO quiz_question (f_ass_id, que_title, ans_opt, que_no) value ('$ass_id','$tenth_q','$tenth_answer', '$q_10')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$tenth_q'),'$tenth_a_ch','$a_pos')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$tenth_q'),'$tenth_b_ch','$b_pos')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$tenth_q'),'$tenth_c_ch','$c_pos')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO q_option (qque_id,opt_title,opt_position)VALUE ((SELECT que_id FROM quiz_question WHERE que_title = '$tenth_q'),'$tenth_d_ch','$d_pos')";
		if ($conn->query($sql) == TRUE) {
			

		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}


		$sql = "UPDATE assessment set status = 'Question Ready' WHERE ass_id = '$ass_id'";
		if ($conn->query($sql) == TRUE) {
			echo '<script>
			window.alert("Question added");
			</script>';
			echo '<script> window.location.href="/Student eval/page/f_quiz.php" </script>';

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
      <a href="/Student eval/page/f_home.php">Student<span>Performance</span>Evaluator</a>
			

      <span class="right grey-text text-darken-1">
    
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
    <li><a href="evaluator.html" class="waves-effect">Performance Evaluator</a></li>
    <li><div class="divider"></div></li>
		<li style="padding: 0 32px;">
		<?php  if (isset($_SESSION['user_name'])) { ?>
      <div class="chip" >
				<?php echo $_SESSION["user_name"]; echo $_SESSION["user_id"];   ?>	
			</div>
			<div class="chip" name="logout" >
				<a href="/Student eval/index.php">logout</a>
			</div>
			<?php } ?>
		</li>
  </ul> 

	<form action="f_quiz_10.php" method="POST">
  <div class="recipes container grey-text text-darken-1">
		<div class="card-panel recipe1 white row">
		<div>	
			<h3> Quiz questions </h3>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="first_q" required>
			<span></span>
			<label>First Question</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="1_first_ch" required>
			<span></span>
			<label name="A">A</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="1_second_ch" required>
			<span></span>
			<label name="B">B</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="1_third_ch" required>
			<span></span>
			<label name="C">C</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="1_fourth_ch" required>
			<span></span>
			<label name="D">D</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="1st_answer" required>
			<span></span>
			<label>Answer</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="second_q" required>
			<span></span>
			<label>Second Question</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="2_first_ch" required>
			<span></span>
			<label>A</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="2_second_ch" required>
			<span></span>
			<label>B</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="2_third_ch" required>
			<span></span>
			<label>C</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="2_fourth_ch" required>
			<span></span>
			<label>D</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="2nd_answer" required>
			<span></span>
			<label>Answer</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="third_q" required>
			<span></span>
			<label>Third Question</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="3_first_ch" required>
			<span></span>
			<label>A</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="3_second_ch" required>
			<span></span>
			<label>B</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="3_third_ch" required>
			<span></span>
			<label>C</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="3_fourth_ch" required>
			<span></span>
			<label>D</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="3rd_answer" required>
			<span></span>
			<label>Answer</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="fourth_q" required>
			<span></span>
			<label>Fourth Question</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="4_first_ch" required>
			<span></span>
			<label>A</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="4_second_ch" required>
			<span></span>
			<label>B</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="4_third_ch" required>
			<span></span>
			<label>C</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="4_fourth_ch" required>
			<span></span>
			<label>D</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="4th_answer" required>
			<span></span>
			<label>Answer</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="fifth_q" required>
			<span></span>
			<label>Fifth Question</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="5_first_ch" required>
			<span></span>
			<label>A</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="5_second_ch" required>
			<span></span>
			<label>B</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="5_third_ch" required>
			<span></span>
			<label>C</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="5_fourth_ch" required>
			<span></span>
			<label>D</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="5th_answer" required>
			<span></span>
			<label>Answer</label>
		</div>
		<br>
		<div>
		</div>
		<!-- 5-10th -->
		<div class="txt_fld">
			<input type="text" name="sixth_q" required>
			<span></span>
			<label>Sixth Question</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="6_first_ch" required>
			<span></span>
			<label name="A">A</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="6_second_ch" required>
			<span></span>
			<label name="B">B</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="6_third_ch" required>
			<span></span>
			<label name="C">C</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="6_fourth_ch" required>
			<span></span>
			<label name="D">D</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="6th_answer" required>
			<span></span>
			<label>Answer</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="seventh_q" required>
			<span></span>
			<label>Seventh Question</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="7_first_ch" required>
			<span></span>
			<label>A</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="7_second_ch" required>
			<span></span>
			<label>B</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="7_third_ch" required>
			<span></span>
			<label>C</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="7_fourth_ch" required>
			<span></span>
			<label>D</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="7th_answer" required>
			<span></span>
			<label>Answer</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="eigth_q" required>
			<span></span>
			<label>Eigth Question</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="8_first_ch" required>
			<span></span>
			<label>A</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="8_second_ch" required>
			<span></span>
			<label>B</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="8_third_ch" required>
			<span></span>
			<label>C</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="8_fourth_ch" required>
			<span></span>
			<label>D</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="8th_answer" required>
			<span></span>
			<label>Answer</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="ninth_q" required>
			<span></span>
			<label>Ninth Question</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="9_first_ch" required>
			<span></span>
			<label>A</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="9_second_ch" required>
			<span></span>
			<label>B</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="9_third_ch" required>
			<span></span>
			<label>C</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="9_fourth_ch" required>
			<span></span>
			<label>D</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="9th_answer" required>
			<span></span>
			<label>Answer</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="tenth_q" required>
			<span></span>
			<label>Tenth Question</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="10_first_ch" required>
			<span></span>
			<label>A</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="10_second_ch" required>
			<span></span>
			<label>B</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="10_third_ch" required>
			<span></span>
			<label>C</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="10_fourth_ch" required>
			<span></span>
			<label>D</label>
		</div>
		<br>
		<div>
		</div>
		<div class="txt_fld">
			<input type="text" name="10th_answer" required>
			<span></span>
			<label>Answer</label>
		</div>
		<br>
		<div>
		</div>

		<div>
			<button name = "submit_q" class="btn waves-effect waves-green">Submit Questions</button>
		</div>
        
            
    
    </div>
	</div>
	</form>
    

    
  



<script  src="/Student eval/js/app.js"></script>
</body>
</html>