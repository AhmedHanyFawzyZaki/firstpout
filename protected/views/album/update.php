<?php
$this->breadcrumbs=array(
	'Albums'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'View','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update Album "'. $model->title.'"'; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model,'model_image'=>$model_image)); ?>