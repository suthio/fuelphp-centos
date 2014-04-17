<h2>Listing <span class='muted'>Notes</span></h2>
<br>
<?php if ($notes): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th>Description</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($notes as $item): ?>		<tr>

			<td><?php echo $item->title; ?></td>
			<td><?php echo $item->description; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('note/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('note/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('note/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Notes.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('note/create', 'Add new Note', array('class' => 'btn btn-success')); ?>

</p>
