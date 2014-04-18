<h2>Editing <span class='muted'>Note</span></h2>
<br>

<?php echo render('note/_form'); ?>
<p>
	<?php echo Html::anchor('note/view/'.$note->id, 'View'); ?> |
	<?php echo Html::anchor('note', 'Back'); ?></p>
