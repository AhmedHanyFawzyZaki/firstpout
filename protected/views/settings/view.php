<?php
$this->breadcrumbs=array(
	'Settings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Update','url'=>array('index','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'View Site Settings' ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(

		'ios_app_link',
		'android_app_link',
		'product_expiration_period',
		'email',
        array(
			'name'=>'image',
			'type'=>'raw',
			'value'=>CHtml::image(Yii::app()->request->baseUrl.'/media/'.$model->image,"No Set",array('width'=>200)),
		),
		array(
			'name'=>'default_profile_pic',
			'type'=>'raw',
			'value'=>CHtml::image(Yii::app()->request->baseUrl.'/media/'.$model->default_profile_pic,"No Set",array('width'=>180)),
		),
		array(
			'name'=>'default_banner_image',
			'type'=>'raw',
			'value'=>CHtml::image(Yii::app()->request->baseUrl.'/media/'.$model->default_banner_image,"No Set",array('width'=>490)),
		),		
	),
)); ?>
