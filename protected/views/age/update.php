<?php
/* @var $this AgeController */
/* @var $model Age */

$this->breadcrumbs=array(
	'Ages'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Age', 'url'=>array('index')),
	array('label'=>'Create Age', 'url'=>array('create')),
	array('label'=>'View Age', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Age', 'url'=>array('admin')),
);
?>

<h1>Update Age <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>