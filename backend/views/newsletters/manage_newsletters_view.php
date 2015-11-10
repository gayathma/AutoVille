<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                Manage Newsletters
                <span class="tools pull-right">
                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                    <a href="javascript:;" class="fa fa-times"></a>
                </span>
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <div class="clearfix">
                        <div class="btn-group">
                            <a id="editable-sample_new" class="btn btn-shadow btn-primary" href="<?php echo site_url(); ?>/subscribe/add_newsletter_view" data-toggle="modal">
                                Send New Newsletter
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <table  class="display table table-bordered table-striped" id="newsletter_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Added Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($results as $result) {
                                ?>
                                <tr id="newsletter_<?php echo $result->id; ?>">
                                    <td><?php echo ++$i; ?></td>
                                    <td><?php echo $result->subject; ?></td>
                                    <td>
                                        <?php if($result->status == '1'){ ?>
                                            sent
                                        <?php }else{ ?>
                                            failed
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $result->added_date; ?></td>

                                    <td align="center">
                                        <a class="btn btn-primary btn-xs" onclick="display_edit_transmission_pop_up(<?php echo $result->id; ?>)"><i class="fa fa-pencil"  title="Update"></i></a>
                                        <a class="btn btn-danger btn-xs" onclick="delete_transmission(<?php echo $result->id; ?>)"><i class="fa fa-trash-o " title="" title="Remove"></i></a>

                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>

                    </table>
                </div>
            </div>
        </section>
    </div>
</div>



<!-- active selected menu -->
<!--toastr-->
<script src="<?php echo base_url(); ?>backend_resources/assets/toastr-master/toastr.js"></script>
<script type="text/javascript">
                                            $('#campaign_menu').addClass('active');

                                            $(document).ready(function () {
                                                $('#newsletter_table').dataTable();
                                            });



                                            //delete newsletter
                                            function delete_transmission(id) {

                                                if (confirm('Are you sure want to delete this Transmission ?')) {

                                                    $.ajax({
                                                        type: "POST",
                                                        url: site_url + '/transmission/delete_transmissions',
                                                        data: "id=" + id,
                                                        success: function (msg) {
                                                            //alert(msg);
                                                            if (msg == 1) {
                                                                //document.getElementById(trid).style.display='none';
                                                                $('#transmission_' + id).hide();
                                                                toastr.success("Successfully deleted !!", "AutoVille");
                                                            }
                                                            else if (msg == 2) {
                                                                toastr.error("Cannot be deleted as it is already assigned to others. !!", "AutoVille");
                                                            }
                                                        }
                                                    });
                                                }
                                            }


</script>
