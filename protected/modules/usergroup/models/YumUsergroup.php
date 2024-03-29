<?php

class YumUsergroup extends YumActiveRecord{

	public $eventIds = array();
	public $memberIds = array();

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function behaviors() {
		return array(
			'CSerializeBehavior' => array(
					'class' => 'application.modules.user.components.CSerializeBehavior',
					'serialAttributes' => array('participants')),
			'ESaveRelatedBehavior' => array(
         		'class' => 'application.components.ESaveRelatedBehavior'),
			);
	}

	public function tableName()
	{
		return Yum::module('usergroup')->usergroupTable;
	}

	public function rules()
	{
		return array(
			array('title, organisation_id', 'required'),
			array('id, owner_id, organisation_id', 'numerical',  'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('participants, eventIds', 'safe'),
			array('id, title, description, organisation_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'owner' => array(self::BELONGS_TO, 'YumUser', 'owner_id'),
			'messages' => array(self::HAS_MANY, 'YumUsergroupMessage', 'group_id'),
			'messagesCount' => array(self::STAT, 'YumUsergroupMessage', 'group_id'),
			'events' => array(self::MANY_MANY, 'Event', 'ku_rg_group_event(group_id, event_id)'),
			// The order must match database order
			'user' => array(self::MANY_MANY, 'YumUser', 'ku_rg_team(group_id, user_id)'),
			// 'userEvent' => array(self::MANY_MANY, 'UserEvent', 'ku_rg_user_event(user_id, group_id, event_id)'),
			'organisation' => array(self::BELONGS_TO, 'Organisation', 'organisation_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => Yum::t('group id'),
			'title' => Yum::t('Group title'),
			'description' => Yum::t('Description'),
			'participants' => Yum::t('Participants'),
			'owner_id' => Yum::t('Group Leader'),
			'organisation_id' => Yum::t('Organisation')
		);
	}

	public function getParticipantDataProvider() {
		$criteria = new CDbCriteria;
		// If there is no participants assigned, search for id 0
		// Outcome, no results found.
		$criteria->compare('id', ($this->participants) ? $this->participants : 0);

		return new CActiveDataProvider('YumUser', array('criteria' => $criteria));
	}
	/**
	 * Get All available events
	 * @param int $statusId Get only events with status
	 * @return type
	 */
	public function getEventDataProvider($statusId = null) {
		$criteria = new CDbCriteria;
		if ($statusId) {
		$criteria->compare('status_id', $statusId);
		}
		// Can only join events for same organisation
		$criteria->compare('organisation_id', $this->organisation_id);

		return new CActiveDataProvider('Event', array('criteria' => $criteria));
	}
	/**
	 * Get all events that the group is registered for
	 * @return CActiveDataProvider object
	 */
	public function getRegisteredEventDataProvider() {
		$criteria = new CDbCriteria;
		// $criteria->with =array('groups');
		$criteria->join = ' INNER JOIN `ku_rg_group_event` AS `group_event` ON t.id = group_event.event_id';
	    $criteria->addCondition("group_event.group_id = ".$this->id." ");

		return new CActiveDataProvider('Event', array('criteria' => $criteria));
	}


	/**
	 * Show Events that the user is registered for
	 * @return type
	 */
	public function getRegisteredMemberEvents($id = null) {
		$id = (!$id) ? Yii::app()->user->id : '0' ;
		$criteria = new CDbCriteria;
		// $criteria->with =array('groups');
		$criteria->join = ' INNER JOIN `ku_rg_user_event` AS `user_event` ON t.id = user_event.event_id';
	    $criteria->addCondition("user_event.user_id = ".$id." ");

		return new CActiveDataProvider('Event', array('criteria' => $criteria));
	}
	/**
	 * Get all events that the group is registered for
	 * @return CActiveDataProvider object
	 *
	 * 			NOT USED AT THE MOMENT
	 */
	public function getRegisteredGroupEvents() {
		$criteria = new CDbCriteria;
		$criteria->with =array('events');
		$criteria->join = ' INNER JOIN `ku_rg_group_event` AS `group_event` ON t.id = group_event.event_id';
	    $criteria->addCondition("group_event.group_id = ".$this->id." ");

		return new CActiveDataProvider('YumUserGroup', array('criteria' => $criteria));
	}

	public function getMessageDataProvider() {
		Yii::import('application.modules.usergroup.models.*');
		$criteria = new CDbCriteria;
		$criteria->compare('group_id', $this->id);

		return new CActiveDataProvider('YumUsergroupMessage', array(
					'criteria' => $criteria));
	}


	/**
	 * Get Group Leaders without a group
	 * @param string $roleId id of role to be searched
	 * @return Object array $groupLeaders Leaders without a group. Null if none are found.
	 */
	public static function getLeadersWithoutGroup($owner_id = null, $roleId = 6)
	{
	  	Yii::import('application.modules.profile.models.*');
	  	$criteria = new CDbCriteria;
	    $criteria->select = 't.user_id, t.firstname, t.lastname ';
	    $criteria->join = ' INNER JOIN `ku_user_role` AS `user_role` ON t.user_id = user_role.user_id';
	    $criteria->addCondition("t.user_id NOT IN (SELECT owner_id FROM ku_usergroup)");
	    $criteria->addCondition("user_role.role_id = {$roleId}");
	    if ($owner_id) {
	    	$criteria->compare('t.user_id', $owner_id, false, 'OR');
	    	// $criteria->addCondition("t.user_id = ".$owner_id." ");
	    }
	    $groupLeaders    =    YumProfile::model()->findAll($criteria);

	  	return $groupLeaders ? $groupLeaders : null;
	}

	/**
	 * Clistdata, If its there is no results return null.
	 * @return type
	 */
	public function listLeaders()
	{
		// On update, we need to pass the current owner id as well
		$groupLeaders = $this->getLeadersWithoutGroup($this->owner_id);
		if ($groupLeaders) {
			return CHtml::listData(
                    $groupLeaders,
                        'user_id',
                        'fullname'
                );
		}
		else {
			return null;
		}


	}

	/**
	 * Get Group Members without a group
	 * @param string $roleId id of role to be searched, Group Members = 7
	 * @return Object array $groupLeaders Leaders without a group. Null if none are found.
	 */
	public static function getMembersWithoutGroup($roleId = 7)
	{
	  	Yii::import('application.modules.profile.models.*');
	  	$criteria = new CDbCriteria;
	    $criteria->select = 't.user_id, t.firstname, t.lastname ';
	    $criteria->join = ' INNER JOIN `ku_user_role` AS `user_role` ON t.user_id = user_role.user_id';
	    // $criteria->join = ' INNER JOIN `ku_rg_team` AS `team` ON t.user_id = team.user_id';
	    $criteria->addCondition("t.user_id NOT IN (SELECT ku_rg_team.user_id FROM ku_rg_team)");
	    $criteria->addCondition("user_role.role_id = {$roleId}");

	    $groupMember = YumProfile::model()->findAll($criteria);

	  	return $groupMember ? $groupMember : null;
	}

	/**
	 * Clistdata, If its there is no results return null.
	 * @return type
	 */
	public function listMembers()
	{
		// On update, we need to pass the current owner id as well
		$groupMember = $this->getMembersWithoutGroup();
		if ($groupMember) {
			return CHtml::listData(
                    $groupMember,
                        'user_id',
                        'fullname'
                );
		}
		else {
			return null;
		}


	}

	/**
	 * Get all members of the group
	 * @return CActiveDataProvider object
	 */
	public function getGroupMembers()
	{
		$criteria = new CDbCriteria;
		$criteria->join = ' INNER JOIN `ku_rg_team` AS `team` ON t.id = team.user_id';
	    $criteria->addCondition("team.group_id = ".$this->id." ");

		return new CActiveDataProvider('YumUser', array('criteria' => $criteria));
	}

	/**
	 * Get all members of the group
	 * @return CActiveDataProvider object
	 */
	public function getGroupMembersByAge($lower = 0, $upper = null)
	{
		$criteria = new CDbCriteria;
		$criteria->select = 't.id, profile.firstname, profile.lastname, profile.dob ';
		$criteria->join = ' INNER JOIN `ku_rg_team` AS `team` ON t.id = team.user_id ';
		$criteria->join .= ' INNER JOIN `ku_profile` AS `profile` ON t.id = profile.user_id ';
	    $criteria->addCondition("team.group_id = ".$this->id." ");
	    if ($lower || $upper) {
	    	$criteria->addBetweenCondition("DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(profile.dob, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(profile.dob, '00-%m-%d'))", $lower, $upper);
	    }

	    // SELECT name
        // FROM users WHERE dob BETWEEN DATE_ADD(CURDATE(), INTERVAL -{$age1} YEAR) AND DATE_ADD(CURDATE(), INTERVAL -{$age2} YEAR)

	    // SELECT DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(dob, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(dob, '00-%m-%d')) AS age
	    // select firstname,extract(year from (from_days(dateDiff(current_timestamp,dob)))) from ku_profile;
	    // SELECT DATE_FORMAT(reference, '%Y') - DATE_FORMAT(birthdate, '%Y') - (DATE_FORMAT(reference, '00-%m-%d') < DATE_FORMAT(birthdate, '00-%m-%d')) AS age

		return new CActiveDataProvider('YumUser', array('criteria' => $criteria));
	}



	public function getRegisteredEvents($data) {

			return in_array($data->id, $data->events);
		}

	public function getParticipantCount($data, $group_id)
	{
		$sql  =		'SELECT COUNT(*) FROM ku_rg_user_event as t ';
		$sql .=		'INNER JOIN ku_rg_event as rg_event on t.event_id = rg_event.id ';
		$sql .=		'WHERE rg_event.id = '.$data->id.' ';
		$sql .=		'AND t.user_id IN (SELECT user_id FROM ku_rg_team WHERE group_id= '.$group_id.') ';
		$result = Yii::app()->db->createCommand($sql)->queryAll(false);
		if ($result) {
			// As It is count, only one row 1 and first index will be the value
			if ($result[0][0] != 0) {
				return $result[0][0];
			} else {
				return "None";
			}
		} else {
			return 'N/A';
		}
	}

	public function getRegisteredMemberIds($user_id)
	{
		$criteria = new CDbCriteria;
		$criteria->select = 't.user_id';
		$criteria->condition = 't.event_id = '.$user_id;

		$userIds = array();
		$data = UserEvent::model()->findAll($criteria);
		foreach ($data as $key => $UserEvent) {
		    $userIds[] = $UserEvent->user_id;
		}
		return $userIds;
	}

	/**
	 * Trying to clean up the getParticipantCount
	 * @param type $data
	 * @param type $group_id
	 * @return type
	 */
	public function getParticipantNumber($data, $group_id)
	{
		// function ($model)  use ($gui)
                $a =YumUsergroup::model()->getParticipantCount($model, $gui);
                // return $a;

		$sql  =		'SELECT COUNT(*) FROM ku_rg_user_event as t ';
		$sql .=		'INNER JOIN ku_rg_event as rg_event on t.event_id = rg_event.id ';
		$sql .=		'WHERE rg_event.id = '.$data->id.' ';
		$sql .=		'AND t.user_id IN (SELECT user_id FROM ku_rg_team WHERE group_id= '.$group_id.') ';
		$result = Yii::app()->db->createCommand($sql)->queryAll(false);
		if ($result) {
			// As It is count, only one row 1 and first index will be the value
			if ($result[0][0] != 0) {
				return $result[0][0];
			} else {
				return "None";
			}
		} else {
			return 'N/A';
		}
	}

	public function afterFind()
	   {
	       if (!empty($this->events))
	       {
	           foreach ($this->events as $n => $event)
	               $this->eventIds[] = $event->id;
	       }

	       parent::afterFind();
	   }

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('description', $this->description, true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
