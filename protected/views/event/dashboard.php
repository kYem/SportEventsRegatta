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



<?php $this->widget('bootstrap.widgets.TbGridView', array(
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
)); ?>


<?php echo '<pre>'; print_r($model->id); echo '</pre>'; ?>