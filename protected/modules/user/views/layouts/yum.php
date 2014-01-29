<?php 
Yii::app()->clientScript->registerCssFile(
		Yii::app()->getAssetManager()->publish(
			Yii::getPathOfAlias('YumModule.assets.css').'/yum.css'));

$this->beginContent(Yum::module()->baseLayout); ?>

<div class="row">
    <div class="span9">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
    <div class="span3">
        <div id="sidebar">
			<?php
			if (Yum::module()->debug) {
				echo CHtml::openTag('div', array('class' => 'yumwarning'));
				echo Yum::t(
						'You are running the Yii User Management Module {version} in Debug Mode!', array(
							'{version}' => Yum::module()->version));
				echo CHtml::closeTag('div');
			}
			Yum::renderFlash(); 

			if(!Yii::app()->user->isGuest)
				echo $this->renderMenu();
			?>
        <?php
            $this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>'Operations',
            ));
            $this->widget('bootstrap.widgets.TbMenu', array(
                'items'=>$this->menu,
                'htmlOptions'=>array('class'=>'operations'),
            ));
            $this->endWidget();

        ?>
        <p>&nbsp;</p>
        <?php $this->widget('bootstrap.widgets.TbNav', array(
        'type' => TbHtml::NAV_TYPE_LIST,
        'items'=>array(
            array('label'=>'USER SETTINGS'),
            array('label'=>'Profile', 'icon'=>'user', 'url'=>array('//profile/profile/view')),
            array('label'=>'Manage Profile', 'icon'=>'cog', 'url'=>array('//user/user/index')),
            array('label'=>'Edit Profile', 'icon'=>'pencil', 'url'=>array('//profile/profile/update')),
            TbHtml::menuDivider(),
            array('label'=>'Events', 'icon'=>'flag', 'url'=>'event/admin','visible'=>Yii::app()->user->isAdmin(), 'items'=>array(
                    array('label'=>'Overview', 'icon'=>'home', 'url'=>array('event/admin')),
                    array('label'=>'Create', 'icon'=>'pencil', 'url'=>array('event/create')),
                    array('label'=>'All Events', 'icon'=>'list', 'url'=>array('event/index')),
                )),
           /* array('label'=>'All Events', 'icon'=>'flag','visible'=>Yii::app()->user->isGuest, 'url'=>array('event/index')),*/
        ),
    )); ?>
        
        </div><!-- sidebar -->
    </div>
</div>
<?php $this->endContent(); ?>




