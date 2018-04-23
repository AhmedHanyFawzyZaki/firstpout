<?php

/**
 * This is the model class for table "chat".
 *
 * The followings are the available columns in table 'chat':
 * @property integer $id
 * @property integer $from_id
 * @property integer $to_id
 * @property string $msg
 * @property integer $msg_type
 * @property integer $seen
 * @property string $date_created
 * @property integer $admin
 * @property integer $fav
 * @property integer $imp
 * @property integer $show
 *
 * The followings are the available model relations:
 * @property User $from
 * @property User $to
 */
class Chat extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Chat the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'fb_chat';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('from_id, to_id, msg_type, seen, admin, fav, imp, show', 'numerical', 'integerOnly' => true),
            array('msg, date_created', 'safe'),
            array('msg, to_id, from_id', 'required'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, from_id, to_id, msg, msg_type, seen, date_created, admin, fav, imp, show', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'from' => array(self::BELONGS_TO, 'User', 'from_id'),
            'to' => array(self::BELONGS_TO, 'User', 'to_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'from_id' => 'From',
            'to_id' => 'To',
            'msg' => 'Message',
            'msg_type' => 'Msg Type',
            'seen' => 'Seen',
            'date_created' => 'Date Created',
            'admin' => 'Admin msg',
            'fav' => 'Favorite',
            'imp' => 'Important',
            'show' => 'Show',
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
        $criteria->compare('from_id', $this->from_id);
        $criteria->compare('to_id', $this->to_id);
        $criteria->compare('msg', $this->msg, true);
        $criteria->compare('msg_type', $this->msg_type);
        $criteria->compare('seen', $this->seen);
        $criteria->compare('date_created', $this->date_created, true);
        $criteria->compare('admin', $this->admin);
        $criteria->compare('fav', $this->fav);
        $criteria->compare('imp', $this->imp);
        $criteria->compare('show', $this->show);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
