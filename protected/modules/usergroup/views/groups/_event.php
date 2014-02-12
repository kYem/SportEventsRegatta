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
		echo CHtml::Button(Yum::t('Cancel'), array(
					'submit' => array('//usergroup/groups/view', 'id' => $model->id))); 
		echo CHtml::submitButton(Yum::t('Save')); 
	$this->endWidget(); 
 
?>
</div> <!-- form -->