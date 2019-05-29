<?php
/**
 * Created by PhpStorm.
 * User: indrajit
 * Date: 5/19/19
 * Time: 4:10 PM
 */
?>
 <div class="container student">


 <h3 style="color: darkblue"><?php echo $title;?></h3>
     <br>
     <div class="row">
         <form action="<?php echo site_url('student/edit/')?>">
             <div class="form-group">
            <span class="input-group-btn">
                <button class="btn btn-success" type="submit"><?php echo "New Entriy"?></button>
            </span>
             </div>
         </form>
     </div>
<div class="row">


    <div class="col-lg-8">
        <form method="post" action="<?php echo site_url('student/index/');?>">
            <div class="input-group">
                <div class="row">
                <div class="form-group col-md-8">
                    <input type="text" class="form-control" name="search" placeholder="<?php echo $this->lang->line('search');?>...">
                </div>
                <div class="form-group col-md-2">
                    <span class="input-group-btn">
                        <button class="btn btn-danger" type="submit"><?php echo 'Search'?></button>
                    </span>
                </div>
                <div class="form-group col-md-2">
                    <a href="<?php echo site_url('student');?>">
                    <span class="input-group-btn">
                        <button class="btn btn-danger" type="submit"><?php echo 'Reset Search'?></button>
                    </span>
                    </a>
                </div>
                </div>


            </div><!-- /input-group -->
        </form>
    </div><!-- /.col-lg-6 -->
</div><!-- /.row -->


<div class="row">

    <div class="col-md-12 table-responsive">
        <br>
        <?php
        if($this->session->flashdata('message')){
            echo $this->session->flashdata('message');
        }
        ?>

        <table id="student_datatable" class="table table-striped table-bordered" width="100%">
            <thead style="alignment: center">
            <tr>

                <th><?php echo 'अ. क्र.'?></th>
                <th><?php echo 'रजि. नं.'?></th>
                <th><?php echo 'नाव'?></th>
                <th><?php echo 'जन्म तारीख'?> </th>
                <th><?php echo 'पालकांचे नाव '?> </th>
                <th><?php echo 'प्रवेश तारीख'?> </th>
                <th><?php echo 'स्टेटस'?> </th>
                <th class="text-center"><?php echo 'Action'?> </th>
            </tr>
            </thead>
            <tbody id="tBody" style="alignment: center">
            <?php
            if(count($result)==0){?>
            <tr>
                <td colspan="3"><?php echo $this->lang->line('no_record_found');?></td>
            </tr>
            <?php
            }
            foreach ($result as $key=>$val)
            {
                ?>
                <tr id="<?php echo (!empty($val['id']))?$val['id']:'';?>?>">

                    <td><?php echo $val['id'];?></td>
                    <td><?php echo $val['register_no'];?></td>
                    <td><?php echo $val['fname'].' '.$val['mname'].' '.$val['lname'];?></td>
                    <?php
                    $dob =isset($val['birth_date'])?date('d-M-Y',strtotime($val['birth_date'])):"";
                    $doadm =isset($val['adm_date'])?date('d-M-Y',strtotime($val['adm_date'])):"";
                    ?>
                    <td><?php echo $dob;?></td>
                    <td><?php echo $val['parents_name'];?></td>
                    <td><?php echo $doadm;?></td>
                    <td><?php echo $val['sgname'];?></td>
                    <td class="text-center">

                        <a href="<?php echo site_url('student/view/'.$val['id']);?>"><i title="View Profile"><img src="/images/view.png"/></a>&nbsp;&nbsp;

                        <a href="<?php echo site_url('student/edit/'.$val['id']);?>"><i class="fa fa-view" title="Edit Information"><img src="/images/edit.png"/></i></a>&nbsp;&nbsp;
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
                <th><?php echo 'रजि. नं.'?></th>
                <th><?php echo 'नाव'?></th>
                <th><?php echo 'जन्म तारीख'?> </th>
                <th><?php echo 'पालकांचे नाव '?> </th>
                <th><?php echo 'प्रवेश तारीख'?> </th>
                <th><?php echo 'स्टेटस'?> </th>
                <th class="text-center"><?php echo 'action'?> </th>
            </tr>
           </tfoot>
        </table>
    </div>

</div>

</div>
<script type="text/javascript">
    var d = new Date();
    var n = d.getDate()+'_'+d.getMonth()+'_'+d.getFullYear()+'_'+d.getHours()+'_'+d.getMinutes()+'_'+d.getSeconds();
    $(document).ready(function () {
        $('#student_datatable').DataTable({

                dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'csv',
                        text: 'Export All CSV',
                        filename:'student_list'+n,
                        className: 'btn btn-success',
                        exportOptions: {
                            columns: [1,2,3,4,5,6,7]
                        }
                    }

                ]
            }
        );

    });
</script>
<script>
    $=jQuery;
    $(document).ready(function () {
        $('#student_datatable').DataTable();
    });
</script>

<script type="text/javascript">
    $(".remove").click(function(){
        var id = $(this).parents("tr").attr("id");


        if(confirm('तुम्ही प्रवेशित माहिती डिलीट करत आहात.\n' +
            'डिलीट करण्यासाठी ok बटन प्रेस करा.'))
        {
            $.ajax({
                url: '/index.php/student/delete/'+id,
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
