<?php

class ControlPanelController extends FrontController {

    /**
     * Declares class-based actions.
     */
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
        if (!isset(Yii::app()->user->id)) {
            $this->redirect(Yii::app()->request->baseUrl . '/login');
        }
        return true;
    }

    /*     * *******Admin messages********* */

    public function actionMessages() {
        $messages = Chat::model()->findAll(array('condition' => '`show`=1 and admin=1 and (from_id=' . Yii::app()->user->id . ' OR to_id=' . Yii::app()->user->id . ')'));
        $this->render('messages', array('messages' => $messages));
    }

    public function actionFavMsg($id) {
        $msg = Chat::model()->findByPk($id);
        if ($msg->fav) {
            $msg->fav = 0;
        } else {
            $msg->fav = 1;
        }
        if ($msg->save(false)) {
            $this->redirect(array('messages'));
        }
    }

    public function actionDelMsg($id) {
        $msg = Chat::model()->findByPk($id);
        $msg->show = 0;
        if ($msg->save(false)) {
            $this->redirect(array('messages'));
        }
    }

    /*     * *******end of admin messages********* */

    /*     * *******Group********* */

    public function actionCreateGroup() {
        $model = new Group;
        if (isset($_POST['Group'])) {
            $model->attributes = $_POST['Group'];
            $model->user_id = Yii::app()->user->id;
            if ($model->save()) {
                if (isset($_POST['GroupUser'])) {
                    foreach ($_POST['GroupUser']['user_id'] as $i => $gu) {
                        $model_user = new GroupUser;
                        $model_user->user_id = $gu;
                        $model_user->connection_id = $_POST['GroupUser']['connection_id'][$i];
                        $model_user->group_id = $model->id;
                        $model_user->role = 1; //admin
                        $model_user->save(false);
                    }
                }
                if (isset($_POST['GroupInvitee'])) {
                    foreach ($_POST['GroupInvitee']['user_id'] as $i => $gu) {
                        $model_invitee = new GroupInvitee;
                        $model_invitee->user_id = $gu;
                        $model_invitee->group_id = $model->id;
                        $model_invitee->save(false);
                    }
                }
                Yii::app()->user->setFlash("done", "Your group has been created successfully.");
                $this->redirect(array('editGroup', 'id' => $model->id));
            }
        }
        $this->render('group-form', array('model' => $model, 'model_users' => array(), 'model_invitee' => array()));
    }

    public function actionEditGroup($id) {
        $model = Group::model()->findByPk($id);
        if (!$model) {
            Yii::app()->user->setFlash('WrongGroup', 'Wrong! The Group you are looking for doesn\'t exist, you can create yours.');
            $this->redirect(array('createGroup'));
        }
        if ($model->user_id != Yii::app()->user->id && !Group::IsGroupAdmin($model->id, Yii::app()->user->id)) {
            $this->redirect(array('createGroup'));
        }
        $model_users = GroupUser::model()->findAllByAttributes(array('group_id' => $model->id));
        $model_Invitee = GroupInvitee::model()->findAllByAttributes(array('group_id' => $model->id, 'status' => 0));
        if (isset($_POST['Group']) && Group::IsGroupAdmin($model->id, Yii::app()->user->id)) {
            $model->attributes = $_POST['Group'];
            //$model->user_id=Yii::app()->user->id;
            if ($model->save(false)) {
                GroupUser::model()->deleteAllByAttributes(array('group_id' => $model->id));
                if (isset($_POST['GroupUser'])) {
                    foreach ($_POST['GroupUser']['user_id'] as $i => $gu) {
                        $model_user = new GroupUser;
                        $model_user->user_id = $gu;
                        $model_user->connection_id = $_POST['GroupUser']['connection_id'][$i];
                        $model_user->group_id = $model->id;
                        $model_user->role = 1; //admin
                        $model_user->save(false);
                    }
                }
                GroupInvitee::model()->deleteAllByAttributes(array('group_id' => $model->id, 'status' => 0));
                if (isset($_POST['GroupInvitee'])) {
                    foreach ($_POST['GroupInvitee']['user_id'] as $i => $gu) {
                        $model_invitee = new GroupInvitee;
                        $model_invitee->user_id = $gu;
                        $model_invitee->group_id = $model->id;
                        $model_invitee->save(false);
                    }
                }
                Yii::app()->user->setFlash("done", "Your group has been updated successfully.");
            }
        }
        $this->render('group-form', array('model' => $model, 'model_users' => $model_users, 'model_invitee' => $model_Invitee));
    }

    public function actionCheckUser() {
        $name = $_REQUEST['user'];
        $con = $_REQUEST['con'];
        $arr['connection'] = Connection::model()->findByPk($con)->title;
        $user = User::model()->find(array('condition' => 'username="' . $name . '" and groups_id=1 and id <>' . Yii::app()->user->id));
        if ($user) {
            $arr['status'] = 'success';
            $arr['image'] = $user->image;
            $arr['user_id'] = $user->id;
            echo json_encode($arr);
        } else {
            echo json_encode(array('status' => 'fail'));
        }
    }

    /*     * **************End of group****************** */

    /*     * *******profile********** */

    public function actionEditProfile() {
        $model = User::model()->findByPk(Yii::app()->user->id);
        $model_users = UserRelationShip::model()->findAllByAttributes(array('me_id' => $model->id));
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            //$model->user_id=Yii::app()->user->id;
            if ($model->validate()) {
                if ($model->save(false)) {
                    if (isset($_POST['UserRelationShip'])) {
                        UserRelationShip::model()->deleteAllByAttributes(array('me_id' => $model->id));
                        foreach ($_POST['UserRelationShip']['user_id'] as $i => $gu) {
                            $model_user = new UserRelationShip;
                            $model_user->user_id = $gu;
                            $model_user->connection_id = $_POST['UserRelationShip']['connection_id'][$i];
                            $model_user->me_id = $model->id;
                            $model_user->save(false);
                        }
                    }
                }
            }
            Yii::app()->user->setFlash('WrongGroup', 'Done! Your Profile has been updated successfully.');
            $this->redirect(array('editProfile'));
        }
        $this->render('edit-profile', array('model' => $model, 'model_users' => $model_users));
    }
	
	public function actionViewProfiles() {
		$profiles = User::model()->findAllByAttributes(array('created_by'=>Yii::app()->user->id,'dummy'=>1));
		$user= User::model()->findByPk(Yii::app()->user->id);
		$babies=Baby::model()->findAllBySql('select * from '.Baby::model()->tableSchema->name.' where user_id="' . Yii::app()->user->id . '" or id in (select baby_id from '.BabyAccessRole::model()->tableSchema->name.' where user_id="' . Yii::app()->user->id . '" and role="1")');
        $this->render('view-profiles', array('profiles' => $profiles, 'user'=>$user, 'babies'=>$babies));
    }
	public function actionDeactivateProfile() {
		$model=User::model()->findByPk(Yii::app()->user->id);
		$model->dummy=1;
		$model->save(false);
		Yii::app()->user->setFlash('WrongGroup', 'Your profile has been Deactivated successfully.');
		$this->redirect(array('viewProfiles'));
	}
	public function actionActivateProfile() {
		$model=User::model()->findByPk(Yii::app()->user->id);
		$model->dummy=0;
		$model->save(false);
		Yii::app()->user->setFlash('WrongGroup', 'Your profile has been Activated successfully.');
		$this->redirect(array('viewProfiles'));
	}
	public function actionDeleteBaby($id) {
		if(Baby::IsBabyAdmin($id, Yii::app()->user->id)){
			$model=Baby::model()->findByPk($id);
			$model->delete();
			Yii::app()->user->setFlash('WrongGroup', 'The selected baby profile has been deleted successfully.');
			$this->redirect(array('viewProfiles'));
		}else{
			Yii::app()->user->setFlash('WrongGroup', 'You don\'t have access to delete this baby profile.');
		}
	}
	public function actionDeleteProfile($id) {
		$model=User::model()->findByPk($id);
		if($model->created_by==Yii::app()->user->id){
			$model->delete();
			Yii::app()->user->setFlash('WrongGroup', 'The selected profile has been deleted successfully.');
			$this->redirect(array('viewProfiles'));
		}
	}
	public function actionCreateProfile($id='') {
		if($id){
			$model = User::model()->findByPk($id);
		}else{
        	$model = new User;
		}
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->created_by=Yii::app()->user->id;
			$model->dummy=1;
			$model->password=rand(1,555);
            if ($model->save(false)) {
                Yii::app()->user->setFlash('WrongGroup', 'The New Profile has been created successfully.');
				$this->redirect(array('createProfile/'.$model->id));
            }
        }
        $this->render('create-profile', array('model' => $model));
    }

    public function actionLinkSocial() {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $this->render('link-social', array('user' => $user));
    }

    public function actionLinkFB() {
        $user = User::model()->findByPk(Yii::app()->user->id);
        if (isset($_GET['status']) && $_GET['status'] == '1') {
            $returnUrl = Yii::app()->request->getBaseUrl(true) . '/controlPanel/linkSocial';
            $permissions = 'public_profile,email'; //,user_about_me,user_location,user_birthday,user_photos later usage
            
            $fb = Yii::app()->facebook;
            $token = $fb->getAccessToken();
            $fb->setAccessToken($token);
            $fbUser = Yii::app()->facebook->getUser();
            if ($fbUser) {
                $fb_user = Yii::app()->facebook->api('/me');
                $user->fb_id = $fb_user['id'];
                $user->save(false);
            } else {
                $loginUrl = Yii::app()->facebook->getLoginUrl(array('scope' => $permissions, 'redirect-uri' => $returnUrl));
                $this->redirect($loginUrl);
            }
        } elseif (isset($_GET['status']) && $_GET['status'] == '0') {
            $user->fb_id = '';
            $user->save(false);
        }
        $this->redirect(array('linkSocial'));
    }

    public function actionLinkTW() {
        $user = User::model()->findByPk(Yii::app()->user->id);
        if (isset($_GET['status']) && $_GET['status'] == '1') {
            Yii::app()->user->setState('social',1);
            $twitter = Yii::app()->twitter->getTwitter();
            //Yii::app()->twitter->
            $request_token = $twitter->getRequestToken();
            //set some session info
            Yii::app()->session['oauth_token'] = $token = $request_token['oauth_token'];
            Yii::app()->session['oauth_token_secret'] = $request_token['oauth_token_secret'];
            if ($twitter->http_code == 200) {
                $user->tw_id = '455';
                $user->save(false);
                //get twitter connect url
                $url = $twitter->getAuthorizeURL($token);
                //send them
                $this->redirect($url);
            }
        } elseif (isset($_GET['status']) && $_GET['status'] == '0') {
            $user->tw_id = '';
            $user->save(false);
        }
        $this->redirect(array('linkSocial'));
    }

    public function actionLinkGP() {
        $user = User::model()->findByPk(Yii::app()->user->id);
        if (isset($_GET['status']) && $_GET['status'] == '1') {
            Yii::app()->user->setState('social',1);
            $client = Yii::app()->GoogleApis->client;
            $plus = Yii::app()->GoogleApis->serviceFactory('Plus');

            if (!isset(Yii::app()->session['auth_token']) || is_null(Yii::app()->session['auth_token'])) {
                $user->google_id = '455';
                $user->save(false);
                Yii::app()->session['auth_token'] = $client->authenticate();
                die;
            }
        } elseif (isset($_GET['status']) && $_GET['status'] == '0') {
            $user->google_id = '';
            $user->save(false);
        }
        $this->redirect(array('linkSocial'));
    }

    /*     * *******end of profile********** */

    /*     * *********album************** */

    public function actionAlbums() {
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id="' . Yii::app()->user->id . '"';
        if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == '4') {
            $criteria->order = 'id desc';
        } elseif (isset($_REQUEST['filter']) && $_REQUEST['filter'] == '3') {
            $criteria->order = 'date_of_album desc';
        } elseif (isset($_REQUEST['filter']) && $_REQUEST['filter'] == '2') {
            $criteria->order = 'date_of_album asc';
        } else {
            $criteria->limit = '8';
            $criteria->order = 'id desc';
        }
        $albums = Album::model()->findAll($criteria);
        $this->render('albums', array('albums' => $albums));
    }

    public function actionCreateAlbum($id = '', $type = '') {
        $album = new Album;
        $albumImg = new AlbumImage;
        $user = User::model()->findByPk(Yii::app()->user->id);
        $image = array(); //fake to accommodate the update contest
        if (isset($_POST['Album'])) {
            $album->attributes = $_POST['Album'];
            $album->user_id = Yii::app()->user->id;
            if ($id && $type == 'baby' && Baby::IsBabyAdmin($id, Yii::app()->user->id))
                $album->baby_id = $id; //mafesh albums ll group "added"
            elseif ($id && $type == 'group' && Group::IsGroupAdmin($id, Yii::app()->user->id))
                $album->group_id = $id;
            else
                $this->redirect(array('index'));
            $album->date_of_album = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
            if ($album->save()) {
                /*                 * *create post to that album** */
                $post = new Post;
                $post->user_id = $album->user_id;
                $post->album_id = $album->id;
                $post->title = $album->title;
                $post->content = $album->desc;
                $post->save(false);
                /*                 * **** */
                $index = 0;
                //$path = Yii::app()->basePath . '/../media/users/' . $album->user_id;
                $path = Yii::app()->basePath . '/../media/albums';
                $photos = CUploadedFile::getInstances($albumImg, 'image');
                if (isset($photos) && count($photos) > 0) {
                    foreach ($photos as $image => $pic) {
                        $albumImg = new AlbumImage;
                        $rnd = time();
                        $fileName = "{$rnd}-{$pic->name}";
                        $albumImg->image = $fileName;
                        if ($pic->saveAs($path . '/' . $albumImg->image)) {
                            $albumImg->album_id = $album->id;
                            $albumImg->date_taken = $_POST['AlbumImage']['date_taken'][$index];
                            if ($index == 0) {
                                $albumImg->main_pic = 1;
                            }
                            $albumImg->save(false); // DONE
                            $media = new PostMedia;
                            $media->post_id = $post->id;
                            $media->media = $fileName;
                            $media->save();
                        }
                        $index++;
                    }
                }
                Yii::app()->user->setFlash('done', 'New album has been created successfully.');
                $this->redirect(array('editAlbum', 'id' => $album->id));
            }
        }
        $this->render('album-form', array('album' => $album, 'album_image' => $albumImg, 'images' => $image, 'user' => $user));
    }

    public function actionEditAlbum($id) {
        $album = Album::model()->findByPk($id);
        if ($album) {
            if ($album->user_id != Yii::app()->user->id && (!Baby::IsBabyAdmin($album->baby_id, Yii::app()->user->id))) {
                Yii::app()->user->setFlash('done', 'Can\'t edit an album which doesn\'t belong to you.');
                $this->redirect(array('createAlbum'));
            }
            $albumImg = new AlbumImage;
            $images = AlbumImage::model()->findAllByAttributes(array('album_id' => $album->id));
            if (isset($_POST['Album'])) {
                $index = 0;
                $path = Yii::app()->basePath . '/../media/albums';
                //$path = Yii::app()->basePath . '/../media/users/' . $album->user_id;
                $photos = CUploadedFile::getInstances($albumImg, 'image');
                if (isset($photos) && count($photos) > 0) {
                    AlbumImage::model()->deleteAll(array('condition' => 'album_id=' . $album->id));
                    foreach ($photos as $image => $pic) {
                        $albumImg = new AlbumImage;
                        $rnd = time();
                        $fileName = "{$rnd}-{$pic->name}";
                        $albumImg->image = $fileName;
                        if ($pic->saveAs($path . '/' . $albumImg->image)) {
                            $albumImg->album_id = $album->id;
                            $albumImg->date_taken = $_POST['AlbumImage']['date_taken'][$index];
                            if ($index == 0) {
                                $albumImg->main_pic = 1;
                            }
                            $albumImg->save(false); // DONE
                        }
                        $index++;
                    }
                }
                Yii::app()->user->setFlash('done', 'Your album has been updated successfully.');
                $this->redirect(array('editAlbum', 'id' => $album->id));
            }
        } else {
            Yii::app()->user->setFlash('done', 'You have no albums to edit, Add your new product!');
            $this->redirect(array('createAlbum'));
        }
        $this->render('album-form', array('album' => $album, 'album_image' => $albumImg, 'images' => $images, 'user' => $user));
    }

    public function actionViewAlbum_old($id) {
        $this->layout = ' ';
        $album = Album::model()->findByPk($id);
        if ($album->private && $album->user_id != Yii::app()->user->id) {
            echo '<script>alert("This is a private album.")</script>';
        } else {
            $main_image = AlbumImage::model()->find(array('condition' => 'main_pic=1 and album_id=' . $album->id));
            $images = AlbumImage::model()->findAll(array('condition' => 'album_id=' . $album->id));
            $comments = Comment::model()->findAllByAttributes(array('item_id' => $album->id, 'item_type' => 2));
            $favs = Favourite::model()->findAllByAttributes(array('item_type' => 2, 'item_id' => $album->id));
            $this->render('view-album', array('album' => $album, 'images' => $images, 'main_image' => $main_image, 'comments' => $comments, 'favs' => $favs));
        }
    }

    public function actionViewAlbum($id) {
        $album = Album::model()->findByPk($id);
        if ($album->private && $album->user_id != Yii::app()->user->id) {
            echo '<script>alert("This is a private album.")</script>';
        } else {
            $main_image = AlbumImage::model()->find(array('condition' => 'main_pic=1 and album_id=' . $album->id));
            $images = AlbumImage::model()->findAll(array('condition' => 'album_id=' . $album->id));
            $criteria = new CDbCriteria;
            $criteria->condition = 'item_id=' . $album->id . ' and item_type=' . Yii::app()->params['typeAlbum'];
            $likes = Like::model()->count($criteria);
            $i_liked = Like::model()->findByAttributes(array('item_id' => $id, 'item_type' => Yii::app()->params['typeAlbum'], 'user_id' => Yii::app()->user->id));
            $comments = Comment::model()->findAll($criteria);
            $this->render('view-album-new', array('album' => $album, 'images' => $images, 'main_image' => $main_image, 'comments' => $comments, 'likes' => $likes, 'i_liked' => $i_liked));
        }
    }

    /*     * *******end of albums********** */

    /*     * ******baby profile******* */

    public function actionCreateBabyProfile() {
        $model = new Baby;
        $sun_signs = SunSign::model()->findAll();
        $doctors = array();
        $family_members = array();
        if (isset($_POST['Baby'])) {
            $model->attributes = $_POST['Baby'];
            $model->user_id = Yii::app()->user->id;
            $birth_hours = '00';
            $birth_minutes = '00';
            $birth_hours = $_POST['am'] == 'AM' ? $_POST['birth_hour'] : $_POST['birth_hour'] + 12;
            $birth_hours = sprintf("%02d", $birth_hours);
            $birth_minutes = sprintf("%02d", $_POST['birth_minute']);
            $model->date_of_birth = sprintf("%02d", $_POST['year']) . '-' . sprintf("%02d", $_POST['month']) . '-' . sprintf("%02d", $_POST['day']) . ' ' . $birth_hours . ':' . $birth_minutes . ':00';
            $model->date_of_pergacy = sprintf("%d", $_POST['pergacy_month']) . '-' . sprintf("%d", $_POST['pergacy_day']);
            if ($model->save()) {
                if (isset($_POST['BabyDoctorHospital'])) {
                    foreach ($_POST['BabyDoctorHospital']['doctor_id'] as $i => $doc_id) {
                        $doctor = new BabyDoctorHospital;
                        $doctor->doctor_id = $doc_id;
                        $doctor->baby_id = $model->id;
                        $doctor->is_hospital = $_POST['BabyDoctorHospital']['is_hospital'][$i];
                        $doctor->save();
                    }
                }
                if (isset($_POST['BabyFamily'])) {
                    foreach ($_POST['BabyFamily']['user_id'] as $i => $user_id) {
                        $family_member = new BabyFamily;
                        $family_member->user_id = $user_id;
                        $family_member->baby_id = $model->id;
                        $family_member->connection_id = $_POST['BabyFamily']['connection_id'][$i];
                        $family_member->save();
                    }
                }

                if ($model->user->country) {
                    $vaccines = Vaccine::model()->findAllByAttributes(array('country_id' => $model->user->country));
                    if ($vaccines) {
                        foreach ($vaccines as $vc) {
                            $vc->isNewRecord = true;
                            $vc->id = null;
                            $vc->baby_id = $model->id;
                            $vc->user_id = $model->user_id;
                            $vc->save();
                        }
                    }
                }

                Yii::app()->user->setFlash("SuccessBaby", 'Your baby profile has been created successfully.');
                $this->redirect(array('updateBabyProfile', 'id' => $model->id));
            }
        }
        $this->render('baby-form', array('model' => $model, 'sun_signs' => $sun_signs, 'doctors' => $doctors, 'family_members' => $family_members));
    }

    public function actionUpdateBabyProfile($id) {
        $model = Baby::model()->findByPk($id);
        $sun_signs = SunSign::model()->findAll();
        $doctors = BabyDoctorHospital::model()->findAllByAttributes(array('baby_id' => $model->id));
        $family_members = BabyFamily::model()->findAllByAttributes(array('baby_id' => $model->id));

        if (!Baby::IsBabyAdmin($model->id, Yii::app()->user->id)) {
            $this->redirect(array('createBabyProfile'));
        }

        if (isset($_POST['Baby'])) {
            $model->attributes = $_POST['Baby'];
            //$model->user_id=Yii::app()->user->id;
            $birth_hours = '00';
            $birth_minutes = '00';
            $birth_hours = $_POST['am'] == 'AM' ? $_POST['birth_hour'] : $_POST['birth_hour'] + 12;
            $birth_minutes = $_POST['birth_minute'];
            $model->date_of_birth = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'] . ' ' . $birth_hours . ':' . $birth_minutes . ':00';
            $model->date_of_pergacy = $_POST['pergacy_month'] . '-' . $_POST['pergacy_day'];
            if ($model->save()) {
                if (isset($_POST['BabyDoctorHospital'])) {
                    BabyDoctorHospital::model()->deleteAllByAttributes(array('baby_id' => $model->id));
                    foreach ($_POST['BabyDoctorHospital']['doctor_id'] as $i => $doc_id) {
                        $doctor = new BabyDoctorHospital;
                        $doctor->doctor_id = $doc_id;
                        $doctor->baby_id = $model->id;
                        $doctor->is_hospital = $_POST['BabyDoctorHospital']['is_hospital'][$i];
                        $doctor->save();
                    }
                }
                if (isset($_POST['BabyFamily'])) {
                    BabyFamily::model()->deleteAllByAttributes(array('baby_id' => $model->id));
                    foreach ($_POST['BabyFamily']['user_id'] as $i => $user_id) {
                        $family_member = new BabyFamily;
                        $family_member->user_id = $user_id;
                        $family_member->baby_id = $model->id;
                        $family_member->connection_id = $_POST['BabyFamily']['connection_id'][$i];
                        $family_member->save();
                    }
                }
                Yii::app()->user->setFlash("SuccessBaby", 'Your baby profile has been updated successfully.');
                $this->redirect(array('updateBabyProfile', 'id' => $model->id));
            }
        }
        $this->render('baby-form', array('model' => $model, 'sun_signs' => $sun_signs, 'doctors' => $doctors, 'family_members' => $family_members));
    }

    public function actionCheckDoctor() {
        $name = $_REQUEST['user'];
        $user = User::model()->find(array('condition' => 'username="' . $name . '" and (groups_id=2 or groups_id=3)'));
        if ($user) {
            $arr['status'] = 'success';
            $arr['image'] = $user->image;
            $arr['doctor_id'] = $user->id;
            $arr['is_hospital'] = $user->groups_id == 2 ? 0 : 1;
            echo json_encode($arr);
        } else {
            echo json_encode(array('status' => 'fail'));
        }
    }

    /*     * ******end of baby profile******* */

    public function actionInviteFriends() {
        if ($_POST['friend_name']) {
            $name = $_POST['friend_name'];
            $connection = $_POST['connection'];
            $user = User::model()->findByAttributes(array('username' => $name, 'groups_id' => 1));
            if ($user) {
                $friend = UserFriend::model()->findBySql('select * from '.UserFriend::model()->tableSchema->name.' where (user_id=' . Yii::app()->user->id . ' and friend_id=' . $user->id . ') OR (friend_id=' . Yii::app()->user->id . ' and user_id=' . $user->id . ')');
                if ($friend) {
                    if ($friend->approved) {
                        Yii::app()->user->setFlash('wrongUser', $user->username . ' is already in your friend list.');
                    } else {
                        Yii::app()->user->setFlash('wrongUser', 'A friend request is already sent previously to (' . $user->username . ').');
                    }
                } else {
                    //create a friend request
                    $model = new UserFriend;
                    $model->user_id = Yii::app()->user->id;
                    $model->friend_id = $user->id;
                    $model->connection_id = $connection;
                    if ($model->save(false)) {
                        $notifier_id = $model->user_id;
                        $table_name = 'user_friend';
                        $row_id = $model->id;
                        $user_id = $model->friend_id;
                        $msg = 'You got a new friend request from <a href="' . Yii::app()->request->baseUrl . '/userProfile/index/' . $model->user_id . '">' . $model->user->username . '</a>';
                        Helper::Notification($notifier_id, $user_id, $baby_id, $msg, $row_id, $table_name);
                        Yii::app()->user->setFlash('successUser', 'Your friend request has been sent successfuly to (' . $user->username . ').');
                    }
                }
            } else {
                Yii::app()->user->setFlash('wrongUser', 'Please choose your friend from the suggested friends displayed or invite your friend by using other social media.');
            }
        }
        $this->render('invite-friends');
    }

    public function actionManageFriends() {
        $cond = '';
        $order = '';
        if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == '2') {
            $cond = 'and (user_id in (select item_id from '.Favourite::model()->tableSchema->name.' where user_id=' . Yii::app()->user->id . ' and item_type=4 ) or friend_id in (select item_id from '.Favourite::model()->tableSchema->name.' where user_id=' . Yii::app()->user->id . ' and item_type=4 ))';
        } elseif (isset($_REQUEST['filter']) && $_REQUEST['filter'] == '3') {
            $order = ' order by id desc';
        } elseif (isset($_REQUEST['filter']) && $_REQUEST['filter'] == '4') {
            $cond = 'and (user_id in (select user_id from '.BabyAccessRole::model()->tableSchema->name.' where role=1 and baby_id in(select id from '.Baby::model()->tableSchema->name.' where user_id=' . Yii::app()->user->id . ')) or friend_id in (select user_id from '.BabyAccessRole::model()->tableSchema->name.' where role=1 and baby_id in(select id from '.Baby::model()->tableSchema->name.' where user_id=' . Yii::app()->user->id . ')))';
        } elseif (isset($_REQUEST['filter']) && $_REQUEST['filter'] == '5') {
            $cond = 'and (user_id in (select user_id from '.BabyAccessRole::model()->tableSchema->name.' where role=0 and baby_id in(select id from '.Baby::model()->tableSchema->name.' where user_id=' . Yii::app()->user->id . ')) or friend_id in (select user_id from '.BabyAccessRole::model()->tableSchema->name.' where role=0 and baby_id in(select id from '.Baby::model()->tableSchema->name.' where user_id=' . Yii::app()->user->id . ')))';
        }

        $friends = UserFriend::model()->findAllBySql('select * from '.UserFriend::model()->tableSchema->name.' where (user_id=' . Yii::app()->user->id . ' OR friend_id=' . Yii::app()->user->id . ') and approved=1 ' . $cond . $order);
        $this->render('manage-friends', array('friends' => $friends));
    }

    public function actionRemoveFriend($id) {
        if ($id) {
            $user_friend = UserFriend::model()->findByPk($id);
            if ($user_friend->friend_id == Yii::app()->user->id || $user_friend->user_id == Yii::app()->user->id) {
                $user_friend->delete();
                Yii::app()->user->setFlash('doneFriend', 'You have removed the selected friend successfully.');
            } else {
                Yii::app()->user->setFlash('wrongFriend', 'You don\'t have access to this friendship, you can only remove friends in your friend list.');
            }
        } else {
            Yii::app()->user->setFlash('wrongFriend', 'You are using wrong link, you can only remove friends in your friend list.');
        }
        $this->redirect(array('manageFriends'));
    }

    public function actionInvite() {
        $id = $_REQUEST['id'];
        $fr = UserFriend::model()->find(array('condition' => '(friend_id=' . $id . ' and user_id=' . Yii::app()->user->id . ') OR (user_id=' . $id . ' and friend_id=' . Yii::app()->user->id . ')'));
        if ($fr) {
            $fr->delete();
            echo 1;
        } else {
            $model = new UserFriend;
            $model->user_id = Yii::app()->user->id;
            $model->friend_id = $id;
            if ($model->save()) {
                $notifier_id = $model->user_id;
                $table_name = 'user_friend';
                $row_id = $model->id;
                $user_id = $model->friend_id;
                $msg = 'You got a new friend request from <a href="' . Yii::app()->request->baseUrl . '/userProfile/index/' . $model->user_id . '">' . $model->user->username . '</a>';
                Helper::Notification($notifier_id, $user_id, $baby_id, $msg, $row_id, $table_name);
                echo 1;
            }
        }
    }

    public function actionAcceptFriend() {
        $id = $_REQUEST['id'];
        $fr = UserFriend::model()->find(array('condition' => '(friend_id=' . $id . ' and user_id=' . Yii::app()->user->id . ') OR (user_id=' . $id . ' and friend_id=' . Yii::app()->user->id . ')'));
        if ($fr) {
            $fr->approved = 1;
            if ($fr->save(false))
                echo 1;
        }
    }

    public function actionChangeAccess() {
        $id = $_REQUEST['id'];
        $role = $_REQUEST['role-' . $id];
        $babies = Baby::model()->findAllBySql('select * from '.Baby::model()->tableSchema->name.' where user_id="' . Yii::app()->user->id . '" or id in (select baby_id from '.BabyAccessRole::model()->tableSchema->name.' where user_id="' . Yii::app()->user->id . '" and role="1")');
        $bab_arr = array();
        if ($babies) {
            foreach ($babies as $baby) {
                $bab_arr[] = $baby->id;
            }
        }

        $add_cri = '';
        if (count($bab_arr) > 1) {
            $add_cri = ' and baby_id in (' . implode(',', $bab_arr) . ')';
        } elseif (count($bab_arr) == 1) {
            $add_cri = ' and baby_id =' . $bab_arr[0];
        }

        if ($add_cri != '') {
            $criteria = new CDbCriteria;
            $criteria->condition = 'user_id=' . $id . $add_cri;
            $accesses = BabyAccessRole::model()->findAll($criteria);
            if ($accesses) {
                foreach ($accesses as $ac) {
                    $ac->delete();
                }
            }
        }

        if ($role == 1 || $role == 0) {
            if ($bab_arr) {
                foreach ($bab_arr as $bb) {
                    $new_role = new BabyAccessRole;
                    $new_role->user_id = $id;
                    $new_role->role = $role;
                    $new_role->baby_id = $bb;
                    $new_role->save();
                }
            }
        }
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionFriendRequests() {
        $requests = UserFriend::model()->findAll(array('condition' => 'friend_id=' . Yii::app()->user->id . ' and approved=0'));
        $this->render('friend-requests', array('requests' => $requests));
    }

    /*     * **********start of chat Page************ */

    public function actionChat() {
        $model = new Chat();
        $pre_users = Chat::model()->findAll(array('condition' => 'to_id=' . Yii::app()->user->id . ' OR from_id=' . Yii::app()->user->id, 'order' => 'id desc'));
        if ($pre_users) {
            $arr = array();
            foreach ($pre_users as $us) {
                $friend = $us->to_id;
                if ($us->to_id == Yii::app()->user->id) {
                    $friend = $us->from_id;
                }
                if (!in_array($friend, $arr))
                    $arr[] = $friend;
            }
        }
        $chat_users = array();
        if ($arr)
            $chat_users = User::model()->findAll(array('condition' => 'id in (' . implode(',', $arr) . ') and groups_id=1'));
        $this->render('chat-main', array('model' => $model, 'users' => $chat_users));
    }

    public function actionLoadMessages($id) {
        //$id=$_REQUEST['id'];
        $messages = Chat::model()->findAll(array('condition' => '(from_id=' . $id . ' and to_id=' . Yii::app()->user->id . ') OR (to_id=' . $id . ' and from_id=' . Yii::app()->user->id . ')'));
        if ($messages) {
            $list = '';
            foreach ($messages as $ms) {
                $class = 'has-sender';
                if ($ms->to_id == Yii::app()->user->id)
                    $class = 'has-receiver';

                if ($ms->msg_type == 0)
                    $msg = nl2br($ms->msg);
                else {
                    if (strpos($ms->msg, '.png') || strpos($ms->msg, '.jpg') || strpos($ms->msg, '.gif') || strpos($ms->msg, '.jpeg')) {
                        $msg = '<img src="' . Yii::app()->request->baseUrl . '/media/chat/' . $ms->msg . '" width="200">';
                    } else {
                        $msg = '<a href="' . Yii::app()->request->baseUrl . '/home/download?name=' . $ms->msg . '">' . explode('---', $ms->msg)[1] . '</a>';
                    }
                }
                $list.='<div class="message-wrap ' . $class . '">
                        <a href="javascript:void(0)" class="person-thumb-wrap">
                            <img src="' . $ms->from->image . '" alt="' . $ms->from->username . '" class="person-thumb" />
                        </a>
                        <div class="message-content">
                            <div class="person-overview">
                                <h3 class="person-name">' . $ms->from->username . '</h3>
                                <span class="message-date">' . Helper::ago($ms->date_created) . '</span>
                            </div>
                            <div class="message-plain">
                                <p>' . $msg . '</p>
                            </div>
                        </div>
                    </div>';
            }
            echo $list;
        } else {
            echo '<span class="empty-chat">No messages found.</span>';
        }
    }

    /*     * **********end of chat Page************ */

    public function actionCreateDoctor() {
        $model = new User();
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
			if($model->image==''){
				$model->image=Yii::app()->request->getBaseUrl(true).'/img/doctor.png';
				if($model->groups_id==3)
					$model->image=Yii::app()->request->getBaseUrl(true).'/img/hospital.png';
			}
            if ($model->save()) {
                echo 1;
                die;
            }
        }
        if (isset($_GET['doc'])) {
            $model->username = $_GET['doc'];
        }
        $this->renderPartial('create-doctor', array('model' => $model));
    }

    public function actionChangePassword() {
        $model = User::model()->findByPk(Yii::app()->user->id);
        if (isset($_POST['User'])) {
            if (empty($_POST['User']['old_password'])) {
                echo 'Please enter your old password.';
            } elseif (empty($_POST['User']['password'])) {
                echo 'Please enter your new password.';
            } elseif (empty($_POST['User']['password_repeat'])) {
                echo 'Please repeat your new password.';
            } else {
                if (!password_verify($_POST['User']['old_password'], $model->password)) {
                    echo 'Wrong Password.';
                } elseif ($_POST['User']['password_repeat'] != $_POST['User']['password']) {
                    echo 'Sorry! your new passwords aren\'t identical.';
                } else {
                    $model->password = password_hash($_POST['User']['password'], PASSWORD_BCRYPT);
                    $model->save(false);
                    echo 'Your password has been changed successfully.';
                }
            }
            die;
        }
        $this->renderPartial('password', array('model' => $model));
    }

}

?>