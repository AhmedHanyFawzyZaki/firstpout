<div id="timeline-board" class="page-wrap">
    <div class="page-head">
        <?php $this->renderPartial('medical-tabs',array('id'=>$baby->id))?>
    </div>
    <!-- /.page-head -->
    <section class="page-contain">
        <div class="medical-records-block">
            <h2 class="block-title">Check Medical records!</h2>
            <div class="baby-card">
                <h3 class="baby-name"><?= $baby->username ?></h3>
                <h3 class="baby-blood-type">
                    <span>
                        Blood Type<strong><?= $baby->blood_type ?></strong>
                    </span>
                </h3>
                <div class="baby-health-card">
                    <div class="baby-infos">
                        <?php
                        if ($baby_doctor) {
                            ?>
                            <div class="infos-wrap doctor-in-charge">
                                <span class="info-label">Doctor:</span>
                                <h4 class="info-content"><?= $baby_doctor->doctor->username ?></h4>
                                <span class="info-label">Phone number:</span>
                                <h4 class="info-content"><?= $baby_doctor->doctor->phone?$baby_doctor->doctor->phone:'Not set' ?></h4>
                            </div>
                            <?php
                        } else {
                            echo '<div class="infos-wrap doctor-in-charge"><h4 class="info-content">Please assign the doctor who tracking your baby.</h4></div>';
                        }
                        if ($baby_hospital) {
                            ?>
                            <div class="infos-wrap hospital-card">
                                <span class="info-label">Hospital:</span>
                                <!--<h4 class="info-content"><?= $baby_hospital->doctor->username ?> in <?= $baby_hospital->doctor->city ?> <?= $baby_hospital->doctor->country ?></h4>
                                <span class="info-label">street:</span>
                                <h4 class="info-content"><?= $baby_hospital->doctor->street ?></h4>-->
                                <h4 class="info-content"><?= $baby_hospital->doctor->username ?> </h4>
                                <span class="info-label">City:</span>
                                <h4 class="info-content"><?= $baby_hospital->doctor->city ?></h4>
                                <span class="info-label">Phone number:</span>
                                <h4 class="info-content"><?= $baby_hospital->doctor->phone?$baby_hospital->doctor->phone:'Not set' ?></h4>
                            </div>
                            <?php
                        } else {
                            echo '<div class="infos-wrap hospital-card"><h4 class="info-content">Please assign the hospital which tracking your baby.</h4></div>';
                        }
                        ?>
                    </div>
                    <div class="baby-infos baby-overview">
                        <div class="infos-wrap baby-details">
                            <span class="info-label">Age:</span>
                            <h4 class="info-content"><?= Helper::age($baby->date_of_birth) ?></h4>
                            <span class="info-label">Height:</span>
                            <h4 class="info-content"><?= $baby->height ?> CM</h4>
                            <span class="info-label">Weight:</span>
                            <h4 class="info-content"><?= $baby->weight ?> KG</h4>
                            <span class="info-label">body mass <br />index (BMI):</span>
                            <h4 class="info-content"><?= $baby->body_mass ? $baby->body_mass : round(($baby->weight * 703) / ($baby->height * $baby->height), 2) ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.medical-records-block -->
        <?php
        if ($next_appointment) {
            ?>
            <div class="sheduled-appointments-block has-actions">
                <h2 class="block-title">Scheduled appointments</h2>
                <div class="appointments-list">
                    <div class="appointment-item">
                        <a href="<?= Yii::app()->request->baseUrl ?>/babyProfile/removeAppointment/<?= $next_appointment->id ?>" class="appointment-remove"></a>
                        <div class="appointment-info atitle">
                            <span class="info-label">visit title</span>
                            <?= $next_appointment->visit->title ?>
                        </div>
                        <div class="appointment-info adate">
                            <span>
                                <span class="info-label">date of visit:</span>
                                <span><?= date('d, F, Y', strtotime($next_appointment->date_of_visit)) ?></span>
                            </span>
                            <span>
                                <span class="info-label time-label">time:</span>
                                <span><?= date('h:i', strtotime($next_appointment->date_of_visit)) ?> <?= date('h', strtotime($next_appointment->date_of_visit)) > 12 ? 'PM' : 'AM' ?></span>
                            </span>
                        </div>
                        <div class="appointment-info alocal">
                            <span><?= $next_appointment->hospital->username ?></span>
                        </div>
                        <div class="appointment-info aorganiser">
                            <span class="info-label">DOCTOR</span>
                            <span><?= $next_appointment->doctor->username ?></span>
                        </div>
                        <div class="appointment-actions">
                            <a href="<?= Yii::app()->request->baseUrl ?>/babyProfile/realizeAppointment/<?= $next_appointment->id ?>" class="btn btn-submit">Realized</a>
                            <a href="<?= Yii::app()->request->baseUrl ?>/babyProfile/unrealizeAppointment/<?= $next_appointment->id ?>" class="btn btn-cancel">Unrealized</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        <!-- /.sheduled-appointments-block -->
        <div class="visits-overview-block block-has-slider">
            <h2 class="block-title">Visit history</h2>
            <div class="bx-slider-wrap">
                <?php
                if ($visits) {
                    ?>
                    <ul class="bx-slider" data-has-controls="1">
                        <?php
                        foreach ($visits as $visit) {
                            ?>
                            <li class="visit-wrap">
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
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <?php
                } else {
                    echo '<div class="visit-wrap">
                                <div class="visit-overview">No visits found.</div></div>';
                }
                ?>
            </div>
            <!-- /.bx-slider-wrap -->
        </div>
        <!-- /.visits-overview-block -->
    </section>
    <!-- /.page-contain -->
    <div class="content-fullwidth page-wrap">
        <?php
        if (Baby::IsBabyAdmin($baby->id, Yii::app()->user->id)) {
            ?>
            <script>
            $(function() {
            $( "#tabs" ).tabs();
            });
            </script>
            <style>
                .page-actions li, ui-state-default ui-corner-top{
                    background: none !important;
                    border: 0px !important;
                }
                .ui-state-default.ui-state-active{
                    border-top: 1px dashed #bdc3c7 !important;
                    border-right: 1px dashed #bdc3c7 !important;
                    border-left: 1px dashed #bdc3c7 !important;
                    border-bottom: 1px solid #ECF0F1 !important;
                    border-radius: 0px;
                }
				.stylish-select ul.newList{
					height:auto !important;
				}
            </style>
            <div class="forms-tabs-block" id="tabs" style="background: none;width:590px;padding: 0px;border:0px;color:inherit;">
                <div class="page-head tabs-nav">
                    <ul class="page-actions" style="background: none;border: 0px;font-weight: inherit;">
                        <li><a href="#visit-form" class="profile-link">Add new visit</a></li>
                        <li><a href="#appointment-form" class="profile-link">Add appointment</a></li>
                        <li><a href="#vaccine-form" class="profile-link">Add vaccine</a></li>
                    </ul>
                </div>
                <!-- /.page-head -->
                <?php
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'visit-form',
                    'enableAjaxValidation' => false,
                    'type' => 'horizontal',
                    'htmlOptions' => array('class' => 'form-wrap tab-content', 'enctype' => 'multipart/form-data'),
                ));
                ?>


                <div class="control-group ">
                    <?php echo $form->labelEx($model_visit, 'date_of_visit', array('class' => 'control-label')) ?>
                    <div class="controls">
                        <?php
                        $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                            'model' => $model_visit, //Model object
                            'attribute' => 'date_of_visit', //attribute name
                            'language' => '',
                            'mode' => 'datetime', //use "time","date" or "datetime" (default)
                            'options' => array(
                                "dateFormat" => Yii::app()->params['dateFormat'],
                                'changeMonth' => 'true',
                                'changeYear' => 'true',
                                'showOtherMonths' => true, // Show Other month in jquery
                                'yearRange' => "-10:+5",
                            ), // jquery plugin options
                            'htmlOptions' => array(
                                'class' => 'input-xmedium pull-left',
                            ),
                        ));
                        ?>
                        <a href="javascript:void(0);" onclick="$('#Visit_date_of_visit').focus();" class="calendar pull-left"></a>
                    </div>
                </div>    

                <?php echo $form->textFieldRow($model_visit, 'title', array('class' => 'input-xlarge', 'maxlength' => 255)); ?>

                <?php echo $form->textFieldRow($model_visit, 'diagonise', array('class' => 'input-xlarge', 'maxlength' => 255)); ?>

                <?php echo $form->textFieldRow($model_visit, 'medication', array('class' => 'input-xlarge', 'maxlength' => 255)); ?>

                <?php echo $form->textFieldRow($model_visit, 'desage', array('class' => 'input-xlarge', 'maxlength' => 255)); ?>

                <?php echo $form->textFieldRow($model_visit, 'bage_on', array('class' => 'input-xlarge', 'maxlength' => 255)); ?>

                <?php echo $form->textFieldRow($model_visit, 'frequency', array('class' => 'input-xmedium', 'maxlength' => 255)); ?>

                <?php
                echo $form->dropDownListRow($model_visit, 'doctor_id', CHtml::listData(User::model()->findAll(array('condition' => 'groups_id=2')), 'id', 'username'), array('class' => 'form-select', 'empty' => 'Select doctor'));
                ?>
                <?php
                    echo $form->dropDownListRow($model_visit, 'appointment_id', CHtml::listData(Appointment::model()->findAll(array('condition'=>'user_id='.Yii::app()->user->id.' and baby_id='.$baby->id)), 'id', 'title'), array('class' => 'form-select', 'empty' => 'Select Appointment'));
                ?>
                <hr />
                <?php echo $form->fileFieldRow($model_visit, 'prescription', array('class'=>'form-uploader'))?>
                <?php echo $form->textAreaRow($model_visit, 'note', array('rows' => 6, 'cols' => 50, 'class' => 'input-xlarge')); ?>
                

                <div class="submit-btn-wrap" style="font-size:16px;">
                    <button type="submit" class="btn btn-green btn-big-submit">Add visit</button>
                </div>
                <?php $this->endWidget(); ?>
                <!--------------------------------second tab--------------------------------------->
                <?php
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'appointment-form',
                    'enableAjaxValidation' => false,
                    'type' => 'horizontal',
                    'htmlOptions' => array('class' => 'form-wrap tab-content', 'enctype' => 'multipart/form-data'),
                ));
                ?>
                
                <?php echo $form->textFieldRow($model_appointment, 'title', array('class' => 'input-xlarge', 'maxlength' => 255)); ?>

                <div class="control-group ">
                    <?php echo $form->labelEx($model_appointment, 'date_of_visit', array('class' => 'control-label')) ?>
                    <div class="controls">
                        <?php
                        $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                            'model' => $model_appointment, //Model object
                            'attribute' => 'date_of_visit', //attribute name
                            'language' => '',
                            'mode' => 'datetime', //use "time","date" or "datetime" (default)
                            'options' => array(
                                "dateFormat" => Yii::app()->params['dateFormat'],
                                'changeMonth' => 'true',
                                'changeYear' => 'true',
                                'showOtherMonths' => true, // Show Other month in jquery
                                'yearRange' => "-10:+5",
                            ), // jquery plugin options
                            'htmlOptions' => array(
                                'class' => 'input-xmedium pull-left',
                            ),
                        ));
                        ?>
                        <a href="javascript:void(0);" onclick="$('#Appointment_date_of_visit').focus();" class="calendar pull-left"></a>
                    </div>
                </div>
                
                <?php
                    echo $form->dropDownListRow($model_appointment, 'doctor_id', CHtml::listData(User::model()->findAll(array('condition' => 'groups_id=2')), 'id', 'username'), array('class' => 'form-select', 'empty' => 'Select doctor'));
                ?>
                
                <?php
                    echo $form->dropDownListRow($model_appointment, 'hospital_id', CHtml::listData(User::model()->findAll(array('condition' => 'groups_id=3')), 'id', 'username'), array('class' => 'form-select', 'empty' => 'Select hospital'));
                ?>
                
                <?php
                    //echo $form->dropDownListRow($model_appointment, 'visit_id', CHtml::listData(Visit::model()->findAll(array('condition'=>'baby_id='.$baby->id)), 'id', 'title'), array('class' => 'form-select', 'empty' => 'Select visit'));
                ?>

                <div class="submit-btn-wrap" style="font-size:16px;">
                    <button type="submit" class="btn btn-green btn-big-submit">Add appointment</button>
                </div>
                <?php $this->endWidget(); ?>
                <!--------------------------------third tab--------------------------------------->
                <?php
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'vaccine-form',
                    'enableAjaxValidation' => false,
                    'type' => 'horizontal',
                    'htmlOptions' => array('class' => 'form-wrap tab-content', 'enctype' => 'multipart/form-data'),
                ));
                ?>
                
                <?php echo $form->textFieldRow($model_vaccine, 'title', array('class' => 'input-xlarge', 'maxlength' => 255)); ?>
                
                <?php
                    echo $form->dropDownListRow($model_vaccine, 'next_vaccine_id', CHtml::listData(Vaccine::model()->findAll(array('condition'=>'baby_id='.$baby->id)), 'id', 'title'), array('class' => 'form-select', 'empty' => 'Select vaccine'));
                ?>
                
                <?php
                    //echo $form->dropDownListRow($model_vaccine, 'visit_id', CHtml::listData(Visit::model()->findAll(array('condition'=>'baby_id='.$baby->id)), 'id', 'title'), array('class' => 'form-select', 'empty' => 'Select visit'));
                ?>
                
                <div class="control-group ">
                    <?php echo $form->labelEx($model_vaccine, 'date_of_vaccine', array('class' => 'control-label')) ?>
                    <div class="controls">
                        <?php
                        $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                            'model' => $model_vaccine, //Model object
                            'attribute' => 'date_of_vaccine', //attribute name
                            'language' => '',
                            'mode' => 'datetime', //use "time","date" or "datetime" (default)
                            'options' => array(
                                "dateFormat" => Yii::app()->params['dateFormat'],
                                'changeMonth' => 'true',
                                'changeYear' => 'true',
                                'showOtherMonths' => true, // Show Other month in jquery
                                'yearRange' => "-10:+5",
                            ), // jquery plugin options
                            'htmlOptions' => array(
                                'class' => 'input-xmedium pull-left',
                            ),
                        ));
                        ?>
                        <a href="javascript:void(0);" onclick="$('#Vaccine_date_of_vaccine').focus();" class="calendar pull-left"></a>
                    </div>
                </div>
                
                <?php echo $form->textAreaRow($model_vaccine, 'desc', array('rows' => 6, 'cols' => 50, 'class' => 'input-xlarge')); ?>
                
                <div class="control-group">
                    <label class="control-label" for="gender"> &nbsp;</label>
                    <div class="controls">
                        <div class="checkbox-wrap">
                            <label class="checkbox">
                                <?php echo $form->checkBox($model_vaccine, 'realized') ?>
                                <span><?php echo $form->labelEx($model_vaccine, 'realized') ?></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="submit-btn-wrap" style="font-size:16px;">
                    <button type="submit" class="btn btn-green btn-big-submit">Add Vaccine</button>
                </div>
                <?php $this->endWidget(); ?>
            </div>
            <?php
        }
        ?>
        <!-- /.forms-tabs-block -->
        <div class="vaccine-overview-block block-has-slider">
            <h2 id="vaccine-title" class="block-title">Vaccine</h2>
            <?php
            if ($vaccines) {
                ?>
                <span id="vaccine-num" class="vaccine-num"><span>1</span> of <?= count($vaccines); ?></span>
                <div class="bx-slider-wrap">
                    <ul class="bx-slider" data-has-controls="1" data-has-counter="#vaccine-num">
                        <?php
                        foreach ($vaccines as $vacc) {
                            ?>
                            <li class="vaccine-wrap">
                                <div class="vaccine-overview">
                                    <div class="vaccine-info">
                                        Vaccine name:
                                        <strong><?= $vacc->title ?></strong>
                                    </div>
                                    <div class="vaccine-info">
                                        Date:
                                        <strong><?=$vacc->date_of_vaccine ?></strong>
                                    </div>
                                    <div class="vaccine-info scheduled-visit">
                                        Visit:
                                        <strong><?= $vacc->visit_id?$vacc->visit->title:'No visit assigned' ?></strong>
                                    </div>
                                </div>
                                <div class="vaccine-details">
                                    <div class="vaccine-infos">
                                        <h3>Vaccine Information</h3>
                                        <p><?= $vacc->desc ?></p>
                                    </div>
                                    <div class="vaccine-additional-infos">
                                        <h3>Next vaccine: <?= $vacc->nextVaccine->title ? $vacc->nextVaccine->title : 'Not set' ?></h3>
                                        <p><?= $vacc->nextVaccine->desc ? $vacc->nextVaccine->desc : 'Not set' ?></p>
                                    </div>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <!-- /.bx-slider-wrap -->
                <?php
            } else {
                echo '<div class="vaccine-overview">No vaccines found.</div>';
            }
            ?>
        </div>
        <!-- /.visits-overview-block -->

    </div>
</div>
<!-- /.page-wrap -->