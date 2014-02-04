<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/main.php'),
	array(
		'components'=>array(
			'fixture'=>array(
				'class'=>'system.test.CDbFixtureManager',
			),
			 // uncomment the following to provide test database connection
			'db' => require(dirname(__FILE__) . '/db.php'),
			
			 'log'=>array(
                        'class'=>'CLogRouter',
                        'routes'=>array(
                                        'class'=>'CFileLogRoute',
                                        'levels'=>'trace',
                                        'categories'=>'system.db.*',
                                        'logFile'=>'sql.log',
                                ),
                        ),

			////

		),
	)
);
