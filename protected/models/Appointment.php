<?php

/**
 * This is the model class for table "appointment".
 *
 * The followings are the available columns in table 'appointment':
 * @property integer $id
 * @property string $title
 * @property integer $user_id
 * @property integer $baby_id
 * @property integer $doctor_id
 * @property integer $hospital_id
 * @property integer $visit_id
 * @property integer $realized
 * @property string $date_of_visit
 * @property string $date_created
 * @property string $date_updated
 *
 * The followings are the available model relations:
 * @property User $user
 * @property User $doctor
 * @property User $hospital
 * @property Visit $visit
 * @property Baby $baby
 */
class Appointment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Appointment the static model class
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
		return 'fb_appointment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, baby_id, doctor_id, hospital_id, visit_id, realized', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('date_of_visit, date_created, date_updated', 'safe'),
			array('date_of_visit, title, user_id, baby_id','required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, user_id, baby_id, doctor_id, hospital_id, visit_id, realized, date_of_visit, date_created, date_updated', 'safe', 'on'=>'search'),
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
			'doctor' => array(self::BELONGS_TO, 'User', 'doctor_id'),
			'hospital' => array(self::BELONGS_TO, 'User', 'hospital_id'),
			'visit' => array(self::BELONGS_TO, 'Visit', 'visit_id'),
			'baby' => array(self::BELONGS_TO, 'Baby', 'baby_id'),
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
			'user_id' => 'Created By',
			'baby_id' => 'Baby',
			'doctor_id' => 'Doctor',
			'hospital_id' => 'Hospital',
			'visit_id' => 'Visit',
			'realized' => 'Realized',
			'date_of_visit' => 'Appoint. Time',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('baby_id',$this->baby_id);
		$criteria->compare('doctor_id',$this->doctor_id);
		$criteria->compare('hospital_id',$this->hospital_id);
		$criteria->compare('visit_id',$this->visit_id);
		$criteria->compare('realized',$this->realized);
		$criteria->compare('date_of_visit',$this->date_of_visit,true);
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
        if($this->baby_id){
            $msg='<a href="'.Yii::app()->request->baseUrl.'/userProfile/index/'.$this->user_id.'">'.$this->user->username.'</a> has added appointment (<a href="'.Yii::app()->request->baseUrl.'/babyProfile/appointments/'.$this->baby_id.'">'.$this->title.'</a>) to <a href="'.Yii::app()->request->baseUrl.'/babyProfile/index/'.$this->baby_id.'">'.$this->baby->username.'</a> profile.';
            $notifier_id=  $this->user_id;
            $baby_id=  $this->baby_id;
            $table_name='appointment';
            $row_id=  $this->id;
			$row_date=$this->date_of_visit;
            $notif=Helper::Notification($notifier_id, '', $baby_id, $msg, $row_id, $table_name, $row_date);
        }
		return true;
	}
	
}