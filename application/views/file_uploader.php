<?php
/**
 * Created by PhpStorm.
 * User: indrajit
 * Date: 5/26/19
 * Time: 2:49 PM
 */

?>

<div class="container">
    <?php
    if($this->session->flashdata('total_success')){
        echo $this->session->flashdata('total_success');
    } if($this->session->flashdata('success')){
        echo $this->session->flashdata('success');
    } if($this->session->flashdata('total_error')){
        echo $this->session->flashdata('total_error');
    } if($this->session->flashdata('error')){
        echo $this->session->flashdata('error');
    }
    ?>
    <h3 style="color: darkblue"><?php echo $title;?> </h3>
    <div class="row">
        <div class="col-md-4">
            <a  href="<?php echo '/database/'.$action.'_info.csv'?>"><input type="button" class="btn btn-info" value="Download Sample CSV"></a>
        </div>
        <div class="col-md-4">
            <form action="<?php echo site_url('upload/index/').$action?>" method="post" enctype="multipart/form-data">
                <div class="input-group">

                    <div class="custom-file">
                        <input required type="file" class="custom-file-input" accept=".csv,.xlsx,.xls" id="file" name="file"
                               aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="file">Choose file</label>
                    </div>
                </div>


        </div>
        <div class="col-md-4">
            <div class="input-group">
                <input type="submit" class="btn btn-primary" name="process" value="Process..!">
            </div>
        </div>
        </form>
    </div>

</div>
