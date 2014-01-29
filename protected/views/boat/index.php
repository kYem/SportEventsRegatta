<?php
/* @var $this BoatController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Boats',
);

$this->menu=array(
	array('label'=>'Create Boat', 'url'=>array('create')),
	array('label'=>'Manage Boat', 'url'=>array('admin')),
);
?>

<h1>Boats</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
