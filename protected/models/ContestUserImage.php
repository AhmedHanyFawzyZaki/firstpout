<?php

/**
 * This is the model class for table "contest_user_image".
 *
 * The followings are the available columns in table 'contest_user_image':
 * @property integer $id
 * @property string $image
 * @property string $title
 * @property string $desc
 * @property integer $contest_user_id
 * @property string $date_taken
 * @property string $date_created
 * @property string $date_updated
 *
 * The followings are the available model relations:
 * @property ContestUser $contestUser
 */
class ContestUserImage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ContestUserImage the static model class
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
		return 'fb_contest_user_image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contest_user_id', 'numerical', 'integerOnly'=>true),
			array('image, title', 'length', 'max'=>255),
			array('desc, date_taken, date_created, date_updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, image, title, desc, contest_user_id, date_taken, date_created, date_updated', 'safe', 'on'=>'search'),
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
			'contestUser' => array(self::BELONGS_TO, 'ContestUser', 'contest_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'image' => 'Image',
			'title' => 'Title',
			'desc' => 'Desc',
			'contest_user_id' => 'Contest User',
			'date_taken' => 'Date Taken',
			'date_created' => 'Date Created',
			'date_updated' => 'Date Updated',
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
		$criteria->compare('image',$this->image,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('contest_user_id',$this->contest_user_id);
		$criteria->compare('date_taken',$this->date_taken,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_updated',$this->date_updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}