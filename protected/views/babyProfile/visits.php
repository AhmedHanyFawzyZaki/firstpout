<div id="timeline-board" class="page-wrap">
    <div class="page-head">
        <?php $this->renderPartial('medical-tabs',array('id'=>$id))?>
    </div>
    <!-- /.page-head -->
    <section class="page-contain visits-listing">
        <div class="visits-overview-block">
            <h2 class="block-title">Visit history</h2>
            <?php
                if($next_visit){
            ?>
            <div class="visit-wrap">
                <div class="visit-overview">
                    <div class="visit-info">
                        <span class="info-label">Diagnose:</span>
                        <p><?= $next_visit->diagonise ?></p>
                    </div>
                    <div class="visit-info">
                        <span class="info-label">Diagnose:</span>
                        <p><?= $next_visit->diagonise ?></p>
                    </div>
                    <div class="visit-info">
                        <span class="info-label">Doctor:</span>
                        <p><?= $next_visit->doctor->username ?></p>
                    </div>
                    <div class="visit-info">
                        <span class="info-label">medication:</span>
                        <p><?= $next_visit->medication ?></p>
                    </div>
                    <div class="visit-info">
                        <span class="info-label">dosage:</span>
                        <p><?= $next_visit->desage ?></p>
                    </div>
                    <div class="visit-info">
                        <span class="info-label">frequency:</span>
                        <p><?= $next_visit->frequency ?></p>
                    </div>
                    <div class="visit-info">
                        <span class="info-label">bage on:</span>
                        <p><?= $next_visit->bage_on ?></p>
                    </div>
                    <div class="visit-info notes">
                        <span class="info-label">Note:</span>
                        <p><?= $next_visit->note ?></p>
                    </div>
                </div>
                <!-- /.visit-overview -->
                <div class="visit-attachment">
                    <span class="info-label">Prescription:</span>
                    <a href="#" class="visit-attachment-thumb">
                        <img src="<?= Yii::app()->request->baseUrl.'/media/babies/'.$next_visit->prescription ?>" alt="" />
                    </a>
                    <a href="<?= Yii::app()->request->baseUrl.'/home/download?src=media/babies/&name='.$next_visit->prescription ?>" class="remove-attachment">Download</a>
                </div>
                <!-- /.visit-attachment -->
            </div>
            <?php
                }else{
                    echo '<div class="visit-wrap"><div class="visit-overview">No upcoming visits.</div></div>';
                }
            ?>
            <!-- /.visit-wrap -->
        </div>
        <?php
            if($visits){
        ?>
            <!-- /.visits-overview-block -->
            <div class="filter-wrap visits-filter-wrap">
                <div class="filter-inner">
                    <label for="filter-visits">Filter:</label>
                    <select name="filter-visits" id="filter-visits" class="form-select">
                        <option value="last-year">Last year</option>
                        <option value="last-30-days">Last 30 days</option>
                        <option value="last-30-hours">Last 30 hours</option>
                    </select>
                </div>
            </div>
            <!-- /.filter-wrap -->
            <?php
                foreach ($visits as $visit){
            ?>
                <div class="visits-overview-block">
                    <h2 class="block-title">Visit history</h2>
                    <div class="visit-wrap">
                        <div class="visit-overview">
                            <div class="visit-info">
                                <span class="info-label">Diagnose:</span>
                                <p><?= $visit->diagonise ?></p>
                            </div>
                            <div class="visit-info">
                                <span class="info-label">Doctor:</span>
                                <p><?= $visit->doctor->username ?></p>
                            </div>
                            <div class="visit-info">
                                <span class="info-label">medication:</span>
                                <p><?= $visit->medication ?></p>
                            </div>
                            <div class="visit-info">
                                <span class="info-label">dosage:</span>
                                <p><?= $visit->desage ?></p>
                            </div>
                            <div class="visit-info">
                                <span class="info-label">frequency:</span>
                                <p><?= $visit->frequency ?></p>
                            </div>
                            <div class="visit-info">
                                <span class="info-label">bage on:</span>
                                <p><?= $visit->bage_on ?></p>
                            </div>
                            <div class="visit-info notes">
                                <span class="info-label">Note:</span>
                                <p><?= $visit->note ?></p>
                            </div>
                        </div>
                        <!-- /.visit-overview -->
                        <div class="visit-attachment">
                            <span class="info-label">Prescription:</span>
                            <a href="#" class="visit-attachment-thumb">
                                <img src="<?= Yii::app()->request->baseUrl.'/media/babies/'.$visit->prescription ?>" alt="" />
                            </a>
                            <a href="<?= Yii::app()->request->baseUrl.'/home/download?src=media/babies/&name='.$visit->prescription ?>" class="remove-attachment">Download</a>
                        </div>
                        <!-- /.visit-attachment -->
                    </div>
                    <!-- /.visit-wrap -->
                </div>
        <?php
                }
            }
        ?>
        <!-- /.visits-overview-block -->
        <?php 
            $this->widget('CLinkPager', array(
                    'pages' => $pages,
                    'header' => '',
                    'nextPageLabel' => '',
                    'prevPageLabel' => '',
                    'firstPageLabel'=>'',
                    'lastPageLabel'=>'',
                    'maxButtonCount'=>'8',
                    'firstPageCssClass'=>'pager_first',//default "first"
                    'lastPageCssClass'=>'pager_last',//default "last"
                    'previousPageCssClass'=>'pager_previous',//default "previours"
                    'nextPageCssClass'=>'pager_next',//default "next"
                    'internalPageCssClass'=>'pager_li',//default "page"
                    'selectedPageCssClass'=>'pager_selected_li',//default "selected"
                    'hiddenPageCssClass'=>'pager_hidden_li',//default "hidden"  
                    'htmlOptions'=>array('class'=>'pagination'),
            ));
        ?>
    </section>
    <!-- /.page-contain -->
</div>
