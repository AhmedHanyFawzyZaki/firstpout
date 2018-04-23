<div id="timeline-board" class="page-wrap">
    <div class="page-head">
        <h1 class="search-head">Friend Requests</h1>
    </div>
    <!-- /.page-head -->
    <section class="page-contain friends-manager-wrap">
        <!-- /.list-overview -->
        
        <div id="tabs">
            <div id="friends-manager">
                <?php
                    if($requests){
                        foreach ($requests as $us){
							$friends=UserFriend::model()->findAll(array('condition'=>'(friend_id=' . $us->user_id . ' OR user_id=' . $us->user_id . ')  and approved=1'));
							$his_fr=array();
							$mutual=array();
							if($friends){
								foreach($friends as $fr){
									if($fr->user_id==$us->user_id){
										$his_fr[]=$fr->friend_id;
									}else{
										$his_fr[]=$fr->user_id;
									}
								}
								$mutual=UserFriend::model()->findAll(array('condition'=>'(friend_id=' . Yii::app()->user->id . ' and user_id in ('.implode(',',$his_fr).') and approved=1) OR (user_id=' . Yii::app()->user->id . ' and friend_id in ('.implode(',',$his_fr).')  and approved=1)'));
							}
                ?>
                <div class="friend-wrap user-search-btn-<?=$us->user_id?>" id="user-search-btn-<?=$us->user_id?>">
                    <div class="friend-card search-card">
                        <img src="<?=$us->user->image?$us->user->image:Yii::app()->params['default_profile_pic']?>" width="60" height="60" alt="" class="friend-thumb pull-left" />
                        <div class="friend-overview pull-left">
                            <h3 class="friend-name"><?=$us->user->username;?></h3>
                            <span class="friend-connection"><b style="font-weight:800;"><?=count($friends)?></b> friend(s) - <b style="font-weight:800;"><?=count($mutual)?></b> mutual friend(s)</span>
                            <span class="friend-connection topMargin10"><?=$us->user->active?'Verified':'Unverified'?> account</span>
                        </div>
                        <div class="pull-right btn-search">
                        	<?php
								echo '<button class="src-btn yellow" onclick="accept('.$us->user_id.')">ACCEPT</button><div class="arrow" onclick="$(\'#reject_fr_'.$us->user_id.'\').toggle()"><span class="arrow-down-yellow"></span></div><span class="src-btn red reject" style="display:none;" id="reject_fr_'.$us->user_id.'" onclick="reject('.$us->user_id.')">Reject</span>';
							?>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    }else{
                        echo '<div class="friend-wrap">
                    <div class="friend-card search-card">
					No friend requests received.</div>
                </div>';
                    }
                ?>
            </div>
            <!-- /#friends-manager -->
        </div>
    </section>
    <!-- /.page-contain -->
</div>