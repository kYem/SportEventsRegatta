<?php
/* @var $this AgeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ages',
);

$this->menu=array(
	array('label'=>'Create Age', 'url'=>array('create')),
	array('label'=>'Manage Age', 'url'=>array('admin')),
);
?>

<h1>Ages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
