<div>

    <?php echo form_open()?>
    <span><?php echo validation_errors() ?></span>

    <div>
        <div>Nama Undian</div>

        <div>
            <?php echo form_input('nama_undian',$datas->nama_undian,'class="form-control input-large"'); ?>
        </div>
    </div>

    <div>
        <div style="padding-top: 5px;">Minimum Keanggotaan (Bulan)</div>
        <div>
            <?php echo form_input('masa_keanggotaan',$datas->masa_keanggotaan,'class="form-control input-small"'); ?>
        </div>
    </div>

    <div>
        <div>Paket</div>
        <div>
            <?php echo form_input('nama_paket',$datas->nama_paket,'id="nama_paket" readonly="readonly"');?>
            <?php
            $attributes = array (
                'class' => "form-control input-small",
                'id' => "paket_paketid",
                'type'  => 'hidden',
                'name'  => 'paket_paketid',
                'value' => $datas->paket_paketid,
            );

            echo form_input($attributes); ?>
            <?php
            $attributes = array(
                'class'     =>  "label label-sm label-info",
                'width'     =>  '500',
                'height'    =>  '300',
                'screenx'   =>  '\'+((parseInt(screen.width) - 500)/2)+\'',
                'screeny'   =>  '\'+((parseInt(screen.height) - 300)/2)+\'',
            );
            echo anchor_popup(base_url().'pilih/paket','Pilih Paket',$attributes);?></div>
    </div>
    <div>
        <div style="padding-top: 5px;">Limit Undian PerBulan</div>
        <div>
            <?php echo form_input('limit_perbulan',$datas->limit_perbulan,'class="form-control input-small"'); ?>
        </div>
    </div>
    <div>
        <div style="padding-top: 5px;">Minimum Anggota</div>
        <div>
            <?php echo form_input('min_user',$datas->min_user,'class="form-control input-small"'); ?>
        </div>
    </div>
    <div>
        <div style="padding-top: 5px;">Status</div>
        <div>
            <?php $options = array(
                '1'  => 'Aktif',
                '0'    => 'Non Aktif',
            );

            echo form_dropdown('status',$options,(bool)$datas->status,'class="form-control input-small"');
            ?>
        </div>
    </div>
    <div style="padding-top: 10px;"><?php echo form_submit('submit', 'Rubah','class="btn btn-small red hidden-print margin-bottom-5"'); ?> </div>

</div>
<?php echo form_close()?>


