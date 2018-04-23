<?php

/**
 * This is the model class for table "connection".
 *
 * The followings are the available columns in table 'connection':
 * @property integer $id
 * @property string $title
 *
 * The followings are the available model relations:
 * @property BabyFamily[] $babyFamilies
 * @property User[] $users
 * @property UserRelationship[] $userRelationships
 */
class Connection extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Connection the static model class
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
		return 'fb_connection';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'length', 'max'=>255),
			array('category_id', 'numerical', 'integerOnly'=>true),
			array('title','required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title', 'safe', 'on'=>'search'),
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
			'babyFamilies' => array(self::HAS_MANY, 'BabyFamily', 'connection_id'),
			'users' => array(self::HAS_MANY, 'User', 'connection_id'),
			'userRelationships' => array(self::HAS_MANY, 'UserRelationship', 'connection_id'),
			'category' => array(self::BELONGS_TO, 'ConnectionCategory', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'category_id' => 'Connection Category',
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}