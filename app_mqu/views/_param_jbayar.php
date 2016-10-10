<div class="row">
    <div class="col-md-12">

        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">

                <div class="col-md-6">
                    <div class="btn-group">
                        <a href="<?php echo base_url();?>parameter/jbayar_edit/" class="btn green" id="sample_editable_1_new">
                            Tambah Data <i class="fa fa-plus"></i>
                        </a>
                        </div>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>

                </div>
            </div>
            <div class="portlet-body flip-scroll">
                <table class="table table-bordered table-striped table-condensed flip-content">
                    <thead class="flip-content">
                    <tr>
                        <th>
                            Jenis Pembayaran
                        </th>
                        <th>
                            Cicilan (Bulan)
                        </th>
                        <th>
                            Proses
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($datas as $data): ?>

                        <tr>
                            <td>
                                <?php echo $data['nama_pembayaran'];?>
                            </td>
                            <td>
                                <?php echo $data['pembagi'];?>
                            </td>
                            <td>
                                <?php echo anchor(base_url().'parameter/jbayar_edit/'. $data['idjenis_pembayaran'],'Edit',array('class' => "label label-sm label-info"));?>
                                <!--<?php echo anchor(base_url().'parameter/jbayar_hapus/'. $data['idjenis_pembayaran'],'Hapus', array(
                                    'onclick' => "return confirm('Data akan dihapus. pastikan?');", 'class' => "label label-sm label-danger"));?>-->
                            </td>
                        </tr>



                    <?php endforeach ?>


                    </tbody>
                </table>
            </div>
        </div>
        <!-- END SAMPLE TABLE PORTLET-->
        <!-- BEGIN SAMPLE TABLE PORTLET-->
    </div>
</div>