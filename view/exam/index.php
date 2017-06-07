<?php
if(isset($_SESSION['userId'])):
?>

<h1>Welkom!</h1>

<?php
endif;
?>

<ul>
<?php
if(isset($_SESSION['exams'])):
	if(is_array($_SESSION['exams']) || is_object($_SESSION['exams'])):
		foreach($_SESSION['exams'] as $exam):
?>
	<li><?=$exam['exam']?> <?=$exam['datetime']?></li>
<?php
		endforeach;
	endif;
endif;
?>

<?php
print_r($_SESSION['exams']);
?>
</ul>