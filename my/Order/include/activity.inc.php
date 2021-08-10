<?php
	if (isset($_POST["submit"])) {
		session_start();
		$userId = $_SESSION["userid"];
		$activityId = $_POST["input2"];
		require_once 'database.inc.php';
		require_once 'activity_function.inc.php';

		createOrder($conn, $userId, $activityId);
	}else {
		header("location: ../activity.php");
	}
?>