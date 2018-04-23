<?php

/**
 * This is the model class for table "notification".
 *
 * The followings are the available columns in table 'notification':
 * @property integer $id
 * @property integer $user_id
 * @property integer $notifier_id
 * @property string $msg
 * @property integer $baby_id
 * @property integer $row_id
 * @property string $table_name
 * @property integer $seen
 * @property string $date_created
 *
 * The followings are the available model relations:
 * @property User $user
 * @property User $notifier
 * @property Baby $baby
 */
class Notification extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Notification the static model class
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
		return 'fb_notification';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, notifier_id, baby_id, row_id, seen, group_id', 'numerical', 'integerOnly'=>true),
			array('table_name', 'length', 'max'=>255),
			array('msg, date_created, row_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, notifier_id, msg, baby_id, row_id, table_name, seen, date_created', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'notifier' => array(self::BELONGS_TO, 'User', 'notifier_id'),
			'baby' => array(self::BELONGS_TO, 'Baby', 'baby_id'),
			'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'notifier_id' => 'Notifier',
			'msg' => 'Msg',
			'baby_id' => 'Baby',
			'row_id' => 'Row',
			'table_name' => 'Table Name',
			'seen' => 'Seen',
			'date_created' => 'Date Created',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('notifier_id',$this->notifier_id);
		$criteria->compare('msg',$this->msg,true);
		$criteria->compare('baby_id',$this->baby_id);
		$criteria->compare('row_id',$this->row_id);
		$criteria->compare('table_name',$this->table_name,true);
		$criteria->compare('seen',$this->seen);
		$criteria->compare('date_created',$this->date_created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}