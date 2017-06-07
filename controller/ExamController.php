<?php

require(ROOT . "model/StudentModel.php");

function index($id = '')
{
	if (IsLoggedInSession()==true && IsTeacher() == false) 
	{
		render("exam/index");
	}
	elseif (IsLoggedInSession()==true && IsTeacher() == true)
	{
		renderTeacher("exam/index");
	}
}

