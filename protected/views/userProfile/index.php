<script>
    $(document).ready(function(e) {
        setInterval(function() {
            $.ajax({
                url: "<?= Yii::app()->request->baseUrl ?>/userProfile/updateTimeline/<?= $id ?>",
                                success: function(data) {
                                    if (data)
                                    {
                                        $('#posts_div').html(data);
                                        $.getScript("<?= Yii::app()->request->baseUrl ?>/js/new.js"); //containg the js of the comments toggle only
                                    }
                                }
                            });
                        }, <?= Yii::app()->params['refreshRate'] ?>);
                    });
</script>

<div id="timeline-board" class="page-wrap">
    <?php
        $this->renderPartial('top-navigation', array('id' => $id));
    ?>
    <!-- /.page-head -->

    <div id="posts_div">
        <?php
            $this->renderPartial('//home/posts', array('posts' => $posts));
        ?>
    </div>
</div>