<?php
$this->breadcrumbs=array(
	'Likes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Like';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>