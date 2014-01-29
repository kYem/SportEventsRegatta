<?php
/* @var $this OrganisationController */
/* @var $model Organisation */

$this->breadcrumbs=array(
	'Organisations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Organisation', 'url'=>array('index')),
	array('label'=>'Create Organisation', 'url'=>array('create')),
	array('label'=>'View Organisation', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Organisation', 'url'=>array('admin')),
);
?>

<h1>Update Organisation <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>