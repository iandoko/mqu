<div class="row margin-top-10">
    <div class="col-md-12">
        <?php echo form_open_multipart(base_url()."member/edit_profile/".$id)?>
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PORTLET -->
                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption caption-md">
                                <i class="icon-bar-chart theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Profile Data Update</span>

                            </div>

                        </div>
                        <?php
                        $notifi = $this->session->flashdata('notification' );
                        if(isset($notifi)) { $display = ''; } else { $display = ' display-hide';}?>
                        <div class="alert alert-danger<?php echo $display;?>">
                            <button class="close" data-close="alert"></button>
                            <span><?php echo $this->session->flashdata('notification'); ?></span>
                        </div>
                        <div class="portlet-body">

                            <div class="table-scrollable table-scrollable-borderless">
                                <table class="table table-hover table-light">

                                    <tbody><tr>
                                       <td>
                                           <span class="bold theme-font">Nama</span>
                                        </td>
                                        <td colspan="1">
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <input class="form-control input-large" type="text" placeholder="Nama Lengkap" value="<?php echo $members['nama_lengkap'];?>" name="nama_lengkap">
								                </div>
                                            </div>

                                        </td>
                                        <td rowspan="3" colspan="2">
                                            <div class="profile-userpic">
                                                <div class="col-md-4">
                                                <?php if($members['pas_foto']) {?>
                                                    <img class="img-responsive" alt="" src="<?php echo base_url().'images/profile/'.$members['pas_foto'];?>" width="80">
                                                <?php } else {?>
                                                    <img class="img-responsive" alt="" src="<?php echo base_url();?>images/profile/no-images.png" width="80">
                                                <?php }?>
                                                    </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <div class="row fileupload-buttonbar">
                                                            <span class="btn green fileinput-button"><i class="fa fa-plus"></i>
                                                                <span>Ganti Photo... </span>
                                                                <input name="pas_foto" type="file" accept="image/*" onchange="loadFile(event)">
                                                            </span>
                                                        <div class="col-md-4">
                                                        <img id="output"  width="80" style="padding-top:10px;"/>
                                                        <script>
                                                            var loadFile = function(event) {
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
                                                    <input class="form-control input-large" type="text" placeholder="Nomor KTP" value="<?php echo $members['nomor_ktp'];?>" name="nomor_ktp">
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
<tr></tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Tempat Lahir</span>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <input class="form-control input-small" type="text" placeholder="Tempat Lahir" value="<?php echo $members['tempat_lahir'];?>" name="tempat_lahir">
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <span class="bold theme-font">Tgl. Lahir</span>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <div class="col-md-3">
                                                    <input class="form-control form-control-inline input-small date-picker" type="text" placeholder="dd-mm-yyyy" size="16" value="<?php echo date('d-m-Y',strtotime($members['tanggal_lahir']));?>" name="tanggal_lahir">
										        </div>
                                            </div>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Alamat</span>
                                        </td>
                                        <td colspan="3">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <input class="form-control input-xxlarge"  type="text" placeholder="Alamat" value="<?php echo $members['alamat'];?>" name="alamat">
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
                                                    <input class="form-control input-small" type="text" placeholder="Nomer Rumah" value="<?php echo $members['no'];?>" name="no">
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            <span class="bold theme-font">RT</span>
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <input class="form-control input-small" type="text" placeholder="RT" value="<?php echo $members['rt'];?>" name="rt">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="bold theme-font">RW</span>
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <input class="form-control input-small" type="text" placeholder="RW" value="<?php echo $members['rw'];?>" name="rw">
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
                                                    <input class="form-control input-medium" type="text" placeholder="Kode Pos" value="<?php echo $members['kodepos'];?>" name="kodepos">
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">No. Handphone</span>
                                        </td>
                                        <td colspan="3">
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <input class="form-control input-large" type="text" placeholder="Nomer Handphone" value="<?php echo $members['no_handphone'];?>" name="no_handphone">
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
                    <input name="user_profile_uid" type="hidden" value="<?php echo $id;?>">
                   <input type="submit" value="update" name="update" class="btn btn-lg blue hidden-print margin-bottom-5" href="<?php echo base_url();?>member/edit_profile/<?php echo $members['userid'];?>">


                    <a class="btn btn-lg red hidden-print margin-bottom-5" href="<?php echo base_url();?>member/detail/<?php echo $members['userid'];?>">
                        Cancel <i class="fa fa-undo"></i>
                    </a>
                </div>

            </div>

        </div>
        <!-- END PROFILE CONTENT -->
        <?php echo form_close()?>
    </div>
</div>
