<h5> <?php echo $data->title; ?> </h5>

<p> <?php echo $data->message; ?> </p>

<?php echo CHtml::link(Yum::t('Answer'), '', array(
			'onClick' => "$('#usergroup_answer_".$data->id."').toggle(500)")); ?>

<div style="display:none;" id="usergroup_answer_<?php echo $data->id; ?>">
<h4> <?php echo Yum::t('Answer to this message'); ?> </h4>
<?php
$this->renderPartial('_message_form', array(
			'title' => Yum::t('Re: ') . ' ' . $data->title,
			'group_id' => $data->group_id));
?>

</div>

<hr />
