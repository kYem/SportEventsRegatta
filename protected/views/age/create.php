<?php
/* @var $this AgeController */
/* @var $model Age */

$this->breadcrumbs=array(
	'Ages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Age', 'url'=>array('index')),
	array('label'=>'Manage Age', 'url'=>array('admin')),
);
?>

<h1>Create Age</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>