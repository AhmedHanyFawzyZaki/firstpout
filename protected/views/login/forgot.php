<main id="main" class="container">
    <?php
    if (Yii::app()->user->hasFlash("resetWrong")) {
        echo '<div class="alert alert-danger">' . Yii::app()->user->getFlash("resetWrong") . '</div>';
    }elseif (Yii::app()->user->hasFlash("resetDone")) {
        echo '<div class="alert alert-success">' . Yii::app()->user->getFlash("resetDone") . '</div>';
    }
    ?>
    <div class="hp-row">
        <article class="fp-overview">
            <h1>Forgot password?</h1>
            <h2>Change your password in 2 steps!</h2>
            <h3>Login with:</h3>
            <ul class="social-registrator">
                <a href="<?= Yii::app()->request->baseUrl ?>/login/facebook" class="social-link facebook">
                    <i></i>
                    <span>Facebook</span>
                </a>
                <a href="<?= Yii::app()->request->baseUrl ?>/login/twitter" class="social-link twitter">
                    <i></i>
                    <span>Twitter</span>
                </a>
                <a href="<?= Yii::app()->request->baseUrl ?>/login/google" class="social-link gplus">
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
            'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'registration-form form-wrap', 'style' => 'width:495px;margin-top:90px;'),
        ));
        ?>
        <h3>Enter Your Email Address</h3>
        <div class="control-group">
            <?= $form->labelEx($user, 'email', array('class' => 'control-label', 'style' => 'text-align:left; width:37px;')) ?>
            <div class="controls">
                <?php echo $form->textField($user, 'email', array('class' => 'input-xlarge', 'placeholder' => 'Email address')); ?>
            </div>
        </div>
        <p>
            Check Your email  box!
        </p>
        <br>
        <p>
            <b>Lorem ipsum dolor:</b> sit amet, consectetur adipiscing elit. Integer eu ullamcorper mauris, non tincidunt lacus. Donec pellentesque velit quis ante euismod, ut pellentesque turpis auctor. Mauris est dolor, ullamcorper ut lacus nec, tincidunt euismod ligula. Phasellus euismod et nisl eu ullamcorper. In venenatis purus non nulla suscipit faucibus. In imperdiet, nunc non suscipit mattis, augue dui pulvinar justo, ut elementum lectus est eget neque. Sed suscipit sit amet lectus eu 
        </p>
        <br><br><br><br>
        <div class="submit-btn-wrap">
            <button type="submit" class="btn btn-red btn-submit pull-right">SEND</button>
        </div>
        <?php $this->endWidget(); ?>
        <!-- /.registration-wrap -->
    </div>
</main>
<!-- /#main -->