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
	'dataProvider'=>$model->searchEvents(),
	// 'ajaxUpdate' => false,
	'filter'=>$model,
	'columns'=>array(
		// 'id',
		'name',
		array('name'=>'age_group.name',
	    'header'=> 'Age Group',
	    'filter'=>CHtml::activeTextField($model,'age_group_search'),
	    ),
		array(
			'name'=>'boats.name',
			'header'=>'Boat',  
			'value'=> function ($model) {
                           $boatName = array();
                           foreach ($model->boats as $boat) {
                              $boatName[] = $boat->name;
                           }
                           return implode(', ', $boatName);
                         } ,
	        'filter'=>CHtml::activeTextField($model,'boat_search'),
			'type'=>'text'),
		'seats',
		array('name'=>'status.name',
		'header'=> 'Status',    
	    'filter'=>CHtml::activeTextField($model,'status_search'),
	    ),
	),
)); ?>