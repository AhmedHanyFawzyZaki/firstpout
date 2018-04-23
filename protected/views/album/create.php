<?php
$this->breadcrumbs=array(
	'Albums'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Album';?>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'model_image'=>$model_image)); ?>