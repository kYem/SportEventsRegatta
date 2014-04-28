<?php
/* @var $this RaceModelController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Race Models',
);

$this->menu=array(
	array('label'=>'Create RaceModel', 'url'=>array('create')),
	array('label'=>'Manage RaceModel', 'url'=>array('admin')),
);
?>

<h1>Race Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
