<?php
$this->breadcrumbs=array(
	'Albums'=>array('index'),
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
	$.fn.yiiGridView.update('album-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->pageTitlecrumbs = 'Manage Albums';?>

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
	'id'=>'album-grid',
	'type'=>'striped  condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'title',
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>'$data->user->username?$data->user->username:"<span style=\"color:red\">Baby Album</span>"',
			'type'=>'raw',
			'filter'=>Helper::ListUsers(),
		),
		'baby_id'=>array(
			'name'=>'baby_id',
			'value'=>'$data->baby->username?$data->baby->username:"<span style=\"color:red\">User Album</span>"',
			'type'=>'raw',
			'filter'=>Helper::ListBaby(),
		),
		'date_of_album',
		//'date_updated',
		'date_created',
		//'pic_date',
		//'private',
		//'belong_to_me',
		/*
		'baby_id',
		'desc',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
