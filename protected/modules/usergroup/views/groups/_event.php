<div class="form">
<p class="note">
<?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
</p>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'usergroup-form',
	// 'action' => Yii::app()->createUrl('//usergroup/groups/Updatep/id/'.$group_id),  //<- your form action here
	'enableAjaxValidation'=>true,
	)); 
	echo $form->errorSummary($model);

	?>
	
	<div class="row oneLineLabel">
        <?php echo $form->labelEx($model, 'events'); ?>
        <?php echo $form->checkBoxList($model, 'eventIds',
            CHtml::listData(Event::model()->findAll(), 'id', 'name'),
            array('checkAll' => 'Check All')); ?>
        <?php echo $form->error($model, 'events'); ?>
    </div>
	<?php
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

			array('class'=>'CCheckBoxColumn','selectableRows'=>2),
		),
	)); 
	
 

		echo CHtml::Button(Yum::t('Cancel'), array(
					'submit' => array('//usergroup/groups/view', 'id' => $model->id))); 
		echo CHtml::submitButton(Yum::t('Save')); 
	$this->endWidget(); 
 
?>
</div> <!-- form -->
        <?php echo $form->checkBoxList($model, 'eventIds',
            CHtml::listData(Event::model()->findAll(), 'id', 'name')); ?>
        <?php echo $form->error($model, 'events'); ?>