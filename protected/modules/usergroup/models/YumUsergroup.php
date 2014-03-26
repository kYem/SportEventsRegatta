<?php

class YumUsergroup extends YumActiveRecord{

	public $eventIds = array();

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
			'owner_id' => Yum::t('Group owner'),
			'organisation_id' => Yum::t('Organisation')
		);
	}

	public function getParticipantDataProvider() {
		$criteria = new CDbCriteria;
		// If there is no particpants assigned, search for id 0
		// Outcome, no results found.
		$criteria->compare('id', $participants = ($this->participants) ? $this->participants : 0);

		return new CActiveDataProvider('YumUser', array('criteria' => $criteria));
	}

	public function getEventDataProvider($statusId = 1) {
		$criteria = new CDbCriteria;
		$criteria->compare('status_id', $statusId);

		return new CActiveDataProvider('Event', array('criteria' => $criteria));
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
	 * @param string $roleTitle title of role to be searched
	 * @return array group leaders with a group. Null if none are found.
	 */
	public static function getLeadersWithoutGroup($roleId = 6)
	{
	  	Yii::import('application.modules.profile.models.*');
	  	$criteria = new CDbCriteria;
	    $criteria->select = 't.user_id, t.firstname, t.lastname ';
	    $criteria->join = ' INNER JOIN `ku_user_role` AS `user_role` ON t.user_id = user_role.user_id';
	    $criteria->addCondition("t.user_id NOT IN (SELECT owner_id FROM fyp.ku_usergroup)");
	    $criteria->addCondition("user_role.role_id = {$roleId}");
	    // $criteria->addCondition("ku_profile.user_id IN (SELECT user_id FROM fyp.ku_user_role)");
	    $groupLeaders    =    YumProfile::model()->findAll($criteria);

	  	return $groupLeaders ? $groupLeaders : null;
	}

	public function getRegisteredEvents($data) {

			return in_array($data->id, $data->events);
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
