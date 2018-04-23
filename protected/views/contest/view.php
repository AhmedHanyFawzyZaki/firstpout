<?php
$this->breadcrumbs=array(
	'Contests'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List','url'=>array('index')),
	array('label'=>'Create','url'=>array('create')),
	array('label'=>'Update','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<?php $this->pageTitlecrumbs = 'View Contest "'. $model->title.'"'; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'title',
		'desc',
		array(
			'name'=>'image',
			'type'=>'raw',
			//'value'=>CHtml::image(Yii::app()->request->baseUrl.'/media/contests/contest'.$model->id.'/'.$model->image,"no image",array('width'=>150)),
			'value'=>CHtml::image(Yii::app()->request->baseUrl.'/media/contests/'.$model->image,"no image",array('width'=>150)),
		),
		'price',
		'date_start',
		'date_end',
		'date_created',
		'date_updated',
		'active'=>array(
			'name'=>'active',
			'value'=>Helper::GetStatus($model->active,"Active","Not Active"),
		),
	),
)); ?>

<!--contest users and images-->
<div class="clear topMargin30">
    <header class="acc_col_head navy-bg">
        <div class="icons"><i class="icon-eye-open"></i></div>
        <h5><?=$model->title?> Participants</h5>
        <div class="toolbar">
            <ul class="nav">
                <li class="widthAuto">
                    <a class="fancyElm" href="<?=Yii::app()->request->baseUrl?>/contestUser/create?contest=<?=$model->id?>">
                        <i class="icon-plus-sign-alt"></i>
                    </a>
                </li>
                <li class="widthAuto">
                    <a href="#conu" data-toggle="collapse" class="accordion-toggle minimize-box collapsed">
                        <i class="icon-chevron-down"></i>
                    </a>
                </li>
            </ul>
        </div>
    </header>

    <div class="collapse" style="height: 0px;" id="conu">
    	<?php $this->widget('bootstrap.widgets.TbGridView',array(
			'id'=>'baby-access-role-grid',
                        'type'=>'striped  condensed',
			'dataProvider'=>new CActiveDataProvider('ContestUser', array(
				'criteria' => array('condition'=>'contest_id='.$model->id),
			)),
			'columns'=>array(
                            'contest_id'=>array(
                                    'name'=>'contest_id',
                                    'value'=>'$data->contest->title',
                                    'type'=>'raw',
                            ),
                            'user_id'=>array(
                                    'name'=>'user_id',
                                    'value'=>'$data->user->username',
                                    'type'=>'raw',
                            ),
                            'baby_id'=>array(
                                    'name'=>'baby_id',
                                    'value'=>'$data->baby->username?$data->baby->username:"<span style=\"color:red\">User Album</span>"',
                                    'type'=>'raw',
                                ),
                            'date_joined',
                            'num_of_votes',
                            'num_of_likes',
                            'winner'=>array(
                                    'name'=>'winner',
                                    'type'=>'raw',
                                    'value'=>'"<span style=\"color:red\">'.Helper::GetStatus($data->winner,"Winner","No").'</span>"',
                            ),
			),
		)); ?>
    </div>
</div>