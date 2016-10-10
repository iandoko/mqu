
        <!-- FORM -->
        <div class="row margin-top-10">
            <div class="col-md-12">
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
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user-plus"></i>KONFIRMASI PEMBAYARAN
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php echo form_open_multipart() ?>
                             <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label"><span class="bold theme-font">Order *</span></label>
                                    <?php
                                    $options = array();

                                    foreach($orders as $order){
                                        $options[$order['idtransaksi_paket']] = 'No Order : #'.$order['idtransaksi_paket'].' - '.$order['nama_paket'].' - '.$order['jenis_sapi']. ' - tgl order: '.date('d-m-Y',strtotime($order['created_time'])). ' - ' .$order['nama_pembayaran']. ' - ' .$order['nama_group'];

                                    }
                                    echo form_dropdown('idorder', $options,$datas->idorder,'class="form-control"');
                                    ?>
															<span class="help-block"><i>(wajib diisi)</i> </span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"><span class="bold theme-font">Jumlah Pembayaran *</span></label>
                                    <div class="input-group">
																<span class="input-group-addon">
																<i class="fa fa-money"></i>
																</span>
                                        <input class="form-control" type="text"
                                               placeholder="Jumlah Pembayaran" value="<?php echo $datas->jumlah_pembayaran; ?>" name="jumlah_pembayaran">

                                    </div>
                                    <span class="help-block"><i>(wajib diisi)</i> </span>
                                </div>
                                 <div class="form-group">
                                     <label class="control-label"><span class="bold theme-font">Jenis Pembayaran</span></label>
                                     <div class="input-group">

                                         <?php $options = array(
                                             'Uang Muka'  => 'Uang Muka',
                                             'Sisa Pembayaran Tunai'  => 'Sisa Pembayaran Tunai',
                                             'Tahapan'  => 'Tahapan',
                                         );

                                         echo form_dropdown('nama_pembayaran',$options,$datas->nama_pembayaran,'class="form-control"');?>

                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label class="control-label"><span class="bold theme-font">Tanggal Pembayaran</span></label>
                                     <div class="input-group">
                                         <input
                                             class="form-control form-control-inline date-picker"
                                             type="text" placeholder="dd-mm-yyyy" size="16"
                                             value="<?php if ($datas->tanggal_bayar) { echo date('d-m-Y', strtotime($datas->tanggal_bayar)); } else {echo date('d-m-Y'); }; ?>"
                                             name="tanggal_bayar">
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label class="control-label"><span class="bold theme-font">Waktu Pembayaran *</span></label>
                                     <div class="input-group">
                                         <input class="form-control" type="text"
                                                placeholder="<?php echo date('H:i:s');?>" value="<?php echo $datas->waktu_bayar; ?>" name="waktu_bayar">

                                     </div>
                                     <span class="help-block"><i>(wajib diisi)</i> </span>
                                 </div>
                                 <div class="form-group">
                                     <label class="control-label"><span class="bold theme-font">No Rek. Pembayaran *</span></label>
                                     <div class="input-group">
                                         <input class="form-control" type="text"
                                                placeholder="" value="<?php echo $datas->no_rek_bayar; ?>" name="no_rek_bayar">

                                     </div>
                                     <span class="help-block"><i>(wajib diisi)</i> </span>
                                 </div>
                                 <div class="form-group">
                                     <label class="control-label"><span class="bold theme-font">Bank Rek. Pembayaran *</span></label>
                                     <div class="input-group">
                                         <input class="form-control" type="text"
                                                placeholder="" value="<?php echo $datas->nama_bank; ?>" name="nama_bank">

                                     </div>
                                     <span class="help-block"><i>(wajib diisi)</i> </span>
                                 </div>
                                 <div class="form-group">
                                     <label class="control-label"><span class="bold theme-font">Nama Pemilik Rek. Pembayaran *</span></label>
                                     <div class="input-group">
                                         <input class="form-control" type="text"
                                                placeholder="" value="<?php echo $datas->nama_rek_bayar; ?>" name="nama_rek_bayar">

                                     </div>
                                     <span class="help-block"><i>(wajib diisi)</i> </span>
                                 </div>
                                <div class="form-group last">

                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="btn-set pull-left">
                                    <?php echo form_submit('submit', 'Konfirm', 'class="btn btn-small red hidden-print margin-bottom-5"'); ?>
                                    <a class="btn btn-small green hidden-print margin-bottom-5" href="<?php echo base_url(); ?>">Cancel
                                        <i class="fa fa-undo"></i>
                                    </a>
                                </div>

                            </div>
                        <?php echo form_close() ?>
                        <!-- END FORM-->
                    </div>
                </div>
            </div>
        </div>
        <!-- END FORM -->

