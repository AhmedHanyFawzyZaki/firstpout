<?php
$this->breadcrumbs=array(
	'Post Medias'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PostMedia','url'=>array('index')),
	array('label'=>'Create PostMedia','url'=>array('create')),
	array('label'=>'View PostMedia','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update PostMedia #'. $model->id; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>