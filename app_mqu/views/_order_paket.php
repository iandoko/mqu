<div>

    <?php echo form_open()?>
    <?php if(validation_errors()) { $display1 = ''; } else { $display1 = ' display-hide';}?>
    <?php
    $notifi = $this->session->flashdata('notification' );
    if(isset($notifi)) { $display = ''; } else { $display = ' display-hide';}?>
    <div class="alert alert-danger<?php echo $display;?>">
        <button class="close" data-close="alert"></button>
        <span><?php echo $this->session->flashdata('notification'); ?></span>
    </div>
    <div class="alert alert-danger<?php echo $display1;?>">
        <button class="close" data-close="alert"></button>
        <span><?php echo validation_errors(); ?></span>
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
                'value' => $datas->paketid,
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
        <div style="padding-top: 5px;">Uang Muka</div>
        <div><?php $options = array(
                '0.1'  => '10%'
            );

            echo form_dropdown('uang_muka',$options,$datas->uang_muka,'class="form-control input-small"');?>
        </div>
    </div>
    <div>
        <div style="padding-top: 5px;">Jenis Pembayaran</div>
        <div><?php
            $jbayar_ops = array();

            foreach($jbayars as $jbayar){
            $jbayar_ops[$jbayar['idjenis_pembayaran']] = $jbayar['nama_pembayaran'];

            }
            echo form_dropdown('jenis_pembayaran', $jbayar_ops,$datas->jenis_pembayaran,'class="form-control input-large"');
            ?>
        </div>
    </div>
    <div>
        <div style="padding-top: 5px;">Tanggal Pengiriman (H = <?php echo $hday; ?>)</div>
        <div><?php $options = array(
                '-1'  => 'H -1',
                '-2'  => 'H -2',
                '-3'  => 'H -3',
                '-4'  => 'H -4',
            );

            echo form_dropdown('tgl_kirim',$options,$datas->tgl_kirim,'class="form-control input-small"');?>
        </div>
    </div>
    <div class="panel-group" style="padding-top: 5px;">
        <div class="panel panel-warning">
            <div class="panel-heading"><strong>Akad Jual Beli Salam</strong></div>
            <div class="panel-body"> <?php //echo $sk->value; ?>
                <iframe class="embed-responsive-item" src="http://docs.google.com/viewer?url=<?=urlencode(base_url().'images/akad_salam.docx')?>&embedded=true" height="350" width="100%"></iframe>
            </div>
        </div>
    </div>
    <div>
        <div style="padding-top: 5px;"><?php $data_checkbox = array(
                'name' => 'agree',
                'value' => '1'
            );
            echo form_checkbox($data_checkbox);
            ?> Saya setuju dengan akad jual beli salam diatas</div>

    </div>
    <div style="padding-top: 10px;"><?php echo form_submit('submit', 'Order Paket','class="btn btn-small red hidden-print margin-bottom-5"',
            array(
                'onclick' => "return confirm('Order Paket akan dibuat. pastikan?');")); ?> </div>

</div>
<?php echo form_close()?>


