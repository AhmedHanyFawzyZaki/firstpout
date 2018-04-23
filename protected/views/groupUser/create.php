<?php
$this->breadcrumbs=array(
	'Group Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create GroupUser';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>