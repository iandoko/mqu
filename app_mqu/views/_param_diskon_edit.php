<div>

    <?php echo form_open(base_url()."parameter/diskon_update/$members->idpromo")?>
    <span><?php echo validation_errors() ?></span>

    <div>
        <div>Nama Diskon</div>

        <div>
            <?php echo form_input('nama_promo',$members->nama_promo,'class="form-control input-large"'); ?>
        </div>
    </div>
    <div>
        <div>Jenis Diskon</div>

        <div>
            <?php $options = array(
                'harga'  => 'Harga',
                'persen'    => 'Persen',
            );

            echo form_dropdown('jenis_diskon',$options,$members->jenis_diskon,'class="form-control input-small"');
            ?>
        </div>
    </div>
    <div>
        <div style="padding-top: 5px;">Besar Diskon</div>
        <div>
            <?php echo form_input('besar_diskon',$members->besar_diskon,'class="form-control input-small"'); ?>
        </div>
    </div>
    <div>
        <div style="padding-top: 5px;">Nama Paket</div>
        <?php
        $paket_options = array();
        foreach($pakets as $paket){
            $paket_options[$paket->paketid] = $paket->nama_paket;
        }
        echo form_dropdown('paketid', $paket_options,$members->paket_paketid,'class="form-control input-large"');
        ?>
    </div>
    <div>
        <div style="padding-top: 5px;">Jenis Member</div>
        <?php
        $member_options = array();
        foreach($jenis_members as $jenis_member){
            $member_options[$jenis_member->memberid] = $jenis_member->nama_member;
        }
        echo form_dropdown('memberid', $member_options,$members->jenis_member_memberid,'class="form-control input-medium"');
        ?>
    </div>
    <div>
        <div style="padding-top: 5px;">Jumlah Orang</div>
        <div>
            <?php echo form_input('group_ref',$members->group_ref,'class="form-control input-small"'); ?>
        </div>
    </div>
    <div>
        <div style="padding-top: 5px;">Status</div>
        <div>
           <?php $options = array(
                '1'  => 'Aktif',
                '0'    => 'Non Aktif',
            );

            echo form_dropdown('status',$options,$members->status,'class="form-control input-small"');
           ?>
        </div>
    </div>


    <div style="padding-top: 10px;"><?php echo form_submit('submit', 'Rubah','class="btn btn-small red hidden-print margin-bottom-5"'); ?> </div>

</div>
<?php echo form_close()?>


