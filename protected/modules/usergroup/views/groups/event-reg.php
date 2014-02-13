<?php
$this->breadcrumbs=array(
	'Groups'=>array('index'),
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
<p class="note">
Please select the events <?php echo $model->title; ?> group would like to join
</p>
<?php 
	// Loose Checking
	$RegisteredEvents = 'in_array($data->id,array('.($model->eventIds ?  implode(',', $model->eventIds) : '').'))';

 ?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'usergroup-form',
	// 'action' => Yii::app()->createUrl('//usergroup/groups/Updatep/id/'.$group_id),  //<- your form action here
	'enableAjaxValidation'=>true,
	)); 
	echo $form->errorSummary($model);

	 $this->widget('bootstrap.widgets.TbGridView', array(
		'id'=>'event-grid',
		'type' => TbHtml::GRID_TYPE_HOVER,
		'dataProvider'=>$model->getEventDataProvider(),
		// 'ajaxUpdate' => false,
		// 'filter'=>$event,
		'columns'=>array(
			'id',
			'name',
			array('name'=>'age_group.name',
		    'header'=> 'Age Group',
		    'filter'=>CHtml::activeTextField($event,'age_group_search'),
		    ),
			array(
				'name'=>'boats.name',
				'header'=>'Boat',  
				'value'=> function ($event) {
	                           $boatName = array();
	                           foreach ($event->boats as $boat) {
	                              $boatName[] = $boat->name;
	                           }
	                           return implode(', ', $boatName);
	                         } ,
		        'filter'=>CHtml::activeTextField($event,'boat_search'),
				'type'=>'text'),
			array('name'=>'organisation.organisation',    
		    'filter'=>CHtml::activeTextField($event,'organisation_search'),
		    ),
			
			// 'star_date',
			// 'end_date',
			array('name'=>'status.name',
			'header'=> 'Status',    
		    'filter'=>CHtml::activeTextField($event,'status_search'),
		    ),
			// 'min_participant',
			// 'max_participant',
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
		echo CHtml::submitButton(Yum::t('Save'), array('class'=>'btn')); 
	$this->endWidget(); 
 
?>
</div> <!-- form -->

