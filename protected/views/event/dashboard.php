<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	'Dashboard',
);

$this->menu=array(
   	array('label'=>'Event Administration'),
    array('label'=>'Overview', 'icon'=>'home', 'url'=>array('admin'), 'active'=>true),
    array('label'=>'Create', 'icon'=>'pencil', 'url'=>array('create')),
    array('label'=>'All Events', 'icon'=>'list', 'url'=>array('index')),

	);
?>

<h1>Dashboard</h1>



<?php
if (Yii::app()->user->isAdmin()) {
    // Event Organiser / Admin View
    echo CHtml::link(Yum::t('Change Events Phase'), '', array(
        'onClick' => "$('#change-phase').toggle(500)",
        'class'=>'btn')); ?>

    <div style="display:none;" id="change-phase">
        <h4> <?php echo Yum::t('Please select the phase for the Regatta'); ?> </h4>

        <?php $this->renderPartial('_change-phase', array(
                'model' => $model,
                'group_id' => $model->id,
                )
            ); ?>
    </div>
    <?php
    // Build Event Table
    $this->widget('bootstrap.widgets.TbGridView', array(
    	'id'=>'event-grid',
    	'type' => TbHtml::GRID_TYPE_HOVER,
    	'dataProvider'=>$model->adminDashboard(),
    	// 'ajaxUpdate' => false,
    	'filter'=>$model,
    	'columns'=>array(
    		// 'id',
    		array('name'=>'organisation.organisation',
    	    'filter'=>CHtml::activeTextField($model,'age_group_search'),
    	    ),
            'name',
    		array(
    			'header'=>'Groups',
    			'value'=> function ($model) {
                    $count = GroupEvent::model()->countByAttributes(
                        array(
                            'event_id'=> $model->id
                        )
                    );
                        return $count;
                        },
    	        'filter'=>CHtml::activeTextField($model,'boat_search'),
    			'type'=>'text'),
    		array('name'=>'status.name',
    		'header'=> 'Progress',
    	    'filter'=>CHtml::activeTextField($model,'status_search'),
    	    ),
    	),
    ));
}
// Group Leader View
elseif (Yii::app()->user->can("userGroup", "create")) {
     $this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'event-grid',
        'type' => TbHtml::GRID_TYPE_HOVER,
        'dataProvider'=>$model->adminDashboard(),
        // 'ajaxUpdate' => false,
        'filter'=>$model,
        'columns'=>array(
            'name',
            array(
                'header'=>'Members',
                'value'=> function ($model) {
                    $count = GroupEvent::model()->countByAttributes(
                        array(
                            'event_id'=> $model->id
                        )
                    );
                        return $count;
                        },
                'filter'=>CHtml::activeTextField($model,'boat_search'),
                'type'=>'text'),
            array('name'=>'status.name',
            'header'=> 'Progress',
            'filter'=>CHtml::activeTextField($model,'status_search'),
            ),
        ),
    ));
// Group Member View
} else {
     $this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'event-grid',
        'type' => TbHtml::GRID_TYPE_HOVER,
        'dataProvider'=>$model->adminDashboard(),
        // 'ajaxUpdate' => false,
        'filter'=>$model,
        'columns'=>array(
            // 'id',
            array('name'=>'organisation.organisation',
            'filter'=>CHtml::activeTextField($model,'age_group_search'),
            ),
            'name',
            array(
                'header'=>'Groups',
                'value'=> function ($model) {
                    $count = GroupEvent::model()->countByAttributes(
                        array(
                            'event_id'=> $model->id
                        )
                    );
                        return $count;
                        },
                'filter'=>CHtml::activeTextField($model,'boat_search'),
                'type'=>'text'),
            array('name'=>'status.name',
            'header'=> 'Progress',
            'filter'=>CHtml::activeTextField($model,'status_search'),
            ),
        ),
    ));
}