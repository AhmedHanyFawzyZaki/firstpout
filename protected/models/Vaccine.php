<?php

/**
 * This is the model class for table "vaccine".
 *
 * The followings are the available columns in table 'vaccine':
 * @property integer $id
 * @property string $title
 * @property string $date_of_vaccine
 * @property integer $visit_id
 * @property string $desc
 * @property integer $next_vaccine_id
 * @property integer $realized
 * @property integer $user_id
 * @property integer $baby_id
 * @property string $date_created
 * @property string $date_updated
 *
 * The followings are the available model relations:
 * @property Vaccine $nextVaccine
 * @property Vaccine[] $vaccines
 * @property Visit $visit
 * @property Baby $baby
 * @property User $user
 */
class Vaccine extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Vaccine the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'fb_vaccine';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('visit_id, next_vaccine_id, realized, user_id, baby_id, country_id', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 255),
            array('date_of_vaccine, desc, date_created, date_updated', 'safe'),
            array('title, date_of_vaccine', 'required'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, date_of_vaccine, visit_id, desc, next_vaccine_id, realized, user_id, baby_id, date_created, date_updated', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'nextVaccine' => array(self::BELONGS_TO, 'Vaccine', 'next_vaccine_id'),
            'vaccines' => array(self::HAS_MANY, 'Vaccine', 'next_vaccine_id'),
            'visit' => array(self::BELONGS_TO, 'Visit', 'visit_id'),
            'baby' => array(self::BELONGS_TO, 'Baby', 'baby_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'country' => array(self::BELONGS_TO, 'AllCountries', 'country_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Vaccine Name',
            'date_of_vaccine' => 'Vaccine date',
            'visit_id' => 'Visit',
            'desc' => 'Description',
            'next_vaccine_id' => 'Next Vaccine',
            'realized' => 'Realized',
            'user_id' => 'Created By',
            'baby_id' => 'Baby',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'country_id' => 'Country',
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
        $criteria->compare('date_of_vaccine', $this->date_of_vaccine, true);
        $criteria->compare('visit_id', $this->visit_id);
        $criteria->compare('desc', $this->desc, true);
        $criteria->compare('next_vaccine_id', $this->next_vaccine_id);
        $criteria->compare('realized', $this->realized);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('baby_id', $this->baby_id);
        $criteria->compare('date_created', $this->date_created, true);
        $criteria->compare('date_updated', $this->date_updated, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    protected function beforeSave() {
        $this->date_updated = date("Y-m-d H:i:s");
        return true;
    }
	
	protected function afterSave() {
        if($this->baby_id){
            $msg='<a href="'.Yii::app()->request->baseUrl.'/userProfile/index/'.$this->user_id.'">'.$this->user->username.'</a> has added vaccine (<a href="'.Yii::app()->request->baseUrl.'/babyProfile/vaccines/'.$this->baby_id.'">'.$this->title.'</a>) to <a href="'.Yii::app()->request->baseUrl.'/babyProfile/index/'.$this->baby_id.'">'.$this->baby->username.'</a> profile.';
            $notifier_id=  $this->user_id;
            $baby_id=  $this->baby_id;
            $table_name='vaccine';
            $row_id=  $this->id;
			$row_date=$this->date_of_vaccine;
            $notif=Helper::Notification($notifier_id, '', $baby_id, $msg, $row_id, $table_name, $row_date);
        }
		return true;
	}

}
