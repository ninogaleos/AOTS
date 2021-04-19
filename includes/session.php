<?php

	session_start();
	include('includes/connection.php');
	
	if (!isset($_SESSION['log_id']) ||(trim ($_SESSION['log_id']) == '')) {
	header('location:../index.php');
    exit();
	}
	$stmt="select * from `log_tb` where log_id='".$_SESSION['log_id']."'";
    $stmt = $conn->prepare($stmt);
    $user = $stmt->fetch();
    $id=$user['log_id'];
    $type=$user['log_type'];

?>