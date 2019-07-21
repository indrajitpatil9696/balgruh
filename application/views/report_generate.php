<a href="<?php echo site_url('student/report')?>"><img title="Back" class="hidden-print" src="<?php echo base_url('images/back.png')?>"></a>
<br>


<div class="container">
    <h4 class="mobile-center"> <?=$title?></h4>
    <br>
    <div class="row">
        <div class="col-md-2 " >
            <span class="checkox-label">प्रवेशित नाव</span>
            <label class="switch " >
                <input type="checkbox" class="default" name="fname" id="fname">
                <span class="slider round"></span>
            </label>
        </div>
        <div class="col-md-2 " >
            <span class="checkox-label">वडिलांचे नाव</span>
            <label class="switch " >
                <input type="checkbox" class="default" name="mname" id="mname">
                <span class="slider round"></span>
            </label>
        </div>
        <div class="col-md-2 " >
            <span class="checkox-label">आडनाव</span>
            <label class="switch " >
                <input type="checkbox" class="default" name="lname" id="lname">
                <span class="slider round"></span>
            </label>
        </div>
        <div class="col-md-2 " >
            <span class="checkox-label">धर्म-जात</span>
            <label class="switch " >
                <input type="checkbox" class="default" name="dharm_jaat" id="dharm_jaat">
                <span class="slider round"></span>
            </label>
        </div>
        <div class="col-md-2 " >
            <span class="checkox-label">जन्मतारीख</span>
            <label class="switch " >
                <input type="checkbox" class="default" name="birth_date" id="birth_date">
                <span class="slider round"></span>
            </label>
        </div>
        <div class="col-md-2 " >
            <span class="checkox-label">वय</span>
            <label class="switch " >
                <input type="checkbox" class="default" name="age" id="age">
                <span class="slider round"></span>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 " >
            <span class="checkox-label">रजि. नं.</span>
            <label class="switch " >
                <input type="checkbox" class="default" name="register_no" id="register_no">
                <span class="slider round"></span>
            </label>
        </div>
        <div class="col-md-2 " >
            <span class="checkox-label">हजर-गैर/ताब्यात</span>
            <label class="switch " >
                <input type="checkbox" class="default" name="status" id="status">
                <span class="slider round"></span>
            </label>
        </div>
        <div class="col-md-2 " >
            <span class="checkox-label">पालकांचे नाव</span>
            <label class="switch " >
                <input type="checkbox" class="default" name="parents_name" id="parents_name">
                <span class="slider round"></span>
            </label>
        </div>
        <div class="col-md-2 " >
            <span class="checkox-label">पत्ता</span>
            <label class="switch " >
                <input type="checkbox" class="default" name="address" id="address">
                <span class="slider round"></span>
            </label>
        </div>
        <div class="col-md-2 " >
            <span class="checkox-label">संपर्क</span>
            <label class="switch " >
                <input type="checkbox" class="default" name="contact_nos" id="contact_nos">
                <span class="slider round"></span>
            </label>
        </div>
        <div class="col-md-2 " >
            <span class="checkox-label">आधार</span>
            <label class="switch " >
                <input type="checkbox" class="default" name="aadhar_no" id="aadhar_no">
                <span class="slider round"></span>
            </label>
        </div>

    </div>
    <div class="row">

        <div class="col-md-2 " >
            <span class="checkox-label">फोटो</span>
            <label class="switch " >
                <input type="checkbox" class="default" name="photo" id="photo">
                <span class="slider round"></span>
            </label>
        </div>

        <div class="col-md-2 " >
            <span class="checkox-label">आदेश क्रमांक</span>
            <label class="switch " >
                <input type="checkbox" class="default" name="order_no" id="order_no">
                <span class="slider round"></span>
            </label>
        </div>
        <div class="col-md-2 " >
            <span class="checkox-label">दाखल तारीख</span>
            <label class="switch " >
                <input type="checkbox" class="default" name="adm_date" id="adm_date">
                <span class="slider round"></span>
            </label>
        </div>
        <div class="col-md-2 " >
            <span class="checkox-label">अखेर-मुदतवाढ</span>
            <label class="switch " >
                <input type="checkbox" class="default" name="to" id="to">
                <span class="slider round"></span>
            </label>
        </div>

        <div class="col-md-2 " >
            <span class="checkox-label">ताब्यात तारीख</span>
            <label class="switch " >
                <input type="checkbox" class="default" name="dis_date" id="dis_date">
                <span class="slider round"></span>
            </label>
        </div>
         <div class="col-md-2 " >
            <span class="checkox-label">निराधार तपशील</span>
            <label class="switch " >
                <input type="checkbox" class="default" name="niradhar_reason" id="niradhar_reason">
                <span class="slider round"></span>
            </label>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="button" id="getReport" class="btn form-control btn-warning">Get Report</button>
        </div>
    </div>
<?php $this->load->view('report_viewer');?>
<br>
<br>
    <?php $this->load->view('loader');?>
</div>

<script>
    var url = '<?= site_url('student/getreport/'.$report_name)?>';
    var selected = {};
    $('input[type="checkbox"]'). click(function(){
        var checkbox = this;
        if($(this). prop("checked") == true){
            selected[checkbox.id] = checkbox.id;
        }
        else{
                delete selected[checkbox.id];
        }

    });
    
    $('#getReport').on('click',function () {
        var post_data = JSON.stringify(selected);
        $('#reportViewer').empty();
    $.ajax({
            url : url,
            type : 'POST',
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',data:post_data},
            dataType: 'json',
            beforeSend: function() {
                openNav();

            },
            complete: function() {
                setTimeout(closeNav, 3000);
            },
            timeout: 30000,
            error: function(jqXHR) {

                if(jqXHR.status==0) {
                    alert(" fail to connect, please check your internet connection");
                }
                $('#reportViewer').html('<h3 style="color: red;font-family: Helvetica;padding-top: 30px;">Report Not Generated...!</h3>');
            },
            success : function(report){
                console.log(report.result);
                $('#reportViewer').html(report.result);
            }
        });
    });
</script>