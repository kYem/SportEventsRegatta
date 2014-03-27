<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<h1>About</h1>

<p>This is a "static" page. You may change the content of this page
by updating the file <code><?php echo __FILE__; ?></code>.</p>
<?php


    $rez =YumUsergroup::model()->with(
        array('user'=>array(
            // we don't want to select posts
            // 'select'=>false,
            // but want to get only users with published posts
            'joinType'=>'INNER JOIN',
            'condition'=>'user.id=2',
            )
        )
    )->findAll();
    echo '<pre>'; print_r($rez); echo '</pre>';
    echo "OK";


 ?>