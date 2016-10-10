<div>

    <?php echo form_open()?>
    <span><?php echo validation_errors() ?></span>
    <script>
        $( document ).ready( function() {
            $('#jumlah_biaya').mask("#.##0", {reverse: true});
        });
    </script>
    <div>
        <div>Nama Biaya</div>

        <div>
            <?php echo form_input('nama_biaya',$datas->nama_biaya,'class="form-control input-medium" id="nama_biaya"'); ?>
        </div>
    </div>
    <div>
        <div>Jumlah Biaya</div>

        <div>
            <?php echo form_input('jumlah_biaya',number_format($datas->jumlah_biaya,0,',','.'),'class="form-control input-small" id="jumlah_biaya"'); ?>
        </div>
    </div>
      <div>
        <div>Jenis Member</div>

        <div>
            <?php
            $jmember_ops = array();

            foreach($jmembers as $jmember){
                $jmember_ops[$jmember['memberid']] = $jmember['nama_member'];

            }
            echo form_dropdown('jenis_memberid', $jmember_ops,$datas->jenis_memberid,'class="form-control input-large"');
            ?>
        </div>
    </div>

    <div style="padding-top: 10px;"><?php echo form_submit('submit', 'Simpan','class="btn btn-small red hidden-print margin-bottom-5"'); ?> </div>

</div>
<?php echo form_close()?>


