<?php
/* @var $this RaceModelController */
/* @var $model RaceModel */

$this->breadcrumbs=array(
	'Race Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RaceModel', 'url'=>array('index')),
	array('label'=>'Manage RaceModel', 'url'=>array('admin')),
);
?>

<h1>Create RaceModel</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>