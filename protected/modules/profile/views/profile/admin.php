<?php

$columns = YumProfile::getProfileFields();

 $this->widget('bootstrap.widgets.TbGridView', array(
			'id'=>'profiles-grid',
			'dataProvider'=>$dataProvider,
			'filter'=>null,
			'columns'=>$columns,
			)
); ?>


