<?php

class LoginController extends FrontController {

    /**
     * Declares class-based actions.
     */
    public $layout = '//layouts/login';

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewActionM',
            ),
        );
    }

    public function beforeAction($action) {
        if (isset(Yii::app()->user->id) && strtolower(Yii::app()->request->urlReferrer)!=Yii::app()->getBaseUrl(true).'/controlpanel/linksocial') {
            $this->redirect(Yii::app()->request->baseUrl . '/home');
        }
        return true;
    }

    public function actionIndex() {
        $model = new LoginForm;
        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->login()) {
                if ($_POST['LoginForm']['rememberMe']) {
                    $m_user = User::model()->findByPk(Yii::app()->user->id);
                    $name = 'fp_user_id'; // cookie name
                    $value = $m_user->id; // cookie value
                    $cookieEmail = new CHttpCookie($name, $value);
                    $cookieEmail->expire = time() + (60 * 60 * 24 * 365);
                    Yii::app()->request->cookies[$name] = $cookieEmail;
                }

                if (Yii::app()->user->group == 1) {
                    $this->redirect(array('home/index'));
                } else if (Yii::app()->user->group == 6) {
                    $this->redirect(array('dashboard/index'));
                } else {
                    $this->redirect(Yii::app()->user->returnUrl);
                }
            } else {
                Yii::app()->user->setFlash("wrong_pass", 'Wrong username or password entered!');
            }
        }

        $user = new User('register');
        if (isset($_POST['User'])) {
            $user->attributes = $_POST['User'];
            $user->date_of_birth = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
            $user->username = trim($user->fname) . ' ' . trim($user->lname); //Helper::slugify($user->fname.$user->lname.rand(0, 999));
            $user->groups_id = 1;
            $user->pass_token = time() . rand(0, 500);
            if ($user->validate()) {
                if ($user->save(false)) {
                    Yii::app()->user->setState('reg_id', $user->id);
                    $this->redirect(array('invite'));
                }
            }
        }

        $this->render('index', array('user' => $user));
    }

    public function actionInvite() {
        //Yii::app()->user->setState('reg_id',20);
        if (!Yii::app()->user->hasState('reg_id'))
            $this->redirect('home');
        $model = User::model()->findByPk(Yii::app()->user->getState('reg_id')); //registered user id

        $this->render('invite', array('model' => $model));
    }

    public function actionProfileInfo() {
        //Yii::app()->user->setState('reg_id',25);
        if (!Yii::app()->user->hasState('reg_id'))
            $this->redirect('home');
        $model = User::model()->findByPk(Yii::app()->user->getState('reg_id')); //registered user id

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save(false))
                $this->redirect(array('completeProfile'));
        }

        $this->render('profile', array('model' => $model));
    }

    public function actionCompleteProfile() {
        if (!Yii::app()->user->hasState('reg_id'))
            $this->redirect('home');
        $model = User::model()->findByPk(Yii::app()->user->getState('reg_id')); //registered user id
        if (isset($_POST['User']) && $model) {
            $model->attributes = $_POST['User'];
            if ($model->save(false)) {
                Yii::app()->user->id = $model->id;
                Yii::app()->user->setState('username', $model->username);
                Yii::app()->user->setState('email', $model->email);
                Yii::app()->user->setState('group', $model->groups_id);
                $this->redirect(Yii::app()->homeUrl);
            }
        }
        if (isset($_GET['skip']) && $model) {
            Yii::app()->user->id = $model->id;
            Yii::app()->user->setState('username', $model->username);
            Yii::app()->user->setState('email', $model->email);
            Yii::app()->user->setState('group', $model->groups_id);
            $this->redirect(Yii::app()->homeUrl);
        }
        $this->render('complete-profile', array('model' => $model));
    }

    public function actionTwitter() {
        $twitter = Yii::app()->twitter->getTwitter();
        $request_token = $twitter->getRequestToken();

        //set some session info
        Yii::app()->session['oauth_token'] = $token = $request_token['oauth_token'];
        Yii::app()->session['oauth_token_secret'] = $request_token['oauth_token_secret'];

        if ($twitter->http_code == 200) {
            //get twitter connect url
            $url = $twitter->getAuthorizeURL($token);
            //send them
            $this->redirect($url);
        } else {
            //error here
            $this->redirect(Yii::app()->homeUrl);
        }
    }

    public function actionTwitterCallBack() {
        /* If the oauth_token is old redirect to the connect page. */
        if (isset($_REQUEST['oauth_token']) && Yii::app()->session['oauth_token'] !== $_REQUEST['oauth_token']) {
            Yii::app()->session['oauth_status'] = 'oldtoken';
        }

        /* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
        $twitter = Yii::app()->twitter->getTwitterTokened(Yii::app()->session['oauth_token'], Yii::app()->session['oauth_token_secret']);

        /* Request access tokens from twitter */
        $access_token = $twitter->getAccessToken($_REQUEST['oauth_verifier']);

        /* Save the access tokens. Normally these would be saved in a database for future use. */
        Yii::app()->session['access_token'] = $access_token;

        /* Remove no longer needed request tokens */
        unset(Yii::app()->session['oauth_token']);
        unset(Yii::app()->session['oauth_token_secret']);

        if (200 == $twitter->http_code) {
            /* The user has been verified and the access tokens can be saved for future use */
            Yii::app()->session['status'] = 'verified';

            //get an access twitter object
            $twitter = Yii::app()->twitter->getTwitterTokened($access_token['oauth_token'], $access_token['oauth_token_secret']);

            //get user details
            $twuser = $twitter->get("account/verify_credentials");
            //$user = User::model()->findByAttributes(array('social_provider' => 'twitter', 'social_identifier' => $twuser->id, 'active' => 1));
			$user = User::model()->find(array('condition'=>'active=1 and email="'.$twuser->email.'"'));
            if ($user) {
                Yii::app()->user->id = $user->id;
                Yii::app()->user->setState('username', $user->username);
                Yii::app()->user->setState('email', $user->email);
                Yii::app()->user->setState('group', $user->groups_id);
				if($user->image=='')
                	$user->image=str_replace('_normal','',$twuser->profile_image_url);
                $user->tw_id=$twuser->id;
                $user->save(false);
                $this->redirect(array('/home'));
            } else {

                $model = new User('register');
                $model->password = 'new';
                $model->groups_id = 1;
                $model->active = '1';
                $model->social_identifier = $twuser->id;
                $model->social_provider = "twitter";
                $model->email = "twitter_email" . $twuser->id;
                $name = explode(' ', $twuser->name);
                $model->fname = $name[0];
                $model->lname = $name[1];
                $model->city = $twuser->location;
                $model->gender = 1;
                if (isset($twuser->gender) && $twuser->gender == 'female') {
                    $model->gender = 2;
                }
                $model->username = trim($twuser->screen_name); //Helper::slugify($twuser->screen_name);
                $model->image = str_replace('_normal','',$twuser->profile_image_url);
                $model->tw_id=$twuser->id;
                if ($model->save(false)) {
                    Yii::app()->user->id = $model->id;
                    Yii::app()->user->setState('username', $model->username);
                    Yii::app()->user->setState('email', $model->email);
                    Yii::app()->user->setState('group', $model->groups_id);
                    $this->redirect('home');
                }
            }
            //var_dump($twuser);die;
            /* //get friends ids
              $friends= $twitter->get("friends/ids");
              //get followers ids
              $followers= $twitter->get("followers/ids");
              //tweet
              $result=$twitter->post('statuses/update', array('status' => "Tweet message"));* */
        } else {
            /* Save HTTP status for error dialog on connnect page. */
            //header('Location: /clearsessions.php');
            $this->redirect(Yii::app()->homeUrl);
        }
    }

    public function actionFacebook() {
        $returnUrl = Yii::app()->request->getBaseUrl(true) . '/login/facebook';
        $permissions = 'public_profile,email,user_birthday'; //,user_about_me,user_location,user_birthday,user_photos later usage

        $fb = Yii::app()->facebook;
        $token = $fb->getAccessToken();
        $fb->setAccessToken($token);
        $fbUser = Yii::app()->facebook->getUser();
        if ($fbUser) {
            $fb_user = Yii::app()->facebook->api('/me');
            //$user = User::model()->findByAttributes(array('social_provider' => 'facebook', 'social_identifier' => $fb_user['id'], 'active' => 1));
			$user = User::model()->find(array('condition'=>'active=1 and email="'.$fb_user['email'].'"'));
            if ($user) {
                Yii::app()->user->id = $user->id;
                Yii::app()->user->setState('username', $user->username);
                Yii::app()->user->setState('email', $user->email);
                Yii::app()->user->setState('group', $user->groups_id);
				if($user->username==''){
					$user->username = trim($fb_user['name']); //Helper::slugify($fb_user['name']);
				}
                if($user->image==''){
					$user->image = Yii::app()->facebook->getProfilePicture('large');
				}
				if($user->date_of_birth==''){
					$user->date_of_birth=date('Y-m-d',strtotime($fb_user['birthday']));
				}
                //$user->fb_id=1;
				$user->fb_id=$fb_user['id'];
				$user->save(false);
                $this->redirect(array('/home'));
            } else {
                $model = new User('register');
                $model->password = 'new';
                $model->groups_id = 1;
                $model->active = '1';
                $model->social_identifier = $fb_user['id'];
                $model->social_provider = "facebook";
                $model->email = $fb_user['email'];
                $model->fname = $fb_user['first_name'];
                $model->lname = $fb_user['last_name'];
                $model->gender = 1;
                if ($fb_user['gender'] == 'female') {
                    $model->gender = 2;
                }
                $model->username = trim($fb_user['name']); //Helper::slugify($fb_user['name']);
                $model->image = Yii::app()->facebook->getProfilePicture('large');
                $model->fb_id=$fb_user['id'];
				$model->date_of_birth=date('Y-m-d',strtotime($fb_user['birthday']));
                if ($model->save(false)) {
                    Yii::app()->user->id = $model->id;
                    Yii::app()->user->setState('username', $model->username);
                    Yii::app()->user->setState('email', $model->email);
                    Yii::app()->user->setState('group', $model->groups_id);
                    $this->redirect(array('/home'));
                }
            }
        } else {
            $loginUrl = Yii::app()->facebook->getLoginUrl(array('scope' => $permissions, 'redirect-uri' => $returnUrl));
            $this->redirect($loginUrl);
        }
    }

    public function actionGoogle() {
        $client = Yii::app()->GoogleApis->client;
		$client->setScopes('email');
        $plus = Yii::app()->GoogleApis->serviceFactory('Plus');

        if (!isset(Yii::app()->session['auth_token']) || is_null(Yii::app()->session['auth_token'])) {
            Yii::app()->session['auth_token'] = $client->authenticate();
            if ($_GET['code'] && Yii::app()->session['auth_token']) {
                $this->redirect('google');
            }
        } else {
            $client->setAccessToken(Yii::app()->session['auth_token']);
            $google_user = $plus->people->get('me');
            //$user = User::model()->findByAttributes(array('social_provider' => 'google', 'social_identifier' => $google_user['id'], 'active' => 1));
			$user = User::model()->find(array('condition'=>'active=1 and email="'.$google_user['emails'][0]['value'].'"'));
            if ($user) {
                Yii::app()->user->id = $user->id;
                Yii::app()->user->setState('username', $user->username);
                Yii::app()->user->setState('email', $user->email);
                Yii::app()->user->setState('group', $user->groups_id);
				if($user->image==''){
					$user->image = str_replace('sz=50','sz=180',$google_user['image']['url']);
				}
                $user->google_id=$google_user['id'];
                $user->save(false);
                $this->redirect(array('/home'));
            } else {

                $model = new User('register');
                $model->password = 'new';
                $model->groups_id = 1;
                $model->active = '1';
                $model->social_identifier = $google_user['id'];
                $model->social_provider = "google";
                $model->email = $google_user['emails'][0]['value'];
                $model->fname = $google_user['name']['givenName'];
                $model->lname = $google_user['name']['familyName'];
                $model->gender = 1;
                if (isset($twuser->gender) && $twuser->gender == 'female') {
                    $model->gender = 2;
                }
                $model->username = trim($google_user['displayName']); //Helper::slugify($google_user['displayName']);
                $model->image = str_replace('sz=50','sz=180',$google_user['image']['url']);
                $model->google_id=$google_user['id'];
                if ($model->save(false)) {
                    Yii::app()->user->id = $model->id;
                    Yii::app()->user->setState('username', $model->username);
                    Yii::app()->user->setState('email', $model->email);
                    Yii::app()->user->setState('group', $model->groups_id);
                    $this->redirect(array('/home'));
                }
            }
            unset(Yii::app()->session['auth_token']);
            /* $activities = '';
              $client->setAccessToken(Yii::app()->session['auth_token']);
              $activities = $plus->activities->listActivities('me', 'public'); */
            //print 'Your Activities: <pre>' . print_r($activities, true) . '</pre>';
        }
    }

    public function actionForgot() {
        $user = new User;
        if(isset($_POST['User'])){
            $user->attributes=$_POST['User'];
            if($user->email){
                $model=  User::model()->findByAttributes(array('email'=>$user->email));
                if($model){
                    $model->can_reset=1;//can reset
                    $code=  rand(0, 999999);
                    $model->pass_token=$code;
                    $model->save(false);
                    
                    $link=Yii::app()->request->getBaseUrl(true).'/login/resetPassword?code='.$code;
                    $body='Thank you for using ('.Yii::app()->name.').<br><br>
                        To reset your password please <a href="'.$link.'">click here</a> or 
                        just copy and paste the following link to your browser url:<br>
                        '.$link.' .';
                    $mail = new YiiMailer();
                    //$mail->clearLayout();//if layout is already set in config
                    $mail->setFrom(Yii::app()->params['email'], Yii::app()->name.' Admininstrator');
                    $mail->setTo($model->email);
                    $mail->setSubject(Yii::app()->name.' - Reset Password');
                    $mail->setBody($body);
                    //$mail->setLayout('layout-mail');

                    if ($mail->send()) {
                        Yii::app()->user->setFlash('resetDone','Please check your email inbox and follow the link we have sent to reset your password.');
                    }else{
                        Yii::app()->user->setFlash('resetWrong','Something went wrong with our mailing server, please try again later.');
                    }
                }else{
                    Yii::app()->user->setFlash('resetWrong','This email address isn\'t registered with us, please enter a valid email.');
                }
            }else{
                Yii::app()->user->setFlash('resetWrong','Please enter your email address below');
            }
        }
        $this->render('forgot', array('user' => $user));
    }
    
    public function actionResetPassword() {
        $code=$_GET['code'];
        $user=  User::model()->findByAttributes(array('pass_token'=>$code, 'can_reset'=>1));
        if($user){
            if(isset($_POST['User'])){
                $user->attributes=$_POST['User'];
                if($user->password==$_POST['User']['password_repeat']){
                    $user->can_reset=0;
                    $user->password=  password_hash($user->password, PASSWORD_BCRYPT);
                    if($user->save())
                    {
                        Yii::app()->user->setFlash("done_reset", 'Your password has been changed successfully.');
                        $this->redirect(array('index'));
                    }
                }else{
                    Yii::app()->user->setFlash("wrong_pass", 'Please make sure that you entered the same password in both fields.');
                }
            }
            $user->password='';
            $this->render('reset', array('user' => $user));
        }else{
            Yii::app()->user->setFlash("wrong_pass", 'You are following a wrong link.');
            $this->redirect(array('index'));
        }
    }

}

?>