<div class="itineraries index">
	<h2><?php echo __('Itineraries'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('location'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('phone'); ?></th>
			<th><?php if($user_role == 0)echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($itineraries as $itinerary): ?>
	<tr>
		<td><?php echo h($itinerary['Itinerary']['id']); ?>&nbsp;</td>
		<td><?php echo h($itinerary['Itinerary']['location']); ?>&nbsp;</td>
		<td><?php echo h($itinerary['Itinerary']['address']); ?>&nbsp;</td>
		<td><?php echo h($itinerary['Itinerary']['phone']); ?>&nbsp;</td>
		<td>
			<?php if($user_role == 0) echo $this->Html->link($itinerary['User']['username'], array('controller' => 'users', 'action' => 'view', $itinerary['User']['id'])); ?>
		</td>
		<td><?php echo h($itinerary['Itinerary']['created']); ?>&nbsp;</td>
		<td><?php echo h($itinerary['Itinerary']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $itinerary['Itinerary']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $itinerary['Itinerary']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $itinerary['Itinerary']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $itinerary['Itinerary']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Itinerary'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
