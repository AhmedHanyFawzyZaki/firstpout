<?php

/**
 * This is the model class for table "user_friend".
 *
 * The followings are the available columns in table 'user_friend':
 * @property integer $id
 * @property integer $user_id
 * @property integer $friend_id
 * @property integer $approved
 * @property string $date_created
 *
 * The followings are the available model relations:
 * @property User $user
 * @property User $friend
 */
class UserFriend extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserFriend the static model class
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
		return 'fb_user_friend';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, friend_id, approved, connection_id', 'numerical', 'integerOnly'=>true),
			array('date_created', 'safe'),
			array('user_id, friend_id', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, friend_id, approved, date_created', 'safe', 'on'=>'search'),
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
			'friend' => array(self::BELONGS_TO, 'User', 'friend_id'),
                        'connection' => array(self::BELONGS_TO, 'Connection', 'connection_id'),
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
			'friend_id' => 'Friend',
                        'connection_id' => 'Connection',
			'approved' => 'Approved',
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
		$criteria->compare('friend_id',$this->friend_id);
		$criteria->compare('approved',$this->approved);
		$criteria->compare('date_created',$this->date_created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function Friend($id,$compared_id,$else_id)
	{
		$friend_id=$id;
		if($id==$compared_id)
		{
			$friend_id=$else_id;
		}
		return User::model()->findByPk($friend_id)->username;
	}
	
	protected function beforeSave(){
		if($this->friend_id && $this->user_id && $this->isNewRecord)
		{
			if(count(self::model()->findByAttributes(array('friend_id'=>$this->friend_id,'user_id'=>$this->user_id)))>0)
			{
				$this->addError('friend_id',Yii::t('app', 'This user is already in your friend list.'));
				return false;
			}
			elseif(count(self::model()->findByAttributes(array('user_id'=>$this->friend_id,'friend_id'=>$this->user_id)))>0)
			{
				$this->addError('friend_id',Yii::t('app', 'This user is already in your friend list.'));
				return false;
			}
			return true;
		}
		return true;
	}
}