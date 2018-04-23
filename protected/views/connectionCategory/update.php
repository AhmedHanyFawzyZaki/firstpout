<?php
$this->breadcrumbs=array(
	'Connection Categories'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ConnectionCategory','url'=>array('index')),
	array('label'=>'Create ConnectionCategory','url'=>array('create')),
	array('label'=>'View ConnectionCategory','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update ConnectionCategory '; ?>
<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>