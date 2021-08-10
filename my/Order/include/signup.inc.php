<?php 
	if (isset($_POST["submit"])) {

		$name = $_POST["name"];
		$account = $_POST["account"];
		$email = $_POST["email"];
		$pwd = $_POST["pwd"];
		$pwdrepeat = $_POST["pwdrepeat"];

		require_once 'database.inc.php';
		require_once 'function.inc.php';

		if (emptyInputSignup($name, $account, $email, $pwd, $pwdrepeat) !== false) {
			header("location: ../signup.php?error=emptyinput");
			exit();
		}

		if (invalidAccount($account) !== false) {
			header("location: ../signup.php?error=invalidAccount");
			exit();
		}

		if (invalidEmail($email) !== false) {
			header("location: ../signup.php?error=invalidEmail");
			exit();
		}

		if (pwdMatch($pwd, $pwdrepeat) !== false) {
			header("location: ../signup.php?error=pwdNotMatch");
			exit();
		}

		if (accountExists($conn, $account) !== false) {
			header("location: ../signup.php?error=accountExists");
			exit();
		}

		createUser($conn, $name, $account, $email, $pwd);

	}else {
		echo "Here";
		header("location: ../signup.php");
		exit();
	}
?>