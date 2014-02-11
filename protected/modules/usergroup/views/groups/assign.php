<?php
$this->breadcrumbs=array(
	'Groups'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('app', 'Join Events'),
);

?>
<h1>Group <?php echo $model->title; ?> - Join Event  </h1>
<?php
$this->renderPartial('_member', array(
			'model'=>$model,
			'event' => $event));
?>
