
<section class="container equal-height">
    <header>
        <h1 class="page-title">Pricing</h1>
    </header>
    <div class="row">

        <div class="col-md-3 col-sm-3">
            <div class="price-box white">                               

                <ul>
                    <li class="row list-inline columnCaptions">
                        <span>No</span>
                        <span>ITEM</span>
                        <span>Price</span>
                    </li>
                    <?php
                    $i = 0;
                    foreach ($items as $value) {
                        ?>

                        <li class="row">
                            <span><?php echo ++$i; ?></span>
                            <span class="itemName"><?php echo $value->spare_name; ?></span>
                            <span class="popbtn"><a class="arrow"></a></span>
                            <span class="price"><?php echo $value->spare_price; ?></span>
                        </li>

                    <?php } ?>


                </ul>

            </div>

        </div>

    </div>

</section>