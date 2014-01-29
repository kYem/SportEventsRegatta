<?php
/* @var $this AgeController */
/* @var $model Age */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'age-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
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
        		)
        ); ?>
		<?php echo $form->error($model,'organisation_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lower'); ?>
		<?php echo $form->textField($model,'lower'); ?>
		<?php echo $form->error($model,'lower'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'upper'); ?>
		<?php echo $form->textField($model,'upper'); ?>
		<?php echo $form->error($model,'upper'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->