<div class="itineraries form">
<?php echo $this->Form->create('Itinerary'); ?>
	<fieldset>
		<legend><?php echo __('Edit Itinerary'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('location');
		echo $this->Form->input('address');
		echo $this->Form->input('phone');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Itinerary.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Itinerary.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Itineraries'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
