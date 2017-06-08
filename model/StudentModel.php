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

		$result2 = $db->prepare("SELECT role FROM users WHERE id=:loginid");
 		$result2->execute(array(
 		':loginid' => $login_id
 		));
 		$role = $result2->fetch(PDO::FETCH_ASSOC);

 		$_SESSION['roles'][] = $role[0]['role'];

		$result3 = $db->prepare("SELECT exam_id FROM exam_user WHERE user_id=:loginid");
 		$result3->execute(array(
 		':loginid' => $login_id
 		));

 		$exams = $result3->fetchAll();

 		if(isset($exams)) {
	 		foreach($exams as $row) {
				$exam_id = $row['exam_id'];
				$sql4 = "SELECT * FROM exams WHERE id = :examid";
				$query4 = $db->prepare($sql4);
				$query4->execute(array(
					":examid" => $exam_id
				));
				$exam = $query4->fetchAll();
				$_SESSION['exams'][] = $exam;
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
	return (!empty($_SESSION['roles']) && $_SESSION['roles'][0] == "Student");
}

function IsTeacher() {
	return (!empty($_SESSION['roles']) && $_SESSION['roles'][0] == "Docent");
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

function getStudents()
{
	$db = openDatabaseConnection();

	$sql = "SELECT * FROM users WHERE role = 'Student'";
	$query = $db->prepare($sql);
	$query->execute();

	$db = null;

	return $query->fetchAll();
}

function getStudent($id)
{
	$db = openDatabaseConnection();

	$sql = "SELECT * FROM users WHERE role = 'Student' AND id=:id";
	$query = $db->prepare($sql);
	$query->execute(array(
		':id' => $id
	));

	$db = null;

	return $query->fetch(PDO::FETCH_ASSOC);
}

function createStudent($firstname = null, $prefix = null, $lastname = null, $email = null, $password = null, $role = null)
{
	$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : null;
	$prefix = isset($_POST['prefix']) ? $_POST['prefix'] : null;
	$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : null;
	$email = isset($_POST['email']) ? $_POST['email'] : null;
	$password = isset($_POST['password']) ? $_POST['password'] : null;
	$hash = md5($password);
	$role = isset($_POST['role']) ? $_POST['role'] : null;
	
	if (strlen($firstname) == 0 || strlen($lastname) == 0 || strlen($email) == 0 || strlen($password) == 0 || strlen($role) == 0) {
		return false;
	}
	
	$db = openDatabaseConnection();


	$sql = "INSERT INTO users(firstname, prefix, lastname, email, password, role) VALUES (:firstname, :prefix, :lastname, :email, :password, :role)";
	$query = $db->prepare($sql);
	$query->execute(array(
		':firstname' => $firstname,
		':prefix' => $prefix,
		':lastname' => $lastname,
		':email' => $email,
		':password' => $hash,
		':role' => $role
	));

	$db = null;
	
	return true;
}

function editStudent($id = null, $firstname = null, $prefix = null, $lastname = null, $email = null)
{
	$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : null;
	$prefix = isset($_POST['prefix']) ? $_POST['prefix'] : null;
	$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : null;
	$email = isset($_POST['email']) ? $_POST['email'] : null;
	$id = isset($_POST['id']) ? $_POST['id'] : null;

	$db = openDatabaseConnection();

	$sql = "UPDATE users SET firstname=:firstname, prefix=:prefix, lastname=:lastname, email=:email WHERE id=:id";
	$query = $db->prepare($sql);
	$query->execute(array(
		':firstname' => $firstname,
		':prefix' => $prefix,
		':lastname' => $lastname,
		':email' => $email,
		':id' => $id
	));

	$db = null;
	
	return true;
}

function DeleteStudent($id)
{
	// Maak connectie met database
	$db = openDatabaseConnection();
	// schrijf een query en voer het uit
	$sql = "DELETE FROM users WHERE id=:id";
	$query = $db->prepare($sql);
	$query->execute(array(
		':id' => $id
	));

	$db = null;
}

function getExams()
{
	$db = openDatabaseConnection();

	$sql = "SELECT * FROM exams";
	$query = $db->prepare($sql);
	$query->execute();

	$db = null;

	return $query->fetchAll();
}

function createExam($exam = null, $date_time = null, $examiner = null)
{
	$exam = isset($_POST['exam']) ? $_POST['exam'] : null;
	$datetime = isset($_POST['datetime']) ? $_POST['datetime'] : null;
	$examiner = isset($_POST['examiner']) ? $_POST['examiner'] : null;

	$db = openDatabaseConnection();

	$sql = "INSERT INTO exams (exam, date_time, examiner) VALUES (:exam, :date_time, :examiner)";
	$query = $db->prepare($sql);
	$query->execute(array(
		':exam' => $exam,
		':date_time' => $date_time,
		':examiner' => $examiner
	));

	$db = null;

	return true;
}

function getExam($id)
{
	$db = openDatabaseConnection();

	$sql = "SELECT * FROM exams WHERE id=:id";
	$query = $db->prepare($sql);
	$query->execute(array(
		':id' => $id
	));

	$db = null;

	return $query->fetch(PDO::FETCH_ASSOC);	
}

function editExam($id = null, $exam = null, $date_time = null, $examiner = null)
{
	$exam = isset($_POST['exam']) ? $_POST['exam'] : null;
	$datetime = isset($_POST['datetime']) ? $_POST['datetime'] : null;
	$examiner = isset($_POST['examiner']) ? $_POST['examiner'] : null;
	$id = isset($_POST['id']) ? $_POST['id'] : null;

	$db = openDatabaseConnection();

	$sql = "UPDATE exams SET exam=:exam, date_time=:date_time, examiner=:examiner WHERE id=:id";
	$query = $db->prepare($sql);
	$query->execute(array(
		':exam' => $exam,
		':date_time' => $date_time,
		':examiner' => $examiner,
		':id' => $id
	));

	$db = null;

	return true;
}