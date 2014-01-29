<?php
/* @var $this AgeController */
/* @var $model Age */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'organisation_id'); ?>
		<?php echo $form->textField($model,'organisation_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lower'); ?>
		<?php echo $form->textField($model,'lower'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'upper'); ?>
		<?php echo $form->textField($model,'upper'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->