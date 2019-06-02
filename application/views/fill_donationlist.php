<?php
/**
 * Created by PhpStorm.
 * User: indrajit
 * Date: 5/25/19
 * Time: 2:58 PM
 */
$edit_mode = false;

if(isset($result[0]['did']) && !empty($sid)){
$edit_mode = true;
}

?>

<div class="container">


    <?php
    if($this->session->flashdata('message')){
        echo $this->session->flashdata('message');
    }

    ?>
   <div class="row">
       <button type="button" class="btn btn-primary hidden-print" data-toggle="modal" data-target="#donationModel">देणगी माहिती भरा</button>
   </div>
    <br>
    <!-- The Modal -->
    <div class="modal fade" id="donationModel">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">देणगी माहिती नोंद</h4><br>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">

                    <form action="<?php echo site_url('doantion/save/'.$did)?>" method="post" >
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="receipt_no">पावती क्रमांक</label>
                                <input type="text" class="form-control" name="receipt_no" id="receipt_no" placeholder="पावती क्रमांक" value="<?php echo (!empty($result[0]['register_no']))?$result[0]['register_no']:'';?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="donation_date">देणगी तारीख</label>
                                <input required type="date" class="form-control" name="donation_date" id="donation_date" placeholder="देणगी तारीख" >
                            </div>

                            <div class="form-group col-md-4">
                                <label for="dname">देणगीदाराचे नाव</label>
                                <input required type="text" class="form-control" name="dname" id="dname" placeholder="देणगीदाराचे नाव" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="address">पत्ता</label>
                                <input  type="text" class="form-control" name="address" id="address" placeholder="पत्ता" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="contact_no">संपर्क क्रमांक</label>
                                <input required type="text" class="form-control" name="contact_no" id="contact_no" placeholder="संपर्क क्रमांक" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="email"></label>
                                <input  type="text" class="form-control" name="email" id="email" placeholder="संपर्क क्रमांक" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="donation">देणगी</label>
                                <input required type="text" class="form-control" name="donation" id="donation" placeholder="देणगी" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="donation_info">देणगी तपशिल</label>
                                <input required type="text" class="form-control" name="donation_info" id="donation_info" placeholder="देणगी तपशिल" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="receiptor">पावती करणारा</label>
                                <input required type="text" class="form-control" name="receiptor" id="receiptor" placeholder="पावती करणारा" >
                            </div>
                        </div>
                        <button type="submit" class="btn btn-secondary" >सेव करा </button>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">

                </div>

            </div>
        </div>
    </div>


    <div class="row">


        <div class="col-md-12 table-responsive">


            <table id="student_marklist" class="table table-striped table-bordered" width="100%">
                <thead style="alignment: center">
                <tr>

                    <th><?php echo 'अ. क्र.'?></th>
                    <th><?php echo 'पावती क्रमांक'?></th>
                    <th><?php echo 'देणगीदाराचे नाव '?></th>
                    <th><?php echo 'पत्ता '?></th>
                    <th><?php echo 'संपर्क क्रमांक'?></th>
                    <th><?php echo 'देणगी तपशील'?></th>
                    <th><?php echo 'देणगी तारीख'?></th>
                    <th><?php echo 'पावती करणारा'?></th>
                    <th class="text-center hidden-print"><?php echo 'Action'?> </th>
                </tr>
                </thead>
                <tbody id="tBody" style="alignment: center">
                <?php
                if(count($result)==0){?>
                    <tr>
                        <td colspan="3"><?php echo 'No Record Found';?></td>
                    </tr>
                    <?php
                }
                $cnt=0;
                foreach ($result as $key=>$val)
                {
                    ?>
                    <tr id="<?php echo (!empty($val['did']))?$val['did']:'';?>?>">

                        <td><?php echo $cnt+1; $cnt++;?></td>
                        <td><?php echo (!empty($val['year']))?$val['year']:'';?></td>
                        <td><?php echo (!empty($val['receipt_no']))?$val['receipt_no']:'';?></td>
                        <td><?php echo (!empty($val['dname']))?$val['dname']:'';?></td>
                        <td><?php echo (!empty($val['address']))?$val['address']:'';?></td>
                        <td><?php echo (!empty($val['contact_no']))?$val['contact_no']:'';?></td>
                        <td><?php echo (!empty($val['donation']))?$val['donation']:'';?></td>
                        <td><?php echo (!empty($val['donation_date']))?$val['donation_date']:'';?></td>
                        <td><?php echo (!empty($val['receiptor']))?$val['receiptor']:'';?></td>

                        <td class="text-center hidden-print">
                            <a class="btn " href="<?php echo site_url('donation/view'.$val['did'])?>"><i title="डिलीट करा"><img src="/images/view.png"/></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a class="btn remove"><i title="डिलीट करा"><img src="/images/delete.png"/></i></a>


                        </td>
                    </tr>

                    <?php
                }
                ?>
                </tbody>
                <tfoot style="alignment: center">
                <tr>

                    <th><?php echo 'अ. क्र.'?></th>
                    <th><?php echo 'पावती क्रमांक'?></th>
                    <th><?php echo 'देणगीदाराचे नाव '?></th>
                    <th><?php echo 'पत्ता '?></th>
                    <th><?php echo 'संपर्क क्रमांक'?></th>
                    <th><?php echo 'देणगी तपशील'?></th>
                    <th><?php echo 'देणगी तारीख'?></th>
                    <th><?php echo 'पावती करणारा'?></th>
                    <th class="text-center hidden-print"><?php echo 'Action'?> </th>
                </tr>
                </tfoot>
            </table>
        </div>

    </div>


</div>


<script>
    $=jQuery;
    $(document).ready(function () {
        $('#student_marklist').DataTable();
    });
</script>
<script type="text/javascript">
    $(".remove").click(function(){
        var id = $(this).parents("tr").attr("id");


        if(confirm('तुम्ही मार्कलिस्ट रेकॉर्ड डिलीट करत आहात.\n' +
            'डिलीट करण्यासाठी ok बटन प्रेस करा'))
        {
            $.ajax({
                url: '/index.php/donation/delete/'+id,
                type: 'DELETE',
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
    });


</script>