<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property string $title
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $sell_donate
 * @property string $price
 * @property string $date_of_product
 * @property string $city
 * @property string $full_name
 * @property string $email
 * @property integer $use_msg_only
 * @property string $phone
 * @property integer $comunicator
 * @property integer $comunicator2
 * @property string $desc
 * @property integer $approved
 * @property integer $sold
 * @property string $date_created
 * @property string $date_updated
 *
 * The followings are the available model relations:
 * @property User $user
 * @property ProductCategory $category
 * @property ProductImage[] $productImages
 */
class Product extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Product the static model class
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
		return 'fb_product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, category_id, sell_donate, use_msg_only, approved, sold', 'numerical', 'integerOnly'=>true),
			array('title, city, full_name, email, phone, slug, comunicator, comunicator2', 'length', 'max'=>255),
			array('price', 'length', 'max'=>10),
			array('date_of_product, desc, date_created, date_updated', 'safe'),
			array('title, user_id, category_id', 'required'),
			array('email','email'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, user_id, category_id, sell_donate, price, date_of_product, city, full_name, email, use_msg_only, phone, comunicator, comunicator2, desc, approved, sold, date_created, date_updated', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'ProductCategory', 'category_id'),
			'productImages' => array(self::HAS_MANY, 'ProductImage', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Name',
			'user_id' => 'Owner',
			'category_id' => 'Category',
			'sell_donate' => 'Sell Donate',
			'price' => 'Price',
			'date_of_product' => 'Date Of Product',
			'city' => 'City',
			'full_name' => 'Full Name',
			'email' => 'Email',
			'use_msg_only' => 'Use Msg Only',
			'phone' => 'Phone',
			'comunicator' => 'Comunicator',
			'comunicator2' => 'Comunicator2',
			'desc' => 'Description',
			'approved' => 'Approved',
			'sold' => 'Sold',
			'date_created' => 'Date Created',
			'date_updated' => 'Date Updated',
			'date_sold' => 'Date Sold',
			'slug' => 'Slug',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('sell_donate',$this->sell_donate);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('date_of_product',$this->date_of_product,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('use_msg_only',$this->use_msg_only);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('comunicator',$this->comunicator);
		$criteria->compare('comunicator2',$this->comunicator2);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('approved',$this->approved);
		$criteria->compare('sold',$this->sold);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_updated',$this->date_updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function beforeSave(){
		$this->slug=Helper::slugify($this->title);
		$this->date_updated = date("Y-m-d H:i:s");
		return true;
	}
	
}