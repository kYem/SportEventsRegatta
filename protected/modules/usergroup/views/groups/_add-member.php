<div class="form">
<p class="note">
<?php echo Yii::t('app','Fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.
</p>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
'id'=>'usergroup-form',
'action' => Yii::app()->createUrl('//usergroup/groups/AddMember/id/'.$group_id),  //<- your form action here
// CANT SAVE NORMALLY ON MANY_MANY WITH VALIDATION ON
// 'enableAjaxValidation'=>true,
	));
	echo $form->errorSummary($model);

?>
<div class="row">
<?php
 // echo $form->labelEx($form,'Id');
 ?>
    </div>
     <?php if ($model->listMembers()) : ?>
    <div class="row">
        <?php echo $form->labelEx(YumUser::model(),'id');
         echo $form->dropDownList(
                YumUser::model(),
                'id',
                $model->listMembers(),
                array('empty' => 'Select Group Member...')
        );
         echo $form->error(YumUser::model(),'id');

     ?>
    </div>
    <?php else : ?>
    <div class="row">
        <?php echo $form->labelEx(YumUser::model(),'id'); ?>
        <h5>No Available Group Members</h5>
    </div>
    <?php endif; ?>
<?php
echo CHtml::Button(Yum::t('Cancel'), array(
			'submit' => array('//usergroup/groups/view', 'id' => $model->id)));
echo CHtml::submitButton(Yum::t('Save'));
$this->endWidget();


?>
</div> <!-- form -->
