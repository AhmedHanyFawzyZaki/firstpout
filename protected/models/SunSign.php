<?php

/**
 * This is the model class for table "sun_sign".
 *
 * The followings are the available columns in table 'sun_sign':
 * @property integer $id
 * @property string $title
 * @property string $image
 *
 * The followings are the available model relations:
 * @property Baby[] $babies
 */
class SunSign extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SunSign the static model class
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
		return 'fb_sun_sign';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, image', 'length', 'max'=>255),
            array('title, image','required'),
			array('title', 'match' ,'pattern'=>'/^[A-Za-z0-9_]+$/u', 'message'=>'Field can contain only alphanumeric characters and underscore(_).'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, image', 'safe', 'on'=>'search'),
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
			'babies' => array(self::HAS_MANY, 'Baby', 'sun_sign'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Sun Sign',
			'image' => 'Image',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('image',$this->image,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}