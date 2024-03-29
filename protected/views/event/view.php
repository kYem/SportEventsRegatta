<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	$model->name,
);


?>

<h1>Event <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array('label'=>'Boat',
			'value'=> function ($model) {
                           $boatName = array();
                           foreach ($model->boats as $boat) {
                              $boatName[] = $boat->name;
                           }
                           return implode(', ', $boatName);
                         } ,
			'type'=>'text'),

		'min_participant',
		'max_participant',
        array(
            'name'=> 'age_group.name',
            'label'=>'Age Group',
            ),
		'seats',
	),
));
?>
<h3>Participanting Groups</h3>
<ul>
<?php
$groups =$model->groups;
if ($groups) {

    foreach ($groups as $key => $group) {
        $link = Yii::app()->createUrl("usergroup/groups/view/", array("id"=> $group->id ));
        echo '<li><a href="'.$link.'">'.$group->title.'</a></li>';
    }
} else {
    echo '<h5>None</h5>';
}

?>
</ul>

