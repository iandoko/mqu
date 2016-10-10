<div class="row">
    <div class="col-md-12">

        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">

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
                            Parameter
                        </th>
                        <th>
                            Data
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($datas as $data): ?>

                        <tr>
                            <td>
                                <?php echo $data['nama_parameter'];?>
                            </td>
                            <td>
                                <?php echo $data['value'];?>
                            </td>

                            <td>
                                <?php echo anchor(base_url().'parameter/edit/'. $data['idparameter'],'Edit',array('class' => "label label-sm label-info"));?>

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