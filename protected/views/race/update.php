<?php
/* @var $this RaceController */
/* @var $model Race */

$this->breadcrumbs=array(
	'Races'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Race', 'url'=>array('index')),
	array('label'=>'Create Race', 'url'=>array('create')),
	array('label'=>'View Race', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Race', 'url'=>array('admin')),
);
?>

<h1>Update Race <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>