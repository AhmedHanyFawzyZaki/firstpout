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
                <div style="position:absolute;right:30px;bottom:20px;" id="btn-fr">
                <?php
				if($id!=Yii::app()->user->id){
					$ismyfriend = UserFriend::model()->find(array('condition' => '(friend_id=' . $id . ' and user_id=' . Yii::app()->user->id . ') OR (user_id=' . $id . ' and friend_id=' . Yii::app()->user->id . ')'));
					if($ismyfriend){
						if($ismyfriend->approved){
							echo '<a href="javascript:void(0)" onclick="unfriend(' . $id . ')">Unfriend</a>';
						}else{
							echo '<a href="javascript:void(0)" onclick="uninvite(' . $id . ')">Remove Request</a>';
						}
					}else{
						echo '<a href="javascript:void(0)" onclick="invite(' . $id . ')">Add Friend</a>';
					}
				}
				?>
                </div>
            </div>
            <!-- /.profile-cover -->
            <div class="baby-infos">
                <div class="baby-info pull-left">
                    <span class="info-label">Full Name:</span>
                    <strong class="info-value"><?=$model->fname.' '.$model->lname?></strong>
                </div>
                <div class="baby-info pull-right">
                    <span class="info-label">Gender:</span>
                    <strong class="info-value"><?=$model->gender==2?'Female':'Male'?></strong>
                </div>
                <div class="baby-info pull-left">
                    <span class="info-label">Date of birth:</span>
                    <strong class="info-value"><?=date('d F Y',strtotime($model->date_of_birth))?></strong>
                </div>
                <div class="baby-info pull-right">
                    <span class="info-label">Phone no.:</span>
                    <strong class="info-value"><?=$model->phone?></strong>
                </div>
                <div class="baby-info adress">
                    <span class="info-label">Address:</span>
                    <strong class="info-value"><?=$model->street?>, <?=$model->city?>, <?=$model->post_code?><br /><?=$model->count->country_name?></strong>
                </div>
                <div class="baby-info pull-right">
                	<?php
                    	$babies=Baby::model()->findAllBySql('select * from '.Baby::model()->tableSchema->name.' where user_id="' . $id . '" or id in (select baby_id from '.BabyAccessRole::model()->tableSchema->name.' where user_id="' . $id . '" and role="1")');
					?>
                    <span class="info-label">Members: <strong class="info-value"><?=count($babies)?> Member<?=Helper::plural(count($babies))?></strong></span>
                    <ul class="family-members">
                    	<?php
                        	if($babies){
								foreach($babies as $baby){
									?>
                                    <li class="person-card padd10">
                                        <img src="<?=$baby->banner?$baby->banner:Yii::app()->params['default_banner_image']?>" width="48" height="48" class="person-thumb" />
                                        <div class="person-overview">
                                            <h3 class="person-name"><a href="<?=Yii::app()->request->baseUrl?>/babyProfile/index/<?=$baby->id?>"><?=$baby->username?></a></h3>
                                            <span class="person-connection" style="font-size:11px;"><?=Helper::age($baby->date_of_birth)?></span>
                                        </div>
                                    </li>
                                    <?php
								}
							}
						?>
                    </ul>
                </div>
                <div class="baby-info pull-left">
                    <span class="info-label">Information:</span>
                    <p class="Margin20TopBottom"><?=$model->desc?$model->desc:'No more information provided.'?></p>
                </div>
            </div>
            <!-- /.baby-infos -->
        </div>
    </section>
    <!-- /.page-contain -->
</div>


<script>
    function uninvite(id) {
        $.ajax({
            url: "<?= Yii::app()->request->baseUrl ?>/controlPanel/invite?id=" + id,
            success: function(data) {
                if (data) {
                    $('#btn-fr').html('<a href="javascript:void(0)" onclick="invite(' +id+ ')">Add Friend</a>');
                }
            }
        });
    }
    function invite(id) {
        $.ajax({
            url: "<?= Yii::app()->request->baseUrl ?>/controlPanel/invite?id=" + id,
            success: function(data) {
                if (data) {
                    $('#btn-fr').html('<a href="javascript:void(0)" onclick="uninvite(' +id+ ')">Remove Request</a>');
                }
            }
        });
    }
    function unfriend(id) {
        $.ajax({
            url: "<?= Yii::app()->request->baseUrl ?>/controlPanel/invite?id=" + id,
            success: function(data) {
                if (data) {
                    $('#btn-fr').html('<a href="javascript:void(0)" onclick="invite(' +id+ ')">Add Friend</a>');
                }
            }
        });
    }
</script>