<?php
/* @var $this BoatController */
/* @var $model Boat */

$this->breadcrumbs=array(
	'Boats'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Boat', 'url'=>array('index')),
	array('label'=>'Manage Boat', 'url'=>array('admin')),
);
?>

<h1>Create Boat</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>