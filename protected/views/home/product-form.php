<div id="timeline-board" class="page-wrap">
    <div class="page-head">
        <div class="page-actions normal-tabs">
            <a href="<?= Yii::app()->request->baseUrl ?>/home/market" class="back">Back</a>
            <a href="javascript:void(0)" class="current">Add Your item to First Pout market</a>
        </div>
    </div>
    <!-- /.page-head -->
    <section class="page-contain">
        <div class="actions-form form-wrap">
            <?php
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'product-form',
                'enableAjaxValidation' => false,
                'type' => 'horizontal',
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
            ?>
            <h1>Sell or donate</h1>
            <?php
            	if(Yii::app()->user->hasFlash('done')){
			?>
            <div class="alert alert-success" style="margin:5px 100px;"><?=Yii::app()->user->getFlash('done')?></div>
            <?php
				}
			?>
            <fieldset>
                <div class="control-group small-label">
                    <label for="item-name" class="control-label">name:</label>
                    <div class="controls">
                        <?php echo $form->error($product, 'title', array('class' => 'error red')) ?>
                        <?php echo $form->textField($product, 'title', array('class' => 'input-xlarge', 'placeholder' => 'Name', 'maxlength' => 255)); ?>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="checkbox-wrap">
                    <label class="checkbox">
                        <input value="sell-type" type="radio" name="Product[sell_donate]" id="item-type">
                        <span>I want to sell that item</span>
                    </label>
                    <label class="checkbox" data-related-field=".item-price-contain">
                        <input value="donate-type" type="radio" name="Product[sell_donate]">
                        <span>I want to donate that item</span>
                    </label>
                </div>
                <div class="control-group hidden-group" id="sell-type">
                    <label for="item-price" class="control-label">Set the price:</label>
                    <div class="controls">
                        <?php echo $form->error($product, 'price', array('class' => 'error red')) ?>
                        <?php echo $form->textField($product, 'price', array('class' => 'input-xmedium pull-left')); ?>
                        <span class="add-on pull-left">$</span>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="control-group">
                    <div class="controls">
                        <?php echo $form->error($product, 'category_id', array('class' => 'error red')) ?>
                        <?php echo $form->dropDownList($product, 'category_id', CHtml::listData(ProductCategory::model()->findAll(), 'id', 'title'), array('class' => 'form-select input-xmedium', 'empty' => 'Product Category')) ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <?php echo $form->error($product, 'desc', array('class' => 'error red')) ?>
                        <?php echo $form->textArea($product, 'desc', array('rows' => 6, 'cols' => 50, 'placeholder' => 'Product Description', 'class' => 'textarea-xlarge')); ?>
                        <!--<small class="control-info"><strong>4000</strong> signs left</small>-->
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
                </div>
                <div class="control-group has-photo-uploader">
                    <label class="control-label">Add pictures: <small>Problem with adding pictures?</small></label>
                    <?php
                    echo $form->fileField($product_image, 'image[]', array('class' => 'form-uploader', 'onchange' => 'readURL(this)', 'multiple' => "multiple"))
                    ?><br><br>
                    <div class="controls pictures-uploader clear">
                        <?php
                        if ($images) {
                            $path = Yii::app()->request->baseUrl . '/media/products/';
                            for ($i = 0; $i < 9; $i++) {
                                $img_class = '';
                                $extra = 'width="80" style="margin-top:-60px"';
                                if ($i == 0) {
                                    $img_class = ' current';
                                    $extra = 'width="180" style="margin-top:0px"';
                                } elseif ($i == 5 || $i == 3) {
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
                            <a href="javascript:void(0)" id="img_4" class="pic-item">&nbsp;</a>
                            <a href="javascript:void(0)" id="img_5" class="pic-item fourth">&nbsp;</a>
                            <a href="javascript:void(0)" id="img_6" class="pic-item">&nbsp;</a>
                            <a href="javascript:void(0)" id="img_0" class="pic-item current">
                            </a>
                            <a href="javascript:void(0)" id="img_7" class="pic-item">&nbsp;</a>
                            <a href="javascript:void(0)" id="img_8" class="pic-item">&nbsp;</a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="control-group">
                    <label for="user-localisation" class="control-label">Your localization:</label>
                    <div class="controls">
                        <?php echo $form->error($product, 'city', array('class' => 'error red')) ?>
                        <?php echo $form->textField($product, 'city', array('class' => 'input-xmedium', 'maxlength' => 255, 'placeholder' => "Post code or city name")); ?>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="control-group">
                    <label for="user-name" class="control-label">Your name:</label>
                    <div class="controls">
                        <?php echo $form->error($product, 'full_name', array('class' => 'error red')) ?>
                        <?php echo $form->textField($product, 'full_name', array('class' => 'input-xmedium', 'placeholder' => "Your Name", 'maxlength' => 255)); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label for="user-email" class="control-label">Your email address:</label>
                    <div class="controls">
                        <?php echo $form->error($product, 'email', array('class' => 'error red')) ?>
                        <?php echo $form->textField($product, 'email', array('class' => 'input-xmedium', 'maxlength' => 255, 'placeholder' => "Email address")); ?>
                        <label class="checkbox">
                            <input type="checkbox" name="Product[use_msg_only]" value="1" <?= $product->use_msg_only ? 'checked' : '' ?>>
                            <!--<span>I don’t want to get answers on my email<br />- use First Pout private messages</span>-->
                        </label>
                    </div>
                </div>
                <div class="control-group">
                    <label for="user-phone" class="control-label">Your phone number:</label>
                    <div class="controls">
                        <?php echo $form->error($product, 'phone', array('class' => 'error red')) ?>
                        <?php echo $form->textField($product, 'phone', array('class' => 'input-xmedium', 'maxlength' => 255, 'placeholder' => "Your phone number")); ?>
                    </div>
                </div>
                <!--<div class="control-group">
                    <label for="user-comunicator" class="control-label">comunicator:</label>
                    <div class="controls">
                        <?php echo $form->error($product, 'comunicator', array('class' => 'error red')) ?>
                        <?php echo $form->textField($product, 'comunicator', array('class' => 'input-xmedium', 'maxlength' => 255, 'placeholder' => "comunicator")); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label for="user-second-comunicator" class="control-label">Second comunicator:</label>
                    <div class="controls">
                        <?php echo $form->error($product, 'comunicator2', array('class' => 'error red')) ?>
                        <?php echo $form->textField($product, 'comunicator2', array('class' => 'input-xmedium', 'maxlength' => 255, 'placeholder' => "Second comunicator")); ?>
                    </div>
                </div>-->
            </fieldset>
            <fieldset>
                <h3>License agreenment</h3>
                <div class="control-group">
                    <div class="controls">
                        <label class="checkbox">
                            <input type="checkbox" name="accept-rems" required="required" <?= $product->isNewRecord ? '' : 'checked' ?>>
                            <span>Oświadczam, że zapoznałem się i akceptuję Regulamin serwisu OLX.pl (dawniej Tablica.pl). Wyrażam zgodę na przetwarzanie moich danych osobowych przez Grupę Allegro Sp. z o.o. z siedzibą w Poznaniu (60-166 Poznań, ul. Grunwaldzka 182), w celu świadczenia przez Grupa Allegro Sp. z o.o. usług w ramach serwisu OLX.pl (dawniej Tablica.pl).</span>
                        </label>
                    </div>
                </div>
                <!--<div class="control-group">
                    <div class="controls">
                        <label class="checkbox">
                            <input type="checkbox" name="join-newsletter">
                            <span>I want to receive newslatter</span>
                        </label>
                    </div>
                </div>-->
            </fieldset>
            <div class="submit-btn-wrap">
                <button type="submit" class="btn btn-blue btn-big-submit">Add Your item to the market</button>
            </div>
            <?php $this->endWidget(); ?>
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
if ($product->date_of_product) {
    $date = explode('-', $product->date_of_product);
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
        if (input.files.length > 9) {
            alert("Only 9 images are allowed.");
        } else if (input.files.length < 1) {
            alert("You should upload at least 1 image to show the product.");
        } else {
            $('#img_0').html(' ');
            $('#img_1').html(' ');
            $('#img_2').html(' ');
            $('#img_3').html(' ');
            $('#img_4').html(' ');
            $('#img_5').html(' ');
            $('#img_6').html(' ');
            $('#img_7').html(' ');
            $('#img_8').html(' ');
            for (var i = 0; i < input.files.length; i++) {
                if (input.files[i]) {
                    var reader = new FileReader();
                    reader.readAsDataURL(input.files[i]);
                    reader.onload = addImg;
                }
            }
        }

        function addImg(e) {
            if (count == 0)
                $('#img_' + count).html('<img src="' + e.target.result + '" width="180" style="margin-top:0">');
            else
                $('#img_' + count).html('<img src="' + e.target.result + '" width="80" style="margin-top:-60px">');
            count++;
        }
    }
</script>
<?php
if ($product->sell_donate == 0) {
    ?>
    <script>
        $(document).ready(function(e) {
            setTimeout(function() {
                $('#item-type').click();
            }, 100);
        });
    </script>
    <?php
}?>