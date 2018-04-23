<script>
    $(document).ready(function(e) {
        setInterval(function() {
            $.ajax({
                url: "<?= Yii::app()->request->baseUrl ?>/home/updateTimeline",
                success: function(data) {
                    if (data)
                    {
                        $('#posts_div').html(data);
                        $.getScript("<?= Yii::app()->request->baseUrl ?>/js/new.js"); //containing the js of the comments toggle only
                    }
                }
            });
        }, <?= Yii::app()->params['refreshRate'] ?>);
    });
</script>
<div id="timeline-board" class="page-wrap">
	<?php
        	if(Yii::app()->user->hasFlash('wrongPost')){
				echo '<div class="alert-danger" style="margin:0 auto;width:80%;">'.Yii::app()->user->getFlash('wrongPost').'</div>';
			}
		?>
    <div class="page-head">
        <h2 class="page-title">Timeline board</h2>
        <!--<div class="page-actions">
            <a href="<?= Yii::app()->request->baseUrl ?>/home/newPost" class="new-post fancybox">New post</a>
        </div>-->
    </div>
    <!-- /.page-head -->

    <div id="posts_div">
        <?php
            $this->renderPartial('//home/posts', array('posts' => $posts));
        ?>
    </div>
    <!-- /.board-feeds -->
</div>