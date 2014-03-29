<?php
/* @var $this RegattaController */
/* @var $model Regatta */

$this->breadcrumbs=array(
	'Regattas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Regatta', 'url'=>array('index')),
	array('label'=>'Manage Regatta', 'url'=>array('admin')),
);
?>

<h1>Create Regatta</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>