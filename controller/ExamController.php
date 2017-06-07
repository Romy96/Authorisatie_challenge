<?php

require(ROOT . "model/StudentModel.php");

function index($id = '')
{
	if (IsLoggedInSession()==true) 
	{
		render("exam/index");
	}
}

