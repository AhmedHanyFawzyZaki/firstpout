<?php
$this->breadcrumbs=array(
	'Posts'=>array('index'),
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
	$.fn.yiiGridView.update('post-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->pageTitlecrumbs = 'Manage Posts';?>

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
	'id'=>'post-grid',
	'type'=>'striped  condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'content',
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>'$data->user->username?$data->user->username:"<span style=\"color:red\">Not Set</span>"',
			'type'=>'raw',
			'filter'=>Helper::ListUsers(),
		),
		'baby_id'=>array(
			'name'=>'baby_id',
			'value'=>'$data->baby->username?$data->baby->username:"<span style=\"color:red\">Not Set</span>"',
			'type'=>'raw',
			'filter'=>Helper::ListBaby(),
		),
		'group_id'=>array(
			'name'=>'group_id',
			'value'=>'$data->group->title?$data->group->title:"<span style=\"color:red\">Not Set</span>"',
			'type'=>'raw',
			'filter'=>CHtml::listData(Group::model()->findAll(),'id','title'),
		),
		'album_id'=>array(
			'name'=>'album_id',
			'value'=>'$data->album_id?"<a href=\''.Yii::app()->request->baseUrl.'/album/view/$data->album_id\'>View</a>":"<span style=\"color:red\">Not Set</span>"',
			'type'=>'raw',
			'filter'=>CHtml::listData(Group::model()->findAll(),'id','title'),
		),
		'date_created',
		//'content',
		/*
		'date_updated',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
