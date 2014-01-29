<?php

/**
 * This is the model class for table "{{rg_age}}".
 *
 * The followings are the available columns in table '{{rg_age}}':
 * @property integer $id
 * @property string $name
 * @property integer $organisation_id
 * @property double $lower
 * @property double $upper
 *
 * The followings are the available model relations:
 * @property RgOrganisation $organisation
 */
class Age extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{rg_age}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('organisation_id', 'numerical', 'integerOnly'=>true),
			array('lower, upper', 'numerical'),
			array('name', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, organisation_id, lower, upper', 'safe', 'on'=>'search'),
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
			'organisation' => array(self::BELONGS_TO, 'RgOrganisation', 'organisation_id'),
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
			'organisation_id' => 'Organisation',
			'lower' => 'Lower',
			'upper' => 'Upper',
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
		$criteria->compare('organisation_id',$this->organisation_id);
		$criteria->compare('lower',$this->lower);
		$criteria->compare('upper',$this->upper);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Age the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
