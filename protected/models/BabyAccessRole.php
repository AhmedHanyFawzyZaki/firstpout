<?php

/**
 * This is the model class for table "baby_access_role".
 *
 * The followings are the available columns in table 'baby_access_role':
 * @property integer $id
 * @property integer $baby_id
 * @property integer $user_id
 * @property integer $role
 *
 * The followings are the available model relations:
 * @property Baby $baby
 * @property User $user
 */
class BabyAccessRole extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BabyAccessRole the static model class
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
		return 'fb_baby_access_role';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('baby_id, user_id, role', 'numerical', 'integerOnly'=>true),
			array('baby_id,user_id,role','required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, baby_id, user_id, role', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
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
			'user_id' => 'User',
			'role' => 'Role',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('role',$this->role);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
    protected function beforeSave(){
		if($this->baby_id && $this->user_id && $this->isNewRecord)
		{
			if(count(self::model()->findByAttributes(array('baby_id'=>$this->baby_id,'user_id'=>$this->user_id)))>0)
			{
				$this->addError('user_id',Yii::t('app', 'Sorry can\'t add more than one access role to the same user.'));
				return false;
			}
			return true;
		}
		return true;
	}
        
}