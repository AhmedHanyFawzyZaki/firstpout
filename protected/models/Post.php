<?php

/**
 * This is the model class for table "post".
 *
 * The followings are the available columns in table 'post':
 * @property integer $id
 * @property integer $user_id
 * @property integer $baby_id
 * @property string $title
 * @property string $content
 * @property string $image
 * @property string $image_date_taken
 * @property string $video_link
 * @property string $date_updated
 * @property string $date_created
 * @property string $video
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Baby $baby
 */
class Post extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Post the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'fb_post';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, baby_id, group_id, album_id', 'numerical', 'integerOnly' => true),
            array('title, image, video_link, video', 'length', 'max' => 255),
            array('content, image_date_taken, date_updated, date_created', 'safe'),
            //array('title', 'required'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_id, baby_id, title, content, image, image_date_taken, video_link, date_updated, date_created, video', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'baby' => array(self::BELONGS_TO, 'Baby', 'baby_id'),
            'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
            'album' => array(self::BELONGS_TO, 'Album', 'album_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'baby_id' => 'Baby',
            'title' => 'Title',
            'content' => 'Text',
            'image' => 'Image',
            'image_date_taken' => 'Image Date Taken',
            'video_link' => 'Video Link',
            'date_updated' => 'Date Updated',
            'date_created' => 'Date Created',
            'video' => 'Video',
            'group_id' => 'Group',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('baby_id', $this->baby_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('image_date_taken', $this->image_date_taken, true);
        $criteria->compare('video_link', $this->video_link, true);
        $criteria->compare('date_updated', $this->date_updated, true);
        $criteria->compare('date_created', $this->date_created, true);
        $criteria->compare('video', $this->video, true);
        $criteria->compare('group_id', $this->group_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    protected function beforeSave() {
        if (!$this->baby_id && !$this->user_id) {
            $this->addError('user_id', Yii::t('app', 'You have to select a baby profile or user profile to which this post relates.'));
            return false;
        }
        /*if (!$this->image && !$this->content && !$this->video && $this->isNewRecord) {
            $this->addError('content', Yii::t('app', 'You have to select the post data you want to publish being it text, image or video.'));
            return false;
        }*/
        $this->date_updated = date("Y-m-d H:i:s");
        return true;
    }

    protected function afterSave() {
        if($this->baby_id){
            if($this->album_id){
                $msg='<a href="'.Yii::app()->request->baseUrl.'/userProfile/index/'.$this->user_id.'">'.$this->user->username.'</a> has added album (<a href="'.Yii::app()->request->baseUrl.'/controlPanel/viewAlbum/'.$this->album_id.'" class="fancybox">'.$this->album->title.'</a>) to <a href="'.Yii::app()->request->baseUrl.'/babyProfile/index/'.$this->baby_id.'">'.$this->baby->username.'</a> profile.';
            }elseif($this->image){
                $msg='<a href="'.Yii::app()->request->baseUrl.'/userProfile/index/'.$this->user_id.'">'.$this->user->username.'</a> has added a new (<a href="'.Yii::app()->request->baseUrl.'/media/posts/'.$this->image.'" class="lightbox">photo</a>) to <a href="'.Yii::app()->request->baseUrl.'/babyProfile/index/'.$this->baby_id.'">'.$this->baby->username.'</a> timeline.';
            }elseif($this->video){
                $msg='<a href="'.Yii::app()->request->baseUrl.'/userProfile/index/'.$this->user_id.'">'.$this->user->username.'</a> has added a new (<a href="'.Yii::app()->request->baseUrl.'/media/posts/'.$this->video.'" class="lightbox">video</a>) to <a href="'.Yii::app()->request->baseUrl.'/babyProfile/index/'.$this->baby_id.'">'.$this->baby->username.'</a> timeline.';
            }else{
                $msg='<a href="'.Yii::app()->request->baseUrl.'/userProfile/index/'.$this->user_id.'">'.$this->user->username.'</a> has added a new (<a href="'.Yii::app()->request->baseUrl.'/babyProfile/index/'.$this->baby_id.'" >post</a>) to <a href="'.Yii::app()->request->baseUrl.'/babyProfile/index/'.$this->baby_id.'">'.$this->baby->username.'</a> timeline.';
            }
            $notifier_id=  $this->user_id;
            $baby_id=  $this->baby_id;
            $table_name='post';
            $row_id=  $this->id;
            $notif=Helper::Notification($notifier_id, '', $baby_id, $msg, $row_id, $table_name);
        }elseif($this->group_id){
            if($this->image){
                $msg='<a href="'.Yii::app()->request->baseUrl.'/userProfile/index/'.$this->user_id.'">'.$this->user->username.'</a> has added a new (<a href="'.Yii::app()->request->baseUrl.'/media/posts/'.$this->image.'" class="lightbox">photo</a>) to <a href="'.Yii::app()->request->baseUrl.'/groups/index/'.$this->group_id.'">'.$this->group->title.'</a> timeline.';
            }elseif($this->video){
                $msg='<a href="'.Yii::app()->request->baseUrl.'/userProfile/index/'.$this->user_id.'">'.$this->user->username.'</a> has added a new (<a href="'.Yii::app()->request->baseUrl.'/media/posts/'.$this->video.'" class="lightbox">video</a>) to <a href="'.Yii::app()->request->baseUrl.'/groups/index/'.$this->group_id.'">'.$this->group->title.'</a> timeline.';
            }else{
                $msg='<a href="'.Yii::app()->request->baseUrl.'/userProfile/index/'.$this->user_id.'">'.$this->user->username.'</a> has added a new (<a href="'.Yii::app()->request->baseUrl.'/babyProfile/index/'.$this->baby_id.'" >post</a>) to <a href="'.Yii::app()->request->baseUrl.'/groups/index/'.$this->group_id.'">'.$this->group->title.'</a> timeline.';
            }
            $notifier_id=  $this->user_id;
            $baby_id=  $this->baby_id;
			$group_id=  $this->group_id;
            $table_name='post';
            $row_id=  $this->id;
            $notif=Helper::Notification($notifier_id, '', $baby_id, $msg, $row_id, $table_name, '', $group_id);
        }
        /*if ($this->video) {
            if (!strpos($this->video, '.flv')) {
                $file_name = $this->video;
                $this->video = Helper::mediaHandler($this->video, 500, 200);
                unlink(Yii::app()->basePath . '/../media/posts/' . $file_name);
                $this->isNewRecord = false;
                $this->save(false);
            }
        }*/
        return true;
    }

}
