<?php
/* @var $this EventController */
/* @var $data Event */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode('Boat'); ?>:</b>
	<?php 
		if (!empty($data->id)) {
			// echo CHtml::encode ($data->boats[0]['name']);   
			foreach ($data->boats as $boat)
        	echo CHtml::encode ($boat->name);    	
		}
		else  echo 'n.n.';
	 ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('star_date')); ?>:</b>
	<?php echo CHtml::encode($data->star_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_date')); ?>:</b>
	<?php echo CHtml::encode($data->end_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('min_participant')); ?>:</b>
	<?php echo CHtml::encode($data->min_participant); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('max_participant')); ?>:</b>
	<?php echo CHtml::encode($data->max_participant); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('age_id')); ?>:</b>
	<?php echo CHtml::encode($data->age_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('organisation_id')); ?>:</b>
	<?php echo CHtml::encode($data->organisation_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seats')); ?>:</b>
	<?php echo CHtml::encode($data->seats); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->seats); ?>
	<br />
	<span class="img">
	<?php 

	if ($data->filename) 
	echo '<img src="'.Yii::app()->baseUrl.'/'. $data->attachment.'" />';

	?>
	</span>

</div>