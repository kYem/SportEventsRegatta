<?php
/* @var $this UserEventController */
/* @var $model UserEvent */

$this->breadcrumbs=array(
	'User Events'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserEvent', 'url'=>array('index')),
	array('label'=>'Create UserEvent', 'url'=>array('create')),
	array('label'=>'Update UserEvent', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserEvent', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserEvent', 'url'=>array('admin')),
);
?>

<h1>View UserEvent #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'event_id',
	),
)); ?>
