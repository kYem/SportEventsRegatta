<?php
/* @var $this RaceModelController */
/* @var $model RaceModel */

$this->breadcrumbs=array(
	'Race Models'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RaceModel', 'url'=>array('index')),
	array('label'=>'Create RaceModel', 'url'=>array('create')),
	array('label'=>'View RaceModel', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RaceModel', 'url'=>array('admin')),
);
?>

<h1>Update RaceModel <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>