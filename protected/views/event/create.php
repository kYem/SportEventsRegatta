<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	'Create',
);
$this->menu=array(
	array('label'=>'Event Administration'),
    array('label'=>'Overview', 'icon'=>'home', 'url'=>array('admin')),
    array('label'=>'Create', 'icon'=>'pencil', 'url'=>array('create'), 'active'=>true),
    array('label'=>'All Events', 'icon'=>'list', 'url'=>array('index')),
   

	);
?>

<h1>Create Event</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>