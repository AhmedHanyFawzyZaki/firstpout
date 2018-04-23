<?php
$this->breadcrumbs=array(
	'Faqs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create FAQ';?> 

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>