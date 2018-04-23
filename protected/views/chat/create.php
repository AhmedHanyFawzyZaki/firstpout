<?php
$this->breadcrumbs=array(
	'Chats'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Chat','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Chat';?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>