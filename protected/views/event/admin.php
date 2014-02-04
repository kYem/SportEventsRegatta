<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	'Manage',
);

$this->menu=array(
   	array('label'=>'Event Administration'),
    array('label'=>'Overview', 'icon'=>'home', 'url'=>array('admin'), 'active'=>true),
    array('label'=>'Create', 'icon'=>'pencil', 'url'=>array('create')),
    array('label'=>'All Events', 'icon'=>'list', 'url'=>array('index')),

	);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#event-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Events</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); 
?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'event-grid',
	'type' => TbHtml::GRID_TYPE_HOVER,
	'dataProvider'=>$model->searchEvents(),
	// 'ajaxUpdate' => false,
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		array('header'=>'Boat',  
			'value'=> function ($model) {
                           $boatName = array();
                           foreach ($model->boats as $boat) {
                              $boatName[] = $boat->name;
                           }
                           return implode(', ', $boatName);
                         } ,
	        'filter'=>CHtml::activeTextField($model,'boatEvent_search'),
			'type'=>'text'),
		array(
		        'name' => 'boats.name',
		        'header'=> 'Boat',
		        'filter' => CHtml::activeTextField($model->searchBoat, 'name'),
		    ),	
		array('name'=>'organisation.organisation',    
	    'filter'=>CHtml::activeTextField($model,'organisation_search'),
	    ),
		array('name'=>'age_group.name',
	    'header'=> 'Age Group',
	    'filter'=>CHtml::activeTextField($model,'age_group_search'),
	    ),
		// 'star_date',
		// 'end_date',
		'min_participant',
		'max_participant',
		// 'age_id',
		'seats',
		array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
	),
)); ?>