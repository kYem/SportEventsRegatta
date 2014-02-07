<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Event Administration'),
    array('label'=>'Overview', 'icon'=>'home', 'url'=>array('admin')),
    array('label'=>'Create', 'icon'=>'pencil', 'url'=>array('create')),
    array('label'=>'All Events', 'icon'=>'list', 'url'=>array('index')),
	array('label'=>'View Event', 'icon'=>'zoom-in', 'url'=>array('view', 'id'=>$model->id), 'active'=>true),
	
);
?>

<h1>Update Event <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_update', array('model'=>$model)); ?>