<div id="timeline-board" class="page-wrap">
    <div class="page-head">
        <div class="page-actions profile-tabs">
            <a href="#" class="back">Back</a>
            <a href="#">albums</a>
            <a href="#">Family</a>
            <a href="#" class="current">Informations</a>
            <a href="#" class="more-options">More</a>
        </div>
    </div>
    <!-- /.page-head -->
    <section class="page-contain">
        <?php
        if (Yii::app()->user->hasFlash("done")) {
            echo '<div class="alert alert-success">' . Yii::app()->user->getFlash("done") . '</div>';
        }
        ?>
        <div class="baby-profile-wrap">
            <!--<div class="profile-cover">
                <img src="<?= $user->banner ?>" alt="<?= $user->username ?>" class="profile-img" />
                <h1 class="baby-name"><?= $user->username ?></h1>
            </div>-->
            <!-- /.profile-cover -->
            <div class="form-wrap">
                <?php
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'album-form',
                    'enableAjaxValidation' => false,
                    'type' => 'horizontal',
                    'htmlOptions' => array('enctype' => 'multipart/form-data'),
                ));
                ?>
                <h1>
<?= $album->isNewRecord ? 'Create New Album' : 'Edit album: "' . $album->title . '"' ?></h1>
                <div class="control-group small-label">
                    <label for="item-name" class="control-label">name:</label>
                    <div class="controls">
<?php echo $form->error($album, 'title', array('class' => 'error red')) ?>
<?php 
	if($album->first_album)
		echo $form->textField($album, 'title', array('class' => 'input-xlarge', 'placeholder' => 'Name', 'maxlength' => 255, 'readonly'=>'readonly')); 
	else
		echo $form->textField($album, 'title', array('class' => 'input-xlarge', 'placeholder' => 'Name', 'maxlength' => 255)); 
?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="production-day">production date</label>
                    <div class="controls birthday-wrap">
                        <select name="day" id="production-day" class="input-xlarge form-select">

                        </select>
                        <select name="month" id="production-month" class="input-xlarge form-select">

                        </select>
                        <select name="year" id="production-year" class="input-xlarge form-select">

                        </select>
                    </div>
                    <label class="checkbox">
                        <input value="1" type="checkbox" name="Album[pic_date]" id="item-type">
                        <span>I want to use picture date</span>
                    </label>
                </div>
                <div class="control-group has-photo-uploader">
                    <label class="control-label">Add pictures: <small>Problem with adding pictures?</small></label>
                    <?php
                    echo $form->fileField($album_image, 'image[]', array('class' => 'form-uploader', 'onchange' => 'readURL(this)', 'multiple' => "multiple"));
                    ?><br>
                    <div class="controls pictures-uploader">
                        <?php
                        if ($images) {
                            $path = Yii::app()->request->baseUrl . '/media/albums';
                            for ($i = 0; $i < 6; $i++) {
                                $img_class = '';
                                $extra = 'width="80" style="margin-top:-60px"';
                                if ($i == 0) {
                                    $img_class = ' current';
                                    $extra = 'width="180" style="margin-top:0px"';
                                } elseif ($i == 3 || $i == 2) {
                                    $img_class = ' fourth';
                                }
                                if ($images[$i]) {
                                    echo '<a href="javascript:void(0)" class="pic-item' . $img_class . '" id="img_' . $i . '"><img src="' . $path . '/' . $images[$i]->image . '" ' . $extra . '></a>';
                                } else {
                                    echo '<a href="javascript:void(0)" class="pic-item' . $img_class . '" id="img_' . $i . '">&nbsp;</a>';
                                }
                            }
                        } else {
                            ?>
                            <a href="javascript:void(0)" id="img_1" class="pic-item">&nbsp;</a>
                            <a href="javascript:void(0)" id="img_2" class="pic-item">&nbsp;</a>
                            <a href="javascript:void(0)" id="img_3" class="pic-item">&nbsp;</a>
                            <a href="javascript:void(0)" id="img_4" class="pic-item fourth">&nbsp;</a>
                            <a href="javascript:void(0)" id="img_0" class="pic-item current">&nbsp;</a>
                            <a href="javascript:void(0)" id="img_5" class="pic-item">
                            </a>
    <?php
}
?>
                        <div>
                        <?= $form->hiddenField($album_image, 'date_taken[]', array('id' => 'date_taken0')) ?>
                        <?= $form->hiddenField($album_image, 'date_taken[]', array('id' => 'date_taken1')) ?>
                        <?= $form->hiddenField($album_image, 'date_taken[]', array('id' => 'date_taken2')) ?>
                        <?= $form->hiddenField($album_image, 'date_taken[]', array('id' => 'date_taken3')) ?>
                            <?= $form->hiddenField($album_image, 'date_taken[]', array('id' => 'date_taken4')) ?>
                            <?= $form->hiddenField($album_image, 'date_taken[]', array('id' => 'date_taken5')) ?>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="description">Description:</label>
                    <div class="controls">
<?php echo $form->error($album, 'desc', array('class' => 'error red')) ?>
<?php echo $form->textArea($album, 'desc', array('rows' => 6, 'cols' => 50, 'placeholder' => 'Little Description', 'class' => 'textarea-xlarge')); ?>
                        <label class="checkbox">
                            <input type="checkbox" value="1" <?= $album->private == 1 ? 'checked' : '' ?> name="Album[private]" id="set-private">
                            <span>Set this album as Private</span>
                        </label>

                    </div>
                </div>
                <div class="submit-btn-wrap">
                    <label class="checkbox">
                        <input value="1" <?= $album->belong_to_me == 1 ? 'checked' : '' ?> type="checkbox" name="Album[belong_to_me]" id="private">
                        <span>This album pictures, belong to me......</span>
                    </label>
                    <button type="submit" class="btn btn-blue btn-big-submit">save</button>
                </div>
<?php $this->endWidget(); ?>
            </div>
            <!-- /.actions-form -->
        </div>
    </section>
    <!-- /.page-contain -->
</div>

<script type="text/javascript">

    /***********************************************
     * Drop Down Date select script- by JavaScriptKit.com
     * This notice MUST stay intact for use
     * Visit JavaScript Kit at http://www.javascriptkit.com/ for this script and more
     ***********************************************/
    $(document).ready(function() {
        populatedropdown('production-day', 'production-month', 'production-year');
    });
    var monthtext = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    function populatedropdown(dayfield, monthfield, yearfield) {
        var today = new Date()
        var dayfield = document.getElementById(dayfield)
        var monthfield = document.getElementById(monthfield)
        var yearfield = document.getElementById(yearfield)
        for (var i = 1; i < 32; i++)
            dayfield.options[i] = new Option(i, i + 1);
<?php
if ($album->date_of_album) {
    $date = explode('-', $album->date_of_album);
    $year = $date[0];
    $month = $date[1];
    $day = $date[2];
}
if ($day) {
    ?>
            dayfield.options[<?= $day ?>] = new Option(<?= $day ?>, <?= $day ?>, true, true); //select today's day
    <?php
} else {
    ?>
            dayfield.options[today.getDate()] = new Option(today.getDate(), today.getDate(), true, true); //select today's day
    <?php
}
?>
        //dayfield.options[today.getDate()] = new Option(today.getDate(), today.getDate(), true, true); //select today's day
        for (var m = 0; m < 12; m++)
            monthfield.options[m] = new Option(monthtext[m], m + 1)
<?php
if ($month) {
    ?>
            monthfield.options[<?= $month ?>] = new Option(monthtext[<?= $month - 1 ?>], (<?= $month ?>), true, true) //select today's month
    <?php
} else {
    ?>
            monthfield.options[today.getMonth()] = new Option(monthtext[today.getMonth()], (today.getMonth() + 1), true, true) //select today's month
    <?php
}
?>
        var thisyear = today.getFullYear()
        for (var y = 0; y < 90; y++) {
            yearfield.options[y] = new Option(thisyear, thisyear)
            thisyear -= 1
        }
<?php
if ($year) {
    ?>
            yearfield.options[today.getFullYear() -<?= $year ?>] = new Option(<?= $year ?>, <?= $year ?>, true, true) //select today's year
    <?php
} else {
    ?>
            yearfield.options[today.getFullYear() - today.getFullYear()] = new Option(today.getFullYear(), today.getFullYear(), true, true) //select today's year
    <?php
}
?>

    }
</script>

<script>
    var count = 0;
    function readURL(input) {
        count = 0;
        if (input.files.length > 6) {
            alert("Only 6 images are allowed.");
        } else if (input.files.length < 1) {
            alert("You should upload at least 1 image.");
        } else {
            $('#img_0').html(' ');
            $('#img_1').html(' ');
            $('#img_2').html(' ');
            $('#img_3').html(' ');
            $('#img_4').html(' ');
            $('#img_5').html(' ');
            for (var i = 0; i < input.files.length; i++) {
                if (input.files[i]) {
                    var reader = new FileReader();
                    var imgMeta = input.files[i];
                    var imgDate = imgMeta.lastModifiedDate;
                    var imgMonth = imgDate.getMonth() + 1;
                    var imgDay = imgDate.getDate();
                    var imgYear = imgDate.getFullYear();
                    var imgHours = imgDate.getHours();
                    var imgMin = imgDate.getMinutes();
                    var imgSec = imgDate.getSeconds();
                    var inputval = imgYear + '-' + imgMonth + '-' + imgDay + ' ' + imgHours + ':' + imgMin + ':' + imgSec;
                    $('#date_taken' + i).val(imgYear + '-' + imgMonth + '-' + imgDay + ' ' + imgHours + ':' + imgMin + ':' + imgSec);
                    reader.readAsDataURL(input.files[i]);
                    reader.onload = function addImg(e) {
                        if (count == 0)
                            var extra = 'width="180" style="margin-top:0"';
                        else
                            var extra = 'width="80" style="margin-top:-60px"';
                        $('#img_' + count).html('<img src="' + e.target.result + '" ' + extra + '>');
                        count++;
                    }
                }
            }
        }


    }
</script>