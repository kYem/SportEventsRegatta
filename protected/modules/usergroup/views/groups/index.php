<?php
$this->breadcrumbs = array(
		'Groups'=>array('index')
		);

$this->title = Yum::t('Usergroups'); ?>

<?php $this->widget('bootstrap.widgets.TbListView', array(
			'template' => "{sorter}\n{items}\n{pager}",
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
			)); ?>

<?php 
	if(Yii::app()->user->can('userGroup', 'create')) {
	echo CHtml::link(Yum::t('Create new Usergroup'), array(
			'//usergroup/groups/create')); 
	}
			?>
