<div class="row">
    <div class="col-md-12">

        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">

                <div class="col-md-6">
                    <div class="btn-group">
                        <a href="<?php echo base_url();?>banggota/edit/" class="btn green" id="sample_editable_1_new">
                            Tambah Data <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="#portlet-config" data-toggle="modal" class="config">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                    <a href="javascript:;" class="remove">
                    </a>
                </div>
            </div>
            <div class="portlet-body flip-scroll">
                <table class="table table-bordered table-striped table-condensed flip-content">
                    <thead class="flip-content">
                    <tr>
                        <th width="150">
                            Biaya
                        </th>
                        <th>
                            Besar Biaya
                        </th>
                        <th>
                            Jenis Member
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
                                <?php echo $data['nama_biaya'];?>
                            </td>
                            <td>
                                <?php echo number_format($data['jumlah_biaya'],0,',','.');?>
                            </td>
                            <td>
                                <?php echo $data['nama_member'];?>
                            </td>
                              <td>
                                <?php echo anchor(base_url().'banggota/edit/'. $data['idbiaya'],'Edit',array('class' => "label label-sm label-info"));?>
                                <?php echo anchor(base_url().'banggota/hapus/'. $data['idbiaya'],'Hapus', array(
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