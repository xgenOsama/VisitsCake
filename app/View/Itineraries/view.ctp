<div class="itineraries view">
<h2><?php echo __('Itinerary'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($itinerary['Itinerary']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo h($itinerary['Itinerary']['location']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($itinerary['Itinerary']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($itinerary['Itinerary']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($itinerary['User']['username'], array('controller' => 'users', 'action' => 'view', $itinerary['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($itinerary['Itinerary']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($itinerary['Itinerary']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Itinerary'), array('action' => 'edit', $itinerary['Itinerary']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Itinerary'), array('action' => 'delete', $itinerary['Itinerary']['id']), array(), __('Are you sure you want to delete # %s?', $itinerary['Itinerary']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Itineraries'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Itinerary'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
