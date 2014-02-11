<?php
$this->breadcrumbs=array(
	'Groups'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('app', 'Assign Memeber'),
);

?>
<h1> <?php echo Yii::t('app', 'Update');?> Usergroup #<?php echo $model->id; ?> </h1>
<?php
$this->renderPartial('_member', array(
			'model'=>$model,
			'event' => $event));
?>
