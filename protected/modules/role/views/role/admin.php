<?php
$this->title = Yum::t('Manage roles'); 

$this->breadcrumbs=array(
	Yum::t('Roles')=>array('index'),
	Yum::t('Manage'),
);

?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name' => 'title',
			'type' => 'raw',
			'value'=> 'CHtml::link(CHtml::encode($data->title),
				array("//role/role/view","id"=>$data->id))',
		),
		'price',
		'membership_priority',
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
	),
)); ?>
