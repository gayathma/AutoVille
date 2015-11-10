
<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                Manage Subscribers
                <span class="tools pull-right">
                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                    <a href="javascript:;" class="fa fa-times"></a>
                </span>
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="subscribers_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Email</th>
                                <th>Registered Date</th>
                                <th>Active Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($results as $result) {
                                ?>
                                <tr id="transmission_<?php echo $result->id; ?>">
                                    <td><?php echo ++$i; ?></td>
                                    <td><?php echo $result->email; ?></td>
                                    <td><?php echo $result->added_date; ?></td>
                                    <td align="center">
                                        <?php if ($result->status == '1') { ?>
                                            <a class="btn btn-success btn-xs" >Subscribed</a>
                                        <?php } else { ?>
                                            <a class="btn btn-warning btn-xs" >Unsubscribed</a>
                                        <?php } ?>
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

        $('#subscribers_table').dataTable();

    });
</script>
