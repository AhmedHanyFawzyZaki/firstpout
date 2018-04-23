<?php

/**
 * This is the model class for table "baby_doctor_hospital".
 *
 * The followings are the available columns in table 'baby_doctor_hospital':
 * @property integer $id
 * @property integer $baby_id
 * @property integer $doctor_id
 * @property integer $is_hospital
 *
 * The followings are the available model relations:
 * @property Baby $baby
 * @property User $doctor
 */
class BabyDoctorHospital extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BabyDoctorHospital the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fb_baby_doctor_hospital';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('baby_id, doctor_id, is_hospital', 'numerical', 'integerOnly'=>true),
                        array('baby_id, doctor_id, is_hospital', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, baby_id, doctor_id, is_hospital', 'safe', 'on'=>'search'),
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
			'baby' => array(self::BELONGS_TO, 'Baby', 'baby_id'),
			'doctor' => array(self::BELONGS_TO, 'User', 'doctor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'baby_id' => 'Baby',
			'doctor_id' => 'Doctor',
			'is_hospital' => 'Is Hospital',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('baby_id',$this->baby_id);
		$criteria->compare('doctor_id',$this->doctor_id);
		$criteria->compare('is_hospital',$this->is_hospital);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}