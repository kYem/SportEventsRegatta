<?php
/* @var $this OrganisationController */
/* @var $model Organisation */

$this->breadcrumbs=array(
	'Organisations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Organisation', 'url'=>array('index')),
	array('label'=>'Manage Organisation', 'url'=>array('admin')),
);
?>

<h1>Create Organisation</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>