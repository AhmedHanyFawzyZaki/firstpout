<div id="timeline-board" class="page-wrap">
    <div class="page-head">
        <div class="page-actions normal-tabs">
            <h2 class="page-title"><?php echo date('F', strtotime($contest->date_start)) ?> Contest</h2>
        </div>
    </div>
    <!-- /.page-head -->
    <section class="contest-contain">
        <?php $this->renderPartial('contest_header')?>
        <!-- /.contest-wrap -->
        <div class="page-head">
            <div class="page-actions normal-tabs filter-wrap">
                <h2 class="filter-title">Latest added submitions</h2>
                <div class="filter-inner">
                    <select onchange="window.location = '?filter=' + this.value" id="filter-contests" class="form-select">
                        <option value="1">Recently Added</option>
                        <option value="2" <?=(isset($_REQUEST['filter']) && $_REQUEST['filter']=='2')?'selected="selected"':''?>>Todays entry</option>
                        <option value="3" <?=(isset($_REQUEST['filter']) && $_REQUEST['filter']=='3')?'selected="selected"':''?>>This week entries</option>
                        <option value="4" <?=(isset($_REQUEST['filter']) && $_REQUEST['filter']=='4')?'selected="selected"':''?>>Show all entries</option>
                    </select>
                </div>
            </div>
        </div>
        <!-- /.page-head -->
        <div class="contests-list">
            <?php
            if ($recent_entries) {
                foreach ($recent_entries as $vo) {
                    $main_img = ContestUserImage::model()->find(array('condition' => 'main_pic=1 and contest_user_id="' . $vo->id . '"'));
					$votes=ContestUserVote::model()->count(array('condition'=>'contest_user_id='.$vo->id));
					$likes=ContestUserLike::model()->count(array('condition'=>'contest_user_id='.$vo->id));
                    ?>
                    <div class="contest-item">
                        <a href="<?=Yii::app()->request->baseUrl?>/home/viewContest/<?=$vo->id?>" class="contest-thumb">
                            <!--<img src="<?= Yii::app()->request->baseUrl ?>/media/contests/contest<?= $contest->id ?>/<?= $vo->user_id ?>/<?= $main_img->image ?>" alt="<?= $main_img->title ?>" />-->
                            <img src="<?= Yii::app()->request->baseUrl ?>/media/contests/<?= $main_img->image ?>" alt="<?= $main_img->title ?>" />
                        </a>
                        <div class="contest-details">
                            <a href="<?= Yii::app()->request->baseUrl ?>/babyProfile/info/<?= $vo->baby_id ?>" class="author-thumb">
                                <img src="<?= $vo->baby->image ?>" alt="" width="50"/>
                            </a>
                            <div class="wrap-addons">
                                <strong class="author-name"><?=$vo->baby->username?></strong>
                                <span class="comments-count" style="cursor:pointer;" onclick="ContestVote(<?=$vo->id?>)" id="cot-vo-<?=$vo->id?>"><?= $votes ?></span>
                                <span class="likes-count" style="cursor:pointer;" onclick="ContestLike(<?=$vo->id?>)" id="cot-li-<?=$vo->id?>"><?= $likes ?></span>
                            </div>
                        </div>
                    </div>
        <?php
    }
}else{
		echo '<div class="ui-notification"><p>No contest entries added.</p></div>';
	}
?>
        </div>
    </section>
    <!-- /.page-contain -->
</div>

<script>
	function ContestVote(id){
		$.ajax({
			url:"<?=Yii::app()->request->baseUrl?>/home/contestVote/"+id,
			success: function(data){
				$('#cot-vo-'+id).html(data);
			}
		});
	}
	function ContestLike(id){
		$.ajax({
			url:"<?=Yii::app()->request->baseUrl?>/home/contestLike/"+id,
			success: function(data){
				$('#cot-li-'+id).html(data);
			}
		});
	}
</script>