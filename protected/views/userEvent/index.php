<?php
/* @var $this UserEventController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Events',
);

$this->menu=array(
	array('label'=>'Create UserEvent', 'url'=>array('create')),
	array('label'=>'Manage UserEvent', 'url'=>array('admin')),
);
?>

<h1>User Events</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
