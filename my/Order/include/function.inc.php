<?php

	function emptyInputSignup($name, $account, $email, $pwd, $pwdrepeat) {
		$result;
		if (empty($name) || empty($account) || empty($email) || empty($pwd) || empty($pwdrepeat)) {
			$result = true;
		}else {
			$result = false;
		}
		return $result;
	}

	function invalidAccount($account) {
		$result;
		if (!preg_match("/^[a-zA-Z0-9]*$/", $account)) {
			$result = true;
		}else {
			$result = false;
		}
		return $result;
	}

	function invalidEmail($email) {
		$result;
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$result = true;
		}else {
			$result = false;
		}
		return $result;
	}

	function pwdMatch($pwd, $pwdrepeat) {
		$result;
		if ($pwd !== $pwdrepeat) {
			$result = true;
		}else {
			$result = false;
		}
		return $result;
	}

	function accountExists($conn, $account) {
		$sql = "SELECT * FROM users WHERE usersAccount = ?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			exit();
		}

		mysqli_stmt_bind_param($stmt, "s", $account);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);

		if ($row = mysqli_fetch_assoc($resultData)) {
			return $row;
		}else {
			$result = false;
			return $result;
		}
		mysqli_stmt_close($stmt);
	}

	function createUser($conn, $name, $account, $email, $pwd) {
		$sql = "INSERT INTO users (usersName, usersAccount, usersEmail, usersPwd) VALUES (?,?,?,?);";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../signup.php?error=stmtfailed");
			exit();
		}

		$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

		mysqli_stmt_bind_param($stmt, "ssss", $name, $account, $email, $hashedPwd);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		header("location: ../signup.php?error=none");
		exit();
		
	}

	function emptyInputLogin($account, $pwd) {
		$result;
		if (empty($account) || empty($pwd)) {
			$result = true;
		}else {
			$result = false;
		}
		return $result;
	}

	function loginUser($conn, $account, $pwd) {
		$userExist = accountExists($conn, $account);

		if ($userExist === false) {
			header("location: ../login.php?error=wronglogin");
			exit();
		}

		$pwdHashed = $userExist["usersPwd"];
		$checkPwd = password_verify($pwd, $pwdHashed);

		if ($checkPwd === false) {
			header("location: ../login.php?error=pwdWrong");
			exit();
		}else if ($checkPwd === true) {
			echo "True";
			session_start();
			$_SESSION["userid"] = $userExist["id"];
			$_SESSION["userName"] = $userExist["usersName"];
			header("location: ../index.php");
			exit();
		}
	}


?>