<div id="timeline-board" class="page-wrap">
    <?php
    $this->renderPartial('top-navigation', array('id' => $id));
    ?>
    <!-- /.page-head -->
    <section class="page-contain">
        <div class="baby-profile-wrap">
            <div class="profile-cover">
                <img src="<?= $model->banner?$model->banner:Yii::app()->params['default_banner_image'] ?>" alt="<?= $model->username ?>" class="profile-img" width="560" height="308"/>
                <h1 class="baby-name"><?= $model->username ?></h1>
            </div>
            <!-- /.profile-cover -->
            <div class="baby-infos">
                <div class="pull-right width50perc">
                    <div class="baby-info family">
                        <span class="info-label">Family members:</span>
                        <ul class="family-members">
                            <?php
                            if ($family) {
                                foreach ($family as $member) {
                                    ?>
                                    <li class="person-card">
                                        <img src="<?= $member->user->image ?>" width="50" class="person-thumb" />
                                        <div class="person-overview">
                                            <h3 class="person-name"><?= $member->user->username ?></h3>
                                            <span class="person-connection"><?= $member->connection->title ?></span>
                                        </div>
                                    </li>
                                    <?php
                                }
                            } else {
                                echo '<li><strong class="info-value">No family members added.</strong></li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="baby-info doctor">
                        <span class="info-label">Doctor:</span>
                        <?php
                        if ($doctors) {
                            foreach ($doctors as $doc) {
                                echo '<p><strong class="info-value">' . $doc->doctor->username . ' <!--<a href="#">Visit doctor profile</a>--></strong><p>';
                            }
                        } else {
                            echo '<p><strong class="info-value">No doctors assigned.</strong></p>';
                        }
                        ?>
                    </div>
                </div>
                <div class="pull-left width50perc">
                    <div class="baby-info age">
                        <span class="info-label">Child age:</span>
                        <strong class="info-value"><?= Helper::age($model->date_of_birth) ?></strong>
                    </div>
                    <div class="baby-info pregnacytime">
                        <span class="info-label">Pregnancy time:</span>
                        <strong class="info-value"><?= explode('-', $model->date_of_pergacy)[0] ?> months <?= explode('-', $model->date_of_pergacy)[1] ?> days</strong>
                    </div>
                    <div class="baby-info dob">
                        <span class="info-label">Date of birth:</span>
                        <strong class="info-value"><?= date('d, F, Y', strtotime($model->date_of_birth)) ?></strong>
                    </div>
                    <div class="baby-info birthplace">
                        <span class="info-label">Birth place:</span>
                        <strong class="info-value"><?= $model->birth_place ?></strong>
                    </div>
                    <div class="baby-info gender <?= $model->gender == 2 ? 'girl' : 'boy' ?>">
                        <span class="info-label">Gender:</span>
                        <strong class="info-value"><?= $model->gender == 2 ? 'Female' : 'Male' ?></strong>
                    </div>
                    <div class="baby-info sign">
                        <span class="info-label">Baby sun sign:</span>
                        <strong class="info-value"><?= $model->sunSign->title ?> </strong>
                        <img src="<?= Yii::app()->request->baseUrl ?>/media/sunsign/<?= $model->sunSign->image ?>" alt="" class="baby-sign">
                    </div>
                </div>
                <div class="baby-info adress">
                    <span class="info-label">Address:</span>
                    <strong class="info-value"><?= $model->user->street ?>, <?= $model->user->city ?>, <?= $model->user->country ?></strong>
                </div>
            </div>
            <!-- /.baby-infos -->
        </div>
    </section>
    <!-- /.page-contain -->
</div>