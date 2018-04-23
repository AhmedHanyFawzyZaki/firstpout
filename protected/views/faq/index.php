<?php
$this->breadcrumbs=array(
'Faqs'=>array('index'),
'Manage',
);

$this->menu=array(
array('label'=>'List','url'=>array('index')),
array('label'=>'Create','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('faq-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->pageTitlecrumbs = 'Manage FAQs';?> 


<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'faq-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
	'question',
	'answer',
	array(
		'class'=>'bootstrap.widgets.TbButtonColumn',
	),
),
)); ?>
