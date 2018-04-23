<?php

class ContestUserController extends AdminController
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
			/*'accessControl', // perform access control for CRUD operations*/
		);
	}

	public function actions() {
        return array(
            'order' => array(
            'class' => 'ext.yiisortablemodel.actions.AjaxSortingAction',
            ),
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
			array('allow', 'actions' => array('order'), 'users' => array('@')),
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
		$model=new ContestUser;
		$model_image=new ContestUserImage;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_GET['contest']))
		{
			$model->contest_id=$_GET['contest'];
		}

		if(isset($_POST['ContestUser']))
		{
			$model->attributes=$_POST['ContestUser'];
			if($model->save())
			{
				if(isset($_POST['ContestUserImage']['title']))
				{
					//$path=Yii::app()->basePath.'/../media/contests/contest'.$model->contest_id.'/'.$model->user_id;
					$path=Yii::app()->basePath.'/../media/contests';
					/*if(!is_dir($path))
						mkdir($path);*/
					foreach($_POST['ContestUserImage']['title'] as $index=>$title)
					{
						$model_image=new ContestUserImage;
						$model_image->title=$title;
						$model_image->desc=$_POST['ContestUserImage']['desc'][$index];
						$model_image->date_taken=$_POST['ContestUserImage']['date_taken'][$index];
						$model_image->contest_user_id=$model->id;
						if($index==0)
						{
							$model_image->main_pic=1;
						}
						$uploadedFile=CUploadedFile::getInstance($model_image,'image['.$index.']');
						if(! empty ($uploadedFile)){
							$rnd = time().rand(1,999);
							$fileName = "{$rnd}-{$uploadedFile}";
							$model_image->image=$fileName;
							$uploadedFile->saveAs($path.'/'.$model_image->image);
						}
						$model_image->save(false);
					}
				}
				if(isset($_GET['contest']))
				{
					$this->redirect(Yii::app()->request->baseUrl.'/contest/view/'.$_GET['contest']);
				}
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'model_image'=>$model_image,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate1($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ContestUser']))
		{
			$model->attributes=$_POST['ContestUser'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$model_image=new ContestUserImage;
		$albumImages=ContestUserImage::model()->findAll(array('condition'=>'contest_user_id='.$id));
		if($albumImages)
		{
			foreach($albumImages as $im){
				$images[]=$im->image;
				$titles[]=$im->title;
				$descs[]=$im->desc;
				$dateTakens[]=$im->date_taken;
			}
			$model_image->image=$images;
			$model_image->title=$titles;
			$model_image->desc=$descs;
			$model_image->date_taken=$dateTakens;
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ContestUser']))
		{
			$model->attributes=$_POST['ContestUser'];
			if($model->save())
			{
				if(isset($_POST['ContestUserImage']['title']))
				{
					foreach($_POST['ContestUserImage']['title'] as $index=>$title)
					{
						$check=ContestUserImage::model()->findAllByAttributes(array('contest_user_id'=>$model->id, 'title'=>$title,'desc'=>$_POST['ContestUserImage']['desc'][$index],'date_taken'=>$_POST['ContestUserImage']['date_taken'][$index]));
						$check_2=ContestUserImage::model()->findBySql('select * from '.ContestUserImage::model()->tableSchema->name.' where `contest_user_id`='.$model->id.' and ((`title`="'.$title.'" and `desc`!="'.$_POST['ContestUserImage']['desc'][$index].'") OR (`title`!="'.$title.'" OR `desc`="'.$_POST['ContestUserImage']['desc'][$index].'"))');
						if(count($check)>0)
						{
							continue;
						}
						/*elseif(count($check_2)>0)
						{
							echo $title;
							if(ContestUserImage::model()->deleteByPk($check_2->id) && $check_2->image){
								if($model->baby_id){
									$path=Yii::app()->basePath.'/../media/babies/'.$model->baby_id.'/'.$check_2->image;
								}
								else
								{
									$path=Yii::app()->basePath.'/../media/users/'.$model->user_id.'/'.$check_2->image;
								}
								unlink($path);
							}
						}*/
						$model_image=new ContestUserImage;
						$model_image->title=$title;
						$model_image->desc=$_POST['ContestUserImage']['desc'][$index];
						$model_image->date_taken=$_POST['ContestUserImage']['date_taken'][$index];
						$model_image->contest_user_id=$model->id;
						if($index==0)
						{
							$model_image->main_pic=1;
						}
						$uploadedFile=CUploadedFile::getInstance($model_image,'image['.$index.']');
						if(! empty ($uploadedFile)){
							$rnd = time().rand(1,999);
							$fileName = "{$rnd}-{$uploadedFile}";
							$model_image->image=$fileName;
							//$path=Yii::app()->basePath.'/../media/contests/contest'.$model->contest_id.'/'.$model->user_id;
							$path=Yii::app()->basePath.'/../media/contests';
							$uploadedFile->saveAs($path.'/'.$model_image->image);
						}
						if($title && $model_image)
						{
							$model_image->save(false);
						}
					}
				}
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
			'model_image'=>$model_image,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new ContestUser('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ContestUser']))
			$model->attributes=$_GET['ContestUser'];

		$this->render('index',array(
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
		$model=ContestUser::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='contest-user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionRemoveContestUserImage(){
		$id=$_POST['id'];
		$image=$_POST['image'];
		$contestUser=ContestUser::model()->findByPk($id);
		//$path=Yii::app()->basePath.'/../media/contests/contest'.$contestUser->contest_id.'/'.$contestUser->user_id.'/'.$image;
		$path=Yii::app()->basePath.'/../media/contests/'.$image;
		
		if(unlink($path))
		{
			if($ai=ContestUserImage::model()->findByAttributes(array('contest_user_id'=>$id,'image'=>$image)))
			{
				ContestUserImage::model()->deleteByPk($ai->id);
				echo "1";
			}
			else
			{	
				echo "An error encountered while removing the image from our database please report this issue to the administrator!";
			}
		}
		else
		{
			echo "An error encountered while removing the image please try again later!";
		}
	}
	
}
