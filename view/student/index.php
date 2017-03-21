<div class="container">
	<table border="1">
		<tr>
			<th>#</th>
			<th>Voornaam</th>
			<th>Achternaam</th>
			<th>Geslacht</th>
			<th colspan="2">Actie</th>
		</tr>
		
		<?php foreach ($students as $student) { ?>
		<tr>
			<td><?= $student['id']; ?></td>
			<td><?= $student['firstname']; ?></td>
			<td><?= $student['lastname']; ?></td>
			<td><?= $student['gender']; ?></td>
			<td><a href="<?= URL ?>student/edit/<?= $student['id'] ?>">Edit</a></td>
			<td><a href="<?= URL ?>student/delete/<?= $student['id'] ?>">Delete</a></td>
		</tr>
		<?php } ?>

	</table>
	<a href="<?= URL ?>student/create">Toevoegen</a>
</div>