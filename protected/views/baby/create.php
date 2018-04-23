<?php
$this->breadcrumbs=array(
	'Babies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Baby';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>