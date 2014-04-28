<?php

/**
 * This is the model class for table "{{rg_race}}".
 *
 * The followings are the available columns in table '{{rg_race}}':
 * @property integer $id
 * @property integer $event_id
 * @property integer $race_model_id
 * @property integer $race_type_id
 *
 * The followings are the available model relations:
 * @property RgEvent $event
 * @property RgRaceModel $raceModel
 * @property RgRaceType $raceType
 */
class Race extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{rg_race}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, race_model_id, race_type_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, event_id, race_model_id, race_type_id', 'safe', 'on'=>'search'),
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
			'event' => array(self::BELONGS_TO, 'RgEvent', 'event_id'),
			'raceModel' => array(self::BELONGS_TO, 'RgRaceModel', 'race_model_id'),
			'raceType' => array(self::BELONGS_TO, 'RgRaceType', 'race_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'event_id' => 'Event',
			'race_model_id' => 'Race Model',
			'race_type_id' => 'Race Type',
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
		$criteria->compare('event_id',$this->event_id);
		$criteria->compare('race_model_id',$this->race_model_id);
		$criteria->compare('race_type_id',$this->race_type_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Race the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
