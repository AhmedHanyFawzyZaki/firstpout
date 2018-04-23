<?php
    $contest=Contest::model()->find(array('condition'=>'active=1'));
?>
<div class="contest-wrap">
    <a href="<?=Yii::app()->request->baseUrl?>/home/contest" class="contest-cover">
        <!--<img src="<?=Yii::app()->request->baseUrl?>/media/contests/contest<?=$contest->id?>/<?=$contest->image?>" alt="" />-->
        <img src="<?=Yii::app()->request->baseUrl?>/media/contests/<?=$contest->image?>" alt="" />
    </a>
    <!-- /.contest-cover -->
    <div class="contest-overview">
        <span class="contest-price">1st place price</span>
        <span class="contest-details">
            <h1 class="contest-title">
                <a href="<?=Yii::app()->request->baseUrl?>/home/contest"><?=$contest->title?></a>
            </h1>
            <p class="contest-description"><?=$contest->desc?></p>
        </span>
        <span class="contest-timing">
            <strong><?php echo round((strtotime($contest->date_end)-time())/(60*60*24))?></strong>
            days left
        </span>
    </div>
    <!-- /.contest-overview -->
    <div class="contest-stats">
        <span class="stats-label">There is:</span>
        <span class="stats-info"><strong><?=count(ContestUser::model()->findAll(array('condition'=>'contest_id="'.$contest->id.'"')));?></strong>Users</span>
        <span class="stats-info"><strong><?=count(ContestUserImage::model()->findAllBySql('select * from '.ContestUserImage::model()->tableSchema->name.' where contest_user_id in ( select id from '.ContestUser::model()->tableSchema->name.' where contest_id="'.$contest->id.'")'));?></strong>Entries</span>
        <span class="stats-info"><strong><?php
                $votes=ContestUser::model()->findAll(array('condition'=>'contest_id="'.$contest->id.'"'));
                        $num_of_votes=0;
                        if($votes)
                        {
                                foreach($votes as $vo){
                                        $num_of_votes+=ContestUserVote::model()->count(array('condition'=>'contest_user_id='.$vo->id));
                                }
                        }
                        echo $num_of_votes;
                        ?></strong>Votes</span>
        <a href="<?=Yii::app()->request->baseUrl?>/home/contestEntry" class="contest-link">Enter contest!</a>
    </div>
    <!-- /.contest-stats -->
</div>