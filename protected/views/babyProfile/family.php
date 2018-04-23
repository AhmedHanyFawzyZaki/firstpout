<div id="timeline-board" class="page-wrap">
    <?php
    $this->renderPartial('top-navigation', array('id' => $id));
    ?>
    <!-- /.page-head -->
    <section class="page-contain">
        <div class="baby-profile-wrap">
            <div class="profile-cover">
                <img src="<?= $model->banner?$model->banner:Yii::app()->params['default_banner_image'] ?>" alt="<?= $model->username ?>" class="profile-img" width="560" height="308" />
                <h1 class="baby-name"><?= $model->username ?></h1>
            </div>
            <!-- /.profile-cover -->
            <h2 class="block-title">Family members:</h2>
            <div class="family-block">
                <?php
                if ($connection_cats) {
                    foreach ($connection_cats as $i => $cat) {
                        $class = $i == 0 ? 'parents' : '';
                        $family = BabyFamily::model()->findAllBySql('select * from '.BabyFamily::model()->tableSchema->name.' where baby_id=' . $id . ' and connection_id in (select id from '.Connection::model()->tableSchema->name.' where category_id=' . $cat->id . ') ');
                        ?>
                        <div class="primary-group-members">
                            <div class="group-members <?= $class ?>">
                                <h3 class="group-title"><?= $cat->title ?>:</h3>
                                <?php
                                if ($family) {
                                    foreach ($family as $member) {
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
                                } else {
                                    echo 'There is no ' . $cat->title . ' added to this profile.';
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
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