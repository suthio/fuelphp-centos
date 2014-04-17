<h2>Viewing <span class='muted'>#<?php echo $note->id; ?></span></h2>

<p>
	<strong>Title:</strong>
	<?php echo $note->title; ?></p>
<p>
	<strong>Description:</strong>
	<?php echo $note->description; ?></p>

<?php echo Html::anchor('note/edit/'.$note->id, 'Edit'); ?> |
<?php echo Html::anchor('note', 'Back'); ?>