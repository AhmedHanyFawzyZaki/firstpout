<script>
    $(document).ready(function(e) {
        setInterval(function() {
            $.ajax({
                url: "<?= Yii::app()->request->baseUrl ?>/groups/updateTimeline/<?= $id ?>",
                                success: function(data) {
                                    if (data)
                                    {
                                        $('#posts_div').html(data);
                                        $.getScript("<?= Yii::app()->request->baseUrl ?>/js/new.js"); //containg the js of the comments toggle only
                                    }
                                }
                            });
                        },<?= Yii::app()->params['refreshRate'] ?>);
                    });
</script>
<div id="timeline-board" class="page-wrap">
    <!--<div class="page-head">
        <h2 class="page-title">Timeline board</h2>
        <div class="page-actions">
            <a href="#" class="new-post">New post</a>
        </div>
    </div>-->
    <?php
    $this->renderPartial('top-navigation', array('id' => $id));
    ?>
    <!-- /.page-head -->
    <section class="page-contain">
        <div class="baby-profile-wrap">
            <?php
            	$this->renderPartial('group-banner', array('id'=>$id, 'model'=>$model));
			?>
        </div>
    </section>
    <div id="posts_div">
        <?php
        $this->renderPartial('//home/posts', array('posts' => $posts));
        ?>
    </div>
    <!-- /.board-feeds -->
</div>