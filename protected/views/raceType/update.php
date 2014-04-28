<?php
/* @var $this RaceTypeController */
/* @var $model RaceType */

$this->breadcrumbs=array(
	'Race Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RaceType', 'url'=>array('index')),
	array('label'=>'Create RaceType', 'url'=>array('create')),
	array('label'=>'View RaceType', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RaceType', 'url'=>array('admin')),
);
?>

<h1>Update RaceType <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>