<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Event Administration'),
    array('label'=>'Overview', 'icon'=>'home', 'url'=>array('admin'), 'active'=>true),
    array('label'=>'Create', 'icon'=>'pencil', 'url'=>array('create')),
    array('label'=>'All Events', 'icon'=>'list', 'url'=>array('index')),

	array('label'=>'Update Event','icon'=>'edit', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Event','icon'=>'list', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Event #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		array('label'=>'Boat',  
			'value'=> function ($model) {
                           $boatName = array();
                           foreach ($model->boats as $boat) {
                              $boatName[] = $boat->name;
                           }
                           return implode(', ', $boatName);
                         } ,
			'type'=>'text'),	
		'star_date',
		'end_date',
		'min_participant',
		'max_participant',
		'age_id',
		'organisation_id',
		'seats',
	),
)); ?>
