<div id="timeline-board" class="page-wrap">
    <div class="page-head">
        <div class="page-actions family-tabs">
            <a href="<?= Yii::app()->request->urlReferrer; ?>" class="back">Back</a>
            <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/manageFriends" class="profile-link">
                Manage Friends
            </a>
            <a href="<?= Yii::app()->request->baseUrl ?>/controlPanel/inviteFriends" class="profile-link current">
                Invite Friends
            </a>
            <a href="javascript:void(0)">
            </a>
        </div>
    </div>
    <!-- /.page-head -->
    <section class="page-contain">
        <?php
        if (Yii::app()->user->hasFlash("wrongUser")) {
            echo '<div class="alert alert-danger">' . Yii::app()->user->getFlash("wrongUser") . '</div>';
        } elseif (Yii::app()->user->hasFlash("successUser")) {
            echo '<div class="alert alert-success">' . Yii::app()->user->getFlash("successUser") . '</div>';
        }
        ?>
        <form action="" class="form-wrap cp-forms" method="post">
            <h1>Invite friends!</h1>
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="profile-name">PROFILE NAME:</label>
                    <div class="controls">
                        <?php
                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name' => 'friend_name',
                            'source' => Helper::ListUsersComplete(), //Helper::ListUsers(),
                            // additional javascript options for the autocomplete plugin
                            'options' => array(
                            //'minLength'=>'2',
                            ),
                            'htmlOptions' => array(
                                'class' => 'input-xmedium',
                                'placeholder' => 'Enter member name',
                                'id'=>'autoUser'
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
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="category">Select:</label>
                    <div class="controls">
                        <?php
                        echo CHtml::dropDownList('connection', '', CHtml::listData(Connection::model()->findAll(), 'id', 'title'), array('class' => "form-select input-xlarge", 'empty' => 'No Connection'));
                        ?>
                    </div>
                </div>
                
                <div class="submit-btn-wrap">
                    <button type="submit" class="btn btn-green btn-submit">Send invitation</button>
                </div>
                
                <div class="clear"><br><br><br><br><br><br></div>
                <div style="margin-left:25px;">
                    <h4>Send invitation:</h4>
                    <ul class="social-registrator paddLeft20">
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
                                <!--<label class="checkbox">
                                    <input type="checkbox" name="gender" id="gender" />
                                    <span>Send me confirmation of receipt</span>
                                </label>-->
                                <button id="facebook-submit" type="button" class="btn btn-red btn-submit">Send social invitation</button>
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
                                <!--<label class="checkbox">
                                    <input type="checkbox" name="gender" id="gender" />
                                    <span>Send me confirmation of receipt</span>
                                </label>-->
                                <a href="javascript:void(0)" id="tw-submit" onclick="shareTwitter()"><button class="btn btn-red btn-submit group-invite" type="button">Send social invitation</button></a>
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
                                <!--<label class="checkbox">
                                    <input type="checkbox" name="gender" id="gender" />
                                    <span>Send me confirmation of receipt</span>
                                </label>-->
    
                                <button
                                    class="g-interactivepost btn btn-red btn-submit group-invite"
                                    data-contenturl="<?= Yii::app()->request->getBaseUrl(true) ?>"
                                    data-contentdeeplinkid="<?= Yii::app()->request->getBaseUrl(true) ?>"
                                    data-clientid="549620825954-gdumfg3tc548ejo8fet7l6jfndn8m0m1.apps.googleusercontent.com"
                                    data-cookiepolicy="single_host_origin"
                                    data-prefilltext="Check out this application."
                                    data-calltoactionlabel="INVITE"
                                    data-calltoactionurl="<?= Yii::app()->request->getBaseUrl(true) ?>"
                                    data-calltoactiondeeplinkid="<?= Yii::app()->request->getBaseUrl(true) ?>" type="button">
                                    Send social invitation</button>
    
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
                                <!--<label class="checkbox">
                                    <input type="checkbox" name="gender" id="gender" />
                                    <span>Send me confirmation of receipt</span>
                                </label>
                                 Go to www.addthis.com/dashboard to generate a new set of sharing buttons -->
                                <a href="javascript:void(0)" onclick="email()" class="btn btn-red btn-submit group-invite">Send social invitation</a>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </section>
    <!-- /.page-contain -->
</div>

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