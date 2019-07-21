<?php
/**
 * Created by PhpStorm.
 * User: indrajit
 * Date: 5/26/19
 * Time: 1:03 PM
 */
?>
<a href="<?php echo site_url('student')?>"><img class="hidden-print" title="Back" src="<?php echo base_url('images/back.png')?>"></a>
<br>
<div class="container " >
    <div class="row">
        <div class="col-md-10 col-sm-10 mobile-center"><h2><?php echo $result[0]['fname'].' '.$result[0]['lname'];?></h2></div>
        <div class="col-md-2 col-sm-2 mobile-center"><a  class="pull-right"><img title="profile image" class="img-circle img-responsive" src="<?php echo (!empty($result[0]['photo']))?base_url('student_photo/'.$result[0]['photo']):base_url('student_photo/user_icon.png')?>"  style="width :150px;height: 150px;"> </a></div>
    </div>
    <div class="row pad-d">
        <div class="col-md-4 col-sm-4 pad"><!--left col-->

            <ul class="list-group">
                <li class="list-group-item text-muted"><?php echo 'प्रवेशित माहिती'?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong><?php echo 'रजि. नं.:';?></strong></span> <?php echo $result[0]['register_no'];?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong><?php echo 'नाव:';?></strong></span> <?php echo $result[0]['fname'].' '.$result[0]['mname'].' '.$result[0]['lname'];?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong><?php echo 'जन्म तारीख:';?></strong></span> <?php echo date('d-m-Y',strtotime($result[0]['birth_date']))?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong><?php echo 'आधार क्रमांक:';?></strong></span> <?php echo $result[0]['aadhar_no']?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong><?php echo 'धर्म जात:';?></strong></span> <?php echo $result[0]['dharm_jaat'];?></li>


            </ul>
        </div>
        <div class="col-md-4 col-sm-4 pad">
            <ul class="list-group pad">
                <li class="list-group-item text-muted"><?php echo 'प्रवेश माहिती'?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong><?php echo 'पटावरची स्तिथी:';?></strong></span>  <?php echo (!empty($result[0]['sgname']))?$result[0]['sgname']:'';?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong><?php echo 'प्रवेश आदेश क्रमांक';?></strong></span><?php echo (!empty($result[0]['order_no']))?$result[0]['order_no']:'';?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong><?php echo 'कोणामार्फत दाखल';?></strong></span> <?php echo (!empty($result[0]['adm_source']))?$result[0]['adm_source']:'';?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong><?php echo 'प्रवेश तारीख:';?></strong></span> <?php echo (!empty($result[0]['adm_date']))?date('d-m-Y',strtotime($result[0]['adm_date'])):'';?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong><?php echo 'निराधार पनाचे तपशील:';?></strong></span> <?php echo $result[0]['niradhar_reason'];?></li>
                <?php if(!empty($result[0]['dis_date'])):?>
                    <li class="list-group-item text-right"><span class="pull-left"><strong><?php echo 'ताब्यात दिल्याची तारीख';?></strong></span> <?php echo date('d-m-Y',strtotime($result[0]['dis_date']))?></li>
                <?php endif;?>
            </ul>


        </div>
        <div class="col-sm-4 pad">
            <ul class="list-group">
                <li class="list-group-item text-muted"><?php echo 'पालक माहिती'?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong><?php echo 'पालकांचे नाव:';?></strong></span> <?php echo $result[0]['parents_name'];?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong><?php echo 'पत्ता:';?></strong></span> <?php echo $result[0]['address'];?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong><?php echo 'संपर्क क्रमांक:';?></strong></span> <?php echo $result[0]['contact_nos']?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong><?php echo 'संपर्क क्रमांक:';?></strong></span> <?php echo $result[0]['parents_income']?></li>
            </ul>
        </div>
    </div>
<div class="row">
    <div class="col-sm-3">
        <h3 style="color: darkblue"><?php echo 'मुदतवाढ माहिती'?> </h3>
        <div class="table-responsive">
            <table class="table table-striped">
                <tbody>
                <tr>
                    <th><?php echo 'पासून';?></th>
                    <th><?php echo 'पर्यंत ';?></th>
                </tr>
                <?php if(!empty($mudatvadh)) {
                    foreach ($mudatvadh as $record) {
                        ?>
                        <tr>
                            <td><?php echo date('d-m-Y',strtotime($record['from'])); ?></td>
                            <td><?php echo date('d-m-Y',strtotime($record['to'])); ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-9">
        <h3 style="color: darkblue"><?php echo 'शैक्षणिक माहिती'?> </h3>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th><?php echo 'वर्ष';?></th>
                        <th><?php echo 'मिळालेले गुण';?></th>
                        <th><?php echo 'एकूण गुण';?></th>
                        <th><?php echo 'टक्केवारी';?></th>
                        <th><?php echo 'निकाल';?></th>
                    </tr>
                    <?php if(!empty($marks)) {
                        foreach ($marks as $record) {
                            ?>
                            <tr>
                                <td><?php echo $record['year']; ?></td>
                                <td><?php echo $record['marks']; ?></td>
                                <td><?php echo $record['total_marks']; ?></td>
                                <td><?php echo $record['per']; ?></td>
                                <td><?php echo $record['result']; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>
</div>