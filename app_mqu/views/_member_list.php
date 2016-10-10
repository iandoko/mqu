<div class="row">
    <div class="col-md-12">
        <div class="note note-success note-bordered">
            <p>
                Please try to re-size your browser window in order to see the tables in responsive mode.
            </p>
        </div>
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">Daftar Member</span>
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
                        <th width="20%">
                            No Anggota
                        </th>
                        <th>
                            Nama
                        </th>
                        <th>
                            Alamat
                        </th>
                        <th>
                            Kota
                        </th>
                        <th class="numeric">
                            No Telp
                        </th>
                        <th>
                            Jenis Member
                        </th>
                        <th class="numeric">
                            Tanggal Lahir
                        </th>
                        <th class="numeric">
                            Tanggal Bergabung
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
                    <?php foreach ($members as $member): ?>

                        <tr>
                            <td>
                                <?php echo $member['username'];?>
                            </td>
                            <td>
                                <?php echo $member['nama_lengkap'];?>
                            </td>
                            <td class="numeric">
                                <?php echo $member['alamat'];?>
                            </td>
                            <td class="numeric">
                                <?php echo $member['kabupaten_kota'];?>
                            </td>
                            <td class="numeric">
                                <?php echo $member['no_handphone'];?>
                            </td>
                            <td class="numeric">
                                <?php echo $member['nama_member'];?>
                            </td>
                            <td class="numeric">
                                <?php echo $member['tanggal_lahir'];?>
                            </td>
                            <td class="numeric">
                                <?php echo $member['create_time'];?>
                            </td>
                            <td>
                                <?php if ($member['status'] == 1) {
                                    echo '<span class="label label-sm label-success">Aktif</span>';
}  else {
                                    echo '<span class="label label-sm label-warning">Non Aktif</span>';
                                }?>
                            </td>
                                <td>
                                    <?php if ($member['status'] == 0) {?> <a href="<?php echo base_url(); ?>member/aktifasi/<?php echo $member['userid'] ?>">Aktifasi</a> | <?php }?>
                        <a href="<?php echo base_url(); ?>member/detail/<?php echo $member['userid'] ?>">Detail</a>
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