<?php
$this->breadcrumbs=array(
	'Group Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create GroupCategory';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>