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
                            <a id="editable-sample_new" class="btn btn-shadow btn-primary" href="<?php echo site_url(); ?>/subscribe/add_newsletter_view/0" data-toggle="modal">
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
                                        <?php if ($result->status == '1') { ?>
                                            sent
                                        <?php } else { ?>
                                            saved
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $result->added_date; ?></td>

                                    <td align="center">
                                        <?php if ($result->status == '0') { ?>
                                            <a class="btn btn-info btn-xs" onclick="send_email(<?php echo $result->id; ?>)"><i class="fa fa-envelope"  title="Send"></i></a>
                                        <?php } ?>
                                        <a class="btn btn-primary btn-xs" href="<?php echo site_url(); ?>/subscribe/add_newsletter_view/<?php echo $result->id; ?>"><i class="fa fa-pencil"  title="Update"></i></a>
                                        <a class="btn btn-danger btn-xs" onclick="delete_newsletter(<?php echo $result->id; ?>)"><i class="fa fa-trash-o " title="" title="Remove"></i></a>

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



                                            //send newsletter
                                            function send_email(id) {

                                                if (confirm('Are you sure want to send this Newsletter ?')) {

                                                    $.ajax({
                                                        type: "POST",
                                                        url: site_url + '/subscribe/send_newsletter_again',
                                                        data: "id=" + id,
                                                        success: function (msg) {
                                                            if (msg == 1) {
                                                                $('#newsletter_' + id).hide();
                                                                toastr.success("Successfully deleted !!", "AutoVille");
                                                            }
                                                            else if (msg == 2) {
                                                                toastr.error("Cannot be deleted as it is already assigned to others. !!", "AutoVille");
                                                            }
                                                        }
                                                    });
                                                }
                                            }
                                            
                                            //delete newsletter
                                            function delete_newsletter(id) {

                                                if (confirm('Are you sure want to delete this Newsletter ?')) {

                                                    $.ajax({
                                                        type: "POST",
                                                        url: site_url + '/subscribe/delete_newsletter',
                                                        data: "id=" + id,
                                                        success: function (msg) {
                                                            if (msg == 1) {
                                                                $('#newsletter_' + id).hide();
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
