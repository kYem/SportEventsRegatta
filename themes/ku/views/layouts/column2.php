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
      if (Yii::app()->user->isAdmin() || Yii::app()->user->can("event", "create")) {
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

                            array('label' => 'Upload avatar for admin', 'url' => array('//avatar/avatar/editAvatar'),
                                'visible' => Yum::hasModule('avatar')),
                            array('label' => 'Change admin Password', 'url' => array('//user/user/changePassword')),
                            array('label' => 'Logout', 'url' => array('//user/user/logout')),
                            )
                        ),
                TbHtml::menuDivider(),
                ),
        ));
        // User and Groups
        $this->widget('bootstrap.widgets.TbNav', array(
            'type' => TbHtml::NAV_TYPE_LIST,
            'items'=>array(
                array('label'=>'USER SETTINGS'),
                array('label'=>'Profile', 'icon'=>'user', 'url'=>array('//profile/profile/view')),
                array('label'=>'Edit Profile', 'icon'=>'pencil', 'url'=>array('//profile/profile/update')),
                TbHtml::menuDivider(),


                array('label' => 'Manage Groups', 'visible' =>  Yum::hasModule('usergroup') && Yii::app()->user->getGroup()),
                array('label' => 'Manage Groups',
                    'visible' =>  Yum::hasModule('usergroup'),
                    'url' => array('/usergroup/groups/admin'),
                    'icon'=>'bullhorn'),
                array('label' => 'Create new Group',
                    'url' => array('/usergroup/groups/create'),
                    'icon'=>'plus'),



            ),
        ));
    } elseif (!Yii::app()->user->isGuest && !Yii::app()->user->isAdmin()) {
         $this->widget('bootstrap.widgets.TbNav', array(
            'type' => TbHtml::NAV_TYPE_LIST,
            'items'=>array(
                array('label'=>'USER SETTINGS'),
                array('label'=>'Profile', 'icon'=>'user', 'url'=>array('//profile/profile/view')),
                array('label'=>'Edit Profile', 'icon'=>'pencil', 'url'=>array('//profile/profile/update')),
                TbHtml::menuDivider(),


                array('label' => 'My Group', 'visible' =>  Yum::hasModule('usergroup') && (Yii::app()->user->getGroup()) OR Yii::app()->user->getMemberGroupId()),
                array('label' => 'Dashboard',
                    'visible' =>  Yum::hasModule('usergroup') && Yii::app()->user->getGroup(),
                    'url' => array('/usergroup/groups/view', 'id'=>Yii::app()->user->getGroup()),
                    'icon'=>'bullhorn'),
                array('label' => 'Dashboard',
                    'visible' =>  Yum::hasModule('usergroup') && Yii::app()->user->getMemberGroupId(),
                    'url' => array('/usergroup/groups/view', 'id'=>Yii::app()->user->getMemberGroupId()),
                    'icon'=>'bullhorn'),
                array('label' => 'Join Event',
                    'visible' =>  Yum::hasModule('usergroup') && Yii::app()->user->getGroup(),
                    'url' => array('/usergroup/groups/joinEvent', 'id'=>Yii::app()->user->getGroup()),
                    'icon'=>'plus'),
            ),
        ));
    }
    ?>
        </div><!-- sidebar -->
    </div>
</div>
<?php $this->endContent(); ?>