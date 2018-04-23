<?php

class AlbumController extends AdminController
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
		$model=new Album;
		$model_image=new AlbumImage;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Album']))
		{
			$model->attributes=$_POST['Album'];
			if($model->save())
			{
				if(isset($_POST['AlbumImage']['title']))
				{
					foreach($_POST['AlbumImage']['title'] as $index=>$title)
					{
						$model_image=new AlbumImage;
						$model_image->title=$title;
						$model_image->desc=$_POST['AlbumImage']['desc'][$index];
						$model_image->date_taken=$_POST['AlbumImage']['date_taken'][$index];
						$model_image->album_id=$model->id;
						if($index==0)
						{
							$model_image->main_pic=1;
						}
						$uploadedFile=CUploadedFile::getInstance($model_image,'image['.$index.']');
						if(! empty ($uploadedFile)){
							$rnd = time();
							$fileName = "{$rnd}-{$uploadedFile}";
							$model_image->image=$fileName;
							$path=Yii::app()->basePath.'/../media/albums/'.$model_image->image;
							$uploadedFile->saveAs($path);
						}
						$model_image->save(false);
					}
				}
				$post=new Post;
				$post->album_id=$model->id;
				$post->title=$model->title;
				$post->user_id=$model->user_id;
				$post->baby_id=$model->baby_id;
				$post->content="album post";
				if($post->save(false)){
					$this->redirect(array('view','id'=>$model->id));
				}
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
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$model_image=new AlbumImage;
		$albumImages=AlbumImage::model()->findAll(array('condition'=>'album_id='.$id));
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

		if(isset($_POST['Album']))
		{
			$model->attributes=$_POST['Album'];
			if($model->save())
			{
				if(isset($_POST['AlbumImage']['title']))
				{
					foreach($_POST['AlbumImage']['title'] as $index=>$title)
					{
						$check=AlbumImage::model()->findAllByAttributes(array('album_id'=>$model->id, 'title'=>$title,'desc'=>$_POST['AlbumImage']['desc'][$index],'date_taken'=>$_POST['AlbumImage']['date_taken'][$index]));
						$check_2=AlbumImage::model()->findBySql('select * from '.AlbumImage::model()->tableSchema->name.' where `album_id`='.$model->id.' and ((`title`="'.$title.'" and `desc`!="'.$_POST['AlbumImage']['desc'][$index].'") OR (`title`!="'.$title.'" OR `desc`="'.$_POST['AlbumImage']['desc'][$index].'"))');
						if(count($check)>0)
						{
							continue;
						}
						/*elseif(count($check_2)>0)
						{
							echo $title;
							if(AlbumImage::model()->deleteByPk($check_2->id) && $check_2->image){
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
						$model_image=new AlbumImage;
						$model_image->title=$title;
						$model_image->desc=$_POST['AlbumImage']['desc'][$index];
						$model_image->date_taken=$_POST['AlbumImage']['date_taken'][$index];
						$model_image->album_id=$model->id;
						if($index==0)
						{
							$model_image->main_pic=1;
						}
						$uploadedFile=CUploadedFile::getInstance($model_image,'image['.$index.']');
						if(! empty ($uploadedFile)){
							$rnd = time();
							$fileName = "{$rnd}-{$uploadedFile}";
							$model_image->image=$fileName;
							$path=Yii::app()->basePath.'/../media/albums/'.$model_image->image;
							$uploadedFile->saveAs($path);
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
		$model=new Album('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Album']))
			$model->attributes=$_GET['Album'];

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
		$model=Album::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='album-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionRemoveAlbumImage(){
		$id=$_POST['id'];
		$image=$_POST['image'];
		$album=Album::model()->findByPk($id);
		$path=Yii::app()->basePath.'/../media/albums/'.$image;
		if(unlink($path))
		{
			if($ai=AlbumImage::model()->findByAttributes(array('album_id'=>$id,'image'=>$image)))
			{
				AlbumImage::model()->deleteByPk($ai->id);
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
