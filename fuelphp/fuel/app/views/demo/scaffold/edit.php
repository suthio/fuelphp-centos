<h2>Editing <span class='muted'>Demo_scaffold</span></h2>
<br>

<?php echo render('demo/scaffold/_form'); ?>
<p>
	<?php echo Html::anchor('demo/scaffold/view/'.$demo_scaffold->id, 'View'); ?> |
	<?php echo Html::anchor('demo/scaffold', 'Back'); ?></p>
