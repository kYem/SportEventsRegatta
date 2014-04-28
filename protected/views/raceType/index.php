<?php
/* @var $this RaceTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Race Types',
);

$this->menu=array(
	array('label'=>'Create RaceType', 'url'=>array('create')),
	array('label'=>'Manage RaceType', 'url'=>array('admin')),
);
?>

<h1>Race Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
