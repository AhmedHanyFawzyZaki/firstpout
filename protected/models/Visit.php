<?php

/**
 * This is the model class for table "visit".
 *
 * The followings are the available columns in table 'visit':
 * @property integer $id
 * @property string $title
 * @property integer $user_id
 * @property integer $baby_id
 * @property string $date_of_visit
 * @property string $diagonise
 * @property string $medication
 * @property string $desage
 * @property string $frequency
 * @property string $bage_on
 * @property integer $doctor_id
 * @property string $prescription
 * @property string $next_medication
 * @property string $note
 * @property integer $realized
 * @property string $date_created
 * @property string $date_updated
 *
 * The followings are the available model relations:
 * @property Appointment[] $appointments
 * @property Vaccine[] $vaccines
 * @property User $user
 * @property User $doctor
 * @property Baby $baby
 */
class Visit extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Visit the static model class
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
		return 'fb_visit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, baby_id, doctor_id, realized, appointment_id', 'numerical', 'integerOnly'=>true),
			array('title, diagonise, medication, desage, frequency, bage_on, prescription, next_medication', 'length', 'max'=>255),
			array('date_of_visit, note, date_created, date_updated', 'safe'),
			array('user_id, title, baby_id, date_of_visit', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, user_id, baby_id, date_of_visit, diagonise, medication, desage, frequency, bage_on, doctor_id, prescription, next_medication, note, realized, date_created, date_updated', 'safe', 'on'=>'search'),
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
			'appointments' => array(self::HAS_MANY, 'Appointment', 'visit_id'),
			'vaccines' => array(self::HAS_MANY, 'Vaccine', 'visit_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'doctor' => array(self::BELONGS_TO, 'User', 'doctor_id'),
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
			'date_of_visit' => 'Date Of Visit',
			'diagonise' => 'Diagnose',
			'medication' => 'Medication',
			'desage' => 'Dosage',
			'frequency' => 'Frequency',
			'bage_on' => 'Bage On',
			'doctor_id' => 'Doctor',
			'prescription' => 'Prescription',
			'next_medication' => 'Next Medication',
			'note' => 'Note',
			'realized' => 'Realized',
			'date_created' => 'Date Created',
			'date_updated' => 'Date Updated',
			'appointment_id' => 'Appointment',
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
		$criteria->compare('date_of_visit',$this->date_of_visit,true);
		$criteria->compare('diagonise',$this->diagonise,true);
		$criteria->compare('medication',$this->medication,true);
		$criteria->compare('desage',$this->desage,true);
		$criteria->compare('frequency',$this->frequency,true);
		$criteria->compare('bage_on',$this->bage_on,true);
		$criteria->compare('doctor_id',$this->doctor_id);
		$criteria->compare('prescription',$this->prescription,true);
		$criteria->compare('next_medication',$this->next_medication,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('realized',$this->realized);
		$criteria->compare('appointment_id',$this->appointment_id);
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
            $msg='<a href="'.Yii::app()->request->baseUrl.'/userProfile/index/'.$this->user_id.'">'.$this->user->username.'</a> has added visit (<a href="'.Yii::app()->request->baseUrl.'/babyProfile/visits/'.$this->baby_id.'">'.$this->title.'</a>) to <a href="'.Yii::app()->request->baseUrl.'/babyProfile/index/'.$this->baby_id.'">'.$this->baby->username.'</a> profile.';
            $notifier_id=  $this->user_id;
            $baby_id=  $this->baby_id;
            $table_name='visit';
            $row_id=  $this->id;
			$row_date=$this->date_of_visit;
            $notif=Helper::Notification($notifier_id, '', $baby_id, $msg, $row_id, $table_name, $row_date);
        }
		return true;
	}
	
}