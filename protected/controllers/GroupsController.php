<?php

class GroupsController extends FrontController {

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

    public function actionUpdateTimeline($id) {
        $model = Group::model()->findByPk($id);
        if ($model) {
            $posts = Post::model()->findAll(array('condition' => 'group_id=' . $id, 'order' => 'id desc'));
            $this->renderPartial('//home/posts', array('posts' => $posts)); //the same view but without the ajax loading script and the container div "timeline-board"
        } else {
            Yii::app()->user->setFlash("WrongGroup", 'The group you are looking for doesn\'t exists, you can create your own group.');
            $this->redirect(Yii::app()->request->baseUrl . '/controlPanel/createGroup');
        }
    }

    public function actionIndex($id) {
        $model = Group::model()->findByPk($id);
        if ($model) {
            $posts = Post::model()->findAll(array('condition' => 'group_id=' . $id, 'order' => 'id desc'));
            $this->render('index', array('posts' => $posts, 'model' => $model, 'id' => $id));
        } else {
            Yii::app()->user->setFlash("WrongGroup", 'The group you are looking for doesn\'t exists, you can create your own group.');
            $this->redirect(Yii::app()->request->baseUrl . '/controlPanel/createGroup');
        }
    }

    /*     * **********End of index********** */

    //*********Info***********/
    public function actionInfo($id) {
        $model = Group::model()->findByPk($id);
        if ($model) {
            $members_no = count(GroupUser::model()->findAll(array('condition' => 'group_id=' . $id)));
            $group_users = GroupUser::model()->findAll(array('condition' => 'group_id=' . $id, 'limit' => 4, 'order' => 'role DESC'));
            $this->render('info', array('model' => $model, 'group_users' => $group_users, 'members_no' => $members_no, 'id' => $id));
        } else {
            Yii::app()->user->setFlash("WrongGroup", 'The group you are looking for doesn\'t exists, you can create your own group.');
            $this->redirect(Yii::app()->request->baseUrl . '/controlPanel/createGroup');
        }
    }

    /*     * *******end of info******** */

    //*********family***********/
    public function actionMembers($id) {
        $model = Group::model()->findByPk($id);
        $group_admins = GroupUser::model()->findAll(array('condition' => 'role=1 and group_id=' . $id));
        $group_users = GroupUser::model()->findAll(array('condition' => 'role=0 and group_id=' . $id));
        $this->render('family', array('model' => $model, 'group_admins' => $group_admins, 'group_users' => $group_users, 'id' => $id));
    }

    /*     * *******end of family******** */

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
	
	public function actionLeaveGroup($id) {
        GroupUser::model()->deleteAllByAttributes(array('user_id'=>Yii::app()->user->id, 'group_id'=>$id));
		echo '1';
    }
	public function actionRemoveRequestGroup($id) {
        GroupInvitee::model()->deleteAllByAttributes(array('user_id'=>Yii::app()->user->id, 'group_id'=>$id));
		echo '1';
    }
	public function actionAcceptRequestGroup($id) {
        $model=GroupInvitee::model()->findByAttributes(array('user_id'=>Yii::app()->user->id, 'group_id'=>$id, 'status'=>0));
		if($model){
			GroupInvitee::model()->deleteAllByAttributes(array('user_id'=>Yii::app()->user->id, 'group_id'=>$id, 'status'=>0));
			$obj=new GroupUser;
			$obj->group_id=$id;
			$obj->user_id=Yii::app()->user->id;
			if($obj->save())
				echo '1';die;
		}
		echo '0';
    }
	
	public function actionAddRequestGroup($id) {
        $model=GroupInvitee::model()->findByAttributes(array('user_id'=>Yii::app()->user->id, 'group_id'=>$id, 'status'=>1));
		if($model){
			echo '0';die;
		}else{
			$obj=new GroupInvitee;
			$obj->group_id=$id;
			$obj->user_id=Yii::app()->user->id;
			$obj->status=1;
			if($obj->save())
				echo '1';die;
		}
    }

}
