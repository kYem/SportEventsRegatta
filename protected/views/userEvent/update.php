<?php
/* @var $this UserEventController */
/* @var $model UserEvent */

$this->breadcrumbs=array(
	'User Events'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserEvent', 'url'=>array('index')),
	array('label'=>'Create UserEvent', 'url'=>array('create')),
	array('label'=>'View UserEvent', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserEvent', 'url'=>array('admin')),
);
?>

<h1>Update UserEvent <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>