<?php

/**
 * This is the model class for table "album_image".
 *
 * The followings are the available columns in table 'album_image':
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $desc
 * @property integer $album_id
 * @property integer $main_pic
 * @property string $date_taken
 * @property string $date_created
 *
 * The followings are the available model relations:
 * @property Album $album
 */
class AlbumImage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AlbumImage the static model class
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
		return 'fb_album_image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('album_id, main_pic', 'numerical', 'integerOnly'=>true),
			array('title, image', 'length', 'max'=>255),
			array('desc, date_taken, date_created', 'safe'),
			array('image', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, image, desc, album_id, main_pic, date_taken, date_created', 'safe', 'on'=>'search'),
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
			'album' => array(self::BELONGS_TO, 'Album', 'album_id'),
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
			'image' => 'Image',
			'desc' => 'Desc',
			'album_id' => 'Album',
			'main_pic' => 'Main Pic',
			'date_taken' => 'Date Taken',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('album_id',$this->album_id);
		$criteria->compare('main_pic',$this->main_pic);
		$criteria->compare('date_taken',$this->date_taken,true);
		$criteria->compare('date_created',$this->date_created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function GetLink($id)
	{
		$album=Album::model()->findByPk($id);
			return Yii::app()->request->baseUrl.'/media/albums/';
	}
}