<?php
$this->breadcrumbs=array(
	'Groups'=>array('index'),
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
	$.fn.yiiGridView.update('group-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->pageTitlecrumbs = 'Manage Groups';?>

<!--<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'group-grid',
	'type'=>'striped  condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'title',
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>'$data->user->username',
			'type'=>'raw',
			'filter'=>Helper::ListUsers(),
		),
		//'category',
		'date_created',
		'category'=>array(
			'name'=>'category',
			'value'=>'$data->category0->title',
			'type'=>'raw',
			'filter'=>CHtml::listData(GroupCategory::model()->findAll(),'id','title'),
		),
		'privacy'=>array(
			'name'=>'privacy',
			'value'=>'Helper::GetStatus($data->privacy,"Private","Public")',
			'filter'=>array("0"=>'Public','1'=>'Private'),
		),
		'image'=>array(
			'header'=>'image',
			'type'=>'html',
			'filter'=>'',
			'value'=>'(!empty($data->image))?CHtml::image($data->image,"",array("style"=>"width:100px;height:75px;")):"No image"',
		),
		
		//'banner',
		/*
		'other',
		'user_id',
		'date_created',
		'date_updated',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
