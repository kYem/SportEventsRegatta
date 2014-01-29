<?php

class YumUsergroupController extends YumController {
	public function beforeAction($event) {
		if (Yii::app()->user->isAdmin())
			$this->layout = Yum::module('usergroup')->adminLayout;
		else
			$this->layout = Yum::module('usergroup')->layout;
		return parent::beforeAction($event);
	}

	public function accessRules() {
		return array(
				array('allow',  
					'actions'=>array('index','view'),
					'users'=>array('*'),
					),
				array('allow', 
					'actions'=>array(
						'getOptions', 'create','update', 'browse', 'join', 'leave', 'write', 'assign', 'Updatep'),
						'users'=>array('@'),
					// 'expression' => 'Yii::app()->user->can("userGroup", "create")',
					),
				array('allow', 
					'actions'=>array('admin','delete'),
					'users'=>array('admin'),
					),
				array('deny', 
					'users'=>array('*'),
					),
				);
	}

	public function actionWrite() {
		Yii::import('application.modules.usergroup.models.YumUsergroupMessage');
		$message = new YumUsergroupMessage;

		if(isset($_POST['YumUsergroupMessage'])) {
			$message->attributes = $_POST['YumUsergroupMessage'];
			$message->author_id = Yii::app()->user->id;

			$message->save();
		}	

		$this->redirect(array('//usergroup/groups/view',
					'id' => $message->group_id));

	}	

	public function actionJoin($id = null) {
		if($id !== null) {
			$p = YumUsergroup::model()->findByPk($id);

			$participants = $p->participants;
			if(in_array(Yii::app()->user->id, $participants)) {
				Yum::setFlash(Yum::t('You are already participating in this group'));
			} else {
				$participants[] = Yii::app()->user->id;
				$p->participants = $participants;

				if($p->save(array('participants'))) {
					Yum::setFlash(Yum::t('You have joined this group'));
					Yum::log(Yum::t('User {username} joined group id {id}', array(
									'{username}' => Yii::app()->user->data()->username,
									'{id}' => $id)));

				}
			}
			$this->redirect(array('//usergroup/groups/view', 'id' => $id));
		} else throw new CHttpException(404);
	}

  /**
	*	Assign team members to the user group (Team)
	*
	*/

	public function actionAssign($id = null) {
		/*echo CHtml::link(Yum::t('Join group'), array(
				'//usergroup/groups/join', 'id' => $data->id)); */

		if($id !== null) {
			$p = YumUsergroup::model()->findByPk($id);

			$participants = $p->participants;
			if(in_array(Yii::app()->user->id, $participants)) {
				Yum::setFlash(Yum::t('You are already participating in this group'));
			} else {
				$participants[] = Yii::app()->user->id;
				$p->participants = $participants;

				if($p->save(array('participants'))) {
					Yum::setFlash(Yum::t('You have joined this group'));
					Yum::log(Yum::t('User {username} joined group id {id}', array(
									'{username}' => Yii::app()->user->data()->username,
									'{id}' => $id)));

				}
			}
			$this->redirect(array('//usergroup/groups/view', 'id' => $id));
		} else throw new CHttpException(404, 'You Cannot Assign Members to the Team');

				
		$participants = $model->findByPk($group_id)->participants;

		print_r($participants);
		// Array ( [1] => 5 [3] => 10 [4] => 15 [5] => 16 [6] => 4 )
		$groupMembers = YumUser::model()->getUsersByRole('TeamMember');
		if($groupMembers && $participants) {
		  foreach($groupMembers as $key => $groupMember) {
		      foreach($participants as $key => $participantId) {
		        if($groupMember->id == $participantId)
		        print_r('<br />'.$participantId);          
		      // print_r(YumUser::model()->getUsersByRole('TeamMember'));
		      }
		  }
		}  
	
	}

  /**
	*
	*
	*/

	public function actionLeave($id = null) {
		if($id !== null) {
			$p = YumUsergroup::model()->findByPk($id);

			$participants = $p->participants;
			if(!in_array(Yii::app()->user->id, $participants)) {
				Yum::setFlash(Yum::t('You are not participating in this group'));
			} else {
				$participants = $p->participants;
				foreach($participants as $key => $participant)
					if($participant == Yii::app()->user->id)
						unset($participants[$key]);
				$p->participants = $participants;

				if($p->save(array('participants'))) {
					Yum::setFlash(Yum::t('You have left this group'));
					Yum::log(Yum::t('User {username} left group id {id}', array(
									'{username}' => Yii::app()->user->data()->username,
									'{id}' => $id)));

				}
			}
			$this->redirect(array('//usergroup/groups/index'));
		} else throw new CHttpException(404);
	}

	public function actionView($id) {
		$model = $this->loadModel($id);

		$this->render('view',array(
					'model' => $model,
					));
	}

	public function loadModel($id = false)
	{
		if($this->_model === null)
		{
			if(is_numeric($id))	
				$this->_model = YumUsergroup::model()->findByPk($id);
			else if(is_string($id))	
				$this->_model = YumUsergroup::model()->find('title = :title', array(
							':title' => $id));
			if($this->_model === null)
				throw new CHttpException(404,'The requested Usergroup does not exist.');
		}
		return $this->_model;
	}

	public function actionCreate() {
		$model = new YumUsergroup;

		$this->performAjaxValidation($model, 'usergroup-form');

		if(isset($_POST['YumUsergroup'])) {
			$model->attributes = $_POST['YumUsergroup'];
			$model->owner_id = Yii::app()->user->id;
			$model->participants = array($model->owner_id);

			if($model->save()) 
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array( 'model'=>$model));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		$this->performAjaxValidation($model, 'usergroup-form');

		if(isset($_POST['YumUsergroup']))
		{
			$model->attributes = $_POST['YumUsergroup'];


			if($model->save()) {

				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
					'model'=>$model,
					));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdatep($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

	
			
		if(isset($_POST['YumUsergroup'])) {
			$model->attributes = $_POST['YumUsergroup'];
			// $model->owner_id = Yii::app()->user->id;
			// $model->participants = array($model->owner_id);

			if($model->save()) 
				$this->redirect(array('view','id'=>$model->id));
		}

		
			/*if($model->saveWithRelated('boats'))
				$this->redirect(array('admin'));
			else
				$model->addError('aaa', 'Error occured while  saving boats.');*/

		$this->render('assign',array(
			'model'=>$model,
		));
	}

	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			$this->loadModel()->delete();

			if(!isset($_GET['ajax']))
			{
				if(isset($_POST['returnUrl']))
					$this->redirect($_POST['returnUrl']); 
				else
					$this->redirect(array('admin'));
			}
		}
		else
			throw new CHttpException(400,
					Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
	}

	public function actionIndex($owner_id = null)
	{
		$criteria = new CDbCriteria;

		if($owner_id != null) {
			$uid = Yii::app()->user->id;
			$criteria->addCondition( array(
						'condition' => "owner_id = {$uid}"));
		}

		$dataProvider=new CActiveDataProvider('YumUsergroup', array(
					'criteria' => $criteria)
				);

		$this->render('index',array(
					'dataProvider'=>$dataProvider,
					));
	}

	public function actionBrowse()
	{
		$model=new YumUsergroup('search');
		$model->unsetAttributes();

		if(isset($_GET['YumUsergroup']))
			$model->attributes = $_GET['YumUsergroup'];

		$this->render('browse',array(
					'model'=>$model,
					));
	}

	public function actionAdmin()
	{
		$model=new YumUsergroup('search');
		$model->unsetAttributes();

		if(isset($_GET['YumUsergroup']))
			$model->attributes = $_GET['YumUsergroup'];

		$this->render('admin',array(
					'model'=>$model,
					));
	}

}
