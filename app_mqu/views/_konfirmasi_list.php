<div class="row">
    <div class="col-md-12">

        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light">
            <?php
            $notifi = $this->session->flashdata('pesan' );
            if(isset($notifi)) { $display = ''; } else { $display = ' display-hide';}?>
            <div class="alert alert-danger<?php echo $display;?>">
                <button class="close" data-close="alert"></button>
                <span><?php echo $this->session->flashdata('pesan'); ?></span>
            </div>
            <div class="portlet-body flip-scroll">
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-condensed flip-content">
                    <thead class="flip-content">
                    <tr>
                        <th>
                            No. Order
                        </th>
                        <th width="150">
                            Waktu Pembayaran
                        </th>
                        <th>
                            Nama Pembayaran
                        </th>
                        <th>
                            Jumlah Pembayaran
                        </th>
                        <th>
                            Paket
                        </th>
                        <th>
                            Total Tagihan
                        </th>
                        <th>
                            Dari Bank / No. Rek / Nama Pemilik
                        </th>
                        <th>
                            Group
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Proses
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                   if(count($datas) > 0) {
                    foreach ($datas as $data): ?>

                        <tr>
                            <td>
                                <?php echo $data['idtransaksi_paket'];?>
                            </td>
                            <td>
                                <?php echo date('d-m-Y',strtotime($data['tanggal_bayar'])).' '.$data['waktu_bayar'];?>
                            </td>
                            <td>
                                <?php echo $data['nama_pembayaran'];?>
                            </td>
                            <td>
                                <?php echo number_format($data['jumlah_pembayaran'], 0, ',', '.');?>
                            </td>
                            <td>
                                <?php echo $data['nama_paket'].' '.$data['jenis_sapi'].' '.$data['range_berat'].' kg';?>
                            </td>

                            <td>
                                <?php
                                    if ($data['nama_group'] != '') {
                                        echo number_format($data['harga_group'], 0, ',', '.');
                                    } else {
                                        echo number_format($data['harga'], 0, ',', '.');
                                    }?>
                            </td>
                            <td>
                                <?php echo $data['nama_bank'].' / '.$data['no_rek_bayar'].' / '.$data['nama_rek_bayar'];?>
                            </td>

                            <td>
                                <?php echo $data['nama_group'];?>
                            </td>
                            <td>
                        <?php if ($data['status_bayar'] == '1') {?>
                            <span class="btn green hidden-print margin-bottom-5">Diterima</span>
                            <?php }?>
                                <?php if ($data['status_bayar'] == '2') {?>
                                    <span class="btn red hidden-print margin-bottom-5">Ditolak</span>
                                <?php }?><br />
                                <?php echo $data['keterangan'];?>
                            </td>
                            <td>
                                <?php if ($data['status_bayar'] != '1') {?>
                                <a class="btn green hidden-print margin-bottom-5" href="<?php echo base_url();?>konfirmasi/proses/<?php echo $data['idpembayaran'];?>" onclick="return confirm('Terima Konfirmasi?')">
                                    Terima <i class="fa fa-check"></i>
                                </a><?php } else {?>
                                    <a class="btn yellow hidden-print margin-bottom-5" href="<?php echo base_url();?>konfirmasi/batal/<?php echo $data['idpembayaran'];?>">
                                        Batal Terima <i class="fa fa-check"></i>
                                    </a>
                            <?php }?>
                        <?php if ($data['status_bayar'] == '0') {?>
                                <a class="btn red hidden-print margin-bottom-5" href="<?php echo base_url();?>konfirmasi/tolak/<?php echo $data['idpembayaran'];?>">
                                    Tolak <i class="fa fa-check"></i>
                                </a>
                        <?php }?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                   <?php }  else {?>
                       <tr class="odd gradeX">
                           <td colspan="8">Tidak Ada data</td>
                       </tr>
                   <?php }?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <?php if($pagination): ?>
            <div class="row">
                <div class="col-md-12 text-center">
                    <?php echo $pagination; ?>
                </div>
            </div>
        <?php endif; ?>
        <!-- END SAMPLE TABLE PORTLET-->
        <!-- BEGIN SAMPLE TABLE PORTLET-->
    </div>
</div>