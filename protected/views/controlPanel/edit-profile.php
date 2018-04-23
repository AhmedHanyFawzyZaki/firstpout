<style>
    img{
        max-width:2000px !important;
    }
</style>
<div id="timeline-board" class="page-wrap">
    <div class="page-head">
        <div class="page-actions family-tabs">
            <a href="<?= Yii::app()->request->baseUrl ?>/home" class="back">Back</a>
            <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/editProfile" class="profile-link current">
                Edit Profile
            </a>
            <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/linkSocial" class="profile-link">
                Social Accounts
            </a>
            <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/viewProfiles" class="profile-link">
                View Profiles
            </a>
            <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/createProfile" class="create-profile">Create user profile</a>
        </div>
    </div>
    <!-- /.page-head -->
    <section class="page-contain">
        <?php
        if (Yii::app()->user->hasFlash("WrongGroup")) {
            echo '<div class="alert alert-success">' . Yii::app()->user->getFlash("WrongGroup") . '</div>';
        }
        ?>
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'user-form',
            //'enableAjaxValidation' => true,
            'type' => 'horizontal',
            'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'form-wrap cp-forms'),
        ));
        ?>
        <h1>Edit profile!</h1>
        <fieldset>
            <?php echo $form->textFieldRow($model, 'username', array('class' => 'input-xmedium', 'placeholder' => 'Profile Name')); ?>
            <div class="control-group">
                <label class="control-label" for="Password">Password</label>
                <div class="controls">
                	<a href="<?=Yii::app()->request->baseUrl?>/controlPanel/changePassword" class="changable-value fancybox">CHANGE PASSWORD</a>
                </div>
            </div>
            <?php echo $form->textFieldRow($model, 'street', array('class' => 'input-xmedium', 'placeholder' => 'Street')); ?>
            <?php echo $form->textFieldRow($model, 'city', array('class' => 'input-xmedium', 'placeholder' => 'City')); ?>
            <?php echo $form->dropDownListRow($model, 'country', CHtml::listData(AllCountries::model()->findAll(), 'country_id', 'country_name'), array('class' => 'form-select input-xlarge', 'placeholder' => 'Country')); ?>
            <?php echo $form->textAreaRow($model, 'desc', array('class' => 'input-xmedium', 'placeholder' => 'Description')); ?>
            <div class="control-group">
                <label class="control-label" for="gender">Gender</label>
                <div class="controls">
                    <div class="checkbox-wrap">
                        <label class="checkbox">
                            <input type="radio" name="User[gender]" value="1" <?= $model->gender == 1 ? 'checked' : '' ?> id="gender" />
                            <span>MALE</span>
                        </label>
                        <label class="checkbox">
                            <input type="radio" name="User[gender]" value="2" <?= $model->gender == 2 ? 'checked' : '' ?>/>
                            <span>FEMALE</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="profile-name">PROFILE PICTURE:<small>Little description of photo uploading here</small></label>
                <div class="controls">
                    <?php echo $form->hiddenField($model, 'image'); ?>
                    <div id="cropContainerEyecandy" class="pull-left">
                        <?php
                        if ($model->image) {
                            echo '<img src="' . $model->image . '" class="croppedImg">';
                        }
                        ?>
                    </div>
                    <a href="javascript:void(0);" class="avatar avatar-circle pull-left center-user-img">
                        <img src="<?= Yii::app()->request->baseUrl ?>" alt="" class="round-img-70" id="user-round-img"/>
                    </a>
                    <!--<input id="profile-name" name="profile-name" type="file" placeholder="Damian Popiół" class="form-uploader">-->
                </div>
            </div>
        </fieldset>
        <fieldset>
            <?php
            echo $form->dropDownListRow($model, 'connection_id', CHtml::listData(Connection::model()->findAll(), 'id', 'title'), array('class' => "form-select input-xmedium"));
            ?>
        </fieldset>
        <fieldset>
            <div class="control-group">
                <label class="control-label" for="connections">RelationShips:</label>
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

                        <a href="javascript:void(0)" onClick="addRelationShip()" class="add-btn"><i></i></a>
                    </div>
                    <div class="relationships-list">
                        <?php
                        if ($model_users) {
                            foreach ($model_users as $i => $mu) {
                                echo '<div class="relationship-wrap" id="user_group_' . $i . '">
											<div class="relationship-actions">
												<a href="javascript:void(0)" onclick="removeGroupAdmin(\'user_group_' . $i . '\')" class="act-remove">Remove
												</a>
											</div>
											<img src="' . $mu->user->image . '" class="person-thumb" width="50" height="50" />
											<div class="person-overview">
												<h3 class="person-name">' . $mu->user->username . '<input type="hidden" name="UserRelationShip[user_id][]" value="' . $mu->user_id . '">
												</h3>
												<span class="person-connection">' . $mu->connection->title . '<input type="hidden" name="UserRelationShip[connection_id][]" value="' . $mu->connection_id . '">
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
        <?php /* <fieldset>
          <h4>Send invitation:</h4>
          <!--<div class="social-grabber socials">
          <a href="#" class="src-email">
          <span>E-mail</span>
          </a>
          <a href="#" class="src-flickr">
          <span>Flickr</span>
          </a>
          <a href="#" class="src-facebook current">
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
          </div>-->
          <ul class="social-registrator">
          <a href="javascript:void(0)" id="invite_facebook" style="margin-left: 0px !important;" class="social-link facebook medium-social">
          <i></i>
          <span>Facebook</span>
          </a>
          <a href="javascript:void(0)" id="invite_twitter" class="social-link twitter medium-social">
          <i></i>
          <span>Twitter</span>
          </a>
          <a href="javascript:void(0)" id="invite_plus" class="social-link gplus medium-social">
          <i></i>
          <span>Google+</span>
          </a>
          <a href="javascript:void(0)" id="invite_email" class="social-link email medium-social">
          <i></i>
          <span>Email</span>
          </a>
          </ul>
          <div class="invitation-form form-wrap" id="div_face">
          <div class="control-group">
          <div class="controls">
          <input id="fb-title" name="fb-title" type="text" placeholder="Enter title" class="input-xlarge">
          </div>
          </div>
          <div class="control-group">
          <div class="controls">
          <textarea id="fb-msg" name="fb-msg" placeholder="Enter message" class="textarea-xlarge">Check out this application!</textarea>
          </div>
          </div>
          <div class="control-group width-450">
          <div class="controls">
          <label class="checkbox">
          <input type="checkbox" name="gender" id="gender" />
          <span>Send me confirmation of receipt</span>
          </label>
          <button id="facebook-submit" type="button" class="btn btn-red btn-submit">Send it</button>
          </div>
          </div>
          </div>
          <div class="invitation-form form-wrap" id="div_twitter" style="display: none;">
          <div class="control-group">
          <div class="controls">
          <input id="tw-account" type="text" placeholder="Relate account?" class="input-xlarge">
          </div>
          </div>
          <div class="control-group">
          <div class="controls">
          <textarea id="tw-msg" placeholder="Enter message" class="textarea-xlarge">Check out this application!</textarea>
          </div>
          </div>
          <div class="control-group width-450">
          <div class="controls">
          <label class="checkbox">
          <input type="checkbox" name="gender" id="gender" />
          <span>Send me confirmation of receipt</span>
          </label>
          <a href="javascript:void(0)" id="tw-submit" onclick="shareTwitter()"><button class="btn btn-red btn-submit group-invite">Send it</button></a>
          </div>
          </div>
          </div>
          <div class="invitation-form form-wrap" id="div_google" style="display: none;">
          <div class="control-group">
          <div class="controls">
          <input id="gp-account" type="text" placeholder="Enter account" class="input-xlarge">
          </div>
          </div>
          <div class="control-group">
          <div class="controls">
          <textarea id="gp-msg" placeholder="Enter message" class="textarea-xlarge">Check out this application!</textarea>
          </div>
          </div>
          <div class="control-group width-450">
          <div class="controls">
          <label class="checkbox">
          <input type="checkbox" name="gender" id="gender" />
          <span>Send me confirmation of receipt</span>
          </label>

          <button
          class="g-interactivepost btn btn-red btn-submit group-invite"
          data-contenturl="<?= Yii::app()->request->getBaseUrl(true) ?>"
          data-contentdeeplinkid="<?= Yii::app()->request->getBaseUrl(true) ?>"
          data-clientid="549620825954-gdumfg3tc548ejo8fet7l6jfndn8m0m1.apps.googleusercontent.com"
          data-cookiepolicy="single_host_origin"
          data-prefilltext="Check out this application."
          data-calltoactionlabel="INVITE"
          data-calltoactionurl="<?= Yii::app()->request->getBaseUrl(true) ?>"
          data-calltoactiondeeplinkid="<?= Yii::app()->request->getBaseUrl(true) ?>">
          Send it</button>

          </div>
          </div>
          </div>
          <div class="invitation-form form-wrap" id="div_email" style="display: none;">
          <div class="control-group">
          <div class="controls">
          <input id="email-account" name="emails" type="text" placeholder="Your Email" class="input-xlarge">
          </div>
          </div>
          <div class="control-group">
          <div class="controls">
          <textarea id="email-msg" name="msg" placeholder="Enter message" class="textarea-xlarge">Check out this application!</textarea>
          </div>
          </div>
          <div class="control-group width-450">
          <div class="controls">
          <label class="checkbox">
          <input type="checkbox" name="gender" id="gender" />
          <span>Send me confirmation of receipt</span>
          </label>
          <!-- Go to www.addthis.com/dashboard to generate a new set of sharing buttons -->
          <a href="javascript:void(0)" onclick="email()" class="btn btn-red btn-submit group-invite">Send it</a>
          </div>
          </div>
          </div>
          </fieldset> */ ?>
        <!--<fieldset>
            <div class="control-group">
                <label class="control-label" for="other-settings">other settings:</label>
                <div class="controls">
                    <select name="other-settings" id="other-settings" class="form-select input-xmedium">
                        <option value="father">Father</option>
                        <option value="mother">Mother</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <div class="confirmations-wrap">
                    <label class="checkbox">
                        <input type="radio" name="update-me" id="update-me" />
                        <span>Send me confirmation of receipt</span>
                    </label>
                    <label class="checkbox">
                        <input type="radio" name="update-me" />
                        <span>Send me confirmation of receipt</span>
                    </label>
                </div>
              </div>
            </div>
        </fieldset>-->
        <div class="submit-btn-wrap">
            <button type="submit" class="btn btn-green btn-submit">Update profile</button>
        </div>
        <?php $this->endWidget(); ?>
    </section>
    <!-- /.page-contain -->
</div>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/croppic/croppic.css" />
<script src="<?= Yii::app()->request->baseUrl ?>/js/croppic/croppic.min.js"></script>                
<script>
                            var croppicContainerEyecandyOptions = {
                                uploadUrl: '<?= Yii::app()->request->baseUrl ?>/croppic/saveOriginalImage',
                                cropUrl: '<?= Yii::app()->request->baseUrl ?>/croppic/saveCroppedImage',
                                //imgEyecandy:false,
                                loaderHtml: '<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
                                outputUrlId: 'User_image',
                            }
                            var userImageEyecandy = new Croppic('cropContainerEyecandy', croppicContainerEyecandyOptions);
</script>

<script>
    $(document).ready(function() {
        setInterval(function() {
            if ($('#User_image').val())
            {
                $('#user-round-img').attr('src', $('#User_image').val());
            }
        }, 2000);
    });
</script>


<script>
    $(document).ready(function() {
        $('#invite_facebook').click(function() {
            $('#div_face').css('display', 'block');
            $('#div_twitter').css('display', 'none');
            $('#div_google').css('display', 'none');
            $('#div_email').css('display', 'none');

            $('#invite_facebook').addClass('active');
            $('#invite_twitter').removeClass('active');
            $('#invite_plus').removeClass('active');
            $('#invite_email').removeClass('active');
        });
        $('#invite_twitter').click(function() {
            $('#div_face').css('display', 'none');
            $('#div_twitter').css('display', 'block');
            $('#div_google').css('display', 'none');
            $('#div_email').css('display', 'none');

            $('#invite_facebook').removeClass('active');
            $('#invite_twitter').addClass('active');
            $('#invite_plus').removeClass('active');
            $('#invite_email').removeClass('active');
        });
        $('#invite_plus').click(function() {
            $('#div_face').css('display', 'none');
            $('#div_twitter').css('display', 'none');
            $('#div_google').css('display', 'block');
            $('#div_email').css('display', 'none');

            $('#invite_facebook').removeClass('active');
            $('#invite_twitter').removeClass('active');
            $('#invite_plus').addClass('active');
            $('#invite_email').removeClass('active');
        });
        $('#invite_email').click(function() {
            $('#div_face').css('display', 'none');
            $('#div_twitter').css('display', 'none');
            $('#div_google').css('display', 'none');
            $('#div_email').css('display', 'block');
            $('#invite_facebook').removeClass('active');
            $('#invite_twitter').removeClass('active');
            $('#invite_plus').removeClass('active');
            $('#invite_email').addClass('active');
        });
    });

    window.fbAsyncInit = function() {
        FB.init({
            appId: '731218783581076',
            status: true,
            cookie: true,
            oauth: true,
            xfbml: true
        });
    };

    $('#facebook-submit').click(sendRequest);
    function sendRequest() {
        FB.ui({
            method: 'apprequests',
            message: $('#fb-msg').val(),
            title: $('#fb-title').val(),
        });
        /*function (response) {
         if (response.request && response.to) {
         var request_ids = [];
         for(i=0; i<response.to.length; i++) {
         var temp = response.request + '_' + response.to[i];
         request_ids.push(temp);
         }
         var requests = request_ids.join(',');
<?php
//$user= Yii::app()->facebook->api('/me');
?>
         //$.post('handle_requests.php',{uid: '<?php echo $user['id']; ?>', request_ids: requests},function(resp) {
         // callback after storing the requests
         });
         } else {
         //request cancelled
         }
         });*/
        return false;
    }

    // Load the SDK Asynchronously
    (function(d) {
        var js, id = 'facebook-jssdk';
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement('script');
        js.id = id;
        js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        d.getElementsByTagName('head')[0].appendChild(js);
    }(document));
</script>

<script type="text/javascript">
    (function() {
        var po = document.createElement('script');
        po.type = 'text/javascript';
        po.async = true;
        po.src = 'https://apis.google.com/js/client:plusone.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(po, s);
    })();
</script>

<script>
    function email() {
        var emailText = $('#email-msg').val();
        var emailAccount = $('#email-account').val();
        var emailLink = 'https://api.addthis.com/oexchange/0.8/forward/email/offer?url=<?= Yii::app()->request->getBaseUrl(true) ?>&pubid=ra-51f9247d3cca3259&ct=1&title=' + emailText + '&pco=tbxnj-1.0&from=' + emailAccount;
        window.open(emailLink, '_blank');
    }
</script>

<script>
    function shareTwitter() {
        var twText = $('#tw-msg').val();
        var twAccount = $('#tw-account').val();
        var twLink = 'https://twitter.com/intent/tweet?original_referer=<?= Yii::app()->request->getBaseUrl(true) ?>&related=' + twAccount + '&text=' + twText + '&url=<?= Yii::app()->request->getBaseUrl(true) ?>&via=<?= Yii::app()->name ?>';
        window.open(twLink, '_blank');
    }
</script>

<script>
    var i = 0;
    function addRelationShip() {
        var name = $('#autoUser').val();
        var con = $('#connection').val();
        $.ajax({
            url: '<?= Yii::app()->request->baseUrl ?>/controlPanel/checkUser?user=' + name + '&con=' + con,
            success: function(data) {
                var arr = jQuery.parseJSON(data);
                if (arr['status'] == 'success') {
                    $('.relationships-list').append('<div class="relationship-wrap" id="' + i + '"><div class="relationship-actions"><a href="javascript:void(0)" onclick="removeGroupAdmin(' + i + ')" class="act-remove">Remove</a></div><img src="' + arr['image'] + '" class="person-thumb" width="50" height="50" /><div class="person-overview"><h3 class="person-name">' + name + '<input type="hidden" name="UserRelationShip[user_id][]" value="' + arr['user_id'] + '"></h3><span class="person-connection">' + arr['connection'] + '<input type="hidden" name="UserRelationShip[connection_id][]" value="' + con + '"></span></div></div>');
                } else {
                    alert("This User can't be found in our database.");
                }
                $('#autoUser').val('');
            }
        });
    }
    function removeGroupAdmin(id) {
        $('#' + id).remove();
    }
</script>