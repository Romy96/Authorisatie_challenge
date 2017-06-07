<?php

function createUser($firstname = null, $prefix = null, $lastname = null, $email = null, $password = null)
{
	$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : null;
	$prefix = isset($_POST['prefix']) ? $_POST['prefix'] : null;
	$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : null;
	$email = isset($_POST['email']) ? $_POST['email'] : null;
	$password = isset($_POST['password']) ? $_POST['password'] : null;
	$hash = md5($password);
	
	if (strlen($firstname) == 0 || strlen($lastname) == 0 || strlen($email) == 0 || strlen($password) == 0) {
		return false;
	}
	
	$db = openDatabaseConnection();


	$sql = "INSERT INTO users(firstname, prefix, lastname, email, password) VALUES (:firstname, :prefix, :lastname, :email, :password)";
	$query = $db->prepare($sql);
	$query->execute(array(
		':firstname' => $firstname,
		':prefix' => $prefix,
		':lastname' => $lastname,
		':email' => $email,
		':password' => $hash
	));

	$db = null;
	
	return true;
}


function loginUser($email = null, $password = null)
{
	$db = openDatabaseConnection();

	$email = $_POST['email'];
	$password = md5($_POST['password']);

    $result1 = $db->prepare("SELECT * FROM users WHERE email = '$email' AND  password = '$password'");
 	$result1->execute();
 	$row = $result1->fetch(PDO::FETCH_ASSOC);
 	$rowCount  = $result1->rowCount();

 	$login_id = $row['id'];

    if($rowCount == 1 )
	{
		$_SESSION['userId'] = $row['id'];
		$_SESSION['logged in'] = true;
		$_SESSION['email'] = $email;

		$result2 = $db->prepare("SELECT role_id FROM user_role WHERE user_id=:loginid");
 		$result2->execute(array(
 		':loginid' => $login_id
 		));
 		$roles = $result2->fetchAll();

 		if(isset($roles)) {
	 		foreach($roles as $row) {
				$role_id = $row['role_id'];

				$sql3 = "SELECT role FROM roles WHERE id = :roleid";
				$query3 = $db->prepare($sql3);
				$query3->execute(array(
					":roleid" => $role_id
				));
				$rolename = $query3->fetchAll();
				$_SESSION['roles'][] = $rolename[0]['name'];
			}
		}

		$result3 = $db->prepare("SELECT exam_id FROM exam_user WHERE user_id=:loginid");
 		$result3->execute(array(
 		':loginid' => $login_id
 		));
 		$exams = $result3->fetchAll();

 		if(isset($exams)) {
	 		foreach($exams as $row) {
				$exam_id = $row['exam_id'];

				$sql4 = "SELECT exam, date_time, examiner FROM exams WHERE id = :examid";
				$query4 = $db->prepare($sql4);
				$query4->execute(array(
					":examid" => $exam_id
				));
				$exam = $query4->fetchAll();
				$_SESSION['exams'][] = $exam[0]['exam'];
				$_SESSION['exams'][] = $exam[0]['date_time'];
				$_SESSION['exams'][] = $exam[0]['examiner'];
			}
		}

		$db = null;
		return true;
	}

	else
	{
		$_SESSION['userid'] = null; 
		$_SESSION['email'] = null; 
		$_SESSION['roles'] = [];
		$_SESSION['exams'] = [];
		$db = null;
		return false;
	}
}

function IsLoggedInSession() {
	if (isset($_SESSION['userId'])==false || empty($_SESSION['userId']) ) {
		return 0;
	}
	else
	{
		return 1;
	}
}

function IsStudent() {
	return (!empty($_SESSION['roles']) && $_SESSION['roles'][0] == "student");
}

function IsTeacher() {
	return (!empty($_SESSION['roles']) && $_SESSION['roles'][0] == "docent");
}

function getUser($id) 
{
	$db = openDatabaseConnection();

	$sql = "SELECT * FROM users WHERE id=:id ";
	$query = $db->prepare($sql);
	$query->execute(array(
		':id' => $id
	));

	$db = null;

	return $query->fetch(PDO::FETCH_ASSOC);
}

function LogOut() {
	echo "Logged out";
	header("location: ". URL ."home/login");

	unset($_SESSION['userId'], $_SESSION['email']);
	$_SESSION = [];
}

