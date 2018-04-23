<?php

/**
 * This is the model class for table "contest_user".
 *
 * The followings are the available columns in table 'contest_user':
 * @property integer $id
 * @property integer $user_id
 * @property integer $contest_id
 * @property string $desc
 * @property integer $num_of_votes
 * @property string $date_joined
 * @property integer $winner
 *
 * The followings are the available model relations:
 * @property Contest $contest
 * @property User $user
 * @property ContestUserImage[] $contestUserImages
 */
class ContestUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ContestUser the static model class
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
		return 'fb_contest_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, contest_id, num_of_votes, winner, baby_id, num_of_likes', 'numerical', 'integerOnly'=>true),
			array('desc, date_joined', 'safe'),
			array('contest_id, user_id, baby_id', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, contest_id, desc, num_of_votes, date_joined, winner', 'safe', 'on'=>'search'),
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
			'contest' => array(self::BELONGS_TO, 'Contest', 'contest_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
                        'baby' => array(self::BELONGS_TO, 'Baby', 'baby_id'),
			'contestUserImages' => array(self::HAS_MANY, 'ContestUserImage', 'contest_user_id'),
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
                        'baby_id' => 'Baby',
			'contest_id' => 'Contest',
			'desc' => 'Description',
			'num_of_votes' => 'Num Of Votes',
                        'num_of_likes' => 'Num Of Likes',
			'date_joined' => 'Date Joined',
			'winner' => 'Winner',
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
                $criteria->compare('baby_id',$this->baby_id);
		$criteria->compare('contest_id',$this->contest_id);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('num_of_votes',$this->num_of_votes);
                $criteria->compare('num_of_likes',$this->num_of_likes);
		$criteria->compare('date_joined',$this->date_joined,true);
		$criteria->compare('winner',$this->winner);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}