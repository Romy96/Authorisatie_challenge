<h1>Creër examen</h1>
<form action="<?= URL ?>exam/insertExam" method="post">
	<div>
		<label for="exam">Examen:</label>
		<input class="form-control"  type="text" name="exam">
	</div>
	<div>
		<label for="datetime">Datum en tijd:</label>
		<input class="form-control"  type="datetime-local" name="datetime">
	</div>
	<div>
		<label for="examiner">Examinator:</label>
		<input class="form-control"  type="text" name="examiner">
	</div>
	<div>
		<input type="submit" value="Send">
	</div>
</form>