<main id="main" class="container">
    <?php
    if (Yii::app()->user->hasFlash("wrong_pass")) {
        echo '<div class="alert alert-danger">' . Yii::app()->user->getFlash("wrong_pass") . '</div>';
    }elseif (Yii::app()->user->hasFlash("done_reset")) {
        echo '<div class="alert alert-success">' . Yii::app()->user->getFlash("done_reset") . '</div>';
    }
    ?>
    <div class="hp-row">
        <article class="fp-overview">
            <h1>Don’t You have account yet?</h1>
            <h2>Create it in 3 steps, now!</h2>
            <h3>Login with:</h3>
            <ul class="social-registrator">
                <a href="<?=Yii::app()->request->baseUrl?>/login/facebook" class="social-link facebook">
                    <i></i>
                    <span>Facebook</span>
                </a>
                <a href="<?=Yii::app()->request->baseUrl?>/login/twitter" class="social-link twitter">
                    <i></i>
                    <span>Twitter</span>
                </a>
                <a href="<?=Yii::app()->request->baseUrl?>/login/google" class="social-link gplus">
                    <i></i>
                    <span>Google+</span>
                </a>
            </ul>
        </article>
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'user-form',
            'enableAjaxValidation' => false,
            'type' => 'horizontal',
            'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'registration-form form-wrap'),
        ));
        ?>
        <h3>Registration</h3>
        <div class="controls-wrap">
            <?php echo $form->textFieldRow($user, 'fname', array('class' => 'input-xlarge', 'maxlength' => 50, 'placeholder' => 'First name')); ?>
            <?php echo $form->textFieldRow($user, 'lname', array('class' => 'input-xlarge', 'maxlength' => 50, 'placeholder' => 'Last name')); ?>
        </div>
        <?php //echo $form->textFieldRow($user, 'username', array('class' => 'input-xlarge', 'maxlength' => 50, 'placeholder'=>'Username'));  ?>
        <?php echo $form->textFieldRow($user, 'email', array('class' => 'input-xlarge', 'placeholder' => 'Email address')); ?>
        <?php echo $form->passwordFieldRow($user, 'password', array('class' => 'input-xlarge', 'placeholder' => 'password')); ?>
        <?php 
			echo '<div class="control-group">';
			echo $form->labelEx($user,'password_repeat', array('class'=>'control-label','style'=>'line-height:20px;'));
			echo '<div class="controls">'.$form->passwordField($user, 'password_repeat', array('class' => 'input-xlarge', 'placeholder' => 'Repeat password')).'</div>';
			echo '</div>';
		?>
        <div class="control-group">
            <label class="control-label" for="birthday-day">Date of birth:</label>
            <div class="controls birthday-wrap">
                <select name="day" id="birthday-day" class="form-select">
                    
                </select>
                <select name="month" id="birthday-month" class="form-select">
                    
                </select>
                <select name="year" id="birthday-year" class="form-select">
                    
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="gender">Gender</label>
            <div class="controls">
                <div class="checkbox-wrap">
                    <label class="checkbox">
                        <input type="radio" name="User[gender]" value="1"/>
                        <span>Male</span>
                    </label>
                    <label class="checkbox">
                        <input type="radio" name="User[gender]" value="2"/>
                        <span>Female</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="submit-btn-wrap">
            <button type="submit" class="btn btn-red btn-big-submit">Register</button>
        </div>
        <?php $this->endWidget(); ?>
        <!-- /.registration-wrap -->
    </div>
</main>
<!-- /#main -->

<script src="<?= Yii::app()->request->baseUrl ?>/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript">

    /***********************************************
     * Drop Down Date select script- by JavaScriptKit.com
     * This notice MUST stay intact for use
     * Visit JavaScript Kit at http://www.javascriptkit.com/ for this script and more
     ***********************************************/
    $(document).ready(function() {
        populatedropdown('birthday-day', 'birthday-month', 'birthday-year');
    });
    var monthtext = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    function populatedropdown(dayfield, monthfield, yearfield) {
        var today = new Date()
        var dayfield = document.getElementById(dayfield)
        var monthfield = document.getElementById(monthfield)
        var yearfield = document.getElementById(yearfield)
        for (var i = 1; i < 32; i++)
            dayfield.options[i] = new Option(i, i)
			//dayfield.options[i] = new Option(i, i + 1)
        dayfield.options[today.getDate()] = new Option(today.getDate(), today.getDate(), true, true) //select today's day
        for (var m = 0; m < 12; m++)
            monthfield.options[m] = new Option(monthtext[m], m+1)
        monthfield.options[today.getMonth()] = new Option(monthtext[today.getMonth()], (today.getMonth()+1), true, true) //select today's month
        var thisyear = today.getFullYear()
        for (var y = 0; y < 90; y++) {
            yearfield.options[y] = new Option(thisyear, thisyear)
            thisyear -= 1
        }
        yearfield.options[0] = new Option(today.getFullYear(), today.getFullYear(), true, true) //select today's year
    }
</script>