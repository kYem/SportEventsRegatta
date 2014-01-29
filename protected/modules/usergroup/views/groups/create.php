<?php
$this->breadcrumbs=array(
	Yum::t('Group')=>array('index'),
	Yum::t('Create'),
);

?>

<?php $this->title = Yum::t('Create Usergroup'); ?> 
<?php
$this->renderPartial('_form', array(
			'model' => $model,
			'buttons' => 'create'));

?>

