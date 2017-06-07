<?php

require(ROOT . "model/StudentModel.php");

function index()
{
	render("home/index");	
}

function login()
{
	if ( IsLoggedInSession()==true ) {
		echo "U heeft al ingelogd!";
		render("home/index");
		exit();
	}
	else {
		if(isset($_POST["email"]) && isset($_POST["password"])) {
			if(loginUser($_POST['email'], $_POST['password']))
			{
				header("Location:" . URL . "exam/index");
				exit();
			}else{
				render("home/login");
				echo 'ownee het is een fout help';
				exit();
			}
		}
		else
		{
			render("home/login");
			exit();
		}
	}
}


function register()
{
	if ( IsLoggedInSession()==true ) {
		echo "U bent al ingelogd!";
		render("home/index");
		exit();
	}
	else {
		render("home/register");
		exit();
	}
}

function registerSave()
{
	if ( IsLoggedInSession()==true ) {
		echo "U bent al ingelogd!";
		render("home/index");
		exit();
	}
	else 
	{
		if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['password'])) {
			echo 'U heeft een veld niet ingevuld';
			render("home/register");
			exit();
		}

		// if fields are filled, call function
		if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password'])) {
			createUser($_POST['firstname'], $_POST['prefix'], $_POST['lastname'],  $_POST['email'], $_POST['password']);
			header("Location:" . URL . "home/login");
			exit();
		}
	}
}