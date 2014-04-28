<?php
/* @var $this RaceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Races',
);

$this->menu=array(
	array('label'=>'Create Race', 'url'=>array('create')),
	array('label'=>'Manage Race', 'url'=>array('admin')),
);
?>

<h1>Races</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
