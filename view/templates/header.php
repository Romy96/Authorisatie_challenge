<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Examen app</title>	
	<link rel="stylesheet" href="<?= URL ?>css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= URL ?>css/bootstrap.min.css">
</head>
<body>
	<nav>
	<ul>
		<li><a href="<?= URL ?>home/index">Home</a></li>
		<?php
		if(isset($_SESSION['userId'])):
		?>
		<li><a href="<?= URL ?>exam/logOut"><i class="fa fa-sign-out" aria-hidden="true"></i> Uitloggen </a></li>
		<?php
		; else:
		?>
		<li><a href="<?= URL ?>home/register">Registreer</a></li>
		<li><a href="<?= URL ?>home/login">Inloggen</a></li>
		<?php
		endif;
		?>
	</ul>
	</nav>
