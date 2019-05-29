<?php
/**
 * Created by PhpStorm.
 * User: indrajit
 * Date: 5/27/19
 * Time: 11:43 PM
 */

?>
 <div class="container student">


 <h3 style="color: darkblue"><?php echo $title;?></h3>

<div class="row">


    <div class="col-md-12 table-responsive">
        <br>
        <?php
        if($this->session->flashdata('message')){
            echo $this->session->flashdata('message');
        }
        ?>

        <table id="student_marklist" class="table table-striped table-bordered" width="100%">
            <thead style="alignment: center">
            <tr>

                <th><?php echo 'अ. क्र.'?></th>
                <th><?php echo 'रजि. नं.'?></th>
                <th><?php echo 'नाव'?></th>
                <th class="text-center"><?php echo 'Action'?> </th>
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
            foreach ($result as $key=>$val)
            {
                ?>
                <tr>

                    <td><?php echo $val['id'];?></td>
                    <td><?php echo $val['register_no'];?></td>
                    <td><?php echo $val['fname'].' '.$val['mname'].' '.$val['lname'];?></td>

                    <td class="text-center">

                        <a href="<?php echo site_url('marks/new/'.$val['id']);?>"><i title="मार्कलिस्ट भरा"><img src="/images/edit.png"/></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

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

                <th class="text-center"><?php echo 'action'?> </th>
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

