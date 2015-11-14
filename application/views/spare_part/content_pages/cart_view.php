
<section class="container equal-height">
    <header>
        <h1 class="page-title">Pricing</h1>
    </header>
    <div class="row" >
        <div class="col-md-6">
            <div class="price-box white">                               
                <header>
                    <h2>Your shopping cart</h2>
                </header>
                <figure><i class="fa fa-shopping-cart fa-5x" style="color: #36b6ff"></i></figure>
            </div>
        </div>

        <div class="col-md-6 detail-sidebar" >
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

        </div>

    </div>

</section>

<script>
                                        //delete items from the cart
                                        function delete_cart_item(id) {
                                            $.ajax({
                                                type: "POST",
                                                url: site_url + '/spare_parts/cart/delete_cart_items',
                                                data: "id=" + id,
                                                success: function(msg) {
                                                    if (msg != 0) {
                                                        $('.detail-sidebar').html(msg);
                                                        var cart_val = $('#cart_span').html();
                                                        if (parseInt(cart_val) <= 0) {
                                                            $('#cart_span').removeClass('items-added');
                                                            cart_val = parseInt(cart_val) - 1;
                                                            $('#cart_span').html("");
                                                            $('#cart_span').html(cart_val);
                                                        } else {
                                                            cart_val = parseInt(cart_val) - 1;
                                                            $('#cart_span').html("");
                                                            $('#cart_span').html(cart_val);
                                                        }
                                                        toastr.success("Successfully item removed from the cart!!", "AutoVille");
                                                    } else {
                                                        toastr.error("Error Occured !!", "AutoVille");
                                                    }
                                                }
                                            });

                                        }
</script>