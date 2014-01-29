<?php
/* @var $this AgeController */
/* @var $data Age */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('organisation_id')); ?>:</b>
	<?php echo CHtml::encode($data->organisation_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lower')); ?>:</b>
	<?php echo CHtml::encode($data->lower); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('upper')); ?>:</b>
	<?php echo CHtml::encode($data->upper); ?>
	<br />


</div>