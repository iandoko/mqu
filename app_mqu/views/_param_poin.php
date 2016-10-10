<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">

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
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_1">
                    <thead>
                    <tr>
                       <th>
                            Nama Poin / Biaya
                        </th>
                        <th>
                            Besar Poin / Biaya
                        </th>
                        <th>
                            Jenis Poin / Biaya
                        </th>
                        <th>
                            Proses
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($members as $member): ?>
                    <tr class="odd gradeX">
                        <td>
                            <?php echo $member['nama_poin'];?>
                        </td>

                        <td>
                            <?php echo number_format($member['jumlah_poin'], 0, ',', '.');?>
                        </td>

                        <td>
                            <?php echo $member['jenis_poin'];?>
                        </td>
                        <td>
                            <a class="btn green hidden-print margin-bottom-5" href="<?php echo base_url();?>parameter/poin/<?php echo $member['idpoin'];?>">
                                Edit <i class="fa fa-check"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>