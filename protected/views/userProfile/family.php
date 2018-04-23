<div id="timeline-board" class="page-wrap">
    <?php
    	$this->renderPartial('top-navigation',array('id'=>$id));
	?>
    <!-- /.page-head -->
    <section class="page-contain">
        <div class="baby-profile-wrap">
            <div class="profile-cover">
                <img src="<?= $model->image?$model->image:Yii::app()->params['default_banner_image'] ?>" alt="<?= $model->username ?>" class="profile-img" width="560" height="308"/>
                <h1 class="baby-name"><?=$model->username?></h1>
            </div>
            <!-- /.profile-cover -->
            <div class="family-block">
                <div class="primary-group-members">
                    <div class="group-members">
						<style>
                            .baby-profile-wrap .person-card .person-thumb, .baby-profile-wrap .person-card .person-overview{
                                vertical-align:middle !important;
                            }
                        </style>
                        <!--<h3 class="group-title">Friends:</h3>-->
						<?php
                            if($friends){
                                foreach($friends as $member){
									if($member->user_id==$id){
										$rel=$member->friend;
									}else{
										$rel=$member->user;
									}
									$member_friends=UserFriend::model()->findAll(array('condition'=>'(friend_id=' . $rel->id . ' OR user_id=' . $rel->id . ')  and approved=1'));
									$isMutual=UserFriend::model()->findAll(array('condition'=>'(friend_id=' . $rel->id . ' and user_id='.Yii::app()->user->id.' and approved=1) OR (user_id=' . $rel->id . ' and friend_id='.Yii::app()->user->id.' and approved=1)'));
                                    ?>
                                    <div class="person-card">
                                        <img src="<?= $rel->image ?>" width="60" alt="<?= $rel->username ?>" class="person-thumb" />
                                        <div class="person-overview">
                                            <h3 class="person-name"><?= $rel->username ?></h3>
                                            <span class="person-connection"><?=count($member_friends)?> friends <?=count($isMutual)>0?' (Mutual friend)':''?></span>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }else{
								echo 'No friends found.';
							}
                        ?>
					</div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.page-contain -->
</div>