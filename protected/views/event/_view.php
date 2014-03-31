<?php
/* @var $this EventController */
/* @var $data Event */
?>

<article class="view">

	<header>
		<h4><?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id)); ?></h4>
	</header>

	<hr />
	<aside class="event-info">

	<div class="event-img">
	<?php

	if ($data->filename)
	echo '<img src="'.Yii::app()->baseUrl.'/'. $data->attachment.'" />';
	else
	echo '<img src="'.Yii::app()->baseUrl.'/uploads/no-available-image.png" />';
	?>
	</div>

	<ul>
		<li>
		<?php echo CHtml::encode('Start'); ?>
		<?php echo CHtml::encode($data->star_date); ?>

		</li>
		<li>
		<?php echo CHtml::encode($data->getAttributeLabel('age_id')); ?>:
		<?php echo CHtml::encode($data->age_group->name); ?>

		</li>
		<li>

		<?php echo CHtml::encode($data->organisation->organisation); ?>

		</li>
		<li>
			<?php
			echo CHtml::encode('Boat Type: ');
				if (!empty($data->id)) {
					// echo CHtml::encode ($data->boats[0]['name']);
					foreach ($data->boats as $boat)
		        	echo CHtml::encode ($boat->name);
				}
				else  echo 'N/A';
			 ?>
		</li>
		<li>
		<?php echo CHtml::encode($data->getAttributeLabel('seats')); ?>:</b>
		<?php echo CHtml::encode($data->seats); ?>

		</li>
	</ul>


	</aside>

</article>
<!-- Article ends -->