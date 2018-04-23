<?php

/**
 * This is the model class for table "comment".
 *
 * The followings are the available columns in table 'comment':
 * @property integer $id
 * @property integer $user_id
 * @property integer $baby_id
 * @property string $comment
 * @property integer $item_id
 * @property integer $item_type
 * @property string $date_created
 * @property string $date_updated
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Baby $baby
 * @property ItemType $itemType
 */
class Comment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comment the static model class
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
		return 'fb_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, baby_id, item_id, item_type', 'numerical', 'integerOnly'=>true),
			array('comment, date_created, date_updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, baby_id, comment, item_id, item_type, date_created, date_updated', 'safe', 'on'=>'search'),
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
			'baby' => array(self::BELONGS_TO, 'Baby', 'baby_id'),
			'itemType' => array(self::BELONGS_TO, 'ItemType', 'item_type'),
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
			'comment' => 'Comment',
			'item_id' => 'Item',
			'item_type' => 'Item Type',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('baby_id',$this->baby_id);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('item_type',$this->item_type);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_updated',$this->date_updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function afterSave() {
		if($this->item_type==1){
			$item=Post::model()->findByPk($this->item_id);
			$link=$item->baby_id?'the <a href="'.Yii::app()->request->baseUrl.'/babyProfile/index/'.$item->baby_id.'#article-'.$item->id.'">post</a> you added on '.$item->baby->username.'\'s timeline.':'the <a href="'.Yii::app()->request->baseUrl.'/groups/index/'.$item->group_id.'#article-'.$item->id.'">post</a> you added on group "'.$item->group->title.'".';
			$user_id=$item->user_id;
			$message='<a href="'.Yii::app()->request->baseUrl.'/userProfile/index/'.$this->user_id.'">'.$this->user->username.'</a> has commented on a <a href="'.Yii::app()->request->baseUrl.'/groups/index/'.$item->group_id.'#article-'.$item->id.'">post</a> you ';
		}elseif($this->item_type==2){
			$item=Album::model()->findByPk($this->item_id);
			$link=$item->baby_id?'the <a href="'.Yii::app()->request->baseUrl.'/controlPanel/viewAlbum/'.$item->id.'">album</a> you added on '.$item->baby->username.'\'s profile.':'the <a href="'.Yii::app()->request->baseUrl.'/controlPanel/viewAlbum/'.$item->id.'">album</a> you created.';
			$user_id=$item->user_id;
			$message='<a href="'.Yii::app()->request->baseUrl.'/userProfile/index/'.$this->user_id.'">'.$this->user->username.'</a> has commented on an <a href="'.Yii::app()->request->baseUrl.'/controlPanel/viewAlbum/'.$item->id.'">album</a> you ';
		}elseif($this->item_type==3){
			$item=AlbumImage::model()->findByPk($this->item_id);
			$link=$item->album->baby_id?'the <a href="'.Yii::app()->request->baseUrl.'/home/viewImage?id='.$item->id.'&mode=AlbumImage" class="fancybox">album image</a> you added on '.$item->album->baby->username.'\'s profile.':'the <a href="'.Yii::app()->request->baseUrl.'/home/viewImage?id='.$item->id.'&mode=AlbumImage" class="fancybox">album image</a> you added to your album "'.$item->album->title.'".';
			$user_id=$item->album->user_id;
			$message='<a href="'.Yii::app()->request->baseUrl.'/userProfile/index/'.$this->user_id.'">'.$this->user->username.'</a> has commented on an <a href="'.Yii::app()->request->baseUrl.'/home/viewImage?id='.$item->id.'&mode=AlbumImage" class="fancybox">album image</a> you ';
		}elseif($this->item_type==6){
			$item=PostMedia::model()->findByPk($this->item_id);
			$link=$item->post->baby_id?'the <a href="'.Yii::app()->request->baseUrl.'/home/viewImage?id='.$item->id.'&mode=PostMedia" class="fancybox">post</a> you added on '.$item->post->baby->username.'\'s profile.':'the <a href="'.Yii::app()->request->baseUrl.'/home/viewImage?id='.$item->id.'&mode=PostMedia" class="fancybox">post</a> you added to your timeline.';
			$user_id=$item->post->user_id;
			$message='<a href="'.Yii::app()->request->baseUrl.'/userProfile/index/'.$this->user_id.'">'.$this->user->username.'</a> has commented on a <a href="'.Yii::app()->request->baseUrl.'/home/viewImage?id='.$item->id.'&mode=PostMedia" class="fancybox">post</a> you ';
		}elseif($this->item_type==7){
			$item=Post::model()->findByPk($this->item_id);
			$link=$item->baby_id?'the <a href="'.Yii::app()->request->baseUrl.'/home/viewImage?id='.$item->id.'&mode=PostImage" class="fancybox">an image</a> you added on '.$item->baby->username.'\'s profile.':'the <a href="'.Yii::app()->request->baseUrl.'/home/viewImage?id='.$item->id.'&mode=PostImage" class="fancybox">post</a> you added on group "'.$item->group->title.'".';
			$user_id=$item->user_id;
			$message='<a href="'.Yii::app()->request->baseUrl.'/userProfile/index/'.$this->user_id.'">'.$this->user->username.'</a> has commented on an <a href="'.Yii::app()->request->baseUrl.'/home/viewImage?id='.$item->id.'&mode=PostImage" class="fancybox">image</a> you ';
		}elseif($this->item_type==9){
			$item=ContestUser::model()->findByPk($this->item_id);
			$link='the <a href="'.Yii::app()->request->baseUrl.'/home/viewContest/'.$item->id.'">contest entry</a> you added on '.$item->baby->username.'\'s profile.';
			$user_id=$item->user_id;
			$message='<a href="'.Yii::app()->request->baseUrl.'/userProfile/index/'.$this->user_id.'">'.$this->user->username.'</a> has commented on a <a href="'.Yii::app()->request->baseUrl.'/home/viewContest/'.$item->id.'">contest entry</a> you ';
		}elseif($this->item_type==10){
			$item=ContestUserImage::model()->findByPk($this->item_id);
			$link='the <a href="'.Yii::app()->request->baseUrl.'/home/viewImage?id='.$item->id.'&mode=ContestUserImage">contest image</a> you added on '.$item->baby->username.'\'s profile.';
			$user_id=$item->contest->user_id;
			$message='<a href="'.Yii::app()->request->baseUrl.'/userProfile/index/'.$this->user_id.'">'.$this->user->username.'</a> has commented on a <a href="'.Yii::app()->request->baseUrl.'/home/viewImage?id='.$item->id.'&mode=ContestUserImage">contest image</a> you ';
		}
		$msg='<a href="'.Yii::app()->request->baseUrl.'/userProfile/index/'.$this->user_id.'">'.$this->user->username.'</a> has commented on '.$link;
		$notifier_id=  $this->user_id;
		$table_name='comment';
		$row_id=  $this->id;
		$notif=Helper::Notification($notifier_id, $user_id, '', $msg, $row_id, $table_name);
		
		$users=Like::model()->findAllByAttributes(array('item_type'=>$this->item_type, 'item_id'=>$this->item_id));
		if($users){
			foreach($users as $us){
				Helper::Notification($notifier_id, $us->user_id, '', $message.'liked.', $row_id, $table_name);
			}
		}
		$followers=Favourite::model()->findAllByAttributes(array('item_type'=>$this->item_type, 'item_id'=>$this->item_id));
		if($users){
			foreach($users as $us){
				Helper::Notification($notifier_id, $us->user_id, '', $message.'followed.', $row_id, $table_name);
			}
		}
		return true;
	}
}