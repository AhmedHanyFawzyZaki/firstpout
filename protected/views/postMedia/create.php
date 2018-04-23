<?php
$this->breadcrumbs=array(
	'Post Medias'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PostMedia','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create PostMedia';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>