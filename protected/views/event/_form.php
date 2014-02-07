<?php
/* @var $this EventController */
/* @var $model Event */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'event-form',
	 'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    ),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<div class="span4">
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx(Boat::model(), 'Boat Type'); ?>
        <?php echo $form->error(Boat::model(), 'name'); ?>
        <?php echo $form->dropDownList(	Boat::model(),'name', 
        		CHtml::listData(Boat::model()->findAll(), 'id', 'name'),
        		array('empty' => 'Select Age Group...')
        ); ?>
       
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'star_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                'model'=>$model,
                'attribute'=>'star_date',               
                'value'=>$model->star_date,
                'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat'=>'yy-mm-dd',
                ),
                'htmlOptions'=>array(
                	'style'=>'height:20px;'
                ),
            ));
		?>

		<?php echo $form->error($model,'star_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_date'); ?>

		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                'model'=>$model,
                'attribute'=>'end_date',               
                'value'=>$model->end_date,
                'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat'=>'yy-mm-dd',
                ),
                'htmlOptions'=>array(
                	'style'=>'height:20px;'
                ),
            ));
		?>

		<?php echo $form->error($model,'end_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'min_participant'); ?>
		<?php echo $form->textField($model,'min_participant'); ?>
		<?php echo $form->error($model,'min_participant'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'max_participant'); ?>
		<?php echo $form->textField($model,'max_participant'); ?>
		<?php echo $form->error($model,'max_participant'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

</div>

<div class="span4">
	<div class="row">
		<?php echo $form->labelEx($model,'age_id'); ?>
		<?php echo $form->dropDownList(
        		$model,
        		'age_id', 
        		CHtml::listData(
    			Age::model()->findAll(), 'id', 'name'),
        		array('empty' => 'Select Age Group...')
        ); ?>
		<?php echo $form->error($model,'age_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'organisation_id'); ?>
		<?php echo $form->dropDownList(
        		$model,
        		'organisation_id', 
        		CHtml::listData(
        			Organisation::model()->findAll(), 
        				'id', 
        				'organisation'
        		),
        		array('empty' => 'Select Organisation...')
        ); ?>
		<?php echo $form->error($model,'organisation_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seats'); ?>
		<?php echo $form->textField($model,'seats'); ?>
		<?php echo $form->error($model,'seats'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'status_id'); ?>
		<?php echo $form->dropDownList(
        		$model,
        		'status_id', 
        		CHtml::listData(Status::model()->findAll(), 'id', 'name')

        ); ?>
		<?php echo $form->error($model,'status_id'); ?>
	</div>
	  <div class="row">
	  <?php 
		if ($model->filename) 
		echo '<img src="'.Yii::app()->baseUrl.'/'. $model->getAttachment('thumb').'" />';

		?>
        <?php echo $form->labelEx($model,'filename'); ?>
        <?php echo $form->fileField($model,'filename'); ?>
        <?php echo $form->error($model,'filename'); ?>
    </div>
</div>
	

<?php $this->endWidget(); ?>

</div><!-- form -->