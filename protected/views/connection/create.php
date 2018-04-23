<?php
$this->breadcrumbs=array(
	'Connections'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Connection';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>