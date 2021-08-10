<?php
	function getActivity($conn) {
		$sql = "SELECT * FROM activity;";
		$resultData = mysqli_query($conn, $sql);

		if ($resultData) {
			return $resultData;
		}else {
			$result = false;
			return $result;
		}
		mysqli_stmt_close($stmt);
	}

	function orderExisted($conn, $userId, $activityId) {
		$sql = "SELECT * FROM orders WHERE userId=? AND activityId=?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../activity.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "ii", $userId, $activityId);
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

	function getUserOrder($conn, $userId) {
		$sql = "SELECT * FROM orders WHERE userId=?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../activity.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "i", $userId);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);
		$ans = array();

		foreach ($resultData as $row) {
			# code...
			$sql = "SELECT * FROM activity WHERE id=?;";
			if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../activity.php?error=stmtfailed");
			exit();
			}
			mysqli_stmt_bind_param($stmt, "i", $row['activityId']);
			mysqli_stmt_execute($stmt);
			$resultData = mysqli_stmt_get_result($stmt);
			array_push($ans, $resultData);
		}

		return $ans;
		mysqli_stmt_close($stmt);
	}

	function deleteOrder($conn, $userId, $activityId) {
		$sql = "DELETE FROM orders WHERE userId=? AND activityId=?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../index.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "ii", $userId, $activityId);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		header("location: ../index.php?error=none");
		exit();
	}

	function createOrder($conn, $userId, $activityId) {
		$sql = "INSERT INTO orders (userId, activityId) VALUES (?,?);";
		$stmt = mysqli_stmt_init($conn);
		if (orderExisted($conn, $userId, $activityId) !== false) {
			header("location: ../activity.php?error=orderExisted");
			exit();
		}

		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../activity.php?error=stmtfailed");
			exit();
		}

		mysqli_stmt_bind_param($stmt, "ss", $userId, $activityId);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		header("location: ../activity.php?error=none");
		exit();
	}
?>