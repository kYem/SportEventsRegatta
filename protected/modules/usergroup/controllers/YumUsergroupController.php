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
					'getOptions', 'create','update', 'browse', 'join', 'leave', 'write', 'assign', ),
					'users'=>array('@'),
					),
				array('allow',
					'actions'=>array('JoinEvent','AddMember', 'JoinEventCheck', 'UpdateMembers', 'AddParticipant'),
					'expression' => 'Yii::app()->user->can("userGroup", "create")',
					),
				array('allow',
					'actions'=>array('admin','delete', 'JoinEvent','AddMember', 'JoinEventCheck', 'UpdateMembers', 'AddParticipant'),
					'users'=>array('admin'),
					'expression' => 'Yii::app()->user->can("event", "create")',
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
	*	Group (Team) can join events on the initial registration.
	*	If update is successful, the browser will be redirected to the 'view' page.
	* 	@param integer $id the ID of the model to be updated
	*/

	/* Alternative version, only checkboxes */

	public function actionJoinEventCheck($id = null) {

			$model = $this->loadModel($id);
			$event = new Event;
		$this->performAjaxValidation($model, 'usergroup-form');

		if(isset($_POST['YumUsergroup'])) {
			$model->attributes = $_POST['YumUsergroup'];
			$model->events = $model->eventIds;

			if($model->saveWithRelated('events')) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('assign',array( 'model'=>$model, 'event' => $event));
	}

	/**
	*	Group (Team) can join events on the initial registration.
	*	If update is successful, the browser will be redirected to the 'view' page.
	* 	@param integer $id the ID of the group to be updated
	*/

	public function actionJoinEvent($id = null) {

			$model = $this->loadModel($id);
			$event = new Event;
			$this->performAjaxValidation($model, 'usergroup-eventInitial');

		// If form was submitted
		if(isset($_POST['submit'])) {
			// IF any values events were selected
			if (isset($_POST['eventIds'])) {
				$model->eventIds = $_POST['eventIds'];
				$model->events = $model->eventIds;

			} else {
				// No events where selected
			    $model->eventIds = null;
				$model->events = $model->eventIds;
			}

			if($model->saveWithRelated('events')) {

				Yii::app()->user->setFlash('success', "Success! The Event list have been updated");
				$this->redirect(array('view','id'=>$model->id));
			} else
				Yii::app()->user->setFlash('error', "Data NOT saved!");
		} else {
			Yii::app()->user->setFlash('error', "Nothing was Submited!");
		}

		$this->render('event-reg',array( 'model'=>$model, 'event' => $event));
	}

  /**
	*	Assign team members to the user group (Team)
	*
	*/

	public function actionAssign($id = null) {

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
		$regatta = Regatta::model()->findByPk(1);
		$this->render('view',array(
					'model' => $model,
					'regatta'=> $regatta,
					));
	}

	public function actionAddParticipant($groupId, $eventId) {
		$model = $this->loadModel($groupId);
			$event = Event::model()->findByPk($eventId);

		// If form was submitted
		if(isset($_POST['submit'])) {
			// IF any values events were selected
			if (isset($_POST['memberIds'])) {
				$event->memberIds = $_POST['memberIds'];
				$event->users = $event->memberIds;
				$model->memberIds = $event->memberIds;


			} else {
				// No users where selected
			    $event->memberIds = null;
				$event->users = $event->memberIds;
				$model->memberIds = $event->memberIds;
			}

			if($event->saveWithRelated('users')) {

				Yii::app()->user->setFlash('success', "Success! The Participant list have been updated");
				$this->redirect(array('view','id'=>$model->id));
			} else
				Yii::app()->user->setFlash('error', "Data NOT saved!");
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('add-participant',array( 'model'=>$model, 'event' => $event, 'eventId' =>$eventId));
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
			// Current User Becomes the owner
			// $model->owner_id = Yii::app()->user->id;
			// $model->participants = array($model->owner_id);

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
	public function actionUpdateMembers($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['yt1'])) {
			if(isset($_POST['YumUsergroup'])) {

				$model->id = $id;

				if(isset($_POST['YumUser']))
				{
					$model->user = $_POST['YumUser'];
				}

				if($model->saveWithRelated(array('user'))){
					Yii::app()->user->setFlash('success', "Success! The New Member have been added.");
					echo '<pre>'; print_r($_POST); echo '</pre>';
					$this->redirect(array('view','id'=>$model->id));
				}

				else {
					Yii::app()->user->setFlash('success', "Success! The Event list have been updated");
					$this->redirect(array('view','id'=>$model->id));
				}
			}
		}

	}

	public function actionAddMember($id)
	{
		$model=$this->loadModel($id);
		if(isset($_POST['YumUser'])) {
			$memberId = $_POST['YumUser']['id'];
		}


		$sql = "INSERT INTO `ku_rg_team` (`user_id`,`group_id`)
				VALUES (".$memberId.",".$model->id.")";
		$result = Yii::app()->db->createCommand($sql)->execute();
		if ($result) {
			$this->redirect(array('view','id'=>$model->id));
		}
	}

	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// $this->loadModel()->delete();
			$this->loadModel($id)->delete();

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
