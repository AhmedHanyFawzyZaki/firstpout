	

<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $username
 * @property string $gender
 * @property string $image
 * @property string $details$banner
 * @property integer $group$connection_id
 * @property string $desc
 * @property integer $active$date_day
 * @property integer $user_credit$date_month
 * @property integer $date_year
 * @property string $city
 * @property string $street
 * @property string $post_code
 * @property string $country
 * @property string $phone
 * @property integer $groups_id
 * @property string $date_created
 *
 * The followings are the available model relations:
 * @property UserDetails $userDetailsAlbum[] $albums
 * @property Appointment[] $appointments
 * @property Appointment[] $appointments1
 * @property Appointment[] $appointments2
 * @property Baby[] $babies
 * @property BabyDoctorHospital[] $babyDoctorHospitals
 * @property BabyFamily[] $babyFamilies
 * @property Comment[] $comments
 * @property ContestUser[] $contestUsers
 * @property Favourite[] $favourites
 * @property GroupUser[] $groupUsers
 * @property Like[] $likes
 * @property Log[] $logs
 * @property Message[] $messages
 * @property Notification[] $notifications
 * @property Notification[] $notifications1
 * @property Post[] $posts
 * @property Product[] $products
 * @property Month $dateMonth
 * @property Connection $connection
 * @property UserAccess[] $userAccesses
 * @property UserAccess[] $userAccesses1
 * @property UserFriend[] $userFriends
 * @property UserFriend[] $userFriends1
 * @property UserRelationship[] $userRelationships
 * @property UserRelationship[] $userRelationships1
 * @property Visit[] $visits
 * @property Visit[] $visits1
 */
class User extends CActiveRecord {

    public $password_repeat;
    public $verifyCode;
	
	public $old_password;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'fb_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email', 'unique'),
            array('email', 'email'),
            array('username, groups_id', 'required'),
            array('gender, connection_id, groups_id, active, chat_status, country', 'numerical', 'integerOnly' => true),
            array('email, password, username, image, banner, city, street, post_code, phone, pass_token, fb_id, tw_id, google_id', 'length', 'max' => 255),
            array('username', 'required', 'on' => 'create ,update'),
            array('desc, date_of_birth, date_created, date_updated, created_by, dummy', 'safe'),
            array('username, email, city, street, post_code, country, phone, desc, date_of_birth, fname, lname', 'filter', 'filter'=>'trim'),
            array('username', 'match' ,'pattern'=>'/^[ \w#-]+$/', 'message'=>'Field can contain only alphanumeric characters and underscore(_) and space.'),
            array('phone','match','pattern'=>'/[0-9]{1,7}(\\.[0-9]{1,2})*$/', 'message'=>'Phone number should be integers only'),
            // The following rule is used by search().
            array('id, email, password, username, gender, image, banner, connection_id, desc, city, street, post_code, country, phone, groups_id, date_created', 'safe', 'on' => 'search'),
            array('password, password_repeat', 'safe','on'=>'register'),
            array('email,password,password_repeat,groups_id, gender,fname,lname','required' ,'on'=>'register'),
            array('password', 'compare', 'compareAttribute' => 'password_repeat', 'on' => 'register'),
            //array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements(), 'on' => 'register'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'count' => array(self::BELONGS_TO, 'AllCountries', 'country'),
            'usergroup' => array(self::BELONGS_TO, 'UserGroups', 'groups_id'),
            'albums' => array(self::HAS_MANY, 'Album', 'user_id'),
            'appointments' => array(self::HAS_MANY, 'Appointment', 'user_id'),
            'appointments1' => array(self::HAS_MANY, 'Appointment', 'doctor_id'),
            'appointments2' => array(self::HAS_MANY, 'Appointment', 'hospital_id'),
            'babies' => array(self::HAS_MANY, 'Baby', 'user_id'),
            'babyAccessRoles' => array(self::HAS_MANY, 'BabyAccessRole', 'user_id'),
            'babyDoctorHospitals' => array(self::HAS_MANY, 'BabyDoctorHospital', 'doctor_id'),
            'babyFamilies' => array(self::HAS_MANY, 'BabyFamily', 'user_id'),
            'comments' => array(self::HAS_MANY, 'Comment', 'user_id'),
            'contestUsers' => array(self::HAS_MANY, 'ContestUser', 'user_id'),
            'favourites' => array(self::HAS_MANY, 'Favourite', 'user_id'),
            'groupUsers' => array(self::HAS_MANY, 'GroupUser', 'user_id'),
            'likes' => array(self::HAS_MANY, 'Like', 'user_id'),
            'logs' => array(self::HAS_MANY, 'Log', 'user_id'),
            'messages' => array(self::HAS_MANY, 'Message', 'sender_id'),
            'notifications' => array(self::HAS_MANY, 'Notification', 'user_id'),
            'notifications1' => array(self::HAS_MANY, 'Notification', 'notifier_id'),
            'posts' => array(self::HAS_MANY, 'Post', 'user_id'),
            'products' => array(self::HAS_MANY, 'Product', 'user_id'),
            //'dateMonth' => array(self::BELONGS_TO, 'Month', 'date_month'),
            'connection' => array(self::BELONGS_TO, 'Connection', 'connection_id'),
            'userAccesses' => array(self::HAS_MANY, 'UserAccess', 'profile_id'),
            'userAccesses1' => array(self::HAS_MANY, 'UserAccess', 'user_id'),
            'userFriends' => array(self::HAS_MANY, 'UserFriend', 'user_id'),
            'userFriends1' => array(self::HAS_MANY, 'UserFriend', 'friend_id'),
            'userRelationships' => array(self::HAS_MANY, 'UserRelationship', 'me_id'),
            'userRelationships1' => array(self::HAS_MANY, 'UserRelationship', 'user_id'),
            'visits' => array(self::HAS_MANY, 'Visit', 'doctor_id'),
            'visits1' => array(self::HAS_MANY, 'Visit', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'username' => 'Profile Name',
            'fname' => 'First Name',
            'lname' => 'Last Name',
            'gender' => 'Gender',
            'image' => 'Image',
            'banner' => 'Profile Banner',
            'connection_id' => 'connection',
            'desc' => 'Description',
            'groups_id' => 'Account Type',
            'password_repeat' => 'Retype password',
            'verifyCode' => 'Verification Code',
            'date_of_birth' => 'Date Of Birth',
            'city' => 'City',
            'street' => 'Address',
            'post_code' => 'Post Code',
            'country' => 'Country',
            'phone' => 'Phone',
            'groups_id' => 'Account Type',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'pass_token'=>'Code',
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
        $criteria->condition='id!=1';
		if($this->date_created)
		{
			$criteria->addBetweenCondition('date_created', "1969-01-01 00:00:00", $this->date_created);
		}
        $criteria->compare('id', $this->id);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('gender', $this->gender);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('groups_id', $this->groups_id, true);
        $criteria->compare('banner', $this->banner, true);
        $criteria->compare('connection_id', $this->connection_id);
        $criteria->compare('desc', $this->desc, true);
        $criteria->compare('date_of_birth', $this->date_of_birth, true);
        $criteria->compare('city', $this->city, true);
        $criteria->compare('street', $this->street, true);
        $criteria->compare('post_code', $this->post_code, true);
        $criteria->compare('country', $this->country, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('groups_id', $this->groups_id);
        
        $criteria->compare('date_updated', $this->date_updated, true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
			if($this->password=='' && $this->isNewRecord && $this->groups_id==3)
			{
				$this->password='hospital';
			}
            if($this->password && $this->isNewRecord)
            {
                $this->password = password_hash($this->password, PASSWORD_BCRYPT); //$this->hash($this->password);
            }
            $this->date_updated = date("Y-m-d H:i:s");
            return true;
        }
        return false;
    }
	
	protected function afterSave() {
        if($this->isNewRecord)
		{
			if($this->id)
			{
				/*$path=Yii::app()->basePath.'/../media/users/'.$this->id;
				if(!is_dir($path))
				{
					mkdir($path,755);
				}*/
				$al=new Album;
				$al->first_album=1;
				$al->title='My Photos';
				$al->date_of_album=date('Y-m-d');
				$al->user_id=$this->id;
				$al->desc='In this album users can find all their photos that isn\'t belonging to a specific album.';
				$al->save();
			
			}
		}
    }

    // Authentication methods
    public function hash($value) {
        return $this->simple_encrypt($value);
    }

    public static function simple_encrypt($text, $salt = "ahmedhany") {
        return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $salt, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND))));
    }

    function simple_decrypt($text, $salt = "ahmedhany") {
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $salt, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND)));
    }

    public function check($value) {
        $new_hash = $this->simple_encrypt($value);
        if ($new_hash == $this->password) {
            return true;
        }
        return false;
    }

    public static function getProfileType() {
        if (Yii::app()->user->group == 1 or Yii::app()->user->group == 0) {
            return 'member';
        } else if (Yii::app()->user->group == 6) {
            return 'dashboard';
        } else {
            return '#';
        }
    }

    public static function CheckAdmin() {
        if (( Yii::app()->user->isGuest)) {
            return false;
        } else if (Yii::app()->user->group == 6) {
            return true;
        } else {
            return false;
        }
    }

// used for multiple users level
    public static function CheckPermission($type) {
        if (( Yii::app()->user->isGuest)) {
            return false;
        }

        switch ($type) {
            case 'member':
                if (Yii::app()->user->group == 1)
                    return true;
                break;

            default:
                return false;
        } // switch
    }

}
