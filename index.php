<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPE</title>
		<link rel="icon" href="/Student eval/img/logo1.png">
    <link type="text/css" href="/student eval/css/materialize.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" href="/student eval/css/style.css" rel="stylesheet">
    <script type="text/javascript" src="js/materialize.min.js"></script>
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
        
      

    </style>

    
</head>
<?php


error_reporting(0);
ini_set('display_errors', 0);
	session_start();
	$con = mysqli_connect('localhost','root','',"spe_website");
	if(isset($_POST['login_btn'])){
		$username = $_POST['user_name'];
		$password = $_POST['user_pass'];
		$q = mysqli_query($con, "SELECT * FROM user WHERE username = '$username' AND user_pass = '$password'");
		$row = mysqli_fetch_array($q);
		$user_type = $row['user_type'];
		$user_id = $row['user_id'];

		$isexist = mysqli_query($con, "SELECT * FROM user WHERE username = '$username' AND user_pass= '$password'");
		$check_user = mysqli_num_rows($isexist);

		if($check_user==1){
			$_SESSION["user_type"] = $row['user_type'];
			//$_SESSION["user_name"] = $row['user_name'];
			$_SESSION["user_id"] = $row['user_id'];

			if($user_type == "Admin"){
				$_SESSION["user_name"] = "$username";
				$_SESSION["user_id"] = "$user_id";
				echo '<script> alert("LOGIN AS ADMIN")</script>';
				echo '<script> window.location.href = "/Student eval/page/admin.php"</script>';
			}elseif($user_type == "Faculty"){
				$_SESSION["user_name"] = "$username";
				$_SESSION["user_id"] = "$user_id";
				echo '<script> alert("LOGIN AS Faculty")</script>';
				echo '<script> window.location.href = "/Student eval/page/f_home.php"</script>';
			}elseif($user_type == "Student"){
				$_SESSION["user_name"] = "$username";
				$_SESSION["user_id"] = "$user_id";
				echo '<script> alert("LOGIN AS Student")</script>';
				echo '<script> window.location.href = "/Student eval/page/home.php"</script>';
			}elseif($user_type == "Parent"){
				$_SESSION["user_name"] = "$username";
				$_SESSION["user_id"] = "$user_id";
				echo '<script> alert("LOGIN AS Parent")</script>';
				echo '<script> window.location.href = "/Student eval/page/p_home.php"</script>';
			}else{
				echo '<script> alert("Invalid username")</script>';
			}
		}else{
			echo '<script> alert("Invalid username and password")</script>';
		}
	}
?>
<body class="grey lighten-4">

    <!-- top nav -->
  <nav class="z-depth-0">
    <div class="nav-wrapper container">
      <a href="#">Student<span>Performance</span>Evaluator</a>
      
    </div>
  </nav>

  <div class="Cbox">
    <h1>Welcome!</h1>
    <form method="post">
        <div class="txt_fld">
            <input type="text" name="user_name"required>
            <span></span>
            <label>Username</label>
        </div>
        <div class="txt_fld">
            <input type="password" name="user_pass"required>
            <span></span>
            <label>Password</label>
        </div>
        
        
        <input type="submit" value="Login" name="login_btn" >
        <div class="signup1">
            Don't have account?<a href="/student eval/page/register.php">Sign up</a>
        </div>
    </form>	
</div>


<script  src="/student eval/js/app.js"></script>
</body>
</html>