<div class="row margin-top-10">
    <div class="col-md-12">

        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar" style="width: 200px; float:left;">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <?php if($members['pas_foto']) {?>
                        <img class="img-responsive" alt="" src="<?php echo base_url().'images/profile/'.$members['pas_foto'];?>" width="150">
                    <?php } else {?>
                    <img class="img-responsive" alt="" src="<?php echo base_url();?>images/profile/no-images.png" width="150">
                    <?php }?>
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle hidden-print">
                    <div class="profile-usertitle-name">
                        Member ID : <?php echo $members['username'];?>
                    </div>
                    <div class="profile-usertitle-job">
                        Group : <?php echo $group['nama_group'];?>
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons hidden-print">
                    <?php if ($members['status'] == 1) {?>
                    <button class="btn btn-circle green-haze btn-sm" type="button">Aktif</button>
                    <?php } else {?>
                    <button class="btn btn-circle btn-danger btn-sm" type="button">Non Aktif</button>
                    <?php } ?>
                </div>
                <!-- END SIDEBAR BUTTONS -->

            </div>
            <!-- END PORTLET MAIN -->

        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-8">
                    <!-- BEGIN PORTLET -->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption caption-md">
                                <i class="icon-bar-chart theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Profile Data (<?php echo $members['username'];?>)</span>

                            </div>

                        </div>
                        <div class="portlet-body">

                            <div class="table-scrollable table-scrollable-borderless">
                                <table class="table table-hover table-light">

                                    <tbody>
                                    <tr>
                                       <td>
                                           <span class="bold theme-font">Nama</span>
                                        </td>
                                        <td colspan="3">
                                            <?php echo $members['nama_lengkap'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Email</span>
                                        </td>
                                        <td colspan="3">
                                            <?php echo $members['email'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">No. KTP</span>
                                        </td>
                                        <td colspan="3">
                                            <?php echo $members['nomor_ktp'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Tempat Lahir</span>
                                        </td>
                                        <td>
                                            <?php echo $members['tempat_lahir'];?>
                                        </td>
                                        <td>
                                            <span class="bold theme-font">Tgl. Lahir</span>
                                        </td>
                                        <td>
                                            <?php echo date('d-m-Y',strtotime($members['tanggal_lahir']));?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Alamat</span>
                                        </td>
                                        <td colspan="3">
                                            <?php echo $members['alamat'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">No</span>
                                        </td>
                                        <td>
                                            <?php echo $members['no'];?>
                                        </td>
                                        <td>
                                            <span class="bold theme-font">RT</span> <?php echo $members['rt'];?>
                                        </td>
                                        <td>
                                            <span class="bold theme-font">RW</span> <?php echo $members['rw'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Pekerjaan</span>
                                        </td>
                                        <td>
                                            <?php echo $members['pekerjaan'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Nama Perusahaan</span>
                                        </td>
                                        <td>
                                            <?php echo $members['nama_perusahaan'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Kabupaten / Kota</span>
                                        </td>
                                        <td>
                                            <?php echo $members['nama_kota'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Propinsi</span>
                                        </td>
                                        <td>
                                            <?php echo $members['nama_prop'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Kodepos</span>
                                        </td>
                                        <td colspan="3">
                                            <?php echo $members['kodepos'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">No. Handphone</span>
                                        </td>
                                        <td colspan="3">
                                            <?php echo $members['no_handphone'];?>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END PORTLET -->
                    <a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();">
                        Print <i class="fa fa-print"></i>
                    </a>
                    <a class="btn btn-lg green hidden-print margin-bottom-5" href="<?php echo base_url();?>member/edit_profile/<?php echo $members['userid'];?>">
                        Edit Profile <i class="fa fa-check"></i>
                    </a>
                </div>

            </div>

        </div>
        <!-- END PROFILE CONTENT -->

    </div>
</div>