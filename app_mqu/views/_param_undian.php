<div class="row">
    <div class="col-md-12">

        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">

                <div class="col-md-6">
                    <div class="btn-group">
                        <a href="<?php echo base_url();?>undian/edit/" class="btn green" id="sample_editable_1_new">
                            Tambah Data <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>

            </div>
            <div class="portlet-body flip-scroll">
                <table class="table table-bordered table-striped table-condensed flip-content">
                    <thead class="flip-content">
                    <tr>
                        <th width="150">
                            Nama Undian
                        </th>
                        <th>
                            Minimum keanggotaan (bulan)
                        </th>
                        <th>
                            Paket
                        </th>
                        <th>
                            Maksimum Pengundian Perbulan
                        </th>
                        <th>
                            Minimum user
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
                    <?php foreach ($datas as $data): ?>

                        <tr>
                            <td>
                                <?php echo $data['nama_undian'];?>
                            </td>
                            <td>
                                <?php echo $data['masa_keanggotaan'];?>
                            </td>
                            <td>
                                <?php echo $data['nama_paket'];?>
                            </td>
                            <td>
                                <?php echo $data['limit_perbulan'];?>
                            </td>
                            <td>
                                <?php echo $data['min_user'];?>
                            </td>
                            <td>
                                <?php if ($data['status'] == 1) {
                                    echo '<span class="label label-sm label-success">Aktif</span>';
                                }  else {
                                    echo '<span class="label label-sm label-warning">Non Aktif</span>';
                                }?>
                            </td>
                              <td>
                                <?php echo anchor(base_url().'undian/edit/'. $data['idundian'],'Edit',array('class' => "label label-sm label-info"));?>
                                <?php echo anchor(base_url().'undian/hapus/'. $data['idundian'],'Hapus', array(
                                    'onclick' => "return confirm('Data akan dihapus. pastikan?');", 'class' => "label label-sm label-danger"));?>
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