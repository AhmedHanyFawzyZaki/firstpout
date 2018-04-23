<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="description" content="<?php echo CHtml::encode($this->pageTitle); ?>">
        <meta name="author" content="Ahmed Hany">

        <style>
            .box .body, .box .block{
                min-height: 372px !important;
            }
        </style>

        <?php
        //if (Yii::app()->getLanguage() == 'en') {
        echo '<link type="text/css" rel="stylesheet" href="' . Yii::app()->request->baseUrl . '/css/style.css">';
		Yii::app()->bootstrap->register();
        ?>

        <!--<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/chat/css/screen.css" />-->

        <!--<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/autocomplete/jquery-ui-1.10.4.js"></script>-->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/date.js"></script>

        <!--<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fullcalendar.css" />-->
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/Font-awesome/css/font-awesome.min.css" />

        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/os_temp.css"/>
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.window.css"/>
        <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/morris-0.4.3.min.css" />
        
    </head>
    
    <body class="hide-sidebar" >

        <div id="wrap">

            <!-- #top -->
            <div id="top">

                <!-- .navbar -->
                <div class="navbar navbar-inverse navbar-static-top">
                    <div class="navbar-inner">
                        <div class="container-fluid">

                            <a class="brand" href="#">
                                <?php echo Yii::t('translate', Yii::app()->name); ?></a>
                            </a>

                            
                        </div>
                    </div>
                </div>
                <!-- /.navbar -->
            </div>
            <!-- /#top -->

            <!-- #content -->
            <div id="content">
                <!-- .outer -->
                <div class="container-fluid outer">
                    <div class="row-fluid">
                        <!-- .inner -->
                        <div class="span12 inner">
                            <!--Begin Datatables-->
                            <div class="row-fluid">
                                <div class="span12">
                                    <div class="box dark">
                                        <header>
                                            <div class="icons"><i class="icon-eye-open"></i></div>
                                            <?php
                                            if (Yii::app()->controller->id == 'dashboard' and Yii::app()->controller->action->id == 'index') {
												echo "<h5>Dashboard</h5>";
                                            } else {
                                                echo "<h5>" . $this->pageTitlecrumbs . "</h5>";
                                            }
                                            ?>
                                            
                                        </header>

                                        <div id="collapse4" class="body">
                                            <?php echo $content; ?>

                                        </div>

                                    </div>
                                </div>
                                <!--End Datatables-->
                            </div>
                            <!-- /.row-fluid -->
                        </div>
                        <!-- /.outer -->
                    </div>
                    <!-- /#content -->
                    <!-- #push do not remove -->
                    <div id="push"></div>
                    <!-- /#push -->
                </div>
                <!-- /#wrap -->
                <div id="footer">
                    <p><?php echo date('Y'); ?> &copy; Ahmed Hany</p>
                </div>

                
                <!---------Crop and upload----------------->
        
                <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
                <!--[if lt IE 9]>
                  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
                <![endif]-->
                
                <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/croppic/croppic.css" />
				<script src="<?=Yii::app()->request->baseUrl?>/js/croppic/croppic.min.js"></script>                
        
                <script>
                    var croppicContainerEyecandyOptions = {
                            uploadUrl:'<?=Yii::app()->request->baseUrl?>/croppic/saveOriginalImage',
                            cropUrl:'<?=Yii::app()->request->baseUrl?>/croppic/saveCroppedImage',
                            //imgEyecandy:false,
                            loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
							outputUrlId:'User_image',
                    }
                    var cropContainerEyecandy = new Croppic('cropContainerEyecandy', croppicContainerEyecandyOptions);
					
					var bannerOptions = {
                            uploadUrl:'<?=Yii::app()->request->baseUrl?>/croppic/saveOriginalImage',
                            cropUrl:'<?=Yii::app()->request->baseUrl?>/croppic/saveCroppedImage',
                            //imgEyecandy:false,
                            loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
							outputUrlId:'User_banner',
                    }
                    var cropContainerEyecandy = new Croppic('bannerCandy', bannerOptions);
                    
                </script>
                <!---------end Crop and upload----------------->
                
                </body>
                </html>