<?php
$this->breadcrumbs=array(
		$model->title,
		);
if(Yii::app()->user->hasFlash('success')){
	echo TbHtml::alert(TbHtml::ALERT_COLOR_SUCCESS, Yii::app()->user->getFlash('success'));
}
?>
<h3> <?php echo $model->title;  ?> </h3>

<p> <?php echo $model->description; ?> </p>

<?php

	if($model->owner)
		printf('%s: %s',
				Yum::t('Group Leader'),
				// Need to update profile view or remove the link
				CHtml::link($model->owner->profile->fullname, array(
						'//profile/profile/view', 'id' => $model->owner_id)));

    echo "<br>";
    ?>
    <div class="btn-control">
    <?php
	if (Yii::app()->user->can("userGroup", "create")) {
	   echo CHtml::link(Yum::t('Assign User'), '', array(
				'onClick' => "$('#usergroup_members').toggle(500)", 'class'=>'btn'));

		echo CHtml::link(' Join Event', array(
						'//usergroup/groups/joinEvent', 'id' => $model->id),array('class'=>'btn'));

		// echo CHtml::link(' Join Initial Events', array('//usergroup/groups/JoinEventCheck', 'id' => $model->id),array('class'=>'btn'));
	}
?>
    </div>
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
printf('<h4> %s </h4>', Yum::t('Registered Events'));

    // Get current group id for closure value
    $gui = $model->id;
    // Show Registered Event GridView
if ($model->getRegisteredEventDataProvider()->itemCount > 0) {
	$this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'event-grid',
        'type' => TbHtml::GRID_TYPE_HOVER,
        'dataProvider'=>$model->getRegisteredEventDataProvider(),
        // 'filter'=>Event::model(),

        'columns'=>array(
            'name',
            array(
                'header'=>'Participanting Groups',
                'value'=> function ($model) {
                    $count = GroupEvent::model()->countByAttributes(
                        array('event_id'=> $model->id,));
                        return $count;
                    },
                'type'=>'text'
            ),
            'seats',
            array(
                'header'=>'Registered Members',
                'value'=> function ($model)  use ($gui){
                    return YumUsergroup::model()->getParticipantCount($model, $gui);
                },
            ),
            array('name'=>'status.name',
            'header'=> 'Progress',
            ),
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'htmlOptions'=>array('style'=>'width: 50px'),
                'template'=>'{view}{update}',
                'buttons'=>array(
                            'delete' => array(
                              'label'=>'Remove Event',
                            ),
                          ),
                'viewButtonUrl'=>'Yii::app()->createUrl("event/view/", array("id"=>$data->id))',
                'updateButtonUrl'=>'$this->grid->controller->createUrl("groups/addParticipant/", array("groupId"=>'.$gui.', "eventId"=>$data->id))',
            ),
        ), // Columns
    ));
} else {
	echo '<h5>'.$model->title.' have not registered for any events</h5>';
}
echo "<br>";
// Show Current Participants
printf('<h4> %s </h4>', Yum::t('Members'));
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
	),
));
?>
 <div style="clear: both;"> </div>
