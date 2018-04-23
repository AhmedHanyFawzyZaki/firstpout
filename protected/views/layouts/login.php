<!DOCTYPE html>  
<!--[if IE 7 ]> <html lang="en" class="ie no-js ie7"> <![endif]-->
<!--[if IE 8 ]> <html lang="en" class="ie no-js ie8"> <![endif]-->
<!--[if IE 9 ]> <html lang="en" class="ie no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> 
<html lang="en"> 
    <!--<![endif]-->
    <head>  
        <!-- Meta -->
        <meta charset="utf-8" />
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="robots" content="noindex,nofollow" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <!-- Titre -->
        <title><?php echo CHtml::encode($this->pageTitle); ?> </title>
        <!-- Include stylesheets -->
        <link href='http://fonts.googleapis.com/css?family=Knewave|Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?= Yii::app()->request->baseUrl ?>/css/globals.css" />	
        <link rel="stylesheet" href="<?= Yii::app()->request->baseUrl ?>/css/front.css" />
        <link rel="stylesheet" href="<?= Yii::app()->request->baseUrl ?>/css/new.css" />
        <link rel="stylesheet" href="<?= Yii::app()->request->baseUrl ?>/css/responsive.home.css" />	
        <script type="text/javascript" src="<?= Yii::app()->request->baseUrl ?>/js/vendor/jquery.js"></script>
        <!--[if lt IE 9]>
        <script type="text/javascript" src="<?= Yii::app()->request->baseUrl ?>/js/vendor/html5shiv.js"></script>
        <![endif]-->
        <script>
            if (/Android|webOS|iPhone|iPod|BlackBerry|IEMobile/i.test(navigator.userAgent)) {
                if (window.location.hash == "#desktop") {
// Stay on desktop website
                } else {
                    window.location = "http://mobile.firstpout.com";
                }

            }
        </script>
    </head> 

    <body class="registration profile">
        <div id="head-container">
            <header id="header">
                <div class="header-wrap container">
                    <a id="logo-home" href="<?= Yii::app()->request->baseUrl ?>/login">
                        <img src="<?= Yii::app()->request->baseUrl ?>/media/<?= Yii::app()->params['logo'] ?>" alt="" />
                    </a>
                    <!-- #logo-home -->
                    <?php
                    $model = new LoginForm;
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id' => 'login',
                        'enableAjaxValidation' => false,
                        'action' => Yii::app()->request->baseUrl . '/login/index',
                        'htmlOptions' => array(
                            'class' => 'login-form',
                        ),
                    ));
                    ?>
                    <div class="controls-wrap">
                        <div class="control-group">
                            <label class="control-label" for="uname">Login Email</label>
                            <div class="controls">
                                <?php echo $form->textField($model, 'username', array('class' => 'input-xlarge', 'placeholder' => 'Login email')) ?>
                                <div class="remember-me">
                                    <label class="checkbox">
                                        <input type="checkbox" name="LoginForm[rememberMe]" id="remember-me" />
                                        <span>Don’t log out</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="pwd">Password</label>
                            <div class="controls">
                                <?php echo $form->passwordField($model, 'password', array('class' => 'input-xlarge', 'placeholder' => 'Password')) ?>
                                <a class="forgot-pass" href="<?= Yii::app()->request->baseUrl ?>/login/forgot">Forgot your password?</a>
                            </div>
                        </div>
                        <button class="btn login-btn" type="submit">Login</button>
                    </div>
                    <?php $this->endWidget(); ?>  
                    <!-- /.login-form -->
                </div>
                <!-- /.header-wrap -->
            </header>
            <!-- /#header -->
        </div>
        <!-- /#head-container -->

        <?php echo $content; ?>


        <footer id="footer-secondary">
            <div class="footer-wrap container">
                <p>Klikając przycisk Rejestracja, akceptujesz nasz Regulamin oraz potwierdzasz zapoznanie się z Zasadami wykorzystania danych, w tym z Zasadami wykorzystywania plików cookie</p>
            </div>
        </footer>
        <!-- /#footer-secondary -->
        <!--<script type="text/javascript" src="<?= Yii::app()->request->baseUrl ?>/js/vendor/jquery.js"></script>-->
        <script type="text/javascript" src="<?= Yii::app()->request->baseUrl ?>/js/vendor/jquery.sticky.min.js"></script>
        <script type="text/javascript" src="<?= Yii::app()->request->baseUrl ?>/js/vendor/jquery.stylish-select.js"></script>
        <script type="text/javascript" src="<?= Yii::app()->request->baseUrl ?>/js/main.js"></script>
        <!-- ./scripts -->
    </body>  
</html>