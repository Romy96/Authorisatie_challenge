<?php 
if(isset($student)):
 ?>
<h1>Bewerk student</h1>
<form action="<?= URL ?>exam/saveStudent/<?=$student['id']?>" method="post">
	<div>
		<label for="firstname">Voornaam:</label>
		<input type="hidden" name="id" value="<?=$student['id']?>">
		<input class="form-control"  type="text" name="firstname" value="<?=$student['firstname']?>">
	</div>
	<div>
		<label for="prefix">Tussenvoegsel:</label>
		<input class="form-control"  type="text" name="prefix" value="<?=$student['prefix']?>">
	</div>
	<div>
		<label for="lastname">Achternaam:</label>
		<input class="form-control"  type="text" name="lastname" value="<?=$student['lastname']?>">
	</div>
		<div>
		<label for="email">Email:</label>
		<div class="input-group margin-bottom-sm">
		<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
		<input class="form-control" type="email" name="email" value="<?=$student['email']?>">
		</div>
	</div>
	<div>
		<input type="submit" value="Send">
	</div>
</form>
<?php
endif;
?>