<div id="timeline-board" class="page-wrap">
    <?php
    	$this->renderPartial('top-navigation',array('id'=>$id));
	?>
    <!-- /.page-head -->
    <section class="page-contain">
        <div class="baby-profile-wrap">
            <?php
            	$this->renderPartial('group-banner', array('id'=>$id, 'model'=>$model));
			?>
            <div class="baby-infos">
                <div class="baby-info pull-left">
                    <span class="info-label">Creation Date:</span>
                    <strong class="info-value"><?=date('d F Y',strtotime($model->date_created))?></strong>
                </div>
                <div class="baby-info pull-right">
                    <span class="info-label">Group Category:</span>
                    <strong class="info-value"><?=$model->category0->title?></strong>
                </div>
                <div class="baby-info pull-left">
                    <span class="info-label">Information:</span>
                    <p class="Margin20TopBottom"><?=$model->other?$model->other:'No more information provided about this group.'?></p>
                </div>
                <div class="baby-info pull-right">
                    <span class="info-label">Members: <strong class="info-value"><?=$members_no?> Member<?=Helper::plural($members_no)?></strong></span>
                    <ul class="family-members">
                    	<?php
                        	if($group_users){
								foreach($group_users as $member){
									?>
                                    <li class="person-card padd10">
                                        <img src="<?=$member->user->image?>" width="50" class="person-thumb" />
                                        <div class="person-overview">
                                            <h3 class="person-name"><?=$member->user->username?></h3>
                                            <span class="person-connection"><?=$member->connection->title?></span>
                                        </div>
                                    </li>
                                    <?php
								}
							}
						?>
                    </ul>
                    <br><br>
                    <a href="<?=Yii::app()->request->baseUrl?>/groups/members/<?=$id?>" class="info-label small-text"><strong class="padd10">View all</strong></a>
                </div>
                <!--<div class="baby-info adress">
                    <span class="info-label">Adress:</span>
                    <strong class="info-value">Biskupice Wlkp. 62-007, <br />ul. Cicha 23</strong>
                </div>-->
            </div>
            <!-- /.baby-infos -->
        </div>
    </section>
    <!-- /.page-contain -->
</div>