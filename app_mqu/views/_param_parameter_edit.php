<div>

    <?php echo form_open()?>
    <span><?php echo validation_errors() ?></span>
    <div>
        <div>Parameter</div>

        <div>
            <?php echo form_input('param',$datas->nama_parameter,'class="form-control input-large" disabled="disabled"'); ?>
        </div>
    </div>
    <div>
        <div>Data</div>

        <div>
            <?php echo form_textarea('value',$datas->value,'class="form-control input-large"'); ?>
        </div>
    </div>


    <div style="padding-top: 10px;"><?php echo form_submit('submit', 'Simpan','class="btn btn-small red hidden-print margin-bottom-5"'); ?>
        <a class="btn btn-small green hidden-print margin-bottom-5" href="<?php echo base_url().'parameter';?>">Cancel <i class="fa fa-undo"></i></a>
    </div>

</div>
<?php echo form_close()?>


