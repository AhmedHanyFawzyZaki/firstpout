<div id="timeline-board" class="page-wrap">
    <div class="page-head">
        <div class="page-actions family-tabs">
            <a href="<?= Yii::app()->request->baseUrl ?>/home" class="back">Back</a>
            <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/createBabyProfile" class="profile-link current">
                Create Baby Profile
            </a>
            <!--<a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/createGroup" class="profile-link">
                Create Group
            </a>-->
            <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/createBabyProfile" class="create-profile">Create new profile</a>
        </div>
    </div>
    <!-- /.page-head -->
    <section class="page-contain">
        <?php
        if (Yii::app()->user->hasFlash("SuccessBaby")) {
            echo '<div class="alert alert-success">' . Yii::app()->user->getFlash("SuccessBaby") . '</div>';
        } elseif (Yii::app()->user->hasFlash("WrongBaby")) {
            echo '<div class="alert alert-danger">' . Yii::app()->user->getFlash("WrongBaby") . '</div>';
        }
        ?>
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'baby-form',
            'enableAjaxValidation' => false,
            'type' => 'horizontal',
            'htmlOptions' => array(
                'class' => 'form-wrap cp-forms'
            )
        ));
        ?>
        <h1 class="red-title"><?= $model->isNewRecord ? 'Create' : 'Update' ?> Your baby profile page!</h1>
        <fieldset>
            <?php echo $form->textFieldRow($model, 'username', array('class' => 'input-xmedium', 'placeholder' => 'Baby Name')); ?>
            <div class="control-group">
                <label class="control-label" for="gender">Gender</label>
                <div class="controls">
                    <div class="checkbox-wrap kids-gender">
                        <label class="checkbox girl">
                            <input type="radio" name="Baby[gender]" value="2" <?= $model->gender == 2 ? 'checked' : '' ?> id="gender" />
                            <span><i></i>Girl</span>
                        </label>
                        <label class="checkbox boy">
                            <input type="radio" name="Baby[gender]" value="1" <?= $model->gender == 1 ? 'checked' : '' ?>/>
                            <span><i></i>Boy</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="birthday-day">Date of birth:</label>
                <div class="controls birthday-wrap">
                    <select name="day" id="production-day"  onchange="changeSign()" class="form-select">

                    </select>
                    <select name="month" id="production-month" onchange="changeSign()" class="form-select">

                    </select>
                    <select name="year" id="production-year" class="form-select">

                    </select>
                </div>
            </div>
            <?php echo $form->textFieldRow($model, 'birth_place', array('class' => 'input-xmedium', 'placeholder' => 'Birth Place')); ?>
            <div class="control-group">
                <label class="control-label" for="birth-place">Time of birth:</label>
                <div class="controls birthday-wrap birthtime-wrap" style="width:250px;">
                    <?php
                    $date = strtotime($model->date_of_birth);
                    $pm = ($date && date('H', $date) > 12) ? 'selected' : '';
                    $hours = $date ? date('H', $date) : '';
                    $hours = $hours > 12 ? $hours - 12 : $hours;
                    $hours = sprintf("%02d", $hours);
                    ?>
                    <input id="birth-hour" name="birth_hour" value="<?= $hours ?>" type="text" placeholder="hours" class="input-xsmall">
                    <input id="birth-minute" name="birth_minute" type="text" value="<?= $date ? date('i', $date) : '' ?>" placeholder="minutes" class="input-xsmall">
                    <select name="am" class="form-select">
                        <option value="AM">AM</option>
                        <option value="PM" <?= $pm ?>>PM</option>
                    </select>
                </div>
            </div>
            <?php echo $form->textFieldRow($model, 'desc', array('class' => 'input-xmedium', 'placeholder' => 'Climate condition')); ?>
            <div class="control-group">
                <label class="control-label" for="birth-place">pregnancy time:</label>
                <div class="controls birthday-wrap birthtime-wrap" style="width:250px;">
                    <!--<div class="incrementer">-->
                    <select name="pergacy_month" class="form-select" style="clear:none;">
                        <option value="">Month</option>
                        <?php
                        //$year_months=array('January','February','March','April','May','June','July','August','September','October','November','December');
                        for ($i = 1; $i < 13; $i++) {
                            echo '<option value="' . sprintf("%02d", $i) . '">' . sprintf("%02d", $i) . '</option>';
                        }
                        ?>

                    </select>
                    <!--<span class="dec-btn" onclick="decrease('pergacy-month')"><i>-</i></span>
                    <input id="pergacy-month" name="pergacy_month" value="<?= $model->date_of_pergacy ? explode('-', $model->date_of_pergacy)[0] : '' ?>" readonly="readonly" type="text" placeholder="month" class="input-xsmall" />
                    <span class="inc-btn" onclick="increase('pergacy-month')"><i>+</i></span>-->
                    <!--</div>
                    <div class="incrementer">-->
                    <select name="pergacy_day" class="form-select" style="clear:none;">
                        <option value="">Day</option>
                        <?php
                        for ($i = 1; $i < 32; $i++) {
                            echo '<option value="' . sprintf("%02d", $i) . '">' . sprintf("%02d", $i) . '</option>';
                        }
                        ?>

                    </select>
                    <!--<span class="dec-btn" onclick="decrease('pergacy-day')"><i>-</i></span>
                    <input id="pergacy-day" name="pergacy_day" value="<?= $model->date_of_pergacy ? explode('-', $model->date_of_pergacy)[1] : '' ?>" readonly="readonly" type="text" placeholder="days" class="input-xsmall" />
                    <span class="inc-btn" onclick="increase('pergacy-day')"><i>+</i></span>-->
                    <!--</div>-->
                </div>
            </div>
        </fieldset>
        <fieldset>
            <?php echo $form->textFieldRow($model, 'height', array('class' => 'input-xsmall pull-left', 'placeholder' => 'Baby Height', 'append'=>'CM')); ?>
            <?php echo $form->textFieldRow($model, 'weight', array('class' => 'input-xsmall pull-left', 'placeholder' => 'Baby Weight', 'append'=>'KG')); ?>
            <?php //echo $form->textFieldRow($model, 'body_mass', array('class' => 'input-xmedium', 'placeholder' => 'Body Mass')); ?>
        </fieldset>
        <fieldset>
            <div class="control-group">
                <label class="control-label inline-label" for="your-picture">BABY PICTURE:<small>Little description of photo uploading here</small></label>
                <!--<div class="controls">
                    <div class="social-grabber socials">
                        <a href="#" class="src-picassa">
                            <span>Picassa</span>
                        </a>
                        <a href="#" class="src-flickr">
                            <span>Flickr</span>
                        </a>
                        <a href="#" class="src-facebook">
                            <span>Facebook</span>
                        </a>
                        <a href="#" class="src-instagram">
                            <span>Instagram</span>
                        </a>
                        <a href="#" class="src-twitter">
                            <span>Twitter</span>
                        </a>
                        <a href="#" class="src-gplus">
                            <span>Google plus</span>
                        </a>
                    </div>
                </div>-->
            </div>
        </fieldset>
        <style>
            img{
                max-width:10000px;
            }
        </style>

        <div class="baby-photo-container">
            <div class="bottomMargin20 leftMargin170">
                <?php echo $form->hiddenField($model, 'image') ?>
                <?php
                if (!$model->isNewRecord && $model->image) {
                    echo '<div id="babyImageCandy"><img src="' . $model->image . '" class="croppedImg"></div>';
                } else {
                    echo '<div id="babyImageCandy"></div>';
                }
                ?>
            </div>
            <?php echo $form->hiddenField($model, 'banner') ?>
            <?php
            if (!$model->isNewRecord && $model->banner) {
                echo '<div id="babyBannerCandy"><img src="' . $model->banner . '" class="croppedImg"></div>';
            } else {
                echo '<div id="babyBannerCandy"></div>';
            }
            ?>
        </div>
        <!--<div class="baby-photo-container">
            <img src="<?= Yii::app()->request->baseurl ?>/img/dyn/photo-baby-profil.jpg" alt="" />
            <div class="avatar-details">
                <a class="avatar-file" href="#">wiktoria.jpg</a>
                <div class="avatar-actions">
                    <a class="avatar-crop" href="#">crop</a>
                    <a class="avatar-edit" href="#">edit</a>
                    <a class="avatar-remove" href="#">remove</a>
                </div>
            </div>
        </div>-->
        <fieldset>
            <div class="control-group">
                <label class="control-label" for="connections">baby sun sign:</label>
                <?php echo $form->hiddenField($model, 'sun_sign'); ?>
                <div class="controls sun-signs">
                    <?php
                    if ($sun_signs) {
                        foreach ($sun_signs as $ss) {
                            $bc = $ss->id == $model->sun_sign ? 'red-border' : '';
                            echo '<a href="javascript:void(0)" class="signs ' . $bc . '" id="sign_' . $ss->id . '" onclick="changeSunSign(' . $ss->id . ')"><img src="' . Yii::app()->request->baseUrl . '/media/sunsign/' . $ss->image . '" title="'.$ss->title.'"></a>';
                        }
                    }
                    ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <div class="control-group">
                <label class="control-label inline-label" for="connections">Family members:</label>
                <div class="controls relations-manager">
                    <div class="add-relationship">
                        <?php
                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name' => 'relationship-name',
                            'source' => Helper::ListUsersRelationComplete(), //Helper::ListUsers(),
                            // additional javascript options for the autocomplete plugin
                            'options' => array(
                            //'minLength'=>'2',
                            ),
                            'htmlOptions' => array(
                                'class' => 'input-xmedium',
                                'placeholder' => 'Enter member name',
                                'id' => 'autoUser',
                            ),
                        ));
                        Yii::app()->clientScript->registerScript("autoUser", "
                            $('#autoUser').autocomplete().data( 'autocomplete' )._renderItem = function( ul, item ) {
                                    return $('<li></li>')
                                        .data('item.autocomplete', item)
                                        .append('<a class=\"autoCa\"><img class=\"autoCimg\" src=\"' + item.img + '\" /><label class=\"autoClabel\">' + '\t'+  item.label +'</label></a>')
                                        .appendTo(ul);
                                };
                        ");
                        ?>
                        <?php
                        echo CHtml::dropDownList('connection', '', CHtml::listData(Connection::model()->findAll(), 'id', 'title'), array('class' => "form-select"));
                        ?>

                        <a href="javascript:void(0)" onClick="addFamilyMember()" class="add-btn"><i></i></a>
                    </div>
                    <div class="relationships-list family-list">
                        <?php
                        if ($family_members) {
                            foreach ($family_members as $i => $fm) {
                                echo '<div class="relationship-wrap" id="family_member_' . $i . '">
											<div class="relationship-actions">
												<a href="javascript:void(0)" onclick="removeFamilyMember(\'family_member_' . $i . '\')" class="act-remove">Remove
												</a>
											</div>
											<img src="' . $fm->user->image . '" class="person-thumb" width="50" height="50" />
											<div class="person-overview">
												<h3 class="person-name">' . $fm->user->username . '<input type="hidden" name="BabyFamily[user_id][]" value="' . $fm->user_id . '">
												</h3>
												<span class="person-connection">' . $fm->connection->title . '<input type="hidden" name="BabyFamily[connection_id][]" value="' . $fm->connection_id . '">
												</span>
											</div>
										</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <div class="control-group">
                <label class="control-label inline-label" for="connections">Doctor:</label>
                <div class="controls relations-manager">
                    <div class="add-relationship">
                        <?php
                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name' => 'doctor-name',
                            'source' => Helper::ListDoctorsAndHospitalsComplete(), //Helper::ListUsers(),
                            // additional javascript options for the autocomplete plugin
                            'options' => array(
                            //'minLength'=>'2',
                            ),
                            'htmlOptions' => array(
                                'class' => 'input-xlarge autoUser',
                                'placeholder' => 'Enter doctor or hospital name',
                                'id' => 'autoDoctor',
                            ),
                        ));
                        Yii::app()->clientScript->registerScript("autoDoctor", "
                            $('#autoDoctor').autocomplete().data( 'autocomplete' )._renderItem = function( ul, item ) {
                                    return $('<li></li>')
                                        .data('item.autocomplete', item)
                                        .append('<a class=\"autoCa\"><img class=\"autoCimg\" src=\"' + item.img + '\" /><label class=\"autoClabel\">' + '\t'+  item.label +'</label></a>')
                                        .appendTo(ul);
                                };
                        ");
                        ?>

                        <a href="javascript:void(0)" onClick="addDoctor()" class="add-btn"><i></i></a>
                    </div>
                    <div class="relationships-list doctors-list">
                        <?php
                        if ($doctors) {
                            foreach ($doctors as $i => $doc) {
                                echo '<div class="relationship-wrap" id="doc_' . $i . '">
											<div class="relationship-actions">
												<a href="javascript:void(0)" onclick="removeDoctor(\'doc_' . $i . '\')" class="act-remove">Remove
												</a>
											</div>
											<img src="' . $doc->doctor->image . '" class="person-thumb" width="50" height="50" />
											<div class="person-overview">
												<h3 class="person-name">' . $doc->doctor->username . '<input type="hidden" name="BabyDoctorHospital[doctor_id][]" value="' . $doc->doctor_id . '"><input type="hidden" name="BabyDoctorHospital[is_hospital][]" value="' . $doc->is_hospital . '">
												</h3>
											</div>
										</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset class="license-agreement">
            <h3>License agreenment</h3>
            <div class="control-group">
                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox" name="accept-rems" required="required">
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
            <!--<a class="preview-profile" href="#">Check your baby page before add</a>-->
            <button type="submit" class="btn btn-red btn-big-submit"><?= $model->isNewRecord ? 'Add' : 'Update' ?> Your baby’s profile</button>
        </div>
        <?php $this->endWidget(); ?>
    </section>
    <!-- /.page-contain -->
    <a href="javascript:void(0)" style="display:none;" id="doc-cr" class="fancybox"></a>
</div>
<script type="text/javascript">

    /***********************************************
     * Drop Down Date select script- by JavaScriptKit.com
     * This notice MUST stay intact for use
     * Visit JavaScript Kit at http://www.javascriptkit.com/ for this script and more
     ***********************************************/
    $(document).ready(function() {
        populatedropdown('production-day', 'production-month', 'production-year');
        setTimeout(function(){changeSign();},500);
    });
    var monthtext = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    function populatedropdown(dayfield, monthfield, yearfield) {
        var today = new Date();
        var dayfield = document.getElementById(dayfield);
        var monthfield = document.getElementById(monthfield);
        var yearfield = document.getElementById(yearfield);
        for (var i = 1; i < 32; i++)
            dayfield.options[i] = new Option(i, i);
<?php
if ($model->date_of_birth) {
    $date = strtotime($model->date_of_birth);
    $year = date('Y', $date);
    $month = date('m', $date);
    $day = date('d', $date);
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
            monthfield.options[<?= $month - 1 ?>] = new Option(monthtext[<?= $month - 1 ?>], (<?= $month ?>), true, true); //select today's month
    <?php
} else {
    ?>
            monthfield.options[today.getMonth()] = new Option(monthtext[today.getMonth()], (today.getMonth() + 1), true, true); //select today's month
    <?php
}
?>
        var thisyear = today.getFullYear();
        for (var y = 0; y < 90; y++) {
            yearfield.options[y] = new Option(thisyear, thisyear);
            thisyear -= 1;
        }
<?php
if ($year) {
    ?>
            yearfield.options[today.getFullYear() -<?= $year ?>] = new Option(<?= $year ?>, <?= $year ?>, true, true); //select today's year
    <?php
} else {
    ?>
            yearfield.options[today.getFullYear() - today.getFullYear()] = new Option(today.getFullYear(), today.getFullYear(), true, true); //select today's year
    <?php
}
?>

    }

    function increase(id) {
        var limit = 12;
        if (id == 'pergacy-day') {
            limit = 31;
        }
        var val = $('#' + id).val();
        if (val < limit) {
            val++;
        }
        val = val < 10 ? '0' + val : val;
        $('#' + id).val(val);
    }
    function decrease(id) {
        var limit = 1;
        var val = $('#' + id).val();
        if (val > limit) {
            val--;
        }
        val = val < 10 ? '0' + val : val;
        val = val <= 1 ? '00' : val;
        $('#' + id).val(val);
    }
</script>

<script type="text/javascript" src="<?= Yii::app()->request->baseUrl ?>/js/vendor/jquery.simplefileinput.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/croppic/croppic.css" />
<script src="<?= Yii::app()->request->baseUrl ?>/js/croppic/croppic.min.js"></script>                
<script>
    var croppicContainerEyecandyOptions = {
        uploadUrl: '<?= Yii::app()->request->baseUrl ?>/croppic/saveOriginalImage',
        cropUrl: '<?= Yii::app()->request->baseUrl ?>/croppic/saveCroppedImage',
        //imgEyecandy:false,
        loaderHtml: '<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
        outputUrlId: 'Baby_banner',
    }
    var babyBannerEyecandy = new Croppic('babyBannerCandy', croppicContainerEyecandyOptions);
</script>
<script>
    var croppicContainerEyecandyOptions1 = {
        uploadUrl: '<?= Yii::app()->request->baseUrl ?>/croppic/saveOriginalImage',
        cropUrl: '<?= Yii::app()->request->baseUrl ?>/croppic/saveCroppedImage',
        //imgEyecandy:false,
        loaderHtml: '<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
        outputUrlId: 'Baby_image',
    }
    var babyBannerEyecandy1 = new Croppic('babyImageCandy', croppicContainerEyecandyOptions1);
</script>

<script>
    function changeSunSign(id) {
        var val = $('#Baby_sun_sign').val();
        $('.signs').each(function(index, element) {
            var el_id = element.id;
            $('#' + el_id).css('border-color', '#bdc3c7');
        });
		
        if (id != val) {
            $('#sign_' + id).css('border-color', 'red');
            $('#Baby_sun_sign').val(id);
        } else {
            $('#Baby_sun_sign').val('');
        }
    }
</script>

<script>
    var i = 0;
    function addFamilyMember() {
        var name = $('#autoUser').val();
        var con = $('#connection').val();
        $.ajax({
            url: '<?= Yii::app()->request->baseUrl ?>/controlPanel/checkUser?user=' + name + '&con=' + con,
            success: function(data) {
                var arr = jQuery.parseJSON(data);
                if (arr['status'] == 'success') {
                    $('.family-list').append('<div class="relationship-wrap" id="' + i + '"><div class="relationship-actions"><a href="javascript:void(0)" onclick="removeFamilyMember(' + i + ')" class="act-remove">Remove</a></div><img src="' + arr['image'] + '" class="person-thumb" width="50" height="50" /><div class="person-overview"><h3 class="person-name">' + name + '<input type="hidden" name="BabyFamily[user_id][]" value="' + arr['user_id'] + '"></h3><span class="person-connection">' + arr['connection'] + '<input type="hidden" name="BabyFamily[connection_id][]" value="' + con + '"></span></div></div>');
                    i++;
                } else {
                    alert("This User can't be found in our database.");
                }
                $('#autoUser').val('');
            }
        });
    }
    function removeFamilyMember(id) {
        $('#' + id).remove();
    }
</script>

<script>
    var j = 0;
    function addDoctor() {
        var name = jQuery.trim($('#autoDoctor').val());
		if(name){
			$.ajax({
				url: '<?= Yii::app()->request->baseUrl ?>/controlPanel/checkDoctor?user=' + name,
				success: function(data) {
					var arr = jQuery.parseJSON(data);
					if (arr['status'] == 'success') {
						$('.doctors-list').append('<div class="relationship-wrap" id="' + j + '"><div class="relationship-actions"><a href="javascript:void(0)" onclick="removeDoctor(' + j + ')" class="act-remove">Remove</a></div><img src="' + arr['image'] + '" class="person-thumb" width="50" height="50" /><div class="person-overview"><h3 class="person-name">' + name + '<input type="hidden" name="BabyDoctorHospital[doctor_id][]" value="' + arr['doctor_id'] + '"></h3><input type="hidden" name="BabyDoctorHospital[is_hospital][]" value="' + arr['is_hospital'] + '"></div></div>');
						j++;
						$('#autoDoctor').val('');
					} else {
						if(confirm("This Doctor can't be found in our database, Do you want to create new doctor?")){
							$('#doc-cr').attr('href','<?=Yii::app()->request->baseUrl?>/controlPanel/createDoctor?doc='+encodeURIComponent(name));
							$('#doc-cr').click();
						}else{
							$('#autoDoctor').val('');
						}
					}
				}
			});
		}else{
			$('#autoDoctor').val('');
			alert('Please Enter Doctor Name.');
		}
    }
    function removeDoctor(id) {
        $('#' + id).remove();
    }
</script>

<script>
    function changeSign() {
        var d = $('#production-day').val();
        var m = $('#production-month').val();
		
        if (m == 12) {
            if (d < 22) {
                changeSunSign(11);
            } else {
                changeSunSign(12);
            }
        } else if (m == 11) {
            if (d < 22) {
                changeSunSign(10);
            } else {
                changeSunSign(11);
            }
        } else if (m == 10) {
            if (d < 23) {
                changeSunSign(9);
            } else {
                changeSunSign(10);
            }
        } else if (m == 9) {
            if (d < 22) {
                changeSunSign(8);
            } else {
                changeSunSign(9);
            }
        } else if (m == 8) {
            if (d < 23) {
                changeSunSign(7);
            } else {
                changeSunSign(8);
            }
        } else if (m == 7) {
            if (d < 23) {
                changeSunSign(6);
            } else {
                changeSunSign(7);
            }
        } else if (m == 6) {
            if (d < 21) {
                changeSunSign(5);
            } else {
                changeSunSign(6);
            }
        } else if (m == 5) {
            if (d < 21) {
                changeSunSign(4);
            } else {
                changeSunSign(5);
            }
        } else if (m == 4) {
            if (d < 20) {
                changeSunSign(3);
            } else {
                changeSunSign(4);
            }
        } else if (m == 3) {
            if (d < 21) {
                changeSunSign(2);
            } else {
                changeSunSign(3);
            }
        } else if (m == 2) {
            if (d < 19) {
                changeSunSign(1);
            } else {
                changeSunSign(2);
            }
        } else if (m == 1) {
            if (d < 20) {
                changeSunSign(12);
            } else {
                changeSunSign(1);
            }
        } else {
            alert('Please choose a valid birthday!');
        }
    }
</script>