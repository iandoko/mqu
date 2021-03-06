<!-- FORM -->
<div class="row margin-top-10">
    <div class="col-md-12">
        <?php
        $notifi = $this->session->flashdata('notification' );
        if(isset($notifi)) { $display = ''; } else { $display = ' display-hide';}?>
        <div class="alert alert-danger<?php echo $display;?>">
            <button class="close" data-close="alert"></button>
            <span><?php echo $this->session->flashdata('notification'); ?></span>
        </div>
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user-plus"></i>UPDATE DETAIL KEANGGOTAAN
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <?php echo form_open_multipart(base_url()."member/edit_profile/".$id)?>
                <div class="form-body">
                    <div class="form-group">
                        <div class="col-md-4">
                            <?php if ($members['pas_foto']) { ?>
                                <img class="img-responsive" alt=""
                                     src="<?php echo base_url() . 'images/profile/' . $members['pas_foto']; ?>"
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
                               value="<?php echo $members['nama_lengkap']; ?>"
                               name="nama_lengkap">
                        <span class="help-block"><i>(wajib diisi)</i> </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><span class="bold theme-font">No. KTP</span></label>
                        <div class="input-group">
                                          <span class="input-group-addon">
																<i class="fa fa-keyboard-o"></i>
																</span>
                            <input class="form-control" type="text"
                                   placeholder="Nomor KTP"
                                   value="<?php echo $members['nomor_ktp']; ?>" name="nomor_ktp">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><span class="bold theme-font">Pekerjaan</span></label>

                        <input class="form-control" type="text"
                               placeholder="Pekerjaan"
                               value="<?php echo $members['pekerjaan']; ?>"
                               name="pekerjaan">

                    </div>
                    <div class="form-group">
                        <label class="control-label"><span class="bold theme-font">Nama Perusahaan</span></label>

                        <input class="form-control" type="text"
                               placeholder="Nama Perusahaan"
                               value="<?php echo $members['nama_perusahaan']; ?>"
                               name="nama_perusahaan">
                        <span class="help-block"><i>(Tempat Bekerja Saat ini)</i> </span>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><span class="bold theme-font">No. Telp / HP *</span></label>
                        <div class="input-group">
                                            <span class="input-group-addon">
																<i class="fa fa-phone"></i>
																</span>
                            <input class="form-control" type="text"
                                   placeholder="Nomer Telp / HP"
                                   value="<?php echo $members['no_handphone']; ?>"
                                   name="no_handphone">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><span class="bold theme-font">Alamat *</span></label>

                        <div class="input-group">
                                            <span class="input-group-addon">
																<i class="fa fa-home"></i>
																</span>
                            <input class="form-control" type="text"
                                   placeholder="Alamat Tinggal" value="<?php echo $members['alamat']; ?>"
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
                               placeholder="Kode Pos" value="<?php echo $members['kodepos']; ?>"
                               name="kodepos">

                    </div>
                    <div class="form-group last">

                    </div>
                </div>
                <div class="form-actions">
                    <div class="btn-set pull-left">
                        <!-- END PORTLET -->
                        <input name="user_profile_uid" type="hidden" value="<?php echo $id;?>">
                        <input type="submit" value="update" name="update" class="btn btn-lg blue hidden-print margin-bottom-5" href="<?php echo base_url();?>member/edit_profile/<?php echo $members['userid'];?>">


                        <a class="btn btn-lg red hidden-print margin-bottom-5" href="<?php echo base_url();?>member/detail/<?php echo $members['userid'];?>">
                            Cancel <i class="fa fa-undo"></i>
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
