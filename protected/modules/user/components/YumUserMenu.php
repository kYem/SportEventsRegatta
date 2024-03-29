<?php
Yii::import('zii.widgets.CPortlet');

class YumUserMenu extends CPortlet {
	public function init() {
		$this->title = sprintf('%s: %s',
				Yum::t('Logged in as'),
				Yii::app()->user->data()->profile->firstname);

		$this->contentCssClass = 'menucontent';
		return parent::init();
	}

	public function run() {
		$this->widget('bootstrap.widgets.TbNav', array(
        'type' => TbHtml::NAV_TYPE_LIST,
					'items' => $this->getMenuItems(),
					));

		parent::run();
	}

	public function getMenuItems() {
		return array(
				array('label'=>'MANAGE'),
				array('label' => 'Profile', 'icon'=>'user', 'visible' => Yum::hasModule('profile'), 'items' => array(
						array('label'=>'Profile',  'url'=>array('//profile/profile/view')),
						array('label' => 'Edit personal data', 'url' => array(
								'//profile/profile/update')),
						array(
							'label' => 'Upload avatar image',
							'url' => array('/avatar/avatar/editAvatar'),
							'visible' => Yum::hasModule('avatar'),
							),
						array('label' => 'Privacy settings', 'url' => array('/profile/privacy/update')),
						)
					),

				array('label' => 'Membership',
					'visible' => Yum::hasModule('membership')
					,'items' => array(
						array('label' => 'My memberships', 'url' => array('/membership/membership/index')),
						array('label' => 'Browse memberships', 'url' => array('/membership/membership/order')),
						)
					),

				array('label' => 'Messages',
					'visible' => Yum::hasModule('message'),
					'items' => array (
						array('label' => 'My inbox', 'url' => array('/message/message/index')),
						array('label' => 'Sent messages', 'url' => array('/message/message/sent')),
						),
					),

				array('label' => 'Social', 'items' => array(
							array(
								'label' => 'My friends',
								'url' => array('/friendship/friendship/index'),
								'visible' => Yum::hasModule('friendship')),
							array('label' => 'Browse users', 'url' => array('/user/user/browse')),
							array('label' => 'My groups', 'url' => array(
									'/usergroup/groups/index'),
								'visible' => Yum::hasModule('usergroup')),
								array('label' => 'Create new Group', 'url' => array(
										'/usergroup/groups/create'),
									'visible' => Yum::hasModule('usergroup')),
								array('label' => 'Browse Groups', 'url' => array(
										'/usergroup/groups/browse'),
									'visible' => Yum::hasModule('usergroup')),
								),
						),
				array('label' => 'Misc', 'items' => array(
							array('label' => 'Change password', 'url' => array('//user/user/changePassword')),
							array('label' => 'Delete account', 'url' => array('//user/user/delete')),
							array('label' => 'Logout', 'url' => array('//user/user/logout')),
							)
						),

				);
	}
}
?>






