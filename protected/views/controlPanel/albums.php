<div id="timeline-board" class="page-wrap">
    <?php
    if ($id) {
        $this->renderPartial('top-navigation', array('id' => $id));
    } else {
        ?>
        <div class="page-head">
            <div class="page-actions family-tabs">
                <a href="<?= Yii::app()->request->baseUrl ?>/home" class="back">Back</a>
                <!--<a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/editProfile">My Profile</a>
                <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/linkSocial">Social Accounts</a>-->
                <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/albums" class="current">Albums</a>
                <a></a>
                <!--<a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/createAlbum" class="more-options">More</a>-->
            </div>
        </div>
        <?php
    }
    ?>
    <!-- /.page-head -->
    <section class="page-contain">
        <div class="baby-profile-wrap">
            <div class="profile-cover">
                <?php
                if (strtolower(Yii::app()->controller->id) == 'controlpanel') {
                    $banner_img = User::model()->findByPk(Yii::app()->user->id)->banner;
                    $username = User::model()->findByPk(Yii::app()->user->id)->username;
                } elseif (strtolower(Yii::app()->controller->id) == 'userprofile') {
                    $banner_img = User::model()->findByPk($id)->banner;
                    $username = User::model()->findByPk($id)->username;
                } else {
                    $banner_img = Baby::model()->findByPk($id)->banner;
                    $username = Baby::model()->findByPk($id)->username;
                    ?>
                    <img src="<?= $banner_img ? $banner_img : Yii::app()->params['default_banner_image'] ?>" alt="<?= $username ?>" class="profile-img" width="560" height="308" />
                    <h1 class="baby-name"><?= $username ?></h1>
                    <?php
                }
                ?>
            </div>
            <!-- /.profile-cover -->
            <div class="albums-list-wrap">
                <div class="list-overview page-head">
                    <div class="page-actions normal-tabs filter-wrap">
                        <div class="filter-inner">
                            <select onchange="window.location = '?filter=' + this.value" id="filter-contests" class="form-select">
                                <option value="1">Recently Added</option>
                                <option value="2" <?= (isset($_REQUEST['filter']) && $_REQUEST['filter'] == '2') ? 'selected="selected"' : '' ?>>Date of Albums (ASC)</option>
                                <option value="3" <?= (isset($_REQUEST['filter']) && $_REQUEST['filter'] == '3') ? 'selected="selected"' : '' ?>>Date of Albums (DESC)</option>
                                <option value="4" <?= (isset($_REQUEST['filter']) && $_REQUEST['filter'] == '4') ? 'selected="selected"' : '' ?>>Show all albums</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.list-overview -->
                <div class="albums-list">
                    <?php
                    if ($albums) {
                        foreach ($albums as $i => $album) {
                            $main_image = AlbumImage::model()->findByAttributes(array('album_id' => $album->id, 'main_pic' => 1));
                            if ($i % 2 == 0 && $i != 0)
                                $class = 'no-marge';
                            else
                                $class = '';
                            if ($album->private)
                                $album_color = 'red';
                            elseif ($album->belong_to_me)
                                $album_color = 'yellow';
                            elseif ($album->pic_date)
                                $album_color = 'blue';
                            else
                                $album_color = 'green';
                            
                            $media_url=Yii::app()->request->baseUrl.'/media/albums/'.$main_image->image;
                            ?>
                            <div class="item-wrap <?= $class ?>">
                                <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/viewAlbum/<?= $album->id ?>" class="item-thumb">
                                    <img src="<?=$main_image->image?$media_url: Yii::app()->params['default_profile_pic']?>" alt="<?= $main_image->title ?>" width="270" height="200" />
                                </a>
                                <div class="item-overview <?= $album_color ?>">
                                    <h3 class="item-title"><?= $album->title ?></h3>
                                    <?php
                                    if (($album->user_id == Yii::app()->user->id) || Baby::IsBabyAccess($album->baby_id, Yii::app()->user->id) || Group::IsGroupAdmin($album->group_id, Yii::app()->user->id)) {
                                        ?>
                                        <div class="item-actions">
                                            <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/editAlbum/<?= $album->id ?>" class="item-edit">
                                                <span>Edit album</span>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo 'No Albums Found';
                    }
                    ?>
                </div>
            </div>


        </div>
    </section>
    <!-- /.page-contain -->
</div>