<table class="table table-hover p-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>                    
                    <th>Category</th>
                    <th>Vehicle</th>
                    <th>Active Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result) { ?>
                    <tr id="advertisement_<?php echo $result->id; ?>">                        
                        <td class="p-team">
                            <?php echo $result->name; ?>
                        </td>
                        <td class="p-team">
                            <?php echo $result->image; ?>
                        </td>
                        <td class="p-team">
                            <?php echo $result->price; ?>
                        </td>
                        <td class="p-team">
                            <?php echo $result->category_id; ?>
                        </td>
                        <td class="p-team">
                            <?php echo $result->manufacture_id; ?>
                        </td>
                        <td>
                            <?php if ($result->is_published == '1') { ?>
                                <span class="label label-primary">Active</span>
                                <a class="btn btn-success btn-xs"  onclick="change_advertisement_status(<?php echo $result->id; ?>, 2, this);"><i class="fa fa-arrow-up " title="Reject Advertisement"></i></a> 
                            <?php } elseif ($result->is_published == '0') { ?>
                                <span class="label label-default">Pending</span> 
                                <a class="btn btn-success btn-xs"  onclick="change_advertisement_status(<?php echo $result->id; ?>, 1, this);"><i class="fa fa-arrow-up " title="Approve Advertisement"></i></a> 
                            <?php } else { ?>
                                <span class="label label-danger">Rejected</span>  
                            <?php } ?>


                        </td>
                        <td>
                            <a class="btn btn-danger btn-xs"  onclick="delete_advertisement(<?php echo $result->id; ?>);"><i class="fa fa-trash-o " title="Remove"></i></a>
                            <a href="project_details.html" class="btn btn-info btn-xs"><i class="fa fa-folder" title="View"></i></a>

                        </td>
                    </tr>

                    <?php
                }
                ?>
            </tbody>
        </table>