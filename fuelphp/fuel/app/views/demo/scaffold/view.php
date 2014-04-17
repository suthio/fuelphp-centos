<h2>Viewing <span class='muted'>#<?php echo $demo_scaffold->id; ?></span></h2>

<p>
	<strong>Title:</strong>
	<?php echo $demo_scaffold->title; ?></p>
<p>
	<strong>Content:</strong>
	<?php echo $demo_scaffold->content; ?></p>
<p>
	<strong>Id:</strong>
	<?php echo $demo_scaffold->id; ?></p>

<?php echo Html::anchor('demo/scaffold/edit/'.$demo_scaffold->id, 'Edit'); ?> |
<?php echo Html::anchor('demo/scaffold', 'Back'); ?>