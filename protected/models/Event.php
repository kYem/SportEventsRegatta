<?php

/**
 * This is the model class for table "{{rg_event}}".
 *
 * The followings are the available columns in table '{{rg_event}}':
 * @property integer $id
 * @property string $name
 * @property string $star_date
 * @property string $end_date
 * @property integer $min_participant
 * @property integer $max_participant
 * @property integer $age_id
 * @property integer $organisation_id
 * @property integer $seats
 *
 * The followings are the available model relations:
 * @property Boat[] $Boats
 * @property User[] $Users
 */
class Event extends CActiveRecord
{
	public $boat_search;
	public $age_group_search;
	public $organisation_search;
	public $boatEvent_search;
	public $searchBoat;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{rg_event}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('min_participant, max_participant, age_id, organisation_id, seats', 'numerical', 'integerOnly'=>true),
			array('name', 'required'),
			array('name', 'length', 'max'=>45),
			array('name', 'unique', 'message'=>'This event by this name already exists.'),
			// array('star_date, end_date', 'safe'),
			array('star_date, end_date', 'date', 'format'=>'yyyy-MM-dd', 'message' => '{attribute}: is not a date!'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, boat, boat_search, boatEvent_search, organisation_search, age_group_search, star_date, end_date, min_participant, max_participant, age_id, organisation_id, seats', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'boats' => array(self::MANY_MANY, 'Boat', 'ku_rg_event_boat(event_id, boat_id)'),
			'users' => array(self::MANY_MANY, 'User', 'rg_user_event(event_id, user_id)'),
			'organisation' => array(self::BELONGS_TO, 'Organisation', 'organisation_id'),
			'age_group' => array(self::BELONGS_TO, 'age', 'age_id'),
		);
	}
	public function behaviors(){
        return array('ESaveRelatedBehavior' => array(
         	'class' => 'application.components.ESaveRelatedBehavior')
	     );
	}


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'star_date' => 'Start Date',
			'end_date' => 'End Date',
			'min_participant' => 'Min Participant',
			'max_participant' => 'Max Participant',
			'age_id' => 'Age Group',
			'organisation_id' => 'Organisation',
			'seats' => 'Seats',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('star_date',$this->star_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('min_participant',$this->min_participant);
		$criteria->compare('max_participant',$this->max_participant);
		$criteria->compare('age_id',$this->age_id);
		$criteria->compare('organisation_id',$this->organisation_id);
		$criteria->compare('seats',$this->seats);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchEvents()
	{
	    $criteria=new CDbCriteria;
	    $criteria->with = array( 'boats', 'organisation','age_group', );
	    $criteria->together= true;
	    // $criteria->alias = 'i';
	    // $criteria->join= 'JOIN ku_rg_event_boat d ON (i.id=d.id)';
	    $criteria->compare('id',$this->id);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('boats.name', $this->boat_search, true );
		$criteria->compare('boat.name', $this->searchBoat->name, true);
		$criteria->compare('star_date',$this->star_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('min_participant',$this->min_participant);
		$criteria->compare('max_participant',$this->max_participant);
		$criteria->compare('age_group.name',$this->age_group_search, true);
		$criteria->compare('organisation.organisation',$this->organisation_search, true);

		$criteria->compare('seats',$this->seats);
	    

	    return new CActiveDataProvider( 'Event', array(
		    'criteria'=>$criteria,
		    'sort'=>array(
		        'attributes'=>array(
		            'organisation.organisation'=>array(
		                'asc'=>'organisation.organisation',
		                'desc'=>'organisation.organisation DESC',
		            ),
		             'age_group.name'=>array(
		                'asc'=>'age_group.name',
		                'desc'=>'age_group.name DESC',
		            ),
		            'boats.name'=>array(
		                'asc'=>'boats.name',
		                'desc'=>'boats.name DESC',
		            ),
		            'boat_search'=>array(
		                'asc'=>'boats.name',
		                'desc'=>'boats.name DESC',
		            ),
		            '*',
		        ),
		    ),
		));
	}

	// Function for displaying boat name in the search menu.
	function showBoatNames($aaa) {
                           $boatName = array();
                           foreach ($aaa->boats as $boat) {
                              $boatName[] = $boat->name;

                           }
                           return $boatName;
                         } 

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Event the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
