<style>
	.img-comm-cont-span p:last-child{
		color:#000 !important;
	}
</style>
<div class="album-lightbox" style="width:590px;float:left;padding:0;">
    <div class="album-wrap" style="background:#FFF;width:540px;margin:0 auto;border-radius:5px;">
        <h2 class="album-title" style="color:#e74c3c;border-bottom:1px solid #f0f3f4;padding:10px 25px;font-size:16px;font-weight:bold;"><?= $model->baby->username ?>'s entry.</h2>
        <div id="album-photos" class="photos-wrap">
            <?php
                //$media_url=Yii::app()->request->baseUrl.'/media/contests/contest'.$model->contest_id.'/'.$model->user_id;
				$media_url=Yii::app()->request->baseUrl.'/media/contests';
            ?>
            <div class="active-media" style="width:500px;">
                <!--<a style="position: absolute;" href="javascript:void(0)" class="show-full-screen">Full Screen</a>-->
                <img src="<?=$media_url?>/<?= $main_image->image ?>" alt="<?= $main_image->title ?>" class="current-media" id="current-media" width="500" />
            </div>
            <div class="list-medias" style="width:100%;height:auto;">
                <?php
                if ($images) {
                    foreach ($images as $image) {
						ob_start();
						$this->widget('ext.SAImageDisplayer', array(
							'image' => $image->image,
							'size' => 'tiny',
							//'defaultImage' => 'default.png',
							'group' => 'contests',
						));
						$im = ob_get_contents();
                		ob_end_clean();
                        ?>
                        <a href="<?=Yii::app()->request->baseUrl?>/home/ViewImage?id=<?=$image->id?>&mode=ContestUserImage" class="album-img fancybox" style="float:left;width:95px;;margin:5px 6px 5px 0px;border:0px;">
                        	<?=$im?>
                            <!--<img src="<?=$media_url?>/<?= $image->image ?>" alt="<?= $image->desc ?>">-->
                        </a>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <?php
        	if($model->desc){
		?>
                <div class="album-overview">
                    <div class="albums-details">
                        <p><?= $model->desc ?></p>
                    </div>
                </div>
        <?php
			}
		?>
        <div class="album-overview">
            <div class="albums-details">
                <div class="right-cont">
                    <div style="margin-top: 20px;">
                        <div style="color:#3b5998;cursor: pointer;">
                            <span onclick="likeImage('ContestUser',<?= $model->id ?>)" id="al_like_unlike"><?= $i_liked ? 'Unlike' : 'Like' ?></span>
                            &nbsp;.&nbsp;
                            <span onclick="$('#al_img_reply').focus();">Comment</span>
                        </div>
                        <div style="width: 0; height: 0; border-left: 6px solid transparent; border-right: 6px solid transparent; border-bottom: 7px solid #e9eaed;margin-left: 20px;"></div>
                        <div class="like-cont clear" style="background:#e9eaed;padding:2px;color:#3b5998;display: table;width: 100%;border-bottom: 1px solid #fff;">
                            <img src="<?= Yii::app()->request->baseUrl ?>/img/like.png" width="24" style="float: left;"> 
                            <span style="float: left;line-height: 22px;" id="al_like_img"><?= $likes ?> people</span>
                            <span style="color:#000;float: left;line-height: 22px;"> &nbsp;like this.</span>
                        </div>
                        <div id="al_img_comments" style="background:#e9eaed;padding:2px;width: 100%;overflow-y: auto;max-height:195px;">
                            <?php
                            if ($comments) {
                                foreach ($comments as $comment) {
                                    ?>
                                    <div class="img-comm-cont">
                                        <img src="<?= $comment->user->image ?>" width="32" height="32" class="pull-left">
                                        <span class="img-comm-cont-span">
                                            <p class="img-comm-cont-name"><?= $comment->user->username ?></p>
                                            <p><?= nl2br($comment->comment) ?></p>
                                        </span>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div style="background:#e9eaed;padding:2px;color:#3b5998;display: table;width: 100%;border-bottom: 1px solid #fff;">
                            <img src="<?= User::model()->findByPk(Yii::app()->user->id)->image ?>" width="32" height="32" style="float:left;">
                            <textarea id="al_img_reply" onkeypress="if (event.keyCode == 13 && event.shiftKey === false) {
                                    commentImage('ContestUser',<?= $model->id ?>)
                                }" style="border: 0 none;border-radius: 0;float: left;margin-left: 4px;padding: 3px;resize: none;width: 229px;margin-bottom: 5px;"></textarea>
                        </div>
                    </div>
                </div>
            
                <script>
                    function likeImage(type, id)
                    {
                        $.ajax({
                            url: "<?= Yii::app()->request->baseUrl ?>/home/like?type=" + type + "&id=" + id,
                            success: function(data) {
                                var arr = jQuery.parseJSON(data);
                                $('#al_like_img').html(arr['count'] + ' people');
                                if (arr['status'] == 2)
                                    $('#al_like_unlike').html('Like');
                                else
                                    $('#al_like_unlike').html('Unlike');
                            }
                        });
                    }
                    function commentImage(type, id)
                    {
                        var reply = $('#al_img_reply').val();
                        $.ajax({
                            url: "<?= Yii::app()->request->baseUrl ?>/home/comment",
                            type: 'POST',
                            data: {'reply': reply, 'id': id, 'type': type},
                            success: function(data) {
                                if (data)
                                {
                                    var arr = jQuery.parseJSON(data);
                                    $('#al_img_reply').val('');
                                    $('#al_img_comments').html(arr['comments']);
                                }
                                else
                                    alert("An error has occured, pleas try again later!");
                            }
                        });
                    }
                </script>
            </div>
            </div>
        </div>
    </div>
</div>