<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar', array(
	'brandLabel'=>CHtml::image(Yii::app()->getBaseUrl().'/images/logo.png'),
	'collapse'=>false,
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbNav',
            'items'=>array(
                array('label'=>'Home', 'url'=>array('//site/index')),
                array('label'=>'Events', 'url'=>array('//event/index')),
                array('label'=>'Spectators', 'url'=>array('/site/page', 'view'=>'map-of-course')),
                array('label'=>'Results & Photos', 'url'=>array('/site/page', 'view'=>'regatta-results-photos')),
                array('label'=>'Contact', 'url'=>array('//site/contact')),
               
                array('label'=>'Login', 'url'=>array('//user/auth/'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('//site/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
        ),
    ),
)); ?>


<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumb', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<footer class='page-footer'>
		Copyright &copy; <?php echo date('Y'); ?> by Kestutis Kasiulynas.<br/>
		All Rights Reserved.<br/>
	</footer><!-- footer -->

</div><!-- page -->

</body>
</html>
