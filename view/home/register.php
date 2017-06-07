<h1>Registreer</h1>
<form action="<?= URL ?>home/registerSave" method="post">
	<div>
		<label for="firstname">Voornaam:</label>
		<input class="form-control"  type="text" name="firstname">
	</div>
	<div>
		<label for="prefix">Tussenvoegsel:</label>
		<input class="form-control"  type="text" name="prefix">
	</div>
	<div>
		<label for="lastname">Achternaam:</label>
		<input class="form-control"  type="text" name="lastname">
	</div>
		<div>
		<label for="email">Email:</label>
		<div class="input-group margin-bottom-sm">
		<span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
		<input class="form-control" type="email" name="email">
		</div>
	</div>
	<div>
		<label for="password">Wachtwoord:</label>
		<div class="input-group margin-bottom-sm">
		<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
		<input class="form-control" type="password" name="password">
		</div>
	</div>
	<div>
		<input type="submit" value="Send">
	</div>
</form>