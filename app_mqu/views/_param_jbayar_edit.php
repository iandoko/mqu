<div>

    <?php echo form_open()?>
    <span><?php echo validation_errors() ?></span>

    <div>
        <div>Nama Jenis Pembayaran</div>

        <div>
            <?php echo form_input('nama_pembayaran',$datas->nama_pembayaran,'class="form-control input-large"'); ?>
        </div>
    </div>
    <div>
        <div>Jumlah Bulan Cicilan</div>

        <div>
            <?php echo form_input('pembagi',$datas->pembagi,'class="form-control input-small"'); ?>
        </div>
    </div>


    <div style="padding-top: 10px;"><?php echo form_submit('submit', 'Simpan','class="btn btn-small red hidden-print margin-bottom-5"'); ?>
        <a class="btn btn-small green hidden-print margin-bottom-5" href="<?php echo base_url().'parameter/jbayar';?>">Cancel <i class="fa fa-undo"></i></a>
    </div>

</div>
<?php echo form_close()?>