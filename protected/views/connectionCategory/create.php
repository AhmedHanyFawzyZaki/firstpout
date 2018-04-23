<?php
$this->breadcrumbs=array(
	'Connection Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ConnectionCategory','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create ConnectionCategory';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>