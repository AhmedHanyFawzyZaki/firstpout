<?php
$this->breadcrumbs=array(
	'Contest Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'Update','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View ContestUser #'. $model->id; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'contest_id'=>array(
			'name'=>'contest_id',
			'value'=>$model->contest->title,
		),
		'user_id'=>array(
			'name'=>'user_id',
			'value'=>$model->user->username,
		),
                'baby_id'=>array(
			'name'=>'baby_id',
			'value'=>$model->baby->username,
		),
		'desc',
		'date_joined',
		'num_of_votes',
                'num_of_likes',
		'winner'=>array(
			'name'=>'winner',
			'type'=>'raw',
			'value'=>'"<span style=\"color:red\">'.Helper::GetStatus($model->winner,"Winner","No").'</span>"',
		),
	),
)); ?>

<!--Album Images-->
<div class="clear topMargin30">
    <header class="acc_col_head navy-bg">
        <div class="icons"><i class="icon-eye-open"></i></div>
        <h5>Participant Photos</h5>
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
	//$imageUrl=Yii::app()->request->baseUrl.'/media/contests/contest'.$model->contest_id.'/'.$model->user_id.'/';
	$imageUrl=Yii::app()->request->baseUrl.'/media/contests/';
	?>

    <div class="collapse" style="height: 0px;" id="fr">
    	<?php $this->widget('bootstrap.widgets.TbGridView',array(
			'id'=>'contest-user-image-grid',
			'type'=>'striped  condensed',
			'dataProvider'=>new CActiveDataProvider('ContestUserImage', array(
				'criteria' => array('condition'=>'contest_user_id='.$model->id),
			)),
			'columns'=>array(
				'title',
				'desc',
				'image'=>array(
					'name'=>'image',
					'type'=>'raw',
					'value'=>'CHtml::image("'.$imageUrl.'$data->image","No Image", array("style"=>"width:150px"))',
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