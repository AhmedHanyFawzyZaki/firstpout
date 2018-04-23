<?php
$this->breadcrumbs=array(
	'Contest User Images'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create ContestUserImage';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>