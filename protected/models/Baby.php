<?php

/**
 * This is the model class for table "baby".
 *
 * The followings are the available columns in table 'baby':
 * @property integer $id
 * @property integer $user_id
 * @property string $username
 * @property integer $gender
 * @property string $date_of_birth
 * @property string $birth_place
 * @property string $date_of_pergacy
 * @property string $image
 * @property string $banner
 * @property integer $sun_sign
 * @property string $blood_type
 * @property string $height
 * @property string $weight
 * @property string $body_mass
 * @property string $date_created
 * @property string $date_updated
 *
 * The followings are the available model relations:
 * @property Album[] $albums
 * @property Appointment[] $appointments
 * @property SunSign $sunSign
 * @property User $user
 * @property BabyAccessRole[] $babyAccessRoles
 * @property BabyDoctorHospital[] $babyDoctorHospitals
 * @property BabyFamily[] $babyFamilies
 * @property Comment[] $comments
 * @property ContestUser[] $contestUsers
 * @property Favourite[] $favourites
 * @property Like[] $likes
 * @property Log[] $logs
 * @property Message[] $messages
 * @property Notification[] $notifications
 * @property Post[] $posts
 * @property Product[] $products
 * @property Vaccine[] $vaccines
 * @property Visit[] $visits
 */
class Baby extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Baby the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'fb_baby';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, gender, sun_sign', 'numerical', 'integerOnly' => true),
            array('username, birth_place, image, desc, banner, blood_type, height, weight, body_mass', 'length', 'max' => 255),
            array('height, weight, body_mass', 'length', 'max' => 10),
            array('date_of_birth, date_of_pergacy, date_created, date_updated', 'safe'),
            array('user_id,username', 'required'),
            /* array('username', 'match' ,'pattern'=>'/^[A-Za-z0-9_]+$/u', 'message'=>'Field can contain only alphanumeric characters and underscore(_).'), */
            array('username', 'match', 'pattern' => '/^[ \w#-]+$/', 'message' => 'Field can contain only alphanumeric characters and underscore(_) and space.'),
            array('username', 'filter', 'filter' => 'trim'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_id, username, gender, date_of_birth, birth_place, date_of_pergacy, image, banner, sun_sign, blood_type, height, weight, body_mass, date_created, date_updated', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'albums' => array(self::HAS_MANY, 'Album', 'baby_id'),
            'appointments' => array(self::HAS_MANY, 'Appointment', 'baby_id'),
            'sunSign' => array(self::BELONGS_TO, 'SunSign', 'sun_sign'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'babyAccessRoles' => array(self::HAS_MANY, 'BabyAccessRole', 'baby_id'),
            'babyDoctorHospitals' => array(self::HAS_MANY, 'BabyDoctorHospital', 'baby_id'),
            'babyFamilies' => array(self::HAS_MANY, 'BabyFamily', 'baby_id'),
            'comments' => array(self::HAS_MANY, 'Comment', 'baby_id'),
            'contestUsers' => array(self::HAS_MANY, 'ContestUser', 'baby_id'),
            'favourites' => array(self::HAS_MANY, 'Favourite', 'baby_id'),
            'likes' => array(self::HAS_MANY, 'Like', 'baby_id'),
            'logs' => array(self::HAS_MANY, 'Log', 'baby_id'),
            'messages' => array(self::HAS_MANY, 'Message', 'baby_id'),
            'notifications' => array(self::HAS_MANY, 'Notification', 'baby_id'),
            'posts' => array(self::HAS_MANY, 'Post', 'baby_id'),
            'products' => array(self::HAS_MANY, 'Product', 'baby_id'),
            'vaccines' => array(self::HAS_MANY, 'Vaccine', 'baby_id'),
            'visits' => array(self::HAS_MANY, 'Visit', 'baby_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'Profile Creator',
            'username' => 'Baby Name',
            'gender' => 'Gender',
            'date_of_birth' => 'Date Of Birth',
            'birth_place' => 'Birth Place',
            'date_of_pergacy' => 'Date Of Pergacy',
            'image' => 'Image',
            'banner' => 'Banner',
            'sun_sign' => 'Sun Sign',
            'blood_type' => 'Blood Type',
            'height' => 'Height',
            'weight' => 'Weight',
            'body_mass' => 'Body Mass',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'desc' => 'Climate',
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
        $criteria->compare('username', $this->username, true);
        $criteria->compare('gender', $this->gender);
        $criteria->compare('birth_place', $this->birth_place, true);
        $criteria->compare('date_of_pergacy', $this->date_of_pergacy, true);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('banner', $this->banner, true);
        $criteria->compare('sun_sign', $this->sun_sign);
        $criteria->compare('blood_type', $this->blood_type, true);
        $criteria->compare('height', $this->height, true);
        $criteria->compare('weight', $this->weight, true);
        $criteria->compare('body_mass', $this->body_mass, true);
        $criteria->compare('date_created', $this->date_created, true);
        $criteria->compare('date_updated', $this->date_updated, true);
        if ($this->date_of_birth) {
            $criteria->addBetweenCondition('date_of_birth', "1969-01-01 00:00:00", $this->date_of_birth);
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            $this->date_updated = date("Y-m-d H:i:s");
            return true;
        }
        return false;
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
				$al->baby_id=$this->id;
				$al->desc='In this album users can find all the photos posts on the wall of this baby that isn\'t belonging to a specific album.';
				$al->save();
            }
        }
    }

    public static function IsBabyAdmin($id, $user_id) {
        $admin = BabyAccessRole::model()->findByAttributes(array('user_id' => $user_id, 'role' => 1, 'baby_id' => $id));
        $creator = Baby::model()->findByPk($id)->user_id == $user_id ? true : false;
        if ($creator == true || !empty($admin)) {
            return true;
        }
        Yii::app()->user->setFlash('WrongBaby', 'Wrong! You can\'t edit this baby profile, but you can create new one.');
        return false;
    }

    public static function IsBabyAccess($id, $user_id) {
        $admin = BabyAccessRole::model()->findByAttributes(array('user_id' => $user_id, 'baby_id' => $id));
        $creator = Baby::model()->findByPk($id)->user_id == $user_id ? true : false;
        if ($creator == true || !empty($admin)) {
            return true;
        }
        Yii::app()->user->setFlash('WrongBaby', 'Wrong! You can\'t edit this baby profile, but you can create new one.');
        return false;
    }

}
