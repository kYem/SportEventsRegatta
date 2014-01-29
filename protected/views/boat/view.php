<?php
/* @var $this BoatController */
/* @var $model Boat */

$this->breadcrumbs=array(
	'Boats'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Boat', 'url'=>array('index')),
	array('label'=>'Create Boat', 'url'=>array('create')),
	array('label'=>'Update Boat', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Boat', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Boat', 'url'=>array('admin')),
);
?>

<h1>View Boat #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
	),
)); ?>
