<?php
if (isset($_POST['login-submit'])) {

	require 'dbh.inc.php';

	$mailuid = $_POST['mailuid'];
	$password = $_POST['pwd'];

	if (empty($mailuid) || empty($password)) {
		header("Location: ../login.php?error=emptyfields");
		exit();
	}
	else {



		$sql = "SELECT * FROM pjiang_users WHERE uidUsers=? OR emailUsers=?;";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../login.php?error=sqlerror");
			exit();
		}
		else {
			mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt); //store results

			mysqli_stmt_bind_result($stmt, $dbIdUsers, $dbUidUsers, $dbEmailUsers, $dbPwdUsers);
			while (mysqli_stmt_fetch($stmt)) {
				$idUsers = $dbIdUsers;
				$uidUsers = $dbUidUsers;
				$emailUsers = $dbEmailUsers;
				$pwdUsers = $dbPwdUsers;
			}

			if (!empty($idUsers) && !empty($uidUsers) && !empty($emailUsers) && !empty($pwdUsers)) { 

				$pwdCheck = password_verify($password, $pwdUsers);
				if ($pwdCheck == false) {																					
					header("Location: ../login.php?error=wrongpwd&mailuid=".$mailuid);
					exit();
				}
				else if ($pwdCheck == true) {
					session_start();
					$_SESSION['userId'] = $idUsers;
					$_SESSION['userUid'] = $uidUsers;

					header("Location: ../index.php?login=success");
					exit();
				}
				else {
					header("Location: ../login.php?error=wrongpwd&&mailuid=".$mailuid);
					exit();
				}
			}

			else {
				header("Location: ../login.php?error=nouser");
				exit();
			}
		}
	}
}
else {
	header("Location: ../login.php");
	exit();
}