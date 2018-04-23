<?php

/**
 * This is the model class for table "album".
 *
 * The followings are the available columns in table 'album':
 * @property integer $id
 * @property string $title
 * @property string $date_of_album
 * @property integer $pic_date
 * @property integer $private
 * @property integer $belong_to_me
 * @property integer $baby_id
 * @property integer $user_id
 * @property string $desc
 * @property string $date_updated
 * @property string $date_created
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Baby $baby
 * @property AlbumImage[] $albumImages
 */
class Album extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Album the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'fb_album';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pic_date, private, belong_to_me, baby_id, user_id, group_id, first_album', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 255),
            array('date_of_album, desc, date_updated, date_created', 'safe'),
            array('title, date_of_album', 'required'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, date_of_album, pic_date, private, belong_to_me, baby_id, user_id, desc, date_updated, date_created', 'safe', 'on' => 'search'),
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
            'albumImages' => array(self::HAS_MANY, 'AlbumImage', 'album_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'date_of_album' => 'Album Date',
            'pic_date' => 'Use picture date',
            'private' => 'Private album',
            'belong_to_me' => 'This album belongs to me',
            'baby_id' => 'Baby',
            'user_id' => 'User',
            'desc' => 'Description',
            'date_updated' => 'Date Updated',
            'date_created' => 'Date Created',
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
        $criteria->compare('title', $this->title, true);
        $criteria->compare('date_of_album', $this->date_of_album, true);
        $criteria->compare('pic_date', $this->pic_date);
        $criteria->compare('private', $this->private);
        $criteria->compare('belong_to_me', $this->belong_to_me);
        $criteria->compare('baby_id', $this->baby_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('desc', $this->desc, true);
        $criteria->compare('date_updated', $this->date_updated, true);
        $criteria->compare('date_created', $this->date_created, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    protected function beforeSave() {
        if (!$this->baby_id && !$this->user_id) {
            $this->addError('user_id', Yii::t('app', 'Please Choose a profile to which this album belongs.'));
            return false;
        }
        /* elseif($this->baby_id && $this->user_id)
          {
          $this->addError('user_id',Yii::t('app', 'Please Choose either a baby profile or a user profile to which this album belongs (Can\'t choose both).'));
          return false;
          } */
        $this->date_updated = date("Y-m-d H:i:s");
        return true;
    }

}
