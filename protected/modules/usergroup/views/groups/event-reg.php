<?php
	$this->breadcrumbs=array(
		$model->title=>array('view','id'=>$model->id),
		Yii::t('app', 'Join Events'),
	);
?>
<h2>Group <?php echo $model->title; ?> - Join Event  </h2>
<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
<div class="form">
<p class="note">Please select the events <?php echo $model->title; ?> group would like to join</p>
<?php
	// Loose Checking
	$RegisteredEvents = 'in_array($data->id,array('.($model->eventIds ?  implode(',', $model->eventIds) : '').'))';

 ?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'usergroup-form',
	'enableAjaxValidation'=>false,
	));
	echo $form->errorSummary($model);

	 $this->widget('bootstrap.widgets.TbGridView', array(
		'id'=>'event-grid',
		'type' => TbHtml::GRID_TYPE_HOVER,
		'dataProvider'=>$model->getEventDataProvider(),
		'columns'=>array(
			'name',
			array('name'=>'age_group.name',
		    'header'=> 'Age Group',
		    'filter'=>CHtml::activeTextField($event,'age_group_search'),
		    ),

			array('name'=>'status.name',
			'header'=> 'Status',
		    'filter'=>CHtml::activeTextField($event,'status_search'),
		    ),
			'seats',

			array(
				'id'=>'eventIds',
				'class'=>'CCheckBoxColumn',
				'selectableRows'=>2,
				'checked' => $RegisteredEvents,
				// 'disabled' => $RegisteredEvents,
				),
		),
	));
		echo CHtml::Button(Yum::t('Cancel'), array(
					'submit' => array('//usergroup/groups/view', 'id' => $model->id), 'class'=>'btn'));
		echo CHtml::submitButton(Yum::t('Save'), array('class'=>'btn', 'name'=> 'submit'));
	$this->endWidget();

?>
</div> <!-- form -->

