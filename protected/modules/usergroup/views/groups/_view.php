<div class="view">

<h3> <?php echo CHtml::link(Yum::t($data->title), array(
					'//usergroup/groups/view', 'id' => $data->id)); ?> </h3>
	<b><?php echo CHtml::encode($data->getAttributeLabel('owner_id')); ?>:</b>
<?php
	if(isset($data->owner))
	echo CHtml::link(Yum::t($data->owner->profile->firstname), array(
		'//user/user/view/', 'id' => $data->owner->id));
?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode(substr($data->description, 0, 100)) . '... '; ?>

	<br />
	<b><?php echo Yum::t('Participant count'); ?> : </b>
	<?php echo count($data->participants); ?>

	<br />
	<b><?php echo Yum::t('Message count'); ?> : </b>
	<?php echo $data->messagesCount; ?>

	<br />
	<br />


	<?php


	// foreach (YumUsergroup::model()->findAll() as $key => $group) {
	// 	if(is_array($group->participants) &&
	// 		in_array(Yii::app()->user->id, $group->participants))
	// 		echo "User is in ".$group->title." <br />";
	// }
	// if(is_array($data->participants) &&
	// 		in_array(Yii::app()->user->id, $data->participants))
	// 	echo CHtml::button(Yum::t('Leave group'), array(
	// 				'submit' => array('//usergroup/groups/leave' , 'id' => $data->id), 'class'=>'btn'));

	// else
	// 	echo CHtml::button(Yum::t('Join group'), array(
	// 				'submit' => array('//usergroup/groups/join' , 'id' => $data->id), 'class'=>'btn'));
	 ?>

	</div>
