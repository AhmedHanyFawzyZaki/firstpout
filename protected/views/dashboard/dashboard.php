
<style type="text/css">


    body.dragging, body.dragging * {
        cursor: move !important;
    }

    .dragged {
        position: absolute;
        opacity: 0.5;
        z-index: 2000;
    }

    ol.example li.placeholder {
        position: relative;
        /** More li styles **/
    }
    ol.example li.placeholder:before {
        position: absolute;
        /** Define arrowhead **/
    }
    .example{

        width: 100%;
    }
    ol.example li{
        float: left;
        width: 48%;
    }
</style>


<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css2/inettuts.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css2/inettuts.js.css" rel="stylesheet" type="text/css" />


<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css2/im.css" type="text/css" rel="stylesheet" />

<div id="columns">

    <div class="row-fluid">
        <div class="span3">
            <div class="circle-tile">
                <a href="<?=Yii::app()->request->baseUrl?>/user?group=1">
                    <div class="circle-tile-heading dark-blue">
                        <i class="icon-user mrgr-10 muted"></i>
                    </div>
                </a>
                <div class="circle-tile-content dark-blue">
                    <p>
                        <?= Yii::t('translate', 'Users'); ?>
                    </p>
                    <span>
                        <?= count(User::model()->findAll(array('condition' => 'groups_id=1'))); ?>

                        <i class="ion ion-stats-bars"></i>

                    </span>
                    <a href="<?=Yii::app()->request->baseUrl?>/user?group=1" class="circle-tile-footer"><?= Yii::t('translate', 'More Info'); ?> <i class="fa fa-chevron-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="span3">
            <div class="circle-tile">
                <a href="<?=Yii::app()->request->baseUrl?>/baby">
                    <div class="circle-tile-heading bg-yellow">
                        <i class="icon-male mrgr-10 muted"></i>
                    </div>
                </a>
                <div class="circle-tile-content bg-yellow">
                    <p>
                        <?= Yii::t('translate', 'Babies'); ?>
                    </p>
                    <span>
                        <?= count(Baby::model()->findAll()); ?>

                        <i class="ion ion-stats-bars"></i>

                    </span>
                    <a href="<?=Yii::app()->request->baseUrl?>/baby" class="circle-tile-footer"><?= Yii::t('translate', 'More Info'); ?> <i class="fa fa-chevron-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="span3">
            <div class="circle-tile">
                <a href="<?=Yii::app()->request->baseUrl?>/user?group=2">
                    <div class="circle-tile-heading blue-background">
                        <i class="icon-user-md mrgr-10 muted"></i>
                    </div>
                </a>
                <div class="circle-tile-content blue-background">
                    <p>
                        <?= Yii::t('translate', 'Doctors'); ?>
                    </p>
                    <span>
                        <?= count(User::model()->findAll(array('condition' => 'groups_id=2'))); ?>

                        <i class="ion ion-stats-bars"></i>

                    </span>
                    <a href="<?=Yii::app()->request->baseUrl?>/user?group=2" class="circle-tile-footer"><?= Yii::t('translate', 'More Info'); ?><i class="fa fa-chevron-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="span3">
            <div class="circle-tile">
                <a href="<?=Yii::app()->request->baseUrl?>/product">
                    <div class="circle-tile-heading red">
                        <i class="icon-location-arrow mrgr-10 muted"></i>
                    </div>
                </a>
                <div class="circle-tile-content red">
                    <p>
                        <?= Yii::t('translate', 'Products'); ?>
                    </p>
                    <span>
                        <?=count(Product::model()->findAll())?> 

                        <i class="ion ion-stats-bars"></i>

                    </span>
                    <a href="<?=Yii::app()->request->baseUrl?>/product" class="circle-tile-footer"><?= Yii::t('translate', 'More Info'); ?> <i class="fa fa-chevron-circle-right"></i></a>
                </div>
            </div>
        </div>

    </div>
    
    <div class="row-fluid well" style="width:96.5%;">
        <ul class="shortcuts span12">
            <li class="events">
                <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/album">
                    <span class="fa icon-picture"></span>
                    <span class="shortcuts-label">Albums</span>
                </a>
            </li>
            <li class="events">
                <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/contest">
                    <span class="fa icon-trophy"></span>
                    <span class="shortcuts-label">Contests</span>
                </a>
            </li>
            <li class="events">
                <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/productCategory">
                    <span class="fa icon-sitemap"></span>
                    <span class="shortcuts-label">Product Categories</span>
                </a>
            </li>
            <li class="events">
                <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/product">
                    <span class="fa icon-location-arrow"></span>
                    <span class="shortcuts-label">Products</span>
                </a>
            </li>
            <!--<li class="events">
                <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/comment">
                    <span class="fa icon-comment-alt"></span>
                    <span class="shortcuts-label">Comments</span>
                </a>
            </li>
            <li class="events">
                <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/favourite">
                    <span class="fa icon-heart"></span>
                    <span class="shortcuts-label">Favourites</span>
                </a>
            </li>
            <li class="events">
                <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/like">
                    <span class="fa icon-thumbs-up"></span>
                    <span class="shortcuts-label">Likes</span>
                </a>
            </li>-->
            <li class="events">
                <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/post">
                    <span class="fa icon-tags"></span>
                    <span class="shortcuts-label">Posts</span>
                </a>
            </li>
            <li class="events">
                <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/group">
                    <span class="fa icon-group"></span>
                    <span class="shortcuts-label">Groups</span>
                </a>
            </li>
            <li class="events">
                <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/visit">
                    <span class="fa icon-list-alt"></span>
                    <span class="shortcuts-label">Visits</span>
                </a>
            </li>
            <li class="events">
                <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/vaccine">
                    <span class="fa icon-tint"></span>
                    <span class="shortcuts-label">Vaccines</span>
                </a>
            </li>
            <li class="events">
                <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/appointment">
                    <span class="fa icon-calendar"></span>
                    <span class="shortcuts-label">Appointments</span>
                </a>
            </li>
            
            <li class="events">
                <a class="btn" href="<?php echo Yii::app()->baseUrl; ?>/ads">
                    <span class="fa icon-puzzle-piece"></span>
                    <span class="shortcuts-label">Advertisements</span>
                </a>
            </li>
        </ul>

        <div class="span7">
        </div>
    </div>

    <!--<div class="row-fluid">

        <div class="span6 block2 box-header">
            <h3>Users</h3>

            <div class="panel panel-default">

                <div class="panel-body">
                    <div id="morris-line-chart"></div>
                </div>
            </div>
        </div>



        <div class="span6 block2 box-header2">
            <h3>Products</h3>

            <div class="panel panel-default">

                <div class="panel-body">
                    <div id="morris-donut-chart"></div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {

            Morris.Donut({
            element: 'morris-donut-chart',
                    data: [
                    {
                    label: "<?php echo Yii::t('translate', 'Off Target'); ?>",
                            value: < ? //Target::model()->count(array('condition' => 'in_off = 0'))?>
                    }, {
                    label: "<?php echo Yii::t('translate', 'On Target'); ?>",
                            value: < ? //Target::model()->count(array('condition' => 'in_off = 1'))?>
                    }
                    ],
                    resize: true
            });
                    Morris.Line({
                    element: 'morris-line-chart',
                            data: [
<?php
$date = date('Y') - 7;
for ($date; $date <= date('Y'); $date++) {
    ?>
                                {
                                y: '<?= $date ?>',
                                        a: < ? //Lead::model()->getCountByYear($date) ?>,
                                        b: < ? //Opportunity::model()->getCountByYear($date) ?>
                                },
<?php } ?>
                            ],
                            xkey: 'y',
                            ykeys: ['a', 'b'], labels: ['Leads', 'Opportunities'],
                            hideHover: 'auto',
                            resize: true
                    });
            });</script>




    </div>-->

    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js2/jquery.metisMenu.js"></script>
    <!-- MORRIS CHART SCRIPTS -->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js2/morris/raphael-2.1.0.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js2/morris/morris.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js2/custom.js"></script>

    <div class="clear"></div>
    <!-- /.outer -->
</div>
<!-- END CONTENT -->
