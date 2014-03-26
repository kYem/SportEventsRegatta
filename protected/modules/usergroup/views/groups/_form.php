<div class="form">
<p class="note">
<?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
</p>
<?php

    // Get Group Leaders without a group
    $criteria = new CDbCriteria;
    $criteria->select = 't.user_id, t.firstname, t.lastname ';
    $criteria->join = ' INNER JOIN `ku_user_role` AS `user_role` ON t.user_id = user_role.user_id';
    $criteria->addCondition("t.user_id NOT IN (SELECT owner_id FROM fyp.ku_usergroup)");
    $criteria->addCondition("user_role.role_id = 6");
    // $criteria->addCondition("ku_profile.user_id IN (SELECT user_id FROM fyp.ku_user_role)");
    $resultSet    =    YumProfile::model()->findAll($criteria);
 ?>
<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'usergroup-form',
	'enableAjaxValidation'=>true,
	));
	echo $form->errorSummary($model);
?>


<div class="row">
<?php echo $form->labelEx($model,'title'); ?>
<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
<?php echo $form->error($model,'title'); ?>
</div>

<div class="row">
<?php echo $form->labelEx($model,'description'); ?>
<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
<?php echo $form->error($model,'description'); ?>
</div>
<div class="row">
        <?php echo $form->labelEx($model,'organisation_id'); ?>
        <?php echo $form->dropDownList(
                $model,
                'organisation_id',
                CHtml::listData(
                    Organisation::model()->findAll(array('order'=>'id ASC')),
                        'id',
                        'organisation'
                ),
                array('empty' => 'Select Organisation...')
        ); ?>
        <?php echo $form->error($model,'organisation_id'); ?>
    </div>
<div class="row">
        <?php echo $form->labelEx($model,'owner_id'); ?>
        <?php echo $form->dropDownList(
                $model,
                'owner_id',
                CHtml::listData(
                    $resultSet,
                        'user_id',
                        'fullname'
                ),
                array('empty' => 'Select Group Leader...')
        ); ?>
        <?php echo $form->error($model,'owner_id'); ?>
    </div>
<?php
echo CHtml::Button(Yum::t('Cancel'), array(
			'submit' => array('groups/index')));
echo CHtml::submitButton(Yum::t('Save'));
$this->endWidget(); ?>
</div> <!-- form -->
