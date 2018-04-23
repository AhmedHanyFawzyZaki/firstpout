<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'Update','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Product "'. $model->title.'"'; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>$model->user->username,
		),
		'title',
		'category_id'=>array(
			'name'=>'category_id',
			'value'=>$model->category->title,
		),
		'sell_donate'=>array(
			'name'=>'sell_donate',
			'value'=>Helper::GetStatus($model->sell_donate,'Donate','Sell'),
		),
		'date_of_product',
		'price',
		'city',
		'full_name',
		'email',
		'phone',
		//'comunicator',
		//'comunicator2',
		'desc',
		'use_msg_only'=>array(
			'name'=>'use_msg_only',
			'value'=>Helper::GetStatus($model->use_msg_only,'Yes','No'),
		),
		'approved'=>array(
			'name'=>'approved',
			'value'=>Helper::GetStatus($model->approved,'Yes','No'),
		),
		'sold'=>array(
			'name'=>'sold',
			'value'=>Helper::GetStatus($model->sold,'Yes','No'),
		),
		'date_sold',
		'date_updated',
		'date_updated',
	),
)); ?>

<!--Product Images-->
<div class="clear topMargin30">
    <header class="acc_col_head navy-bg">
        <div class="icons"><i class="icon-eye-open"></i></div>
        <h5>Product Images</h5>
        <div class="toolbar">
            <ul class="nav">
                <li class="widthAuto">
                    <a class="fancyElm" href="<?=Yii::app()->request->baseUrl?>/productImage/create?id=<?=$model->id?>">
                        <i class="icon-plus-sign-alt"></i>
                    </a>
                </li>
                <li class="widthAuto">
                    <a href="#im" data-toggle="collapse" class="accordion-toggle minimize-box collapsed">
                        <i class="icon-chevron-down"></i>
                    </a>
                </li>
            </ul>
        </div>
    </header>
    
    <?php
	$imageUrl=Yii::app()->request->baseUrl.'/media/products/';
	?>

    <div class="collapse" style="height: 0px;" id="im">
    	<?php $this->widget('bootstrap.widgets.TbGridView',array(
			'id'=>'contest-user-image-grid',
			'type'=>'striped  condensed',
			'dataProvider'=>new CActiveDataProvider('ProductImage', array(
				'criteria' => array('condition'=>'product_id='.$model->id),
			)),
			'columns'=>array(
				'image'=>array(
					'name'=>'image',
					'type'=>'raw',
					'value'=>'CHtml::image("'.$imageUrl.'$data->image","No Image", array("style"=>"width:150px"))',
				),
				'main_image'=>array(
					'name'=>'main_image',
					'value'=>'Helper::getStatus($data->main_image)',
				),
			),
		)); ?>
    </div>
</div>