<div id="timeline-board" class="page-wrap">
    <div class="page-head">
        <?php $this->renderPartial('medical-tabs',array('id'=>$id))?>
    </div>
    <!-- /.page-head -->
    <section class="page-contain">
        <div class="sheduled-appointments-block has-actions">
            <h2 class="block-title">Scheduled appointments</h2>
            <?php
                if($next_appointment){
            ?>
                <div class="appointments-list">
                    <div class="appointment-item">
                        <a href="<?=Yii::app()->request->baseUrl?>/babyProfile/removeAppointment/<?=$next_appointment->id?>" class="appointment-remove"></a>
                        <div class="appointment-info atitle">
                            <span class="info-label">visit title</span>
                            <?=$next_appointment->visit->title?>
                        </div>
                        <div class="appointment-info adate">
                            <span>
                                <span class="info-label">date of visit:</span>
                                <span><?=  date('d, F, Y',strtotime($next_appointment->date_of_visit))?></span>
                            </span>
                            <span>
                                <span class="info-label time-label">time:</span>
                                <span><?=  date('h:i',strtotime($next_appointment->date_of_visit))?> <?=date('h',strtotime($next_appointment->date_of_visit))>12?'PM':'AM'?></span>
                            </span>
                        </div>
                        <div class="appointment-info alocal">
                            <span><?=$next_appointment->hospital->username?></span>
                        </div>
                        <div class="appointment-info aorganiser">
                            <span class="info-label">DOCTOR</span>
                            <span><?=$next_appointment->doctor->username?></span>
                        </div>
                        <div class="appointment-actions">
                            <a href="<?=Yii::app()->request->baseUrl?>/babyProfile/realizeAppointment/<?=$next_appointment->id?>" class="btn btn-submit">Realized</a>
                            <a href="<?=Yii::app()->request->baseUrl?>/babyProfile/unrealizeAppointment/<?=$next_appointment->id?>" class="btn btn-cancel">Unrealized</a>
                        </div>
                    </div>
                </div>
            <?php
                }else{
                    echo '<div style="padding:0px 20px 20px 0px;">No upcoming appointments.</div>';
                }
            ?>
        </div>
        <!-- /.sheduled-appointments-block -->
        <?php
        if($appointments){
        ?>
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
            foreach ($appointments as $next_appointment){
        ?>
            <div class="sheduled-appointments-block">
            <h2 class="block-title">Scheduled appointments</h2>
            <div class="appointments-list">
                <div class="appointment-item">
                    <a href="<?=Yii::app()->request->baseUrl?>/babyProfile/removeAppointment/<?=$next_appointment->id?>" class="appointment-remove"></a>
                    <div class="appointment-info atitle">
                        <span class="info-label">visit title</span>
                        <?=$next_appointment->visit->title?>
                    </div>
                    <div class="appointment-info adate">
                        <span>
                            <span class="info-label">date of visit:</span>
                            <span><?=  date('d, F, Y',strtotime($next_appointment->date_of_visit))?></span>
                        </span>
                        <span>
                            <span class="info-label time-label">time:</span>
                            <span><?=  date('h:i',strtotime($next_appointment->date_of_visit))?> <?=date('h',strtotime($next_appointment->date_of_visit))>12?'PM':'AM'?></span>
                        </span>
                    </div>
                    <div class="appointment-info alocal">
                        <span><?=$next_appointment->hospital->username?></span>
                    </div>
                    <div class="appointment-info aorganiser">
                        <span class="info-label">DOCTOR</span>
                        <span><?=$next_appointment->doctor->username?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        }
        ?>
        <!-- /.sheduled-appointments-block -->
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
