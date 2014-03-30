<?php
$this->breadcrumbs=array(
		$model->title,
		);
if(Yii::app()->user->hasFlash('success')){
	echo TbHtml::alert(TbHtml::ALERT_COLOR_SUCCESS, Yii::app()->user->getFlash('success'));
}
    if($model->owner)
        printf('%s: %s',
                Yum::t('Group Leader'),
                // Need to update profile view or remove the link
                CHtml::link($model->owner->profile->fullname, array(
                        '//profile/profile/view', 'id' => $model->owner_id)));

        // Get current group id for closure value
    $gui = $model->id;
    echo "<br>";
    // echo '<pre>'; print_r($model->getGroupMembersByAge($event->age_group->lower, $event->age_group->upper)->getData()); echo '</pre>';
?>
<h3> <?php echo $model->title.' - add participants to '. $event->name; ?> </h3>
<h4>Please select <?php echo $event->seats; ?> member<?php echo ($event->seats >= 2) ? 's':'' ?></h4>
<br>
<?php

// Show Current Participants
printf('<h4> %s </h4>', Yum::t('Members'));
$userIds = $model->getRegisteredMemberIds($event->id);
$isRegistered = 'in_array($data->id,array('.($userIds ?  implode(',', $userIds) : '').'))';

//
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'usergroup-form',
    'enableAjaxValidation'=>false,
    ));
    echo $form->errorSummary($model);
 $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'usergroup-grid',
	'type' => TbHtml::GRID_TYPE_HOVER,
	'dataProvider'=>$model->getGroupMembersByAge($event->age_group->lower, $event->age_group->upper),
	'columns'=>array(
		// This is YumProfile model attributes
		// 'id',
		array(
			'header'=>'First Name',
			'name'=> 'profile.firstname'
		),
		array(
			'header'=>'Last Name',
			'name'=> 'profile.lastname'
		),
        array(
            'header'=>'Date of birth',
            'name'=> 'profile.dob'
        ),
        array(
                'id'=>'memberIds',
                'class'=>'CCheckBoxColumn',
                'selectableRows'=>2,
                'checked' => $isRegistered,
                // 'disabled' => $RegisteredEvents,
                ),
	),
));
        echo CHtml::submitButton(Yum::t('Save'), array('class'=>'btn'));
    $this->endWidget();
?>
 <div style="clear: both;"> </div>
