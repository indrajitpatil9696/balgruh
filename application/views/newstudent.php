<?php
/**
 * Created by PhpStorm.
 * User: indrajit
 * Date: 5/25/19
 * Time: 2:58 PM
 */
$edit_mode = false;

if(isset($result[0]['id']) && !empty($sid)){
$edit_mode = true;
}

?>
<div class="container">
    <?php
    if($this->session->flashdata('message')){
        echo $this->session->flashdata('message');
    }
    ?>
    <form action="<?php echo (isset($result[0]['id']))?site_url('student/save/'.$sid):site_url('student/save/');?>" method="post" enctype="multipart/form-data">
    <div class="form-row">
        <div class="form-group col-md-1">
            <label for="register_no">रजि. नं.</label>
            <input type="text" class="form-control" name="register_no" id="register_no" placeholder="रजि. नं." value="<?php echo (!empty($result[0]['register_no']))?$result[0]['register_no']:'';?>">
        </div>
        <div class="form-group col-md-3">
            <label for="fname">नाव</label>
            <input required type="text" class="form-control" name="fname" id="fname" placeholder="नाव" value="<?php echo (!empty($result[0]['fname']))?$result[0]['fname']:'';?>"/>
        </div>
        <div class="form-group col-md-3">
            <label for="mname">वडिलांचे नाव</label>
            <input  type="text" class="form-control" name="mname" id="mname" placeholder="वडिलांचे नाव" value="<?php echo (!empty($result[0]['mname']))?$result[0]['mname']:'';?>">
        </div>
        <div class="form-group col-md-3">
            <label for="lname">आडनाव</label>
            <input required type="text" class="form-control" name="lname" id="lname" placeholder="आडनाव" value="<?php echo (!empty($result[0]['lname']))?$result[0]['lname']:'';?>">
        </div>
        <div class="form-group col-md-2">
            <label>प्रवेशित फोटो</label>
            <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-primary btn-file">
                    Browse… <input name="studphoto" type="file" id="studphoto" accept=".png,.jpeg,.jpg" value="<?php echo (!empty($result[0]['photo']))?base_url('student_photo/'.$result[0]['photo']):'';?>" >
                </span>
            </span>
                <?php if(!empty($result[0]['photo'])){
                    ?>
                    <input type="hidden" id="photoexist" name="photoexist" value="<?php echo $result[0]['photo'];?>">
                <?php
                }
                ?>
                <input type="text" class="form-control" readonly value="<?php echo (!empty($result[0]['photo']))?base_url('student_photo/'.$result[0]['photo']):'';?>">
            </div>
            <img id='img-upload' src="<?php echo (!empty($result[0]['photo']))?base_url('student_photo/'.$result[0]['photo']):'';?>"/>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="birth_date">जन्म तारीख (MM/DD/YYYY)</label>
            <input type="date" class="form-control " name="birth_date" id="birth_date"  placeholder="जन्म तारीख" value="<?php echo (!empty($result[0]['birth_date']))?$result[0]['birth_date']:'';?>">
        </div>
        <div class="form-group col-md-3">
            <label >आधार क्रमांक</label>
            <input type="text" class="form-control" name="aadhar_no" id="aadhar_no" placeholder="आधार क्रमांक" value="<?php echo (!empty($result[0]['aadhar_no']))?$result[0]['aadhar_no']:'';?>">
        </div>
        <div class="form-group col-md-3">
                <label for="dharm_jaat">धर्म जात</label>
                <input type="text" class="form-control" name="dharm_jaat" id="dharm_jaat" placeholder="धर्म जात" value="<?php echo (!empty($result[0]['dharm_jaat']))?$result[0]['dharm_jaat']:'';?>">
        </div>
        <div class="form-group col-md-3">
                <label for="parents_name">पालकांचे नाव</label>
                <input type="text" class="form-control" name="parents_name" id="parents_name" placeholder="पालकांचे नाव" value="<?php echo (!empty($result[0]['parents_name']))?$result[0]['parents_name']:'';?>">
        </div>

    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="address">पत्ता</label>
            <textarea type="text" class="form-control " name="address" id="address" placeholder="पत्ता"><?php echo (!empty($result[0]['address']))?$result[0]['address']:'';?></textarea>
        </div>
        <div class="form-group col-md-4">
            <label for="contact_nos">संपर्क क्रमांक</label>
            <textarea type="text" class="form-control " name="contact_nos" id="contact_nos" placeholder="संपर्क क्रमांक"><?php echo (!empty($result[0]['contact_nos']))?$result[0]['contact_nos']:'';?></textarea>
        </div>

        <div class="form-group col-md-4">
            <label for="niradhar_reason">निराधार पनाचे तपशील</label>
            <textarea type="text" class="form-control " name="niradhar_reason" id="niradhar_reason" placeholder="निराधार पनाचे तपशील"><?php echo (!empty($result[0]['niradhar_reason']))?$result[0]['niradhar_reason']:'';?></textarea>
        </div>

    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
                <label for="adm_date">प्रवेश तारीख (MM/DD/YYYY)</label>
                <input  type="date" class="form-control " name="adm_date" id="adm_date"  placeholder="प्रवेश तारीख" value="<?php echo (!empty($result[0]['adm_date']))?$result[0]['adm_date']:'';?>">
        </div>
        <div class="form-group col-md-3">
                <label for="order_no">प्रवेश आदेश क्रमांक</label>
                <input type="text" class="form-control" name="order_no" id="order_no" placeholder="प्रवेश आदेश क्रमांक" value="<?php echo (!empty($result[0]['order_no']))?$result[0]['order_no']:'';?>">
        </div>
        <div class="form-group col-md-3">
                <label for="adm_source">कोणामार्फत दाखल</label>
                <input type="text" class="form-control" name="adm_source" id="adm_source" placeholder="कोणामार्फत दाखल" value="<?php echo (!empty($result[0]['adm_source']))?$result[0]['adm_source']:'';?>">
        </div>
        <div class="form-group col-md-3">
            <label for="parents_income">पालकांचे उत्पन्न</label>
            <input type="text" class="form-control " name="parents_income" id="parents_income" placeholder="पालकांचे उत्पन्न" value="<?php echo (!empty($result[0]['parents_income']))?$result[0]['parents_income']:'';?>"/>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="std">इयत्ता</label>
            <input type="text" class="form-control" name="std" id="std" placeholder="इयत्ता" value="<?php echo (!empty($result[0]['std']))?$result[0]['std']:'';?>">
        </div>
        <div class="form-group col-md-5">
            <label for="sgid">पटावरची स्तिथी</label>
            <select required id="sgid" name="sgid" class="form-control" value="<?php echo (!empty($result[0]['sgname']))?$result[0]['sgname']:'';?>">
                <?php
                foreach ($groups as $value){
                    if(!empty($result[0]['sgname'])){
                        if($result[0]['sgname']==$value['sgname']){
                            ?>
                            <option  selected value="<?php echo $value['sgid'] ?>"><?php echo $value['sgname'] ?></option>
                            <?php
                        }
                        else{
                            ?>
                            <option value="<?php echo $value['sgid'] ?>"><?php echo $value['sgname'] ?></option>
                            <?php
                        }
                    }
                    else {
                        ?>
                        <option value="<?php echo $value['sgid'] ?>"><?php echo $value['sgname'] ?></option>
                        <?php
                    }
                    }?>
            </select>
        </div>
        <?php if(!empty($result[0]['dis_date'])):?>
        <div class="form-group col-md-5">
            <label for="dis_date">ताब्यात दिल्याची तारीख</label>
            <input readonly type="date" class="form-control" id="dis_date" name="dis_date"  value="<?php echo$result[0]['dis_date']?>">
        </div>
        <?php endif;?>
    </div>
<div class="row">
    <div class="col-md-10"></div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary" style="width: 100%">सेव करा </button>
    </div>
</div>
</form>
</div>


<script>
    $(document).ready( function() {
        $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }

        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#studphoto").change(function(){
            readURL(this);
        });
    });
</script>