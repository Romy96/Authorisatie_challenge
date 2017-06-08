<?php

require(ROOT . "model/StudentModel.php");

function index($id = '')
{
	if (IsLoggedInSession()==true && IsTeacher() == false) 
	{
		render("exam/index");
	}
	elseif (IsLoggedInSession()==true && IsTeacher()==true) 
	{
		renderTeacher("exam/index");
	}
}

function students()
{
	if (IsLoggedInSession()==false) 
	{
		echo 'U bent nog niet ingelogd!';
		render("home/login");
	}
	elseif (IsLoggedInSession()==true && IsTeacher() == false) 
	{
		
		echo 'U bent geen leraar!';
		render("exam/index");
		exit;
	}
	if (IsLoggedInSession()==true && IsTeacher()==true) 
	{
		$students = getStudents();

		if(empty($students))
		{
			echo 'Geen studenten gevonden';
			renderTeacher("exam/index");
			exit;
		}

		if(isset($students))
		{
			renderTeacher("exam/students", array(
			'students' => $students	
			));
		}
	}
}

function create_student()
{
	if (IsLoggedInSession()==false) 
	{
		echo 'U bent nog niet ingelogd!';
		render("home/login");
	}
	elseif (IsLoggedInSession()==true && IsTeacher() == false) 
	{
		
		echo 'U bent geen leraar!';
		render("exam/index");
		exit;
	}
	if (IsLoggedInSession()==true && IsTeacher()==true) 
	{
		renderTeacher("exam/create_student");
	}
}

function insertStudent()
{
	if ( IsLoggedInSession()==false ) {
		echo "U bent nog niet ingelogd!";
		render("home/index");
		exit();
	}
	elseif (IsLoggedInSession()==true && IsTeacher() == false) 
	{
		
		echo 'U bent geen leraar!';
		render("exam/index");
		exit;
	}
	elseif (IsLoggedInSession()==true && IsTeacher()==true) 
	{
		if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['role'])) {
			echo 'U heeft een veld niet ingevuld';
			renderTeacher("exam/create_student");
			exit;
		}

		// if fields are filled, call function
		if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
			createStudent($_POST['firstname'], $_POST['prefix'], $_POST['lastname'],  $_POST['email'], $_POST['password'], $_POST['role']);
			$students = getStudents();
			renderTeacher("exam/students", array(
			'students' => $students	
			));
			exit;
		}
	}
}

function edit_student($id = '')
{
	$student = getStudent($id);

	if(empty($student))
	{
		echo 'Student niet gevonden!';
		$students = getStudents();
		renderTeacher("exam/students", array(
			'students' => $students	
		));
	}

	if(isset($student))
	{
		renderTeacher("exam/edit_student", array(
			'student' => $student
		));
	}
}

function saveStudent($id = '')
{
	if ( IsLoggedInSession()==false ) {
		echo "U bent nog niet ingelogd!";
		render("home/login");
		exit();
	}
	elseif (IsLoggedInSession()==true && IsTeacher() == false) 
	{
		
		echo 'U bent geen leraar!';
		render("exam/index");
		exit;
	}
	elseif (IsLoggedInSession()==true && IsTeacher()==true) 
	{
		if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email'])) {
			echo 'U heeft een veld niet ingevuld';
			$student = getStudent($id);
			renderTeacher("exam/edit_student", array(
				'student' => $student
			));
			exit;
		}

		if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email'])) {
			editStudent($_POST['firstname'], $_POST['prefix'], $_POST['lastname'],  $_POST['email']);
			$students = getStudents();
			renderTeacher("exam/students", array(
			'students' => $students	
			));
			exit;
		}
	}
}

function delete_student($id = '')
{
	$student = getStudent($id);

	if ( IsLoggedInSession()==false ) {
		echo "U bent nog niet ingelogd!";
		render("home/login");
		exit();
	}
	elseif (IsLoggedInSession()==true && IsTeacher() == false) 
	{
		
		echo 'U bent geen leraar!';
		render("exam/index");
		exit;
	}
	elseif (IsLoggedInSession()==true && IsTeacher()==true) 
	{
		if(isset($student))
		{
			DeleteStudent($id);
			$students = getStudents();
			renderTeacher("exam/students", array(
			'students' => $students	
			));
			exit;
		}
		else
		{
			echo 'Student niet gevonden!';
			$students = getStudents();
			renderTeacher("exam/students", array(
			'students' => $students	
			));
			exit;
		}
	}
}