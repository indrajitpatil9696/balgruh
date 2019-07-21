<?php
/**
 * Created by PhpStorm.
 * User: indrajit
 * Date: 6/15/19
 * Time: 4:00 PM
 */

?>
    <a href="<?php echo site_url('donation')?>"><img title="Back" class="hidden-print" src="<?php echo base_url('images/back.png')?>"></a>
    <br>
<?php
    if(!empty($result[0])){
?>
<div class="alert" >
    <div class="container receipt">
        <div class="row">
            <div class="col-md-6">
                <p> <b>पावती क्रमांक :</b> <span><?=$result[0]['receipt_no']?></span></p>
            </div>
            <div class="col-md-6">
                <p ><b>दिनांक : </b><span><?=date('d-M-Y',strtotime($result[0]['donation_date']))?></span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p ><b>देणगीदाराचे नाव : </b><span><?=$result[0]['dname']?></span></p>
            </div>
        </div>
    <div class="row">
            <div class="col-md-6">
                <p ><b>पत्ता : </b><span><?= $result[0]['address']?></span></p>
            </div>
            <div class="col-md-3">
                <p ><b>संपर्क क्रमांक : </b><span><?=$result[0]['contact_no']?></span></p>
            </div>
            <div class="col-md-3">
                <p ><b>ई-मेल : </b><span><?=$result[0]['email']?></span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p ><b>देणगी तपशील : </b><br/><span><?=$result[0]['donation']?></span></p>
                <p ><span><?=$result[0]['donation_info']?></span></p>

            </div>
            <div class="col-md-6">
                <p ><b>पावती करणारा : </b><span><?=$result[0]['receiptor']?></span></p>
            </div>
        </div>
    </div>
</div>
<?php }