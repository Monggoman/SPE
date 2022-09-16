<?php

//fetch.php
header('Content-Type: application/json');
include '../db_con.php';
$conn = OpenCon();

if(isset($_POST["year"]))
{
 $query = "
 SELECT ass_name, f_sub, history.score FROM assessment LEFT JOIN history ON history.f_ass_id = assessment.ass_id
 WHERE f_sub = '".$_POST["subject"]."' 
 ";
 $result = mysqli_query($conn,$query);

 foreach ($result as $row) {
	 $data[] = array(
		'Quiz'   => $row["ass_name"],
		'score'  => floatval($row["score"])
	 );
 }
 
 mysqli_close($conn);
 echo json_encode($data);
}

?>