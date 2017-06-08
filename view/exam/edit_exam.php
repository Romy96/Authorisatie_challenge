<?php
if(isset($exam)):
?>
<h1>Bewerk examen</h1>
<form action="<?= URL ?>exam/saveExam/<?=$exam['id']?>" method="post">
	<div>
		<label for="exam">Examen:</label>
		<input type="hidden" name="id" value="<?=$exam['id']?>">
		<input class="form-control"  type="text" name="exam" value="<?=$exam['exam']?>">
	</div>
	<div>
		<label for="datetime">Datum en tijd:</label>
		<input class="form-control"  type="datetime" name="datetime" value="<?=$exam['date_time']?>">
	</div>
	<div>
		<label for="examiner">Examinator:</label>
		<input class="form-control"  type="text" name="examiner" value="<?=$exam['examiner']?>">
	</div>
	<div>
		<input type="submit" value="Send">
	</div>
</form>
<?php
endif;
?>