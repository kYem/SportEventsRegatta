<?php
/* @var $this OrganisationController */
/* @var $data Organisation */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('organisation')); ?>:</b>
	<?php echo CHtml::encode($data->organisation); ?>
	<br />


</div>