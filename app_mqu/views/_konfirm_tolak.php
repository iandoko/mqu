<div>

    <?php echo form_open()?>
    <?php
    if (validation_errors()) {
        $display = '';
    } else {
        $display = ' display-hide';
    } ?>
    <?php
    if ($display == ' display-hide') {
        $notification = $this->session->flashdata('notification');
        if (isset($notification)) {
            $display = '';
        } else {
            $display = ' display-hide';
        }
    } ?>
    <div class="alert alert-danger<?php echo $display; ?>">
        <button class="close" data-close="alert"></button>
        <span><?php echo validation_errors() ?><?php if (isset($notification)) echo $this->session->flashdata('notification'); ?></span>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-condensed flip-content">
        <tr>
            <td width="30%">No Anggota / Username:</td>
            <td><strong><?php echo $users['username'];?></strong></td>
        </tr>
        <tr>
            <td>Order ID:</td>
            <td><strong>#<?php echo $users['idorder'];?></strong></td>
        </tr>
        <tr>
            <td>Jenis Pembayaran:</td>
            <td><strong><?php echo $users['nama_pembayaran'];?></strong></td>
        </tr>
        <tr>
            <td>Jumlah Pembayaran:</td>
            <td><strong><?php echo $users['jumlah_pembayaran'];?></strong></td>
        </tr>
        <tr>
            <td>Tgl dan Waktu Pembayaran:</td>
            <td><strong><?php echo date('d-m-Y',strtotime($users['tanggal_bayar']));?> <?php echo $users['waktu_bayar'];?></strong></td>
        </tr>
        <tr>
            <td>Nama Bank Pembayar:</td>
            <td><strong><?php echo $users['nama_bank'];?></strong></td>
        </tr>
        <tr>
            <td>No. Rek. & Nama Bank Pembayar:</td>
            <td><strong><?php echo $users['no_rek_bayar'];?></strong> / <strong><?php echo $users['nama_rek_bayar'];?></strong></td>
        </tr>
    </table>
        </div>
        <div>Keterangan Penolakan / Pembatalan</div>
        <div>
            <?php echo form_textarea('keterangan',htmlspecialchars_decode($users['keterangan']),'class="form-control"'); ?>
        </div>
    </div>

<?php if ($users['status_bayar'] == '0' || $users['status_bayar'] == '1' ) {?>

    <div style="padding-top: 10px;"><?php echo form_submit('submit', 'Kirim','class="btn btn-small red hidden-print margin-bottom-5"'); ?> </div>
    <?php }?>

</div>
<?php echo form_close()?>