<div class="album-lightbox">
    <div class="album-wrap">
        <h2 class="album-title"><?= $album->title ?></h2>
        <div id="album-photos" class="photos-wrap">
            <?php
                $media_url=Yii::app()->request->baseUrl.'/media/albums';
            ?>
            <div class="active-media">
                <a style="position: absolute;" href="javascript:void(0)" class="show-full-screen">Full Screen</a>
                <img src="<?=$media_url?>/<?= $main_image->image ?>" alt="<?= $main_image->title ?>" class="current-media" id="current-media" />
            </div>
            <div id="list-medias" class="list-medias custom-scroll">
                <?php
                if ($images) {
                    foreach ($images as $image) {
                        ?>
                        <a href="<?=$media_url?>/<?= $image->image ?>" class="album-img">
                            <img src="<?=$media_url?>/<?= $image->image ?>" alt="<?= $image->title ?>">
                        </a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="album-overview">
            <div class="albums-details">
                <!--<h3 class="album-title">Litlle princess in her best pose</h3>-->
                <p><?= $album->desc ?></p>
            </div>
            <div class="albums-stats">
                <a href="#" class="album-likes"><i></i><?= count($favs) ?></a>
                <a href="#" class="album-comments"><i></i><?= count($comments) ?></a>
            </div>
        </div>
    </div>
</div>