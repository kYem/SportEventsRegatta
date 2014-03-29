<?php
/* @var $this RegattaController */
/* @var $model Regatta */

$this->breadcrumbs=array(
	'Regattas'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Regatta', 'url'=>array('index')),
	array('label'=>'Create Regatta', 'url'=>array('create')),
	array('label'=>'View Regatta', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Regatta', 'url'=>array('admin')),
);
?>

<h1>Update Regatta <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>