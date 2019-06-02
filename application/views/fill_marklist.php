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
<a href="<?php echo site_url('marks')?>"><img title="Back" class="hidden-print" src="<?php echo base_url('images/back.png')?>"></a>
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
       <button type="button" class="btn btn-primary hidden-print" data-toggle="modal" data-target="#marksModel">मार्कलिस्ट भरा</button>
   </div>
    <br>
    <!-- The Modal -->
    <div class="modal fade" id="marksModel">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">प्रवेशित मार्कलिस्ट नोंद</h4><br>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <?php if(!empty($sid)){echo "<h4 class='modal-title' style='text-align: center;'>".$student[0]['fname'].' '.$student[0]['mname'].' '.$student[0]['lname']."</h4>"; }?>
                    <br>
                    <form action="<?php echo site_url('marks/save/'.$sid)?>" method="post" >
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="year">शैक्षणिक वर्ष</label>
                                <input type="text" class="form-control" name="year" id="year" placeholder="शैक्षणिक वर्ष" value="<?php echo (!empty($result[0]['register_no']))?$result[0]['register_no']:'';?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="std">इयत्ता</label>
                                <input required type="text" class="form-control" name="std" id="std" placeholder="इयत्ता" value="<?php echo (!empty($result[0]['fname']))?$result[0]['fname']:'';?>"/>
                            </div>
                        </div>
                            <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="marks">मिळालेले गुण</label>
                                <input  type="text" class="form-control" name="marks" id="marks" placeholder="मिळालेले गुण" value="<?php echo (!empty($result[0]['mname']))?$result[0]['mname']:'';?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="total_marks">एकूण गुण</label>
                                <input required type="text" class="form-control" name="total_marks" id="total_marks" placeholder="एकूण गुण" value="<?php echo (!empty($result[0]['lname']))?$result[0]['lname']:'';?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="result">निकाल</label>
                                <input required type="text" class="form-control" name="result" id="result" placeholder="निकाल" value="<?php echo (!empty($result[0]['lname']))?$result[0]['lname']:'';?>">
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
                    <th><?php echo 'शैक्षणिक वर्ष'?></th>
                    <th><?php echo 'इयत्ता'?></th>
                    <th><?php echo 'मिळालेले गुण'?></th>
                    <th><?php echo 'एकूण गुण'?></th>
                    <th><?php echo 'टक्केवारी'?></th>
                    <th><?php echo 'निकाल'?></th>
                    <th class="text-center hidden-print"><?php echo 'Action'?> </th>
                </tr>
                </thead>
                <tbody id="tBody" style="alignment: center">
                <?php
                if(count($result)==0){?>
                    <tr>
                        <td colspan="3"><?php echo 'No record Found';?></td>
                    </tr>
                    <?php
                }
                $cnt=0;
                foreach ($result as $key=>$val)
                {
                    ?>
                    <tr id="<?php echo (!empty($val['id']))?$val['id']:'';?>?>">

                        <td><?php echo $cnt+1; $cnt++;?></td>
                        <td><?php echo (!empty($val['year']))?$val['year']:'';?></td>
                        <td><?php echo (!empty($val['std']))?$val['std']:'';?></td>
                        <td><?php echo (!empty($val['marks']))?$val['marks']:'';?></td>
                        <td><?php echo (!empty($val['total_marks']))?$val['total_marks']:'';?></td>
                        <td><?php echo (!empty($val['per']))?$val['per'].'%':'';?></td>
                        <td><?php echo (!empty($val['result']))?$val['result']:'';?></td>

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
                    <th><?php echo 'शैक्षणिक वर्ष'?></th>
                    <th><?php echo 'इयत्ता'?></th>
                    <th><?php echo 'मिळालेले गुण'?></th>
                    <th><?php echo 'एकूण गुण'?></th>
                    <th><?php echo 'टक्केवारी'?></th>
                    <th><?php echo 'निकाल'?></th>
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
                url: '/index.php/marks/delete/'+id,
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