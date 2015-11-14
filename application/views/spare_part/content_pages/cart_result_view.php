
<div class="price-box white">                               
    <table class="table table-bordered table-striped">
        <tr>
            <td>Qty</td>
            <td>Item</td>
            <td>Price</td>
        </tr>
        <tbody>
            <?php
            $total = 0;
            foreach ($items as $value) {
                $total += ($value->spare_price * $value->qty);
                ?>

                <tr>
                    <td><?php echo $value->qty; ?></td>
                    <td class="itemName"><?php echo $value->spare_name; ?></td>
                    <td class="price">
                        <?php echo ' Rs.' . number_format(($value->spare_price * $value->qty), 2); ?>
                        <a class="pull-right" title="Remove Item" onclick="delete_cart_item(<?php echo $value->id; ?>)" href="#">
                            <i class="fa fa-trash-o" style="color: red;"></i>
                        </a>
                    </td>
                </tr>

            <?php } ?>
            <tr>
                <td colspan="2">Total </td>
                <td ><?php echo ' Rs.' . number_format($total, 2); ?></td>
            </tr>
        </tbody>
    </table>
</div>