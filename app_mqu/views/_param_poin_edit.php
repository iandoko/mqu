<div>

    <?php echo form_open(base_url()."parameter/poin_update/$members->idpoin")?>
    <span><?php echo validation_errors() ?></span>

    <div>
        <div>Nama Poin / Biaya</div>

        <div>
            <?php echo form_hidden('nama_poin',$members->nama_poin); ?>
            <?php echo form_input('nama_poin',$members->nama_poin,'class="form-control input-large" disabled="disabled"'); ?>
        </div>
    </div>

    <div>
        <div style="padding-top: 5px;">Besar Poin / Biaya</div>
        <div>
            <?php echo form_input('jumlah_poin',$members->jumlah_poin,'class="form-control input-small"'); ?>
        </div>
    </div>

    <div>
        <div style="padding-top: 5px;">Jenis Poin / Biaya</div>
        <div>
           <?php $options = array(
                'uang'  => 'Uang',
                'poin'    => 'Poin',
            );

            echo form_dropdown('jenis_poin',$options,$members->jenis_poin,'class="form-control input-small"');
           ?>
        </div>
    </div>


    <div style="padding-top: 10px;"><?php echo form_submit('submit', 'Rubah','class="btn btn-small red hidden-print margin-bottom-5"'); ?> </div>

</div>
<?php echo form_close()?>


