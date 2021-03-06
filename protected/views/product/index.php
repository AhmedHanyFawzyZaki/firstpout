<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
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
	$.fn.yiiGridView.update('product-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->pageTitlecrumbs = 'Manage Products';?>

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
	'id'=>'product-grid',
	'type'=>'striped  condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'title',
		'category_id'=>array(
			'name'=>'category_id',
			'value'=>'$data->category->title',
			'filter'=>CHtml::listData(ProductCategory::model()->findAll(),'id','title'),
		),
		'sell_donate'=>array(
			'name'=>'sell_donate',
			'value'=>'Helper::GetStatus($data->sell_donate,"Donate","Sell")',
			'filter'=>array('0'=>'Sell','1'=>'Donate')
		),
		'price',
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>'$data->user->username',
			'filter'=>Helper::ListUsers(),
		),
		/*
		'date_of_product',
		'city',
		'full_name',
		'email',
		'use_msg_only',
		'phone',
		'comunicator',
		'comunicator2',
		'desc',
		'approved',
		'sold',
		'date_created',
		'date_updated',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
