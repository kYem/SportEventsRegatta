<div class="form">
<p class="note">
<?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
</p>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
'id'=>'changePhase-form',
'action' => Yii::app()->createUrl('//event/ChangeRegattaPhase'),  //<- your form action here
'enableAjaxValidation'=>true,
    ));
    echo $form->errorSummary($model);

?>
<div class="row">
<?php echo $form->dropDownList($model, 'status_id', CHtml::listData(Status::model()->findAll(array('order' => 'id ASC')),'id', 'name')); ?>
    </div>
<?php
echo CHtml::Button(Yum::t('Cancel'), array(
            'submit' => array('//usergroup/groups/view', 'id' => $model->id)));
echo CHtml::submitButton(Yum::t('Save'));
$this->endWidget();


?>
</div> <!-- form -->
