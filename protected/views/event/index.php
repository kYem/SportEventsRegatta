<?php
/* @var $this EventController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Events',
);

$this->menu=array(
	array('label'=>'Event Administration'),
    array('label'=>'Overview', 'icon'=>'home', 'url'=>array('admin')),
    array('label'=>'Create', 'icon'=>'pencil', 'url'=>array('create')),
    array('label'=>'All Events', 'icon'=>'list', 'url'=>array('index'), 'active'=>true),
);
?>

<h1>Events</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
