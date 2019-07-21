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
<a href="<?php echo site_url('mudatvadh')?>"><img class="hidden-print" title="Back" src="<?php echo base_url('images/back.png')?>"></a>
<br>
<div class="container">
    <?php
    if($this->session->flashdata('message')){
        echo $this->session->flashdata('message');
    }
    if(!empty($sid)){
        echo "<div class='alert alert-success'>".$student[0]['fname'].' '.$student[0]['mname'].' '.$student[0]['lname']."</div>";
    }
    ?>
   <div class="row">
       <button type="button" class="btn btn-primary hidden-print" data-toggle="modal" data-target="#marksModel">मुदतवाढ भरा</button>
   </div>
    <br>
    <!-- The Modal -->
    <div class="modal fade" id="marksModel">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">प्रवेशित मुदतवाढ नोंद</h4><br>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <?php if(!empty($sid)){echo "<h4 class='modal-title' style='text-align: center'>".$student[0]['fname'].' '.$student[0]['mname'].' '.$student[0]['lname']."</h4>"; }?>
                    <form action="<?php echo site_url('mudatvadh/save/'.$sid)?>" method="post" >
                        <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="from">मुदतवाढ पासून</label>
                                <input required type="date" class="form-control" name="from" id="from" placeholder="मुदतवाढ पासून" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="to">मुदतवाढ पर्यंत</label>
                                <input required type="date" class="form-control" name="to" id="to" placeholder="मुदतवाढ पर्यंत" />
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
                    <th><?php echo 'मुदतवाढ पासून'?></th>
                    <th><?php echo 'मुदतवाढ पर्यंत'?></th>
                    <th class="text-center hidden-print"><?php echo 'Action'?> </th>
                </tr>
                </thead>
                <tbody id="tBody" style="alignment: center">
                <?php
                if(count($result)==0){?>
                    <tr>
                        <td colspan="3"><?php echo 'no_record_found';?></td>
                    </tr>
                    <?php
                }
                $cnt=0;
                foreach ($result as $key=>$val)
                {
                    ?>
                    <tr id="<?php echo (!empty($val['id']))?$val['id']:'';?>?>">

                        <td><?php echo $cnt+1; $cnt++;?></td>
                        <td><?php echo (!empty($val['from']))?date('d-M-Y',strtotime($val['from'])):'';?></td>
                        <td><?php echo (!empty($val['to']))?date('d-M-Y',strtotime($val['to'])):'';?></td>

                        <td class="text-center hidden-print">

                            <a class="btn remove"><i title="डिलीट करा"><img src="/images/delete.png"/></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        </td>
                    </tr>

                    <?php
                }
                ?>
                </tbody>
                <tfoot style="alignment: center">
                <tr>

                    <th><?php echo 'अ. क्र.'?></th>
                    <th><?php echo 'मुदतवाढ पासून'?></th>
                    <th><?php echo 'मुदतवाढ पर्यंत'?></th>
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


        if(confirm('तुम्ही मुदतवाढ रेकॉर्ड डिलीट करत आहात.\n' +
            'डिलीट करण्यासाठी ok बटन प्रेस करा'))
        {
            $.ajax({
                url: '/index.php/mudatvadh/delete/'+id,
                type: 'DELETE',
                data:
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