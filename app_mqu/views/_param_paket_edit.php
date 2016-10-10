<div>

    <?php echo form_open(base_url()."parameter/paket_update/$members->paketid")?>
    <span><?php echo validation_errors() ?></span>

    <div>
        <div>Nama Paket</div>

        <div>
            <?php echo form_input('nama_paket',$members->nama_paket,'class="form-control input-large"'); ?>
        </div>
    </div>
    <div>
        <div>Detail Paket</div>
        <script src="<?php echo base_url()?>js/tinymce/tinymce.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            tinymce.init({
                selector: "textarea",
                theme: "modern",
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "template paste textcolor colorpicker textpattern imagetools"
                ],
                toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                toolbar2: "print preview media | forecolor backcolor",
                image_advtab: true,
                templates: [
                    {title: 'Test template 1', content: 'Test 1'},
                    {title: 'Test template 2', content: 'Test 2'}
                ]
            });

        </script>
        <div>
            <?php echo form_textarea('content',$members->detail,'class="form-control"'); ?>
        </div>
    </div>
    <div>
        <div style="padding-top: 5px;">Harga per ekor</div>
        <div>
            <?php echo form_input('harga',$members->harga,'class="form-control input-small"'); ?>
        </div>
    </div>
    <div>
        <div style="padding-top: 5px;">Harga Group per orang</div>
        <div>
            <?php echo form_input('harga_group',$members->harga_group,'class="form-control input-small"'); ?>
        </div>
    </div>
    <div>
        <div style="padding-top: 5px;">Harga Pokok Pembelian</div>
        <div>
            <?php echo form_input('hpp',$members->hpp,'class="form-control input-small"'); ?>
        </div>
    </div>
    <div>
        <div style="padding-top: 5px;">Jenis Sapi</div>
        <div>
            <?php
            $options = array();
            foreach($jenis_hewans as $jenis_hewan){
                $options[$jenis_hewan['nama_hewan']] = $jenis_hewan['nama_hewan'];
            }
            echo form_dropdown('jenis_sapi',$options,$members->jenis_sapi,'class="form-control input-small"');
            ?>
        </div>
    </div>
    <div>
        <div style="padding-top: 5px;">Range Berat (kg)</div>
        <div>
            <?php
            $options = array();
            foreach($ranges as $range){
                $options[$range['berat']] = $range['berat'];
            }
            echo form_dropdown('range_berat',$options,$members->range_berat,'class="form-control input-small"');
            ?>
        </div>
    </div>
    <div>
        <div style="padding-top: 5px;">Status</div>
        <div>
           <?php $options = array(
                '1'  => 'Aktif',
                '0'  => 'Non Aktif',
            );

            echo form_dropdown('status',$options,$members->status,'class="form-control input-small"');
           ?>
        </div>
    </div>


    <div style="padding-top: 10px;"><?php echo form_submit('submit', 'Rubah','class="btn btn-small red hidden-print margin-bottom-5"'); ?> </div>

</div>
<?php echo form_close()?>


