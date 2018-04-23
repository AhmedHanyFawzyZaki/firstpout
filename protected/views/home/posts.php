<section class="board-stories">
    <?php
    if ($posts) {
        foreach ($posts as $post) {
            $post_user_image = $post->user->image;
            if ($post->content) {
                $class = "story-type-article";
                $content = '<div class="story-article-wrap">
                                    <!--<h5>' . $post->user->username . '</h5>-->
                                    <p>
                                            ' . $post->content . '
                                    </p>
                            </div>';
            }

            $images = PostMedia::model()->findAllByAttributes(array('post_id' => $post->id));
            if ($images) {
                $class = "story-type-img";
				$size='small';
				$tile='tiles3';
				if(count($images)==2){
					$size='medium';
					$tile='tiles2';
				}elseif(count($images)%3==0){
					$size='small';
					$tile='tiles3';
				}elseif(count($images)%4==0){
					$size='small';
					$tile='tiles4';
				}elseif(count($images)%5==0){
					$size='small';
					$tile='tiles5';
				}/*elseif(count($images)%3==1){
					$size='small';
					$size1='';
					$tile='tiles3';
				}elseif(count($images)%3==2){
					$size='small';
					$tile='tiles3';
				}*/
                $content .= '<figure class="story-media-wrap multi-medias '.$tile.'">';
                if ($images) {
                    foreach ($images as $img) {
                        $image = Yii::app()->request->baseUrl . '/media/albums/' . $img->media;
						ob_start();
						$this->widget('ext.SAImageDisplayer', array(
							'image' => $img->media,
							'size' => $size,
							//'defaultImage' => 'default.png',
							'group' => 'albums',
						));
						$image = ob_get_contents();
                		ob_end_clean();
                        $content.='<a class="fancybox" href="' . Yii::app()->request->baseUrl . '/home/ViewImage?id=' . $img->id . '&mode=PostMedia">'.$image.'</a>';
                    }
                }
                $content.='</figure>';
            } elseif ($post->image) {
                $class = "story-type-img";
				/*ob_start();
				$this->widget('ext.SAImageDisplayer', array(
					'image' => $post->image,
					'size' => 'big',
					//'defaultImage' => 'default.png',
					'group' => 'posts',
				));
				$image = ob_get_contents();
				ob_end_clean();*/
                $content .= '<figure class="story-media-wrap">
                                <a class="fancybox" href="' . Yii::app()->request->baseUrl . '/home/ViewImage?id=' . $post->id . '&mode=PostImage"><img src="'.Yii::app()->request->baseUrl.'/media/posts/'.$post->image.'"></a>
                        </figure>';
            } elseif ($post->video) {
                $class = "story-type-video";
                ob_start();
                Helper::ShowVideo($post->video, '540', '400');
                $video = ob_get_contents();
                ob_end_clean();
                //$video='<iframe src="'.Yii::app()->request->baseUrl.'/media/posts/'.$post->video.'" width="540px" height="400px"></iframe>';
                $content .= '<figure class="story-media-wrap video">
                            <a class="lightbox" href="' . Yii::app()->request->baseUrl . '/media/posts/' . $post->video . '">
                                ' . $video . '
                            </a>
                        </figure>';
            }


            $fav = Favourite::model()->findByAttributes(array('user_id' => Yii::app()->user->id, 'item_type' => 1, 'item_id' => $post->id));
            if ($fav)
                $fav_class = 'full-star';
            else
                $fav_class = 'like-this';
            $comments = Comment::model()->findAllByAttributes(array('item_id' => $post->id, 'item_type' => 1));
            ?>
            <article class="story-wrap <?= $class ?>" id="article-<?=$post->id?>">
                <div class="story-inner">
                    <div class="story-head">
                        <h4 class="story-author">
                        	<span class="pull-left">
							<?= $post->user->username ?>&nbsp;&nbsp; 
                            </span>
							<?php 
								if($post->baby_id && Yii::app()->controller->id!='babyProfile'){
                            		echo ' &nbsp;<span class="arrow-right"></span>&nbsp;'.$post->baby->username;
                            	}elseif($post->group_id && Yii::app()->controller->id!='groups'){
									echo ' &nbsp;<span class="arrow-right"></span>&nbsp;'.$post->group->title;
								}
							?>
                        </h4>
                        <div class="story-actions">
                            <a href="javascript:void(0);" onClick="favourite('post',<?= $post->id ?>)" id="fav_<?= $post->id ?>" class="<?= $fav_class ?>">favourite</a>
                        </div>
                    </div>
                    <!-- /.story-head -->
                    <?= $content ?>
                    <!-- /.story-media-wrap -->
                    <div class="story-overview">
                        <a href="javascript:void(0);" class="story-author-thumb">
                            <img src="<?= $post_user_image ?>" width="60" height="60" alt="">
                        </a>
                        <div class="story-details">
                            <h3 class="story-title"><?= $post->user->username ?></h3>
                            <span class="story-time"><?= date('d', strtotime($post->date_created)) ?>, <?= date('M', strtotime($post->date_created)) ?>, <?= date('y', strtotime($post->date_created)) ?><br /><?= date('h', strtotime($post->date_created)) ?>:<?= date('i', strtotime($post->date_created)) ?> <?= date('H', strtotime($post->date_created)) > 12 ? 'PM' : 'AM' ?></span>
                        </div>
                        <div class="story-stats">
                            <a href="javascript:void(0);" onclick="like('post',<?= $post->id ?>)" class="story-likes" id="likes_count_<?= $post->id ?>">
                                <i></i>
                                <?= count(Like::model()->findAllByAttributes(array('item_id' => $post->id, 'item_type' => 1))); ?>
                            </a>
                            <a href="javascript:void(0);" class="story-comments" id="comments_count_<?= $post->id ?>">
                                <i></i>
                                <?= count($comments) ?>
                            </a>
                        </div>
                    </div>
                    <!-- /.story-overview -->
                    <div class="story-trends">
                        <div class="story-comments-wrap" id="comments_<?= $post->id ?>">
                            <?php
                            if ($comments) {
                                $i = 0;
                                foreach ($comments as $comment) {
                                    if ($i % 2 == 0)
                                        $com_cl = 'even';
                                    else
                                        $com_cl = '';
                                    ?>
                                    <div class="story-comment <?= $com_cl ?>">
                                        <figure class="comment-author-thumb">
                                            <a href="javascript:void(0)">
                                                <img src="<?= $comment->user->image ?>" alt="<?= $comment->user->username ?>" width="60" height="60" />
                                            </a>
                                        </figure>
                                        <div class="comment-overview">
                                            <h4 class="comment-author-name">
                                                <a href="<?= Yii::app()->request->baseUrl ?>/home/profile/<?= $comment->user_id ?>"><?= $comment->user->username ?></a>
                                            </h4>
                                            <span class="comment-date"><?= $comment->date_created ?></span>
                                            <div class="comment-plain">
                                                <p>
                                                    <?= nl2br($comment->comment); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                        </div>
                        <!-- /.story-comments -->
                        <div class="leave-a-reply">
                            <h3>Leave a comment</h3>
                            <form action="" enctype="multipart/form-data" method="post" id="commentform">
                                <p>
                                    <textarea name="reply" id="reply_<?= $post->id ?>" onkeypress="if (event.keyCode == 13 && event.shiftKey === false) {
                                                        comment('post',<?= $post->id ?>)
                                                    }" placeholder="Write your comment here"></textarea>
                                </p>
                                <button class="btn btn-default btn-submit" type="button" onClick="comment('post',<?= $post->id ?>)">Send</button>
                            </form>
                        </div>
                        <!-- /.leave-a-reply -->
                    </div>
                    <!-- /.story-trends -->
                </div>
                <!-- /.story-inner -->
            </article>
            <?php
        }
    }
    else {
        echo '<div class="ui-notification"><p>No Posts found.</p></div>';
    }
    ?>
    <!-- /.story-wrap -->
</section>