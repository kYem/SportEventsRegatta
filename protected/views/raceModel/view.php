<?php
/* @var $this RaceModelController */
/* @var $model RaceModel */

$this->breadcrumbs=array(
	'Race Models'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List RaceModel', 'url'=>array('index')),
	array('label'=>'Create RaceModel', 'url'=>array('create')),
	array('label'=>'Update RaceModel', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RaceModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RaceModel', 'url'=>array('admin')),
);
?>

<h1>View RaceModel #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
	),
)); ?>
