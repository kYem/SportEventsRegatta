<?php
/* @var $this RaceController */
/* @var $data Race */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event_id')); ?>:</b>
	<?php echo CHtml::encode($data->event_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('race_model_id')); ?>:</b>
	<?php echo CHtml::encode($data->race_model_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('race_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->race_type_id); ?>
	<br />


</div>