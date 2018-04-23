<?php

class HomeController extends FrontController {

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
        if(Yii::app()->user->hasState('social')&&Yii::app()->user->getState('social')==1){ 
            Yii::app()->user->setState('social',''); 
            $this->redirect(Yii::app()->request->baseUrl.'/controlPanel/linksocial'); 
        }
        if (!isset(Yii::app()->user->id)) {
            $this->redirect(Yii::app()->request->baseUrl . '/login');
        }
        return true;
    }

    public function actionNotificationSeen() {
		$notifs=Notification::model()->findAll(array('condition' => 'user_id="'.Yii::app()->user->id.'" and table_name<>"vaccine" and table_name<>"appointment" and table_name<>"visit"'));
		if($notifs){
			foreach($notifs as $n){
				$n->seen=1;
				$n->save(false);
			}
			echo 'done';
		}
	}
	
	public function actionNotificationRefresh() {
		$notifs=Notification::model()->findAll(array('condition' => 'seen=0 and user_id="'.Yii::app()->user->id.'" and table_name<>"vaccine" and table_name<>"appointment" and table_name<>"visit"', 'order' => 'id desc'));
		$list='';
		if($notifs){
			foreach ($notifs as $not) {
				$list.='<div class="ad-not"><label class="ph-has"></label><span class="Readed">' . $not->msg . '</span></div>';
			}
			$count=count($notifs);
		}else{
			$count=0;
		}
		echo json_encode(array('count'=>$count, 'list'=>$list));
	}
	
	public function actionUpdateNotifications() {
        //$notifs = Notification::model()->findAll(array('condition' => '(notifier_id !=' . Yii::app()->user->id . ' and baby_id in (select id from '.Baby::model()->tableSchema->name.' where user_id="' . Yii::app()->user->id . '" or id in (select baby_id from '.BabyAccessRole::model()->tableSchema->name.' where user_id="' . Yii::app()->user->id . '"))) or user_id=' . Yii::app()->user->id, 'limit' => '6', 'order' => 'id desc'));
		$notifs = Notification::model()->findAll(array('condition' => 'row_date >= Now() and (table_name="vaccine" or table_name="appointment" or table_name="visit") and baby_id in (select id from '.Baby::model()->tableSchema->name.' where user_id="' . Yii::app()->user->id . '" or id in (select baby_id from '.BabyAccessRole::model()->tableSchema->name.' where user_id="' . Yii::app()->user->id . '"))', 'limit' => '10', 'order' => 'id desc'));
        $list = '';
        if ($notifs) {
            foreach ($notifs as $not) {
                if ($not->table_name == 'post') {
                    $class = 'has-photo';
                } elseif ($not->table_name == 'vaccine') {
                    $class = 'has-vaccine';
                } elseif ($not->table_name == 'appointment') {
                    $class = 'has-appoinment';
                } elseif ($not->table_name == 'user_friend') {
                    $class = 'has-friend';
                }

                $list.='<li class="' . $class . '">' . $not->msg . '</li>';
            }
        } else {
            $list.='<li class="has-photo">No notifications found.</li>';
        }
        echo $list;
    }

    /*     * ************chat*************** */

    public function actionDownload() {
        $name = $_REQUEST['name'];
		if(!isset($_REQUEST['src']) || $_REQUEST['src']==''){
			$src='media/chat/';
		}else{
			$src=$_REQUEST['src'];
		}
        $src .= $name;
        if (file_exists($src)) {
            $path_parts = @pathinfo($src);
            //$mime = $this->__get_mime($path_parts['extension']);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            //header('Content-Type: '.$mime);
            header('Content-Disposition: attachment; filename=' . basename($src));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($src));
            ob_clean();
            flush();
            readfile($src);
        } else {
            header("HTTP/1.0 404 Not Found");
            exit();
        }
    }

    public function actionChatList() {
        $this->renderPartial('chat-list');
    }

    public function actionChatWindows() {
        //$this->renderPartial('chat-windows');
        $arr = array();
        $chat_users = User::model()->findAllBySql('select * from '.User::model()->tableSchema->name.' where id!=' . Yii::app()->user->id . ' and (id in (select user_id from '.UserFriend::model()->tableSchema->name.' where friend_id=' . Yii::app()->user->id . '  and approved=1) or id in (select friend_id from '.UserFriend::model()->tableSchema->name.' where user_id=' . Yii::app()->user->id . ' and approved=1))');
        //$chat_users = User::model()->findAll(array('condition' => 'id!=' . Yii::app()->user->id));
        if ($chat_users) {
            foreach ($chat_users as $c_u) {
                //open boxes of users chatting me
                $not_seen = Chat::model()->findAllByAttributes(array('seen' => '0', 'to_id' => Yii::app()->user->id, 'from_id' => $c_u->id, 'admin' => 0));
                $open = '0';
                if ($not_seen || (Yii::app()->user->hasState('openBoxes') && in_array($c_u->id, Yii::app()->user->getState('openBoxes')))) {
                    $open = '1';
                }
                $list = '';
                $chat_records = Chat::model()->findAllBySql('select * from '.Chat::model()->tableSchema->name.' where admin=0 and (to_id="' . Yii::app()->user->id . '" and from_id="' . $c_u->id . '") OR (from_id="' . Yii::app()->user->id . '" and to_id="' . $c_u->id . '")');
                if ($chat_records) {
                    foreach ($chat_records as $c_r) {
                        if ($c_r->msg_type == 0)
                            $msg = nl2br($c_r->msg);
                        else {
                            if (strpos($c_r->msg, '.png') || strpos($c_r->msg, '.jpg') || strpos($c_r->msg, '.gif') || strpos($c_r->msg, '.jpeg')) {
                                $msg = '<img src="' . Yii::app()->request->baseUrl . '/media/chat/' . $c_r->msg . '" width="200">';
                            } else {
								if (strpos(strtolower($c_r->msg), '.docx') || strpos(strtolower($c_r->msg), '.doc') || strpos(strtolower($c_r->msg), '.odt') || strpos(strtolower($c_r->msg), '.dotm')){
									$msg='<img src="'.Yii::app()->request->baseUrl.'/img/docx.png" class="pull-left" width="24" height="24">';
								}elseif (strpos(strtolower($c_r->msg), '.csv') || strpos(strtolower($c_r->msg), '.xls') || strpos(strtolower($c_r->msg), '.xlsx') || strpos(strtolower($c_r->msg), '.odm')){
									$msg='<img src="'.Yii::app()->request->baseUrl.'/img/csv.png" class="pull-left" width="24" height="24">';
								}elseif (strpos(strtolower($c_r->msg), '.txt') || strpos(strtolower($c_r->msg), '.xml') || strpos(strtolower($c_r->msg), '.html') || strpos(strtolower($c_r->msg), '.sql') || strpos(strtolower($c_r->msg), '.css')){
									$msg='<img src="'.Yii::app()->request->baseUrl.'/img/notepad.png" class="pull-left" width="24" height="24">';
								}elseif (strpos(strtolower($c_r->msg), '.pdf')){
									$msg='<img src="'.Yii::app()->request->baseUrl.'/img/pdf.png" class="pull-left" width="24" height="24">';
								}
                                $msg .= '<a href="' . Yii::app()->request->baseUrl . '/home/download?name=' . $c_r->msg . '" class="pull-left chat-download">' . explode('---', $c_r->msg)[1] . '</a>';
                            }
                        }
                        $cl = 'has-reciever';
                        if ($c_r->from_id == Yii::app()->user->id)
                            $cl = 'has-sender';
                        $list.='<div class="message-wrap ' . $cl . '">
                                <a href="javascript:void(0)" class="person-thumb-wrap">
                                    <img src="' . $c_r->from->image . '" alt="" class="person-thumb" />
                                </a>
                                <div class="message-content">
                                    <div class="person-overview">
                                        <h3 class="person-name">' . $c_r->from->username . '</h3>
                                        <span class="message-date">' . Helper::ago($c_r->date_created) . '</span>
                                    </div>
                                    <div class="message-plain">
                                        <p>
                                        ' . $msg . '
                                    </p>
                                    </div>
                                </div>
                            </div>';
                    }
                }
                $arr[$c_u->id]['items'] = $list;
                $arr[$c_u->id]['open'] = $open;
            }
        }
        echo json_encode($arr);
    }

    public function actionsetOpenBox($id) {
        $arr = array();
        if (Yii::app()->user->hasState('openBoxes')) {
            $arr = Yii::app()->user->getState('openBoxes');
            if (($key = array_search($id, $arr)) !== false) {
                unset($arr[$key]);
            }
        }
        $arr[] = $id;
        Yii::app()->user->setState('openBoxes', $arr);
    }

    public function actionUnSetOpenBox($id) {
        $arr = array();
        if (Yii::app()->user->hasState('openBoxes')) {
            $arr = Yii::app()->user->getState('openBoxes');
            if (($key = array_search($id, $arr)) !== false) {
                unset($arr[$key]);
            }
        }
        Yii::app()->user->setState('openBoxes', $arr);
    }

    public function actionChatChangeStatus() {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $user->chat_status = $_GET['status'];
        $user->save(false);
    }

    public function actionSetSeen($id) {
        Chat::model()->updateAll(array('seen' => 1), 'from_id="' . $id . '" and to_id="' . Yii::app()->user->id . '"');
    }

    public function actionReplySubmit($id) {
        $to = User::model()->findByPk($id);
        $from = User::model()->findByPk(Yii::app()->user->id);
        $content = trim($_POST['reply']);
        if ($content) {
            $model = new Chat;
            $model->from_id = Yii::app()->user->id;
            $model->to_id = $id;
            $model->msg = $_POST['reply'];
            $model->msg_type = '0'; //file
            if (isset($_POST['admin']))
                $model->admin = 1;
            if ($model->save(false)) {
                echo 'success';
            } else {
                echo 'failed';
            }
        }
    }

    public function actionFileUpload($id) {
        $output_dir = Yii::app()->basePath . '/../media/chat/';
        if (isset($_FILES["file"])) {
            //Filter the file types , if you want.
            if ($_FILES["file"]["error"] > 0) {
                echo "Error: " . $_FILES["file"]["error"];
                //$response = array('status' => 'error', 'content' => $_FILES["file"]["error"]);
            } else {
                $img_name = time() . '---' . $_FILES["file"]["name"];
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $output_dir . $img_name)) {
                    chmod($output_dir . $img_name, 0755);
                    $model = new Chat;
                    $model->from_id = Yii::app()->user->id;
                    $model->to_id = $id;
                    $model->msg = $img_name;
                    $model->msg_type = '1'; //file
                    if ($model->save(false)) {
                        echo 'success';
                    } else {
                        echo 'error';
                    }
                    //echo "Uploaded File :" . $img_name;
                } else {
                    echo 'can\'t upload';
                }
            }
        } else {
            echo 'error';
        }
    }

    /*     * **********end of chat popup************ */

    /*     * *timeline* */

    public function actionIndex() {
        $posts = Post::model()->findAllBySql('select * from '.Post::model()->tableSchema->name.' where user_id=' . Yii::app()->user->id . ' or 
		(
			user_id in (select user_id from '.UserFriend::model()->tableSchema->name.' where friend_id=' . Yii::app()->user->id . '  and approved=1 and date_created <= `'.Post::model()->tableSchema->name.'`.date_created) or 
			user_id in (select friend_id from '.UserFriend::model()->tableSchema->name.' where user_id=' . Yii::app()->user->id . ' and approved=1 and date_created <= `'.Post::model()->tableSchema->name.'`.date_created)
		) or 
		(
			group_id in (select id from `'.Group::model()->tableSchema->name.'` where user_id=' . Yii::app()->user->id . ' or id in (select group_id from '.GroupUser::model()->tableSchema->name.' where user_id=' . Yii::app()->user->id . ' and date_created <= `'.Post::model()->tableSchema->name.'`.date_created))
		) order by id desc');
        //$posts=Post::model()->findAll(array('condition'=>'user_id='.Yii::app()->user->id,'order'=>'id desc'));
        $this->render('index', array('posts' => $posts));
    }

    public function actionUpdateTimeline() {
        //$posts = Post::model()->findAllBySql('select * from '.Post::model()->tableSchema->name.' where user_id=' . Yii::app()->user->id . ' or (user_id in (select user_id from '.UserFriend::model()->tableSchema->name.' where friend_id=' . Yii::app()->user->id . '  and approved=1) or user_id in (select friend_id from '.UserFriend::model()->tableSchema->name.' where user_id=' . Yii::app()->user->id . ' and approved=1)) order by id desc');
        $posts = Post::model()->findAllBySql('select * from '.Post::model()->tableSchema->name.' where user_id=' . Yii::app()->user->id . ' or 
		(
			user_id in (select user_id from '.UserFriend::model()->tableSchema->name.' where friend_id=' . Yii::app()->user->id . '  and approved=1 and date_created <= `'.Post::model()->tableSchema->name.'`.date_created) or 
			user_id in (select friend_id from '.UserFriend::model()->tableSchema->name.' where user_id=' . Yii::app()->user->id . ' and approved=1 and date_created <= `'.Post::model()->tableSchema->name.'`.date_created)
		) or 
		(
			group_id in (select id from `'.Group::model()->tableSchema->name.'` where user_id=' . Yii::app()->user->id . ' or id in (select group_id from '.GroupUser::model()->tableSchema->name.' where user_id=' . Yii::app()->user->id . ' and date_created <= `'.Post::model()->tableSchema->name.'`.date_created))
		) order by id desc');
        $this->renderPartial('//home/posts', array('posts' => $posts)); //the same view but without the ajax loading script and the container div "timeline-board"
    }

    public function actionLike() {
        $type = Yii::app()->params['type' . ucfirst($_REQUEST['type'])];
        $id = $_REQUEST['id'];
        $fav = Like::model()->findByAttributes(array('user_id' => Yii::app()->user->id, 'item_type' => $type, 'item_id' => $id));
        if ($fav) {
            if ($fav->delete())
                $status = 2;
        }
        else {
            $fav = new Like;
            $fav->item_id = $id;
            $fav->item_type = $type;
            $fav->user_id = Yii::app()->user->id;
            if ($fav->save(false))
                $status = 1;
        }
        $favs = Like::model()->findAllByAttributes(array('item_type' => $type, 'item_id' => $id));
        echo json_encode(array('status' => $status, 'count' => count($favs)));
    }

    public function actionFavourite() {
        if ($_REQUEST['type'] == 'post')
            $type = 1;
        elseif ($_REQUEST['type'] == 'album')
            $type = 2;
        elseif ($_REQUEST['type'] == 'albumImage')
            $type = 3;
        elseif ($_REQUEST['type'] == 'user')
            $type = 4;
        elseif ($_REQUEST['type'] == 'baby')
            $type = 5;
        $id = $_REQUEST['id'];
        $fav = Favourite::model()->findByAttributes(array('user_id' => Yii::app()->user->id, 'item_type' => $type, 'item_id' => $id));
        if ($fav) {
            if ($fav->delete())
                $status = 2;
        }
        else {
            $fav = new Favourite;
            $fav->item_id = $id;
            $fav->item_type = $type;
            $fav->user_id = Yii::app()->user->id;
            if ($fav->save(false))
                $status = 1;
        }
        $favs = Favourite::model()->findAllByAttributes(array('item_type' => $type, 'item_id' => $id));
        echo json_encode(array('status' => $status, 'count' => count($favs)));
    }

    public function actionComment() {
        $type = Yii::app()->params['type' . ucfirst($_REQUEST['type'])];
        $id = $_REQUEST['id'];
        $reply = $_REQUEST['reply'];
        $comment = new Comment;
        $comment->user_id = Yii::app()->user->id;
        $comment->item_id = $id;
        $comment->item_type = $type;
        $comment->comment = $reply;
        if ($comment->save(false)) {
            $comments = Comment::model()->findAllByAttributes(array('item_type' => $type, 'item_id' => $id));

            if ($comments) {
                if ($type == Yii::app()->params['typePostMedia'] || $type == Yii::app()->params['typePostImage'] || $type == Yii::app()->params['typeAlbum'] || $type == Yii::app()->params['typeAlbumImage'] || $type == Yii::app()->params['typeContestUserImage'] || $type == Yii::app()->params['typeContestUser']) {
                    foreach ($comments as $comment) {
                        $list.='<div class="img-comm-cont">
                            <img src="' . $comment->user->image . '" width="32" height="32" class="pull-left">
                            <span class="img-comm-cont-span">
                                <p class="img-comm-cont-name">' . $comment->user->username . '</p>
                                <p>' . nl2br($comment->comment) . '</p>
                            </span>
                        </div>';
                    }
                } else {
                    $i = 0;
                    foreach ($comments as $comment) {
                        if ($i % 2 == 0)
                            $com_cl = 'even';
                        else
                            $com_cl = '';
                        $list.='
                    <div class="story-comment ' . $com_cl . '">
                            <figure class="comment-author-thumb">
                                    <a href="javascript:void(0)">
                                            <img src="' . $comment->user->image . '" alt="' . $comment->user->username . '" width="60" height="60" />
                                    </a>
                            </figure>
                            <div class="comment-overview">
                                    <h4 class="comment-author-name">
                                            <a href="' . Yii::app()->request->baseUrl . '/home/profile/' . $comment->user_id . '">' . $comment->user->username . '</a>
                                    </h4>
                                    <span class="comment-date">' . $comment->date_created . '</span>
                                    <div class="comment-plain">
                                            <p>
                                                    ' . nl2br($comment->comment) . '
                                            </p>
                                    </div>
                            </div>
                    </div>';
                        $i++;
                    }
                }

                echo json_encode(array('comments' => $list, 'count' => count($comments)));
            }
        }
    }

    public function actionNewPost() {
        $model = new Post;
		$wrong=0;
        if (isset($_GET['baby'])) {
            $model->baby_id = $_GET['baby'];
        } elseif (isset($_GET['group'])) {
            $model->group_id = $_GET['group'];
        } else if(isset($_REQUEST['profile'])){
			$prof=explode(',',$_REQUEST['profile']);
			if($prof[0]=='baby'){
				$model->baby_id=$prof[1];
			}else{
				$model->group_id=$prof[1];
			}
		} else {
            //$this->renderPartial('wrong', array('msg' => 'Sorry! You can only post to a baby profile or a group profile.'));
			$this->renderPartial('wrong', array('msg' => 'Please choose a baby profile or a group profile.'));
			$wrong=1;
        }

        if (isset($_POST['Post']) && (($model->group_id != '' && Group::IsGroupAccess($model->group_id, Yii::app()->user->id)) || ($model->baby_id != '' && Baby::IsBabyAccess($model->baby_id, Yii::app()->user->id)))) {
            $model->attributes = $_POST['Post'];
            $model->user_id = Yii::app()->user->id;
            if (isset($_POST['images']) && count($_POST['images']) > 1) {
                if (isset($_POST['isVideo']) && $_POST['isVideo'] == 2) {
                    $album = new Album;
                    $album->title = $_POST['title'];
                    $album->date_of_album = date('Y-m-d');
                    $album->user_id = Yii::app()->user->id;
                    if ($model->baby_id) {
                        $album->baby_id = $model->baby_id;
                    } elseif ($model->group_id) {
                        $album->group_id = $model->group_id;
                    }
                    $album->save();
                    $model->album_id = $album->id; // save the album and put the album id in the post
                } else {
                    $album = Album::model()->findByAttributes(array('first_album' => '1', 'user_id' => Yii::app()->user->id));
                }
                $sub_album = $model->baby_id ? Album::model()->findByAttributes(array('first_album' => '1', 'baby_id' => $model->baby_id)) : Album::model()->findByAttributes(array('first_album' => '1', 'group_id' => $model->group_id));
                if ($model->save()) {
                    foreach ($_POST['images'] as $i => $img) {
                        $albumImg = new AlbumImage;
                        $albumImg->album_id = $album->id;
                        if ($i == 0)
                            $albumImg->main_pic = 1;

                        $file = explode(',', $img); //array('data:image/jpeg;base64','image')
                        $dataType = explode('/', explode(';', $file[0])[0]);
                        $type = $dataType[1];
                        $fileData = $file[1];
                        $fileName = time() . '-' . rand(0, 99999) . '.' . $type;
                        $filePath = Yii::app()->basePath . '/../media/albums';
                        $filePath = $filePath . '/' . $fileName;
                        // decode binary data
                        $decoded = base64_decode($fileData);
                        // write data
                        $fp = fopen($filePath, 'wb');
                        if (!fwrite($fp, $decoded)) {
                            echo 'Something went wrong, please contact the developer who created this platform <a href="http://egysn.com">AHMED HANY</a>';
                            die;
                        }
                        fclose($fp);
                        $albumImg->image = $fileName;
                        if ($albumImg->save()) {
                            $albumImg->isNewRecord = true;
                            $albumImg->album_id = $sub_album->id;
                            $albumImg->id = NULL;
                            $albumImg->save(); //save the image into the user album and the baby or group album too
                            $media = new PostMedia;
                            $media->post_id = $model->id;
                            $media->media = $fileName;
                            $media->save();
                        }
                    }
                }
            } else {
                $rnd = time();  // generate random number between 0-9999
                $uploadedFile = CUploadedFile::getInstance($model, 'image');

                if (!empty($uploadedFile)) {
                    if (isset($_POST['isVideo']) && $_POST['isVideo'] == 1) {
                        $fileName = "vid-{$rnd}-{$uploadedFile}";  // random number + file name
                        $model->video = $fileName;
                    } else {
                        $fileName = "img-{$rnd}-{$uploadedFile}";  // random number + file name
                        $model->image = $fileName;
                    }
                    $uploadedFile->saveAs(Yii::app()->basePath . '/../media/posts/' . $fileName);
                }
                $model->save(false);
            }

            if ($model->group_id) {
                $this->redirect(Yii::app()->request->baseUrl . '/groups/index/' . $model->group_id);
            } elseif ($model->baby_id) {
                $this->redirect(Yii::app()->request->baseUrl . '/babyProfile/index/' . $model->baby_id);
            } else {
                $this->redirect(Yii::app()->homeUrl);
            }
        } elseif (isset($_POST['Post'])) {
            Yii::app()->user->setFlash('wrongPost', 'You can only post to a baby profile or a group.');
            $this->redirect(Yii::app()->homeUrl);
        }
        $this->renderPartial('new-post', array('model' => $model, 'wrong'=>$wrong));
    }

    public function actionShare() {
        $profiles = Baby::model()->findAllBySql('select * from '.Baby::model()->tableSchema->name.' where user_id="' . Yii::app()->user->id . '" or id in (select baby_id from '.BabyAccessRole::model()->tableSchema->name.' where user_id="' . Yii::app()->user->id . '" and role="1")');
        $albums = Album::model()->findAll(array('condition' => 'user_id=' . Yii::app()->user->id));
        $this->renderPartial('share-story', array('profiles' => $profiles, 'albums' => $albums));
    }

    /*     * ***end of timeline**** */

    /*     * ***Contest**** */

    public function actionContest() {
        $contest = Contest::model()->find(array('condition' => 'active=1'));
        $criteria = new CDbCriteria;
        $criteria->condition = 'contest_id="' . $contest->id . '"';
        if (isset($_REQUEST['filter']) && $_REQUEST['filter'] == '4') {
            $criteria->order = 'id desc';
        } elseif (isset($_REQUEST['filter']) && $_REQUEST['filter'] == '3') {
            $criteria->addCondition('DATE(date_joined) > (NOW() - INTERVAL 7 DAY)');
            $criteria->order = 'id desc';
        } elseif (isset($_REQUEST['filter']) && $_REQUEST['filter'] == '2') {
            $criteria->addCondition('DATE(date_joined) > (NOW() - INTERVAL 1 DAY)');
            $criteria->order = 'id desc';
        } else {
            $criteria->limit = '12';
            $criteria->order = 'id desc';
        }
        $recent_entries = ContestUser::model()->findAll($criteria);
        $this->render('contest', array('contest' => $contest, 'recent_entries' => $recent_entries));
    }

    public function actionContestEntry() {
        $contest = Contest::model()->find(array('condition' => 'active=1'));
        $model = new ContestUser;
        $model_image = new ContestUserImage;
        $image = array(); //fake to accommodate the update contest
        if (isset($_POST['ContestUser'])) {
            $model->attributes = $_POST['ContestUser'];
            $model->contest_id = $contest->id;
            $model->user_id = Yii::app()->user->id;
            if ($model->save()) {
                $index = 0;
                //$path = Yii::app()->basePath . '/../media/contests/contest' . $model->contest_id . '/' . $model->user_id;
				$path = Yii::app()->basePath . '/../media/contests';
                if (!is_dir($path))
                    mkdir($path);
                $photos = CUploadedFile::getInstances($model_image, 'image');
                if (isset($photos) && count($photos) > 0) {
                    foreach ($photos as $image => $pic) {
                        $model_image = new ContestUserImage;
                        $rnd = time().rand(1,999);
                        $fileName = "{$rnd}-{$pic->name}";
                        $model_image->image = $fileName;
                        if ($pic->saveAs($path . '/' . $model_image->image)) {
                            $model_image->contest_user_id = $model->id;
                            if ($index == 0) {
                                $model_image->main_pic = 1;
                            }
                            $model_image->save(false); // DONE
                        }
                        $index++;
                    }
                }
                Yii::app()->user->setFlash('done', 'Your contest entry has been added successfully.');
                $this->redirect(array('updateContestEntry', 'id' => $model->id));
            }
        }

        $this->render('contest_form', array('contest' => $contest, 'model' => $model, 'model_image' => $model_image, 'images' => $image));
    }

    public function actionUpdateContestEntry($id) {
        $contest = Contest::model()->find(array('condition' => 'active=1'));
        $model = ContestUser::model()->findByPk($id);
        if ($model) {
            if ($model->user_id != Yii::app()->user->id) {
                Yii::app()->user->setFlash('done', 'Can\'t edit a contest entry which doesn\'t belong to you.');
                $this->redirect(array('contestEntry'));
            }
            $model_image = new ContestUserImage;
            $images = ContestUserImage::model()->findAllByAttributes(array('contest_user_id' => $model->id));
            if (isset($_POST['ContestUser'])) {
                $_POST['ContestUser']['contest_id'] = $model->contest_id;
                $_POST['ContestUser']['baby_id'] = $model->baby_id;
                $_POST['ContestUser']['user_id'] = $model->user_id;
                $model->attributes = $_POST['ContestUser'];
                if ($model->save()) {
                    $index = 0;
                    //$path = Yii::app()->basePath . '/../media/contests/contest' . $model->contest_id . '/' . $model->user_id;
					$path = Yii::app()->basePath . '/../media/contests';
                    if (!is_dir($path))
                        mkdir($path);
                    $photos = CUploadedFile::getInstances($model_image, 'image');
                    if (isset($photos) && count($photos) > 0) {
                        ContestUserImage::model()->deleteAll(array('condition' => 'contest_user_id=' . $model->id));
                        foreach ($photos as $image => $pic) {
                            $model_image = new ContestUserImage;
                            $rnd = time().rand(1,999);
                            $fileName = "{$rnd}-{$pic->name}";
                            $model_image->image = $fileName;
                            if ($pic->saveAs($path . '/' . $model_image->image)) {
                                $model_image->contest_user_id = $model->id;
                                if ($index == 0) {
                                    $model_image->main_pic = 1;
                                }
                                $model_image->save(false); // DONE
                            }
                            $index++;
                        }
                    }
                    Yii::app()->user->setFlash('done', 'Your contest entry has been updated successfully.');
                    $this->redirect(array('updateContestEntry', 'id' => $model->id));
                }
            }
        } else {
            Yii::app()->user->setFlash('done', 'You have no entries to this contest, Submit your new entry!');
            $this->redirect(array('ContestEntry'));
        }

        $this->render('contest_form', array('contest' => $contest, 'model' => $model, 'model_image' => $model_image, 'images' => $images));
    }

    /*     * ****end of contest*** */


    /*     * ****sell/donate***** */

    public function actionMarket() {
        $criteria = new CDbCriteria;
        $criteria->condition = 'approved=1 and sold=0';
        $products = Product::model()->findAll($criteria);
        $pages = new CPagination(count($products));
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
        $products = Product::model()->findAll($criteria);

        $this->render('product-list', array('products' => $products, 'pages' => $pages, 'my' => 0));
    }

    public function actionMyProducts() {
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=' . Yii::app()->user->id;
        $products = Product::model()->findAll($criteria);
        $pages = new CPagination(count($products));
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);
        $products = Product::model()->findAll($criteria);

        $this->render('product-list', array('products' => $products, 'pages' => $pages, 'my' => 1));
    }

    public function actionProduct() {
        $slug = $_REQUEST['slug'];
        $product = Product::model()->findByAttributes(array('slug' => $slug));
        if ($product) {
            $main_img = ProductImage::model()->find(array('condition' => 'main_image=1 and product_id=' . $product->id));
            $images = ProductImage::model()->findAll(array('condition' => 'main_image=0 and product_id=' . $product->id));
        } else {
            $this->redirect(array('home'));
        }
        $this->render('product_main', array('product' => $product, 'main_img' => $main_img, 'images' => $images));
    }

    public function actionAddProduct() {
        $product = new Product;
        $productImg = new ProductImage;
        $image = array(); //fake to accommodate the update contest
        if (isset($_POST['Product'])) {
            $product->attributes = $_POST['Product'];
            $product->user_id = Yii::app()->user->id;
            $product->slug = Helper::slugify($product->title);
            $product->user_id = Yii::app()->user->id;
            $product->date_of_product = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
            if ($product->sell_donate == 'sell-type') {
                $product->sell_donate = 0;
            } else {
                $product->sell_donate = 1;
                $product->price = 0.00;
            }
            if ($product->save()) {
                $index = 0;
                $path = Yii::app()->basePath . '/../media/products';
                $photos = CUploadedFile::getInstances($productImg, 'image');
                if (isset($photos) && count($photos) > 0) {
                    foreach ($photos as $image => $pic) {
                        $productImg = new ProductImage;
                        $rnd = time();
                        $fileName = "{$rnd}-{$pic->name}";
                        $productImg->image = $fileName;
                        if ($pic->saveAs($path . '/' . $productImg->image)) {
                            $productImg->product_id = $product->id;
                            if ($index == 0) {
                                $productImg->main_image = 1;
                            }
                            $productImg->save(false); // DONE
                        }
                        $index++;
                    }
                }
                Yii::app()->user->setFlash('done', 'Your product has been added successfully.');
                $this->redirect(array('updateProduct', 'id' => $product->id));
            }
        }
        $this->render('product-form', array('product' => $product, 'product_image' => $productImg, 'images' => $image));
    }

    public function actionUpdateProduct($id) {
        $product = Product::model()->findByPk($id);
        if ($product) {
            if ($product->user_id != Yii::app()->user->id) {
                Yii::app()->user->setFlash('done', 'Can\'t edit a product which doesn\'t belong to you.');
                $this->redirect(array('market'));
            }
            $productImg = new ProductImage;
            $images = ProductImage::model()->findAllByAttributes(array('product_id' => $product->id));
            if (isset($_POST['Product'])) {
                $_POST['Product']['user_id'] = $product->user_id;
                $product->attributes = $_POST['Product'];
                $product->slug = Helper::slugify($product->title);
                $product->date_of_product = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
                if ($product->sell_donate == 'sell-type') {
                    $product->sell_donate = 0;
                } else {
                    $product->sell_donate = 1;
                    $product->price = 0.00;
                }
                if ($product->save()) {
                    $index = 0;
                    $path = Yii::app()->basePath . '/../media/products';
                    $photos = CUploadedFile::getInstances($productImg, 'image');
                    if (isset($photos) && count($photos) > 0) {
                        Productimage::model()->deleteAll(array('condition' => 'product_id=' . $product->id));
                        foreach ($photos as $image => $pic) {
                            $productImg = new ProductImage;
                            $rnd = time();
                            $fileName = "{$rnd}-{$pic->name}";
                            $productImg->image = $fileName;
                            if ($pic->saveAs($path . '/' . $productImg->image)) {
                                $productImg->product_id = $product->id;
                                if ($index == 0) {
                                    $productImg->main_image = 1;
                                }
                                $productImg->save(false); // DONE
                            }
                            $index++;
                        }
                    }
                    Yii::app()->user->setFlash('done', 'Your product has been updated successfully.');
                    $this->redirect(array('updateProduct', 'id' => $product->id));
                }
            }
        } else {
            Yii::app()->user->setFlash('done', 'You have no products to edit, Add your new product!');
            $this->redirect(array('addProduct'));
        }
        $this->render('product-form', array('product' => $product, 'product_image' => $productImg, 'images' => $images));
    }

    /*     * ****end of sell/donate***** */

    public function actionPage() {
        //echo 'dd';die;
        $slug = $_REQUEST['slug'];
        $page = Pages::model()->find(array('condition' => 'url="' . $slug . '"'));
        $this->render('staticpage', array('pages' => $page));
    }

    public function actionSend() {
        $mail = new YiiMailer();
        //$mail->clearLayout();//if layout is already set in config
        $mail->setFrom($_POST['email'], $_POST['name']);
        //$mail->setTo(Yii::app()->params['adminEmail']);

        $mail->setTo(Yii::app()->params['adminEmail']);
        $mail->setSubject('Contact Me "Phone no.: (' . $_POST['phone'] . ')"');
        $mail->setBody($_POST['message']);

        if ($mail->send()) {
            Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
            $this->redirect(Yii::app()->request->baseUrl . '/home/contact#done');
        } else {
            Yii::app()->user->setFlash('error', 'Error while sending email: ' . $mail->getError());
        }
        //send attachements
        /*
          $mail->setAttachment('something.pdf');
          $mail->setAttachment(array('something.pdf','something_else.pdf','another.doc'));
          $mail->setAttachment(array('something.pdf'=>'Some file','something_else.pdf'=>'Another file'));

         */
    }

    public function actionFaq() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $model = Faq::model()->findAll();
        $this->render('faq', array('faqs' => $model,));
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $this->render('contact');
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        unset(Yii::app()->request->cookies['fp_user_id']);
        $this->redirect(Yii::app()->homeUrl);
    }

    /* ----  load dynamic pages ------- */

    public function loadPage($id) {
        $model = Pages::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionAutoComplete() {
        $res = array();

        if (isset($_GET['term'])) {
            // sql query to get execute
            $qtxt = "SELECT id,username,image FROM ".User::model()->tableSchema->name." WHERE username LIKE :name";
            // preparing the sql query
            $command = Yii::app()->db->createCommand($qtxt);
            // assigning the get value
            $command->bindValue(":name", '%' . $_GET['term'] . '%', PDO::PARAM_STR);
            //$res =$command->queryColumn(); // this is the function which was giving me result of only 1 column
            $res = $command->queryAll(); // I changed that to this to give me result of all column's specified in sql query.
        }
        echo CJSON::encode($res); // encoding the result to JSON
        Yii::app()->end();
    }

    public function actionSearch() {
        $s = strtolower($_POST['s']);
        if ($s) {
            $users = User::model()->findAll(array('condition' => '(lower(username) like "%' . $s . '%" OR lower(email) = "' . $s . '" OR lower(fname) like "%' . $s . '%" OR lower(lname) like "%' . $s . '%") and groups_id!=6 and id!=' . Yii::app()->user->id));
            $groups = Group::model()->findAll(array('condition' => 'lower(title) like "%' . $s . '%"'));
            $babies = Baby::model()->findAll(array('condition' => 'lower(username) like "%' . $s . '%"'));
        } else {
            $users = array();
            $groups = array();
            $babies = array();
        }

        $this->render('search', array('babies' => $babies, 'users' => $users, 'groups' => $groups));
    }

    public function actionFacebookPhotos() {
        $returnUrl = Yii::app()->request->getBaseUrl(true) . '/home/facebookPhotos';
        $permissions = 'user_photos'; //,user_about_me,user_location,user_birthday,user_photos later usage

        $fb = Yii::app()->facebook;
        $token = $fb->getAccessToken();
        $fb->setAccessToken($token);
        $fbUser = Yii::app()->facebook->getUser();
        if ($fbUser) {
            $photos = Yii::app()->facebook->api('/me/photos/uploaded');
            if ($photos) {
                $arr['photos'][] = $photos[1];
            }
            $arr['status'] = 'success';
        } else {
            $loginUrl = Yii::app()->facebook->getLoginUrl(array('scope' => $permissions, 'redirect-uri' => $returnUrl));
            $arr['status'] = 'fail';
            $arr['link'] = $loginUrl;
            //$this->redirect($loginUrl);
        }
        echo json_encode($arr, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    public function actionViewContest($id) {
        $model = ContestUser::model()->findByPk($id);
        $main_image = ContestUserImage::model()->find(array('condition' => 'main_pic=1 and contest_user_id=' . $model->id));
        $images = ContestUserImage::model()->findAll(array('condition' => 'contest_user_id=' . $model->id));
        $criteria = new CDbCriteria;
        $criteria->condition = 'item_id=' . $model->id . ' and item_type=' . Yii::app()->params['typeContestUser'];
        $likes = Like::model()->count($criteria);
        $i_liked = Like::model()->findByAttributes(array('item_id' => $id, 'item_type' => Yii::app()->params['typeContestUser'], 'user_id' => Yii::app()->user->id));
        $comments = Comment::model()->findAll($criteria);
        $this->render('view-contest', array('model' => $model, 'images' => $images, 'main_image' => $main_image, 'comments' => $comments, 'likes' => $likes, 'i_liked' => $i_liked));
    }

    public function actionViewImage() {
        $id = $_GET['id'];
        $type = $_GET['mode'];

        if ($id && $type) {
            $criteria = new CDbCriteria;
            $criteria->condition = 'item_id=' . $id . ' and item_type=' . Yii::app()->params['type' . $type];
            $likes = Like::model()->count($criteria);
            $i_liked = Like::model()->findByAttributes(array('item_id' => $id, 'item_type' => Yii::app()->params['type' . $type], 'user_id' => Yii::app()->user->id));
            $comments = Comment::model()->findAll($criteria);

            if ($type == 'PostMedia') {
                $model = PostMedia::model()->findByPk($id);
                $image = $model->media;
                $owner = User::model()->findByPk($model->post->user_id);
                $dir = 'albums';
            } elseif ($type == 'PostImage') {
                $model = Post::model()->findByPk($id);
                $image = $model->image;
                $owner = User::model()->findByPk($model->user_id);
                $dir = 'posts';
            } elseif ($type == 'AlbumImage') {
                $model = AlbumImage::model()->findByPk($id);
                $image = $model->image;
                $owner = User::model()->findByPk($model->album->user_id);
                $dir = 'albums';
            } elseif ($type == 'ContestUserImage') {
                $model = ContestUserImage::model()->findByPk($id);
                $image = $model->image;
                $owner = User::model()->findByPk($model->contestUser->user_id);
                //$dir = 'contests/contest' . $model->contestUser->contest_id . '/' . $owner->id;
				$dir = 'contests';
            }
            $this->renderPartial('view-image', array('id' => $id, 'image' => $image, 'i_liked' => $i_liked, 'comments' => $comments, 'likes' => $likes, 'dir' => $dir, 'owner' => $owner, 'type' => $_GET['mode']));
        }
    }

    public function actionContestVote($id) {
        $model = ContestUserVote::model()->find(array('condition' => 'contest_user_id=' . $id . ' and user_id=' . Yii::app()->user->id));
        if ($model) {
            ContestUserVote::model()->deleteAll(array('condition' => 'contest_user_id=' . $id . ' and user_id=' . Yii::app()->user->id));
        } else {
            $model = new ContestUserVote;
            $model->user_id = Yii::app()->user->id;
            $model->contest_user_id = $id;
            $model->save();
        }
        $votes = ContestUserVote::model()->count(array('condition' => 'contest_user_id=' . $id));
        echo $votes;
    }

    public function actionContestLike($id) {
        $model = ContestUserLike::model()->find(array('condition' => 'contest_user_id=' . $id . ' and user_id=' . Yii::app()->user->id));
        if ($model) {
            ContestUserLike::model()->deleteAll(array('condition' => 'contest_user_id=' . $id . ' and user_id=' . Yii::app()->user->id));
        } else {
            $model = new ContestUserLike;
            $model->user_id = Yii::app()->user->id;
            $model->contest_user_id = $id;
            $model->save();
        }
        $votes = ContestUserLike::model()->count(array('condition' => 'contest_user_id=' . $id));
        echo $votes;
    }

}
