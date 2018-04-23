<?php

class UserProfileController extends FrontController {

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

    /*     * *******Index******** */

    public function actionIndex($id) {
        $posts = Post::model()->findAll(array('condition' => 'user_id=' . $id, 'order' => 'id desc'));
        $this->render('index', array('posts' => $posts, 'id' => $id));
    }

    public function actionUpdateTimeline($id) {
        $posts = Post::model()->findAll(array('condition' => 'user_id=' . $id, 'order' => 'id desc'));
        $this->renderPartial('//home/posts', array('posts' => $posts));
    }

    /*     * **********End of index********** */

    //*********Info***********/
    public function actionInfo($id) {
        $user = User::model()->findByPk($id);
        $this->render('info', array('model' => $user, 'id' => $id));
    }

    /*     * *******end of info******** */

    //*********family***********/
    public function actionFriends($id) {
        $model = User::model()->findByPk($id);
        $friends = UserFriend::model()->findAllBySql('select * from '.UserFriend::model()->tableSchema->name.' where (user_id=' . $id . ' OR friend_id=' . $id . ') and approved=1');
        $this->render('family', array('model' => $model, 'friends'=>$friends, 'id' => $id));
    }

    /*     * *******end of family******** */

    //*********albums***********/
    public function actionAlbums($id) {
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id="' . $id . '"';
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
        $this->render('//controlPanel/albums', array('albums' => $albums, 'id' => $id));
    }

    /*     * *******end of albums******** */

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

}
