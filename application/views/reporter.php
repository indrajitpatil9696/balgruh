<?php
if(!empty($report)){
    if($report=='student') {
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-4 pad">
                    <a href="<?php echo site_url('student/export/presentabsent');?>" class="report-link">
                        <div class="report-container" style="text-align: center">
                            <p class="report-container-text">
                                गैर-हजर/ताब्यात यादी रिपोर्ट
                            </p>
                            <span><img src="<?= base_url('/images/report-icon.png') ?>"> </span>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 pad">
                    <a href="<?php echo site_url('student/export/mudatvadh');?>" class="report-link">
                        <div class="report-container" style="text-align: center">
                            <p class="report-container-text">
                                मुदतवाढ रिपोर्ट
                            </p>
                            <span><img src="<?= base_url('/images/report-icon.png') ?>"> </span>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 pad">
                    <a href="<?php echo site_url('student/export/age');?>" class="report-link">
                        <div class="report-container" style="text-align: center">
                            <p class="report-container-text">
                                वयानुसार रिपोर्ट
                            </p>
                            <span><img src="<?= base_url('/images/report-icon.png') ?>"> </span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row pad pad-d">
                <div class="col-md-4 pad">
                    <a href="<?php echo site_url('student/export/marklist');?>" class="report-link">
                        <div class="report-container" style="text-align: center">
                            <p class="report-container-text">
                                मार्कलिस्ट रिपोर्ट
                            </p>
                            <span><img src="<?= base_url('/images/report-icon.png') ?>"> </span>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 pad">
                    <a href="<?php echo site_url('student/export/list');?>" class="report-link">
                        <div class="report-container" style="text-align: center">
                            <p class="report-container-text">
                                प्रवेशित यादी रिपोर्ट
                            </p>
                            <span><img src="<?= base_url('/images/report-icon.png') ?>"> </span>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 pad">
                    <a href="<?php echo site_url('student/export/profile');?>" class="report-link">
                        <div class="report-container" style="text-align: center">
                            <p class="report-container-text">
                                प्रोफाईल लिस्ट रिपोर्ट
                            </p>
                            <span><img src="<?= base_url('/images/report-icon.png') ?>"> </span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <?php
    }
    else if($report=='donation'){?>
        <div class="container">
            <div class="row pad pad-d">
                <div class="col-md-4 pad"></div>
                <div class="col-md-4 pad">
                    <a href="<?php echo site_url('donation/export');?>" class="report-link">
                        <div class="report-container" style="text-align: center">
                            <p class="report-container-text">
                                देणगी रिपोर्ट
                            </p>
                            <span><img src="<?= base_url('/images/report-icon.png') ?>"> </span>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 pad"></div>
            </div>
        </div>
        <?php
    }
}?>