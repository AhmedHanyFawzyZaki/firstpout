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
            <!-- /.profile-cover -->
            <div class="family-block">
                <div class="primary-group-members">
                    <div class="group-members">
                        <h3 class="group-title">Administrators:</h3>
                        <div class="person-card">
                            <img src="<?= $model->user->image ?>" width="50" alt="<?= $model->user->username ?>" class="person-thumb" />
                            <div class="person-overview">
                                <h3 class="person-name"><?= $model->user->username ?></h3>
                                <span class="person-connection">Group creator</span>
                            </div>
                        </div>
						<?php
                            if($group_admins){
                                foreach($group_admins as $member){
                                    ?>
                                    <div class="person-card">
                                        <img src="<?= $member->user->image ?>" width="50" alt="<?= $member->user->username ?>" class="person-thumb" />
                                        <div class="person-overview">
                                            <h3 class="person-name"><?= $member->user->username ?></h3>
                                            <span class="person-connection"><?= $member->connection->title ?></span>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        ?>
					</div>
                </div>
            </div>
            <div class="family-block">
                <div class="primary-group-members">
                    <div class="group-members">
                        <h3 class="group-title">Members:</h3>
						<?php
                            if($group_users){
                                foreach($group_users as $member){
                                    ?>
                                    <div class="person-card">
                                        <img src="<?= $member->user->image ?>" width="50" alt="<?= $member->user->username ?>" class="person-thumb" />
                                        <div class="person-overview">
                                            <h3 class="person-name"><?= $member->user->username ?></h3>
                                            <span class="person-connection"><?= $member->connection->title ?></span>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }else{
								echo 'No members found.';
							}
                        ?>
					</div>
                </div>
            </div>
            <!--<h2 class="block-title">Rest of family:</h2>
            <div class="family-block">
                <div class="secondary-group-members">
                    <div class="group-members">
                        <div class="person-card">
                            <img src="img/dyn/author-50x50.jpg" alt="" class="person-thumb" />
                            <div class="person-overview">
                                <h3 class="person-name">Sandra Dolata</h3>
                                <span class="person-connection">Wife</span>
                            </div>
                        </div>
                        <div class="person-card">
                            <img src="img/dyn/author-50x50.jpg" alt="" class="person-thumb" />
                            <div class="person-overview">
                                <h3 class="person-name">Sandra Dolata</h3>
                                <span class="person-connection">Wife</span>
                            </div>
                        </div>
                        <div class="person-card no-marge">
                            <img src="img/dyn/author-50x50.jpg" alt="" class="person-thumb" />
                            <div class="person-overview">
                                <h3 class="person-name">Sandra Dolata</h3>
                                <span class="person-connection">Wife</span>
                            </div>
                        </div>
                        <div class="person-card">
                            <img src="img/dyn/author-50x50.jpg" alt="" class="person-thumb" />
                            <div class="person-overview">
                                <h3 class="person-name">Sandra Dolata</h3>
                                <span class="person-connection">Wife</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="block-title">Family Friends:</h2>
            <div class="family-block">
                <div class="secondary-group-members">
                    <div class="group-members">
                        <div class="person-card">
                            <img src="img/dyn/author-50x50.jpg" alt="" class="person-thumb" />
                            <div class="person-overview">
                                <h3 class="person-name">Sandra Dolata</h3>
                                <span class="person-connection">Wife</span>
                            </div>
                        </div>
                        <div class="person-card">
                            <img src="img/dyn/author-50x50.jpg" alt="" class="person-thumb" />
                            <div class="person-overview">
                                <h3 class="person-name">Sandra Dolata</h3>
                                <span class="person-connection">Wife</span>
                            </div>
                        </div>
                        <div class="person-card no-marge">
                            <img src="img/dyn/author-50x50.jpg" alt="" class="person-thumb" />
                            <div class="person-overview">
                                <h3 class="person-name">Sandra Dolata</h3>
                                <span class="person-connection">Wife</span>
                            </div>
                        </div>
                        <div class="person-card">
                            <img src="img/dyn/author-50x50.jpg" alt="" class="person-thumb" />
                            <div class="person-overview">
                                <h3 class="person-name">Sandra Dolata</h3>
                                <span class="person-connection">Wife</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
    </section>
    <!-- /.page-contain -->
</div>