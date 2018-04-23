<?php
$this->breadcrumbs=array(
	'Baby Doctor Hospitals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Baby Doctor & Hospital';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>