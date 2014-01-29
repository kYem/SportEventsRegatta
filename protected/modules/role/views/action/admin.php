
<?php
$this->breadcrumbs=array(
	Yum::t('Actions')=>array('index'),
	Yum::t('Manage'),
);

?>
<h1> <?php echo Yum::t('Manage Actions'); ?></h1>

<?php



 $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'action-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'title',
		'comment',
		'subject',
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
	),
			
)); 
echo CHtml::link(
		Yum::t('Create new Action'), array(
			'//role/action/create'), array('class' => 'btn')); 

?>


