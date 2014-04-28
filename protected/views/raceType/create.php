<?php
/* @var $this RaceTypeController */
/* @var $model RaceType */

$this->breadcrumbs=array(
	'Race Types'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RaceType', 'url'=>array('index')),
	array('label'=>'Manage RaceType', 'url'=>array('admin')),
);
?>

<h1>Create RaceType</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>