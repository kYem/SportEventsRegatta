
<?php
$this->title = Yum::t('Manage users');

$this->breadcrumbs = array(
		Yum::t('Users'),
		Yum::t('Manage'));



$columns = array(
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
		array(
			'name'=>'id',
			'filter' => false,
			'type'=>'raw',
		'headerHtmlOptions' => array('class' => 'span1'),
			'value'=>'CHtml::link($data->id,
				array("//user/user/update","id"=>$data->id))',
			),
		array(
			'name'=>'username',
			'type'=>'raw',
		'headerHtmlOptions' => array('class' => 'span1'),
			'value'=>'CHtml::link(CHtml::encode($data->username),
				array("//user/user/view","id"=>$data->id))',
			),
		);

if(Yum::hasModule('profile') && isset($profile))
foreach(Yum::module('profile')->gridColumns as $column)
$columns[] = array(
		'header' => Yum::t($column),
		'filter' => CHtml::textField('YumProfile['.$column.']', $profile->$column),
		'name' => 'profile.'.$column,
		'headerHtmlOptions' => array('class' => 'span1'),
		);

/*$columns[] = array(
		'name'=>'createtime',
		'filter' => false,
		'value'=>'date(UserModule::$dateFormat,$data->createtime)',
		'headerHtmlOptions' => array('class' => 'span1'),
		);*/
/*$columns[] = array(
		'name'=>'lastvisit',
		'filter' => false,
		'value'=>'date(UserModule::$dateFormat,$data->lastvisit)',
		'headerHtmlOptions' => array('class' => 'span1'),
		);*/
/*$columns[] = array(
		'name'=>'status',
		'filter' => array(
			'0' => Yum::t('Not active'),
			'1' => Yum::t('Active'),
			'-1' => Yum::t('Banned'),
			'-2' => Yum::t('Deleted')),
		'value'=>'YumUser::itemAlias("UserStatus",$data->status)',
		'headerHtmlOptions' => array('class' => 'span1'),
		);*/
$columns[] = array(
		'name'=>'superuser',
		'filter' => array(0 => Yum::t('No'), 1 => Yum::t('Yes')),
		'value'=>'YumUser::itemAlias("AdminStatus",$data->superuser)',
		'headerHtmlOptions' => array('class' => 'span1'),
		);

if(Yum::hasModule('role'))
$columns[] = array(
		'header'=>Yum::t('Roles'),
		'name'=>'filter_role',
		'type' => 'raw',
		'visible' => Yum::hasModule('role'),
		'filter' => CHtml::listData(YumRole::model()->findAll(), 'id', 'title'),
		'value'=>'$data->getRoles()',
		'headerHtmlOptions' => array('class' => 'span1'),
		);

$this->widget('bootstrap.widgets.TbGridView',array(
			'dataProvider'=>$model->search(),
			'filter' => $model,
			'columns'=>$columns,
			
			)
		); ?>
<?php
	echo CHtml::link(Yum::t('Create new User'), array(
			'//user/user/create'), array('class' => 'btn')); 
?>

