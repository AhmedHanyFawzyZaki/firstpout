<?php

/**
 * This is the model class for table "contest".
 *
 * The followings are the available columns in table 'contest':
 * @property integer $id
 * @property string $title
 * @property string $desc
 * @property string $image
 * @property string $price
 * @property integer $active
 * @property string $date_start
 * @property string $date_end
 * @property string $date_created
 * @property string $date_updated
 *
 * The followings are the available model relations:
 * @property ContestUser[] $contestUsers
 */
class Contest extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Contest the static model class
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
		return 'fb_contest';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('active', 'numerical', 'integerOnly'=>true),
			array('title, image', 'length', 'max'=>255),
			array('price', 'length', 'max'=>10),
			array('desc, date_start, date_end, date_created, date_updated', 'safe'),
			array('title, desc, price, image, date_start, date_end', 'required'),
			array('price', 'match', 'pattern'=>'/^\d+(\.(\d{2}))?$/','message'=>'Prize can be only positive decimals.'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, desc, image, price, active, date_start, date_end, date_created, date_updated', 'safe', 'on'=>'search'),
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
			'contestUsers' => array(self::HAS_MANY, 'ContestUser', 'contest_id'),
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
			'desc' => 'Description',
			'image' => 'Image',
			'price' => 'Prize',
			'active' => 'Active',
			'date_start' => 'Start Date',
			'date_end' => 'End Date',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('date_start',$this->date_start,true);
		$criteria->compare('date_end',$this->date_end,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_updated',$this->date_updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function beforeSave(){
		$this->date_updated = date("Y-m-d H:i:s");
		return true;
	}
	
}