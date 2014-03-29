<?php
/* @var $this RegattaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Regattas',
);

$this->menu=array(
	array('label'=>'Create Regatta', 'url'=>array('create')),
	array('label'=>'Manage Regatta', 'url'=>array('admin')),
);
?>

<h1>Regattas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
