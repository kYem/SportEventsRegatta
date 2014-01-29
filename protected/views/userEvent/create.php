<?php
/* @var $this UserEventController */
/* @var $model UserEvent */

$this->breadcrumbs=array(
	'User Events'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserEvent', 'url'=>array('index')),
	array('label'=>'Manage UserEvent', 'url'=>array('admin')),
);
?>

<h1>Create UserEvent</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>