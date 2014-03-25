<?php

// Define a path alias for the Bootstrap extension as it's used internally.
// In this example we assume that you unzipped the extension under     protected/extensions.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Sports Event Management System',
	'theme'=>'ku', // requires you to copy the theme under your themes directory
	// preloading 'log' component
	'preload'=>array('log'),

	 // path aliases
    'aliases' => array(
        'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'),
      	// yiiwheels configuration
    	'yiiwheels' => realpath(__DIR__ . '/../extensions/yiiwheels'),
    ),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
  		'application.modules.user.models.*',
  		'application.modules.usergroup.models.*',
  		'bootstrap.helpers.TbHtml',
  		'bootstrap.helpers.TbArray',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'logi12',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths' => array('bootstrap.gii'),
		),

		'user' => array(
				'debug' => false,
				'userTable' => 'ku_user',
				'translationTable' => 'ku_translation',
			),
		'usergroup' => array(
				'usergroupTable' => 'ku_usergroup',
				'usergroupMessageTable' => 'ku_user_group_message',
			),
		/*'membership' => array(
				'membershipTable' => 'ku_membership',
				'paymentTable' => 'ku_payment',
			),*/
		/*'friendship' => array(
				'friendshipTable' => 'ku_friendship',
			),*/
		'profile' => array(
				'privacySettingTable' => 'ku_privacysetting',
				'profileTable' => 'ku_profile',
				'profileCommentTable' => 'ku_profile_comment',
				'profileVisitTable' => 'ku_profile_visit',
			),
		'role' => array(
				'roleTable' => 'ku_role',
				'userRoleTable' => 'ku_user_role',
				'actionTable' => 'ku_action',
				'permissionTable' => 'ku_permission',
			),
		/*'message' => array(
				'messageTable' => 'ku_message',
			),*/
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'class' => 'application.modules.user.components.YumWebUser',
	      	'allowAutoLogin'=>true,
	     	'loginUrl' => array('//user/user/login'),

		),
		'cache' => array('class' => 'system.caching.CDummyCache'),

		'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),
		'yiiwheels' => array(
            'class' => 'yiiwheels.YiiWheels',
        ),

		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'rules'=>array(
				''=>'site/index',
				'<view:(about)>' => 'site/page',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				// defaults to a site page if not above
     			'<view:[a-zA-Z0-9-]+>/'=>'site/page',
			),
		),
				// uncomment the following to use a MySQL database
		'db' => require(dirname(__FILE__) . '/db.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		// Log
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
		// Not Tracked local config
		 'log'=>require(dirname(__FILE__) . '/log.php'),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'mr.kyem@gmail.com',
	),
);
