<?php

	if (isset($_POST["submit"])) {

		$account = $_POST["account"];
		$pwd = $_POST["pwd"];

		require_once 'database.inc.php';
		require_once 'function.inc.php';

		if (emptyInputLogin($account, $pwd) !== false) {
			header("location: ../signup.php?error=emptyinput");
			exit();
		}

		loginUser($conn, $account, $pwd);
	}else {
		header("location: ../login.php");
	}

?>