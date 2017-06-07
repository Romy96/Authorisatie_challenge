<?php
if(isset($_SESSION['userId'])):
?>

<h1>Welkom!</h1>

<?php
endif;
?>

<?php
if(isset($_SESSION['exams'])):
	if(is_array($_SESSION['exams'])):
		foreach($_SESSION['exams'] as $row):
?>
<p><?=$row['exam']?></p>
<?php
		endforeach;
	endif;
endif;
?>