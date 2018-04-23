<?php

class BabyProfileController extends FrontController {
    public $layout='//layouts/main';
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
        $posts = Post::model()->findAll(array('condition' => 'baby_id=' . $id, 'order' => 'id desc'));
        $this->render('index', array('posts' => $posts, 'id' => $id));
    }

    public function actionUpdateTimeline($id) {
        $posts = Post::model()->findAll(array('condition' => 'baby_id=' . $id, 'order' => 'id desc'));
        $this->renderPartial('//home/posts', array('posts' => $posts));
    }

    /*     * **********End of index********** */

    //*********Info***********/
    public function actionInfo($id) {
        $baby = Baby::model()->findByPk($id);
        $family = BabyFamily::model()->findAll(array('condition' => 'baby_id=' . $id, 'limit' => 3));
        $doctors = BabyDoctorHospital::model()->findAll(array('condition' => 'baby_id=' . $id));
        $this->render('info', array('model' => $baby, 'family' => $family, 'doctors' => $doctors, 'id' => $id));
    }

    /*     * *******end of info******** */

    //*********family***********/
    public function actionFamily($id) {
        $baby = Baby::model()->findByPk($id);
        $connection_cats = ConnectionCategory::model()->findAll();
        $this->render('family', array('model' => $baby, 'connection_cats' => $connection_cats, 'id' => $id));
    }

    /*     * *******end of family******** */

    //*********albums***********/
    public function actionAlbums($id) {
        $criteria = new CDbCriteria;
        $criteria->condition = 'baby_id="' . $id . '"';
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

    /*     * **************Medical records*************** */

    public function actionMedicalRecords($id) {
        if (Baby::IsBabyAccess($id, Yii::app()->user->id)) {
            $baby = Baby::model()->findByPk($id);
            $baby_doctor = BabyDoctorHospital::model()->findByAttributes(array('baby_id' => $id, 'is_hospital' => 0));
            $baby_hospital = BabyDoctorHospital::model()->findByAttributes(array('baby_id' => $id, 'is_hospital' => 1));
            $next_appointment = Appointment::model()->find(array('condition' => 'baby_id=' . $id . ' and realized=0 and date_of_visit >=  "' . date('Y-m-d') . '"'));
            $visits = Visit::model()->findAllByAttributes(array('baby_id' => $id));
            $vaccines = Vaccine::model()->findAllByAttributes(array('baby_id' => $id));

            /* $criteria = new CDbCriteria;
              $criteria->condition = 'id <> "'.$next_appointment->id.'" and baby_id='.$id;
              $appointments= Appointment::model()->findAll($criteria); */

            $model_visit = new Visit;
            if (isset($_POST['Visit']) && Baby::IsBabyAdmin($baby->id, Yii::app()->user->id)) {
                $model_visit->attributes = $_POST['Visit'];
                $model_visit->user_id = Yii::app()->user->id;
                $model_visit->baby_id = $baby->id;
				$uploadedFile=CUploadedFile::getInstance($model_visit,'prescription');
				if(! empty ($uploadedFile)){
					$rnd = time();
					$fileName = "{$rnd}-pre-{$uploadedFile}";  // random number + file name
					$model_visit->prescription = $fileName;
					$uploadedFile->saveAs(Yii::app()->basePath.'/../media/babies/'.$fileName);
				}
                if ($model_visit->save())
                    $this->redirect(array('medicalRecords', 'id' => $baby->id));
            }

            $model_appointment = new Appointment;

            if (isset($_POST['Appointment'])) {
                $model_appointment->attributes = $_POST['Appointment'];
                $model_appointment->user_id = Yii::app()->user->id;
                $model_appointment->baby_id = $baby->id;
                if ($model_appointment->save())
                    $this->redirect(array('medicalRecords', 'id' => $baby->id));
            }

            $model_vaccine = new Vaccine;
            if (isset($_POST['Vaccine'])) {
                $model_vaccine->attributes = $_POST['Vaccine'];
                $model_vaccine->user_id = Yii::app()->user->id;
                $model_vaccine->baby_id = $baby->id;
                if ($model_vaccine->save())
                    $this->redirect(array('medicalRecords', 'id' => $baby->id));
            }
            $this->render('medical-records', array('baby' => $baby, 'baby_doctor' => $baby_doctor,
                'baby_hospital' => $baby_hospital, 'visits' => $visits, 'vaccines' => $vaccines,
                //'appointments'=>$appointments, 
                'next_appointment' => $next_appointment,
                'model_visit' => $model_visit,
                'model_appointment' => $model_appointment,
                'model_vaccine'=>$model_vaccine,
            ));
        }else {
            $this->redirect(array('babyProfile/index/' . $id));
        }
    }

    public function actionAppointments($id) {
        if (Baby::IsBabyAccess($id, Yii::app()->user->id)) {
            $next_appointment = Appointment::model()->find(array('condition' => 'baby_id=' . $id . ' and realized=0 and date_of_visit >=  "' . date('Y-m-d') . '"'));
            $criteria = new CDbCriteria;
            $criteria->condition = 'id <> "' . $next_appointment->id . '" and baby_id=' . $id;
            $appointments = Appointment::model()->findAll($criteria);
            $pages = new CPagination(count($appointments));
            $pages->pageSize = 5;
            $pages->applyLimit($criteria);
            $appointments = Appointment::model()->findAll($criteria);

            $this->render('appointments', array('appointments' => $appointments, 'next_appointment' => $next_appointment, 'pages' => $pages, 'id' => $id));
        } else {
            $this->redirect(array('babyProfile/index/' . $id));
        }
    }

    public function actionRemoveAppointment($id) {
        $appointment = Appointment::model()->findByPk($id);
        $baby_id = $appointment->baby_id;
        if (Baby::IsBabyAdmin($baby_id, Yii::app()->user->id)) {
            $appointment->delete();
            $this->redirect(array('appointments', 'id' => $baby_id));
        } else {
            $this->redirect(array('babyProfile/index/' . $id));
        }
        $this->render('appointments', array('appointments' => $appointments, 'next_appointment' => $next_appointment));
    }

    public function actionRealizeAppointment($id) {
        $appointment = Appointment::model()->findByPk($id);
        $baby_id = $appointment->baby_id;
        if (Baby::IsBabyAdmin($baby_id, Yii::app()->user->id)) {
            $appointment->realized = 1;
            $appointment->save(false);
            $this->redirect(array('babyProfile/medicalRecords/'.$baby_id.'#tabs'));
        } else {
            $this->redirect(array('babyProfile/index/' . $id));
        }
        $this->render('appointments', array('appointments' => $appointments, 'next_appointment' => $next_appointment));
    }

    public function actionUnrealizeAppointment($id) {
        $appointment = Appointment::model()->findByPk($id);
        $baby_id = $appointment->baby_id;
        if (Baby::IsBabyAdmin($baby_id, Yii::app()->user->id)) {
            $appointment->realized = 0;
            $appointment->save(false);
            $this->redirect(array('babyProfile/medicalRecords/'.$baby_id.'#tabs'));
        } else {
            $this->redirect(array('babyProfile/index/' . $id));
        }
        $this->render('appointments', array('appointments' => $appointments, 'next_appointment' => $next_appointment));
    }

    public function actionVisits($id) {
        if (Baby::IsBabyAccess($id, Yii::app()->user->id)) {
            $next_visit = Visit::model()->find(array('condition' => 'baby_id=' . $id . ' and date_of_visit >=  "' . date('Y-m-d') . '"'));
            $criteria = new CDbCriteria;
            $criteria->condition = 'id <> "' . $next_visit->id . '" and baby_id=' . $id;
            $visits = Visit::model()->findAll($criteria);
            $pages = new CPagination(count($visits));
            $pages->pageSize = 5;
            $pages->applyLimit($criteria);
            $visits = Visit::model()->findAll($criteria);

            $this->render('visits', array('visits' => $visits, 'next_visit' => $next_visit, 'pages' => $pages, 'id' => $id));
        } else {
            $this->redirect(array('babyProfile/index/' . $id));
        }
    }

    public function actionVaccines($id) {
        if (Baby::IsBabyAccess($id, Yii::app()->user->id)) {
            $current_vaccine = Vaccine::model()->find(array('condition' => 'baby_id=' . $id.' and realized=0','order'=>'id asc'));
            $vaccines = Vaccine::model()->findAll(array('condition' => 'baby_id=' . $id));
            $prev_vaccines = Vaccine::model()->findAll(array('condition' => 'baby_id=' . $id.' and realized=1'));
            $next_vaccines = Vaccine::model()->findAll(array('condition' => 'baby_id=' . $id.' and realized=0'));

            $this->render('vaccines', array('current_vaccine' => $current_vaccine,
                'vaccines' => $vaccines, 'id' => $id, 'prev_vaccines'=>$prev_vaccines, 'next_vaccines'=>$next_vaccines));
        } else {
            $this->redirect(array('babyProfile/index/' . $id));
        }
    }
	
	public function actionVaccineDesc(){
		$id=$_REQUEST['id'];
		echo Vaccine::model()->findByPk($id)->desc;
	}
	
	public function actionVaccineRealize(){
		$id=$_REQUEST['id'];
		$model=Vaccine::model()->findByPk($id);
		$model->realized=1;
		$model->save(false);
		echo '1';
	}

    /*     * *********end of Medical records************* */

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
