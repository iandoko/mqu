<div class="row margin-top-10">
    <div class="col-md-12">
        <?php echo form_open_multipart() ?>

        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PORTLET -->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption caption-md">
                                <i class="icon-bar-chart theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Detail Keanggotaan</span>

                            </div>

                        </div>
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
                        <div class="portlet-body">

                            <div class="table-scrollable table-scrollable-borderless">
                                <table class="table table-hover table-light">

                                    <tbody>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Nama *</span>
                                        </td>
                                        <td colspan="1">
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <input class="form-control input-large" type="text"
                                                           placeholder="Nama Lengkap"
                                                           value="<?php echo $datas->nama_lengkap; ?>"
                                                           name="nama_lengkap">
                                                </div>
                                            </div>

                                        </td>
                                        <td rowspan="3" colspan="2">
                                            <div class="profile-userpic">
                                                maks: 100kb (1024 x 768)
                                                <div class="col-md-4">
                                                    <?php if ($datas->pas_foto) { ?>
                                                        <img class="img-responsive" alt=""
                                                             src="<?php echo base_url() . 'images/profile/' . $datas->pas_foto; ?>"
                                                             width="80">
                                                    <?php } else { ?>
                                                        <img class="img-responsive" alt=""
                                                             src="<?php echo base_url(); ?>images/profile/no-images.png"
                                                             width="80">
                                                    <?php } ?>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <div class="row fileupload-buttonbar">
                                                            <span class="btn green fileinput-button"><i
                                                                    class="fa fa-plus"></i>
                                                                <span>Ganti Photo... </span>
                                                                <input name="pas_foto" type="file" accept="image/*"
                                                                       onchange="loadFile(event)">
                                                            </span>

                                                        <div class="col-md-4">
                                                            <img id="output1" width="80" style="padding-top:10px;"/>
                                                            <script>
                                                                var loadFile = function (event) {
                                                                    var output = document.getElementById('output');
                                                                    output.src = URL.createObjectURL(event.target.files[0]);
                                                                };
                                                            </script>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                    <tr>
                                        <td>
                                            <span class="bold theme-font">No. KTP</span>
                                        </td>
                                        <td colspan="1">
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <input class="form-control input-large" type="text"
                                                           placeholder="Nomor KTP"
                                                           value="<?php echo $datas->nomor_ktp; ?>" name="nomor_ktp">
                                                </div>
                                            </div>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Email *</span>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <input class="form-control input-medium" type="text"
                                                           placeholder="Email" value="<?php echo $datas_usr->email; ?>"
                                                           name="email">
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>

                                        <td>
                                            <span class="bold theme-font">Password yang diinginkan *</span>

                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <input class="form-control input-medium" type="password"
                                                           placeholder="Password"
                                                           value="<?php echo $datas_usr->password; ?>" name="password">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="bold theme-font">Konfirmasi Password *</span>

                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <input class="form-control input-medium" type="password"
                                                           placeholder="konfiramsi password"
                                                           value="<?php echo $datas_usr->passconf; ?>" name="passconf">
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Jenis Keanggotaan</span>
                                        </td>
                                        <td>
                                            <?php
                                            if ($datas_usr->jenis_member_memberid == 2) {
                                                $checked1 = True;
                                                $checked2 = False;
                                            } else {
                                                $checked1 = False;
                                                $checked2 = True;
                                            } ?>
                                            <div class="radio-list"><label>
                                                    <input name="jenis_member_memberid" type="radio"
                                                           <?php if ($checked1) { ?>checked=""<?php } ?> value="2">
                                                    <span class="bold theme-font">Member Standard</span></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Tempat Lahir</span>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <input class="form-control input-small" type="text"
                                                           placeholder="Tempat Lahir"
                                                           value="<?php echo $datas->tempat_lahir; ?>"
                                                           name="tempat_lahir">
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <span class="bold theme-font">Tgl. Lahir</span>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <input
                                                        class="form-control form-control-inline input-small date-picker"
                                                        type="text" placeholder="dd-mm-yyyy" size="16"
                                                        value="<?php echo date('d-m-Y', strtotime($datas->tanggal_lahir)); ?>"
                                                        name="tanggal_lahir">
                                                </div>
                                            </div>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Alamat *</span>
                                        </td>
                                        <td colspan="3">
                                            <div class="form-group">
                                                <div class="col-md-10">
                                                    <input class="form-control input-xxlarge" type="text"
                                                           placeholder="Alamat" value="<?php echo $datas->alamat; ?>"
                                                           name="alamat">
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">No Rumah</span>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <input class="form-control input-small" type="text"
                                                           placeholder="Nomer Rumah" value="<?php echo $datas->no; ?>"
                                                           name="no">
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <span class="bold theme-font">RT</span>

                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <input class="form-control input-small" type="text" placeholder="RT"
                                                           value="<?php echo $datas->rt; ?>" name="rt">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="bold theme-font">RW</span>

                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <input class="form-control input-small" type="text" placeholder="RW"
                                                           value="<?php echo $datas->rw; ?>" name="rw">
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <script type="text/javascript">

                                        $(document).ready(function() {

                                            $("#propinsi").change(function(){
                                                /*dropdown post *///
                                                $.ajax({
                                                    url:"<?php echo base_url();?>kota",
                                                    data: {propinsi: $(this).val(),
                                                        kabupaten_kota: $("#kabupaten_kota").val
                                                        },

                                                    type: "POST",
                                                    success:function(data){
                                                        $("#kabupaten_kota").html(data);
                                                        console.log(data);
                                                    },
                                                    error: function(xhr) {
                                                        console.log(xhr.responseText);
                                                    }
                                                });
                                                //alert ($(this).val());
                                            });
                                        });
                                    </script>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Propinsi</span>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <select name="propinsi" id="propinsi" class="form-control input-medium">
                                                        <option value="">-- Pilih Propinsi --</option>
                                                        <?php echo $prop; ?>
                                                    </select>

                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Kabupaten / kota</span>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <!--city dropdown-->
                                                        <select name="kabupaten_kota" id="kabupaten_kota" class="form-control input-medium">
                                                             <option value="">-- Pilih Kota --</option>
                                                            <?php echo $kota; ?>
                                                        </select>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Kodepos</span>
                                        </td>
                                        <td colspan="3">
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <input class="form-control input-medium" type="text"
                                                           placeholder="Kode Pos" value="<?php echo $datas->kodepos; ?>"
                                                           name="kodepos">
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">No. Handphone *</span>
                                        </td>
                                        <td colspan="3">
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <input class="form-control input-large" type="text"
                                                           placeholder="Nomer Handphone"
                                                           value="<?php echo $datas->no_handphone; ?>"
                                                           name="no_handphone">
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END PORTLET -->

                    <?php echo form_submit('submit', 'Daftar', 'class="btn btn-small red hidden-print margin-bottom-5"'); ?>
                    <a class="btn btn-small green hidden-print margin-bottom-5" href="<?php echo base_url(); ?>">Cancel
                        <i class="fa fa-undo"></i>
                    </a>
                </div>

            </div>

        </div>

        <!-- END PROFILE CONTENT -->
        <!-- FORM -->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user-plus"></i>DETAIL KEANGGOTAAN
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php echo form_open_multipart() ?>
                             <div class="form-body">
                                 <div class="form-group">
                                     <div class="col-md-4">
                                         <?php if ($datas->pas_foto) { ?>
                                             <img class="img-responsive" alt=""
                                                  src="<?php echo base_url() . 'images/profile/' . $datas->pas_foto; ?>"
                                                  width="80">
                                         <?php } else { ?>
                                             <img class="img-responsive" alt=""
                                                  src="<?php echo base_url(); ?>images/profile/no-images.png"
                                                  width="80">
                                         <?php } ?>

                                     </div>
                                    <div class="row fileupload-buttonbar">


                                     <div class="col-md-4">
                                           <span class="btn green fileinput-button"><i
                                                   class="fa fa-plus"></i>
                                                                <span>Ganti Photo... </span>
                                                                <input name="pas_foto" type="file" accept="image/*"
                                                                       onchange="loadFile(event)">
                                                            </span>
                                         <img id="output" width="80" style="padding-top:10px;"/>
                                         <script>
                                             var loadFile = function (event) {
                                                 var output = document.getElementById('output');
                                                 output.src = URL.createObjectURL(event.target.files[0]);
                                             };
                                         </script>
                                     </div>
                                 </div>
                                     <span class="help-block">
															<i>(maks: 100kb (1024 x 768)</i> </span>
                                 </div>
                                <div class="form-group">
                                    <label class="control-label"><span class="bold theme-font">Nama *</span></label>
                                    <input class="form-control" type="text"
                                           placeholder="Nama Lengkap"
                                           value="<?php echo $datas->nama_lengkap; ?>"
                                           name="nama_lengkap">
															<span class="help-block"><i>(wajib diisi)</i> </span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"><span class="bold theme-font">Email Address *</span></label>
                                    <div class="input-group">
																<span class="input-group-addon">
																<i class="fa fa-envelope"></i>
																</span>
                                        <input class="form-control" type="text"
                                               placeholder="Email" value="<?php echo $datas_usr->email; ?>" name="email">

                                    </div>
                                    <span class="help-block"><i>(wajib diisi)</i> </span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"><span class="bold theme-font">Password *</span></label>
                                    <div class="input-group">
                                        <input class="form-control" type="password"
                                               placeholder="Password"
                                               value="<?php echo $datas_usr->password; ?>" name="password">
																<span class="input-group-addon">
																<i class="fa fa-lock"></i>
																</span>
                                    </div>
                                </div>
                                 <div class="form-group">
                                     <label class="control-label"><span class="bold theme-font">Konfirmasi Password *</span></label>
                                     <div class="input-group">
                                         <input class="form-control" type="password"
                                                placeholder="konfiramsi password"
                                                value="<?php echo $datas_usr->passconf; ?>" name="passconf">
																<span class="input-group-addon">
																<i class="fa fa-lock"></i>
																</span>
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label class="control-label"><span class="bold theme-font">No. KTP</span></label>
                                     <div class="input-group">
                                          <span class="input-group-addon">
																<i class="fa fa-keyboard-o"></i>
																</span>
                                         <input class="form-control" type="text"
                                                placeholder="Nomor KTP"
                                                value="<?php echo $datas->nomor_ktp; ?>" name="nomor_ktp">

                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label class="control-label"><span class="bold theme-font">No. Telp / HP *</span></label>
                                     <div class="input-group">
                                            <span class="input-group-addon">
																<i class="fa fa-phone"></i>
																</span>
                                         <input class="form-control" type="text"
                                                placeholder="Nomer Telp / HP"
                                                value="<?php echo $datas->no_handphone; ?>"
                                                name="no_handphone">
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label class="control-label"><span class="bold theme-font">Pekerjaan</span></label>

                                         <input class="form-control" type="text"
                                                placeholder="Pekerjaan"
                                                value="<?php echo $datas->pekerjaan; ?>"
                                                name="pekerjaan">

                                 </div>
                                 <div class="form-group">
                                     <label class="control-label"><span class="bold theme-font">Nama Perusahaan</span></label>

                                     <input class="form-control" type="text"
                                            placeholder="Nama Perusahaan"
                                            value="<?php echo $datas->perusahaan; ?>"
                                            name="perusahaam">
                                     <span class="help-block"><i>(Tempat Bekerja Saat ini)</i> </span>
                                 </div>
                                 <div class="form-group">
                                     <label class="control-label"><span class="bold theme-font">Alamat *</span></label>

                                     <div class="input-group">
                                            <span class="input-group-addon">
																<i class="fa fa-home"></i>
																</span>
                                         <input class="form-control" type="text"
                                                placeholder="Alamat" value="<?php echo $datas->alamat; ?>"
                                                name="alamat">

                                         </div>
                                     <span class="help-block"><i>(wajib diisi sesuai KTP)</i> </span>
                                 </div>
                                 <div class="form-group">
                                     <script type="text/javascript">

                                         $(document).ready(function() {

                                             $("#propinsi").change(function(){
                                                 /*dropdown post *///
                                                 $.ajax({
                                                     url:"<?php echo base_url();?>kota",
                                                     data: {propinsi: $(this).val(),
                                                         kabupaten_kota: $("#kabupaten_kota").val
                                                     },

                                                     type: "POST",
                                                     success:function(data){
                                                         $("#kabupaten_kota").html(data);
                                                         console.log(data);
                                                     },
                                                     error: function(xhr) {
                                                         console.log(xhr.responseText);
                                                     }
                                                 });
                                                 //alert ($(this).val());
                                             });
                                         });
                                     </script>
                                     <label class="control-label"><span class="bold theme-font">Propinsi</span></label>
                                         <select name="propinsi" id="propinsi" class="form-control">
                                             <option value="">-- Pilih Propinsi --</option>
                                             <?php echo $prop; ?>
                                         </select>

                                 </div>
                                 <div class="form-group">
                                     <label class="control-label"><span class="bold theme-font">Kabupaten / Kota</span></label>
                                         <!--city dropdown-->
                                         <select name="kabupaten_kota" id="kabupaten_kota" class="form-control">
                                             <option value="">-- Pilih Kota --</option>
                                             <?php echo $kota; ?>
                                         </select>
                                 </div>
                                 <div class="form-group">
                                     <label class="control-label"><span class="bold theme-font">Kodepos</span></label>
                                         <input class="form-control" type="text"
                                                placeholder="Kode Pos" value="<?php echo $datas->kodepos; ?>"
                                                name="kodepos">

                                 </div>
                                <div class="form-group last">

                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="btn-set pull-left">
                                    <?php echo form_submit('submit', 'Daftar', 'class="btn btn-small red hidden-print margin-bottom-5"'); ?>
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
        <?php echo form_close() ?>
    </div>
</div>
