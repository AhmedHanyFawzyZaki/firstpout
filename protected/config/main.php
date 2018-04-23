<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');


return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'FirstPout',
    'defaultController' => 'home',
    //'homeUrl'=>'home',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'ext.YiiMailer.YiiMailer',
        /*         * * for gallery extesnion *** */
        'ext.galleryManager.*',
        'ext.galleryManager.models.*',
        'ext.galleryManager.GalleryController',
        'ext.yiisortablemodel.models.*',
        'ext.yii_select2.Select2',
    ),
    //'viewPath' => 'views/admin',
    'controllerMap' => array(
        'floara' => array(
            'class' => 'ext.floara.FloaraController',
        ),
    ),
    //'theme'=>'bootstrap', // requires you to copy the theme under your themes directory
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'admin',
            'generatorPaths' => array(
                'bootstrap.gii',
            ),
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('*', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'bootstrap' => array(
            'class' => 'bootstrap.components.Bootstrap',
        ),
        'phpThumb' => array(
            'class' => 'ext.EPhpThumb.EPhpThumb.EPhpThumb',
        ),
        'facebook' => array(
            'class' => 'ext.yii-facebook-opengraph.SFacebook',
            'appId' => '731218783581076', // needed for JS SDK, Social Plugins and PHP SDK
            'secret' => 'd80e246c97bafa0988e986992c2e3bcb', // needed for the PHP SDK
        //'fileUpload'=>false, // needed to support API POST requests which send files
        //'trustForwarded'=>false, // trust HTTP_X_FORWARDED_* headers ?
        //'locale'=>'en_US', // override locale setting (defaults to en_US)
        //'jsSdk'=>true, // don't include JS SDK
        //'async'=>true, // load JS SDK asynchronously
        //'jsCallback'=>false, // declare if you are going to be inserting any JS callbacks to the async JS SDK loader
        //'status'=>true, // JS SDK - check login status
        //'cookie'=>true, // JS SDK - enable cookies to allow the server to access the session
        //'oauth'=>true,  // JS SDK - enable OAuth 2.0
        //'xfbml'=>true,  // JS SDK - parse XFBML / html5 Social Plugins
        //'frictionlessRequests'=>true, // JS SDK - enable frictionless requests for request dialogs
        //'html5'=>true,  // use html5 Social Plugins instead of XFBML
        //'ogTags'=>array(  // set default OG tags
        //'og:title'=>'MY_WEBSITE_NAME',
        //'og:description'=>'MY_WEBSITE_DESCRIPTION',
        //'og:image'=>'URL_TO_WEBSITE_LOGO',
        //),
        ),
        'twitter' => array(
            'class' => 'ext.yiitwitteroauth.YiiTwitter',
            'consumer_key' => '8e1ki0VPkijEuxSgX81GhI21V',
            'consumer_secret' => 'g5kFvkdBBdMybauJ0WMdKDgdlCEdkNAvEYaNynIhH91MiRTpoW',
            'callback' => '/login/twitterCallBack',
        ),
        'GoogleApis' => array(
            'class' => 'ext.GoogleApis.GoogleApis',
            // See http://code.google.com/p/google-api-php-client/wiki/OAuth2
            'clientId' => '549620825954-gdumfg3tc548ejo8fet7l6jfndn8m0m1.apps.googleusercontent.com',
            'clientSecret' => 'vEfv9b5UAWRDaxehby_-mWFW',
            'redirectUri' => 'http://localhost/firstpout/login/google',
            // // This is the API key for 'Simple API Access'
            'developerKey' => 'AIzaSyA1vYXqS3z5cPe2W53sqMkiQWmyfJV7Bas',
        ),
        // to disable caching
        'components' => array(
            'assetManager' => array(
                'linkAssets' => false,
            ),
        ),
        /*         * *For gallery extension  ** */
        'widgetFactory' => array(
            'class' => 'CWidgetFactory',
            'widgets' => array(
                'GalleryManager' => array(
                    'controllerRoute' => '/gallery',
                ),
				'SAImageDisplayer'=>array(
                    'baseDir' => 'media',
                    'originalFolderName'=> '',
                    'sizes' =>array(
                        'small' => array('width' => 180, 'height' => 180),
                        'big' => array('width' => 540, 'height' => 299),
                    ),
                    'groups' => array(
                        'posts' => array(
                            'small' => array('width' => 180, 'height' => 180),
                            'big' => array('width' => 540, 'height' => 299),
                        ),
                        'albums' => array(
                            'medium' => array('width' => 270, 'height' => 270),
							'small' => array('width' => 180, 'height' => 180),
                            'big' => array('width' => 540, 'height' => 299),
							'tiny' => array('width' => 95, 'height' => 95),
                        ),
						'contests' => array(
                            'medium' => array('width' => 270, 'height' => 270),
							'small' => array('width' => 180, 'height' => 180),
                            'big' => array('width' => 540, 'height' => 299),
							'tiny' => array('width' => 95, 'height' => 95),
                        ),
                    ),
                ),
            )
        ),
        'image' => array(
            'class' => 'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'GD',
            // ImageMagick setup path
            'params' => array('directory' => '/var/www/projects/PHPLib/ImageMagick-6.8.6-8'),
        ),
        'mailer' => array(
            'class' => 'ext.mail.Mailer',
        ),
        'Paypal' => array(
            'class' => 'application.components.Paypal',
            'apiUsername' => 'ahmed_hany_zaki-facilitator_api1.hotmail.com',
            'apiPassword' => '1399018021', //'1355392425',
            'apiSignature' => 'At26pwh2mx4VGwRCWOEEEOF9qqhEAfYt1hC4cwNXhy-Y1wS0fsrZj-Ap',
            'apiLive' => false,
            'currency' => 'USD',
            'returnUrl' => 'home/confirm/', //regardless of url management component
            'cancelUrl' => 'home/cancel/', //regardless of url management component
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                'home/product/<slug>' => 'home/product',
            ),
        ),
        'db' => array(
            'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
        ),
        // uncomment the following to use a MySQL database
        'db' => require(dirname(__FILE__) . '/connection.php'),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'home/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages


            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'ahmed_hany_zaki@hotmail.com',
        'dateFormat' => 'yy-mm-dd', /* must be the same as the {{dateModelFormat}} but with Y instead of yy (m=>mm , d=>dd) */
        'dateModelFormat' => 'Y-m-d',
        'projectUrl' => 'http://egysn.com',
        'typePost'=>1,
        'typeAlbum'=>2,
        'typeAlbumImage'=>3,
        'typeUser'=>4,
        'typeBaby'=>5,
        'typePostMedia'=>6,
        'typePostImage'=>7,
		'typeContest'=>8,
		'typeContestUser'=>9,
		'typeContestUserImage'=>10,
    ),
);
