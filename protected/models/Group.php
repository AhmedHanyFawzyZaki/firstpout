<?php

/**
 * This is the model class for table "group".
 *
 * The followings are the available columns in table 'group':
 * @property integer $id
 * @property string $title
 * @property string $category
 * @property string $image
 * @property string $banner
 * @property integer $privacy
 * @property string $other
 * @property integer $user_id
 * @property string $date_created
 * @property string $date_updated
 *
 * The followings are the available model relations:
 * @property GroupUser[] $groupUsers
 * @property Post[] $posts
 */
class Group extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Group the static model class
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
		return 'fb_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('privacy, user_id', 'numerical', 'integerOnly'=>true),
			array('title, category, image, banner', 'length', 'max'=>255),
			array('date_created, date_updated, other', 'safe'),
			array('title, user_id', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, category, image, banner, privacy, other, user_id, date_created, date_updated', 'safe', 'on'=>'search'),
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
			'groupUsers' => array(self::HAS_MANY, 'GroupUser', 'group_id'),
			'posts' => array(self::HAS_MANY, 'Post', 'group_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'category0' => array(self::BELONGS_TO, 'GroupCategory', 'category'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Group Name',
			'category' => 'Group Category',
			'image' => 'Image',
			'banner' => 'Banner',
			'privacy' => 'Privacy',
			'other' => 'Other',
			'user_id' => 'Creator',
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
		$criteria->compare('category',$this->category,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('banner',$this->banner,true);
		$criteria->compare('privacy',$this->privacy);
		$criteria->compare('other',$this->other,true);
		$criteria->compare('user_id',$this->user_id);
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
	
	protected function afterSave() {
        if ($this->isNewRecord) {
            if ($this->id) {
                /*$path = Yii::app()->basePath . '/../media/babies/' . $this->id;
                mkdir($path, 755);*/
				$al=new Album;
				$al->first_album=1;
				$al->title='My Photos';
				$al->date_of_album=date('Y-m-d');
				$al->group_id=$this->id;
				$al->desc='In this album users can find all the photos related to this group that isn\'t belonging to a specific album.';
				$al->save();
            }
        }
    }
	
	public static function IsGroupAdmin($id, $user_id){
		$admin=GroupUser::model()->findByAttributes(array('user_id'=>$user_id,'role'=>1,'group_id'=>$id));
		$creator=Group::model()->findByPk($id)->user_id==$user_id?true:false;
		if($creator==true || !empty($admin)){
			return true;
		}
		Yii::app()->user->setFlash('WrongGroup','Wrong! Only Group Administrators can manage the group.');
		return false;
	}
	
	public static function IsGroupAccess($id, $user_id){
		$admin=GroupUser::model()->findByAttributes(array('user_id'=>$user_id, 'group_id'=>$id));
		$creator=Group::model()->findByPk($id)->user_id==$user_id?true:false;
		if($creator==true || !empty($admin)){
			return true;
		}
		Yii::app()->user->setFlash('WrongGroup','Wrong! Only Group Administrators can manage the group.');
		return false;
	}
	
	
}