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
?>
<h3> <?php echo $model->title.' - add participants to '. $event->name; ?> </h3>
	<br />
	<?php // Add Member Ajax roll over ?>
	<div style="display:none;" id="usergroup_members">
		<h4> <?php echo Yum::t('Add new members to the group'); ?> </h4>

		<?php $this->renderPartial('_add-member', array(
				'model' => $model,
				'group_id' => $model->id,
				)
			); ?>
	</div>
<?php
// Testing
echo '<pre>'; print_r($model->memberIds); echo '</pre>';
echo '<pre>'; print_r($_POST); echo '</pre>';


// Show Current Participants
printf('<h4> %s </h4>', Yum::t('Members'));
$RegisteredMembers = 'in_array($data->id,array('.($model->memberIds ?  implode(',', $model->memberIds) : '').'))';

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'usergroup-form',
    'enableAjaxValidation'=>false,
    ));
    echo $form->errorSummary($model);
 $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'usergroup-grid',
	'type' => TbHtml::GRID_TYPE_HOVER,
	'dataProvider'=>$model->getGroupMembers(),
	'columns'=>array(
		// This is YumUser model attributes
		'id',
		// 'username',
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
                'checked' => $RegisteredMembers,
                // 'disabled' => $RegisteredEvents,
                ),
	),
));
        echo CHtml::submitButton(Yum::t('Save'), array('class'=>'btn'));
    $this->endWidget();
?>
 <div style="clear: both;"> </div>
