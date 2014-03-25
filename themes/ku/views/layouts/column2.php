<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
    <div class="span9">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
    <div class="span3">
        <div id="sidebar">



        <div>
            <?php  echo TbHtml::imageRounded(Yii::app()->getBaseUrl().'/images/crews.png', 'Reggata'); ?>
            <h3></h3>
            <p style="text-align: left; "></p><p style="text-align: left; "></p>
            <?php

            if (Yii::app()->user->isGuest)        {
                echo '<h3>Regatta Dates</h3>';
                echo '<p>1st July - 5th July 2015</p>';
                echo '<p>2nd July - 6th July 2014</p>';
                echo TbHtml::lead('Available events');
            $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'event-grid',
            'type' => TbHtml::GRID_TYPE_HOVER,
            'template'=>"{items}\n{pager}",
            'dataProvider'=>Event::model()->search(),
            'columns'=>array(
                 array(
                    'name' => 'name',
                    'header' => 'Event',

                ),
                'star_date',
            ),
        )); }?>


        </div>

     <?php
      if (Yii::app()->user->isAdmin()) {
    $this->widget('bootstrap.widgets.TbNav', array(
            'type' => TbHtml::NAV_TYPE_LIST,
            'items'=>array(
                array('label'=>'Administration'),
                array('label'=>'Dashboard', 'icon'=>'cog', 'url'=>array('//event/dashboard')),
                array('label'=>'Users', 'icon'=>'user',
                    'items' => array(
                        array('label'=> 'Statistics', 'url'=>array('//user/statistics/index')),
                        array('label' => 'User Administration', 'url' => array('//user/user/admin')),
                        array('label' => 'Avatar administration', 'url' => array('//avatar/avatar/admin'), 'visible' => Yum::hasModule('avatar')),
                        array('label' => 'Create new User', 'url' => array('//user/user/create')),
                        array('label' => 'Generate Demo Data', 'url' => array('//user/user/generateData'), 'visible' => Yum::module()->debug),
                        )
                    ),
                 array('label'=>'Events', 'icon'=>'flag', 'url'=>'event/admin','visible'=>Yii::app()->user->isAdmin(), 'items'=>array(
                        array('label'=>'Overview', 'icon'=>'home', 'url'=>array('//event/admin')),
                        array('label'=>'Create', 'icon'=>'pencil', 'url'=>array('//event/create')),
                        array('label'=>'All Events', 'icon'=>'list', 'url'=>array('//event/index')),
                    )),
                array(
                    'label'=>'Roles / Access control', 'icon'=>'check',
                    'active' => Yii::app()->controller->id == 'role' || Yii::app()->controller->id == 'permission' || Yii::app()->controller->id == 'action', 'visible' => Yum::hasModule('role'), 'items' => array(
                        array('label' => 'Roles', 'url' => array('//role/role/admin')),
                        array('label' => 'Create new role', 'url' => array('//role/role/create')),
                        array('label' => 'Permissions', 'url' => array('//role/permission/admin')),
                        array('label' => 'Grant permission', 'url' => array('//role/permission/create')),
                        array('label' => 'Actions', 'url' => array('//role/action/admin')),
                        array('label' => 'Create new action', 'url' => array('//role/action/create')),
                        )
                    ),
                array('label'=>'Membership',
                        'visible' => Yum::hasModule('membership'), 'items' => array(
                            array('label' => 'Ordered memberships', 'url' => array('//membership/membership/admin')),
                            array('label' => 'Payment types', 'url' => array('//membership/payment/admin')),
                            array('label' => 'Create new payment type', 'url' => array('//membership/payment/create')),
                            )
                        ),
               /* array('label'=>'Profiles',
                        'visible' => Yum::hasModule('profile'),
                        'items' => array(
                            array('label' => 'Manage profiles', 'url' => array('//profile/profile/admin')),
                            array('label'=>'My Profile', 'icon'=>'user', 'url'=>array('//profile/profile/view')),
                            array('label' => 'Show profile visits', 'url' => array('//profile/profile/visits')),
                            )
                        ),*/
                array('label' => 'Messages',
                        'visible' => Yum::hasModule('message'),
                        'items' => array (
                            array('label' => 'Admin inbox', 'url' => array('/message/message/index')),
                            array('label' => 'Sent messages', 'url' => array('/message/message/sent')),
                            array('label' => 'Write a message', 'url' => array('/message/message/compose')),
                            ),
                        ),
                array('label' => 'Misc', 'icon'=>'briefcase',
                        'items' => array(
                            array('label' => 'Text translations', 'url' => array('//user/translation/admin')),
                            array('label' => 'Upload avatar for admin', 'url' => array('//avatar/avatar/editAvatar'),
                                'visible' => Yum::hasModule('avatar')),
                            array('label' => 'Change admin Password', 'url' => array('//user/user/changePassword')),
                            array('label' => 'Logout', 'url' => array('//user/user/logout')),
                            )
                        ),
                TbHtml::menuDivider(),
                ),
        ));
    }
     if (!Yii::app()->user->isGuest) {
         $this->widget('bootstrap.widgets.TbNav', array(
            'type' => TbHtml::NAV_TYPE_LIST,
            'items'=>array(
                array('label'=>'USER SETTINGS'),
                array('label'=>'Profile', 'icon'=>'user', 'url'=>array('//profile/profile/view')),
                // array('label'=>'Manage Profile', 'icon'=>'cog', 'url'=>array('//user/user/index')),
                array('label'=>'Edit Profile', 'icon'=>'pencil', 'url'=>array('//profile/profile/update')),
                // array('label' => 'Privacy settings','icon'=>'lock', 'url' => array('/profile/privacy/update')),
                 array(
                    'label' => 'Upload avatar image',
                    'url' => array('/avatar/avatar/editAvatar'),
                    'visible' => Yum::hasModule('avatar'),
                    ),
                TbHtml::menuDivider(),

                array('label' => 'Membership','visible' => Yum::hasModule('membership'),
                    'items' => array(
                        array('label' => 'My memberships', 'url' => array('/membership/membership/index')),
                        array('label' => 'Browse memberships', 'url' => array('/membership/membership/order')),
                        )
                    ),

                array('label' => 'Messages', 'visible' => Yum::hasModule('message')),
                array('label' => 'My inbox', 'icon'=>'envelope', 'visible' => Yum::hasModule('message'),'url' => array('/message/message/index')),
                array('label' => 'Sent messages', 'icon'=>'arrow-right', 'visible' => Yum::hasModule('message'), 'url' => array('/message/message/sent')),
                 // TbHtml::menuDivider(),


                array(
                    'label' => 'My friends',
                    'url' => array('/friendship/friendship/index'),
                    'visible' => Yum::hasModule('friendship') && Yii::app()->user->isAdmin()),
                // array('label' => 'Browse users', 'url' => array('/user/user/browse')),
                array('label' => 'Group'),
                array('label' => 'My group',
                    'visible' =>  Yum::hasModule('usergroup') && !Yii::app()->user->isAdmin(),
                    'url' => array('/usergroup/groups/index'),
                    'icon'=>'bullhorn'),
                 array('label' => 'Manage groups',
                    'visible' =>  Yum::hasModule('usergroup') && Yii::app()->user->isAdmin(),
                    'url' => array('//usergroup/groups/admin'),
                    'icon'=>'bullhorn'),


                array('label' => 'Create new Group', 'icon'=>'plus', 'url' => array(
                        '/usergroup/groups/create'),
                    'visible' => Yum::hasModule('usergroup')),
                   /* array('label' => 'Browse Groups', 'url' => array(
                            '/usergroup/groups/browse'),
                        'visible' => Yum::hasModule('usergroup')),*/



               /* TbHtml::menuDivider(),
                array('label' => 'Misc', 'items' => array(
                            array('label' => 'Change password', 'url' => array('//user/user/changePassword')),
                            array('label' => 'Delete account', 'url' => array('//user/user/delete')),
                            array('label' => 'Logout', 'url' => array('//user/user/logout')),
                            )
                        ),*/


            ),
        ));
    }
    ?>
    <p>&nbsp;</p>
    <?php
           /* $this->beginWidget('zii.widgets.CPortlet', array(

            ));
            $this->widget('bootstrap.widgets.TbNav', array(
                'type'=>'list',
                'items'=>$this->menu,
                'htmlOptions'=>array('class'=>'operations'),
            ));
            $this->endWidget();*/

        ?>

        </div><!-- sidebar -->
    </div>
</div>
<?php $this->endContent(); ?>