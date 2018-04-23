<?php
$this->breadcrumbs=array(
	'Chats'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Chat','url'=>array('index')),
	array('label'=>'Create Chat','url'=>array('create')),
	array('label'=>'View Chat','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update Chat #'. $model->id; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>