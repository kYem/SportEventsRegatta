<?php Yum::register('css/yum.css');

$this->breadcrumbs=array(
		Yum::t('Groups')=>array('index'),
		$model->title,
		);
 ?>

<h3> <?php echo $model->title;  ?> </h3>

<p> <?php echo $model->description; ?> </p>

<?php

	if($model->owner)
		printf('%s: %s',
				Yum::t('Owner'),
				CHtml::link($model->owner->profile->firstname, array(
						'//profile/profile/view', 'id' => $model->owner_id)));

	printf('<h4> %s </h4>', Yum::t('Participants'));

	if (Yii::app()->user->can("userGroup", "create")) {
	echo CHtml::link(Yum::t('Assign User'), '', array(
				'onClick' => "$('#usergroup_members').toggle(500)", 'class'=>'btn'));

		echo CHtml::link(' Join Event', array(
						'//usergroup/groups/joinEvent', 'id' => $model->id),array('class'=>'btn'));

		echo CHtml::link(' Join Initial Events', array(
						'//usergroup/groups/joinInitialEvent', 'id' => $model->id),array('class'=>'btn'));
	}



?>
	<br />
	<?php // Addd Member Ajax roll over ?>
	<div style="display:none;" id="usergroup_members">
		<h4> <?php echo Yum::t('Add members to the team'); ?> </h4>

		<?php $this->renderPartial('_add-member', array(
				'model' => $model,
				'group_id' => $model->id,
				)
			); ?>
	</div>
<?php
	// Show Current Participants

// $this->widget('bootstrap.widgets.TbListView', array(
//     'dataProvider'=>$model->getParticipantDataProvider(),
//     'template'=>'{items} {pager}',
//     'itemView'=>'_participant',
// ));
echo "<br>";

$test = array();


 $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'usergroup-grid',
	'type' => TbHtml::GRID_TYPE_HOVER,
	'dataProvider'=>$model->getParticipantDataProvider(),
	'columns'=>array(
		// This is YumUser model attributes
		'id',
		'username',
		array(
			'header'=>'First Name',
			'name'=> 'profile.firstname'
		),
		array(
			'header'=>'Last Name',
			'name'=> 'profile.lastname'
		),
	),
));
?>
 <div style="clear: both;"> </div>
