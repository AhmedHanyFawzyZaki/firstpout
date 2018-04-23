<?php
$this->breadcrumbs=array(
	'Albums'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'Update','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Album "'. $model->title.'"'; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'date_of_album',
		'pic_date'=>array(
			'name'=>'pic_date',
			'value'=>Helper::GetStatus($model->pic_date),
		),
		'private'=>array(
			'name'=>'private',
			'value'=>Helper::GetStatus($model->private),
		),
		'belong_to_me'=>array(
			'name'=>'belong_to_me',
			'value'=>Helper::GetStatus($model->pic_date),
		),
		'baby_id'=>array(
			'name'=>'baby_id',
			'value'=>$model->baby->username,
		),
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>$model->user->username,
		),
		'date_updated',
		'desc',
		'date_created',
	),
)); ?>

<!--Album Images-->
<div class="clear topMargin30">
    <header class="acc_col_head navy-bg">
        <div class="icons"><i class="icon-eye-open"></i></div>
        <h5><?=$model->title?>'s Photos</h5>
        <div class="toolbar">
            <ul class="nav">
                <!--<li class="widthAuto">
                    <a class="fancyElm" href="<?=Yii::app()->request->baseUrl?>/UserFriend/create?user=<?=$model->id?>">
                        <i class="icon-plus-sign-alt"></i>
                    </a>
                </li>-->
                <li class="widthAuto">
                    <a href="#fr" data-toggle="collapse" class="accordion-toggle minimize-box collapsed">
                        <i class="icon-chevron-down"></i>
                    </a>
                </li>
            </ul>
        </div>
    </header>
    
    <?php
	$imageUrl=Yii::app()->request->baseUrl.'/media/albums/';
	?>

    <div class="collapse" style="height: 0px;" id="fr">
    	<?php $this->widget('bootstrap.widgets.TbGridView',array(
			'id'=>'album-image-grid',
			'type'=>'striped  condensed',
			'dataProvider'=>new CActiveDataProvider('AlbumImage', array(
				'criteria' => array('condition'=>'album_id='.$model->id),
			)),
			'columns'=>array(
				'title',
				'desc',
				'image'=>array(
					'name'=>'image',
					'type'=>'raw',
					'value'=>'CHtml::image(AlbumImage::GetLink($data->album_id).$data->image,"No Image", array("style"=>"width:150px"))',
				),
				'main_pic'=>array(
					'name'=>'main_pic',
					'value'=>'Helper::getStatus($data->main_pic)',
				),
				'date_taken',
			),
		)); ?>
    </div>
</div>
