<?php

/**
 * This is the model class for table "settings".
 *
 * The followings are the available columns in table 'settings':
 * @property integer $id
 * @property string $website
 * @property string $google
 * @property string $twitter
 * @property string $pinterest
 * @property string $support_email
 * @property string $email
 * @property string $facebook
 * @property string $paypal_email
 */
class Settings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Settings the static model class
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
		return 'fb_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, image, config_key, android_app_link, ios_app_link, default_profile_pic, default_banner_image', 'length', 'max'=>255),
			array('config_value, product_expiration_period','safe'),
			array('autoload', 'numerical', 'integerOnly'=>true),
			array('email, image', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'image'=>'Logo',
			'email'=>'Email',
			'config_key'=>'Config Key',
			'config_value'=>'Config Value',
			'autoload'=>'Autoload',
			'product_expiration_period'=>'Product Expiration Period',
			'android_app_link'=>'Android Application Link',
			'ios_app_link'=>'IOS Application Link',
			'default_profile_pic'=>'Default Profile Picture',
			'default_banner_pic'=>'Default Banner Picture',
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
		$criteria->compare('website',$this->website,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('config_key',$this->config_key,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
}