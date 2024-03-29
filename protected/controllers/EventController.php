<?php

class EventController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('dashboard'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'create','update', 'ChangeRegattaPhase'),
				'users'=>array('admin'),
				'expression' => 'Yii::app()->user->can("event", "create")',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
				'deniedCallback' =>  function() { Yii::app()->controller->redirect(array ('/site/index')); }
			),
		);
	}


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Event;
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Event']))
		{
			$model->attributes=$_POST['Event'];

			if(isset($_POST['Boat']))
			{
				$model->boats = $_POST['Boat'];
			}

			if($model->saveWithRelated('boats')) {
				$this->redirect(array('admin'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Event']))
		{
			$model->attributes=$_POST['Event'];
			if(isset($_POST['Boat']))
			{
				$model->boats = $_POST['Boat'];
			}
			if($model->saveWithRelated('boats'))
				$this->redirect(array('admin'));
			else
				$model->addError('aaa', 'Error occured while  saving boats.');
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider(
			'Event',
			array(
			    'criteria' => array(

			    ),
			    'pagination'=>array(
			      'pageSize'=>9,
			    ),
			)
		);
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Event('search');
		$model->unsetAttributes();  // clear any default values
		$boat = new Boat('search');
		$boat->unsetAttributes();
		$model->searchBoat = $boat;
		if(isset($_GET['Event']))
			$model->attributes=$_GET['Event'];
		if (isset($_GET['Boat'])) {
        	$boat->attributes = $_GET['Boat'];
    }
			/*Event::model()->attributes = $_GET['Boat'];*/
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages dashboard
	 */
	public function actionDashboard()
	{
		$model=new Event('search');
		$model->unsetAttributes();  // clear any default values
		$regatta = Regatta::model()->findByPk(1);
		if(isset($_GET['Event']))
			$model->attributes=$_GET['Event'];
		if (isset($_GET['Boat'])) {
        	$boat->attributes = $_GET['Boat'];
    }

		$this->render('dashboard',array(
			'model'=>$model,
			'regatta'=>$regatta,
		));
	}


	/**
	 * Change Phase for all Events
	 */
	public function actionChangeRegattaPhase()
	{
		if(isset($_POST['Event']['status_id']))
			$stat_id = (int) $_POST['Event']['status_id'];

		$sql  = 'UPDATE ku_rg_event set status_id = '.$stat_id.';';
		$sql .= 'UPDATE ku_rg_regatta set status_id = '.$stat_id.';';

		$result = Yii::app()->db->createCommand($sql)->execute();
		if($result)
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('dashboard'));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Event the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Event::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Event $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='event-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
