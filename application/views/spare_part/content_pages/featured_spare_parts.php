<div class="row">
    <?php foreach ($featured_spare_parts as $value) { ?>
        <div class="col-md-3 col-sm-3">
            <div class="item featured">
                <div class="image">
                    <div class="quick-view" id="1"><i class="fa fa-eye"></i><span>Quick View</span></div>
                    <a href="<?php echo site_url() ?>/spare_parts/spare_parts_advertisements/spare_part_advertisement_detail_view/<?php echo $value->id; ?>">
                        
                        <div class="overlay">
                            <div class="inner">
                                <div class="content">
                                    <h4>Description</h4>
                                    <p><?php echo $value->description; ?></p>                                   
                                </div>
                            </div>
                        </div>
                        <div class="item-specific">                            
                        </div>
                        <div class="icon">
                            <i class="fa fa-thumbs-up"></i>
                        </div>
                        <img src="<?php echo base_url() . 'uploads/spare_part_images/' . $value->image; ?>" height="180" width="260" alt=""/>                        
                    </a>
                </div>
                <div class="wrapper">
                    <a href="#"<h3><?php echo $value->name; ?> </h3></h3></a>
                    <figure><?php echo $value->category; ?></figure>
                    <div class="price"><?php echo "Rs. " . CurrencyFormat($value->price); ?></div>
                    <br>

                    <?php if ($value->is_featured == '1') { ?>
                        <div class="type label-success label">
                            <span>Featured</span>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!-- /.item-->
        </div> 
    <?php } ?>
</div>

<?php
function CurrencyFormat($number) {
    $decimalplaces = 2;
    $decimalcharacter = '.';
    $thousandseparater = ',';
    return number_format($number, $decimalplaces, $decimalcharacter, $thousandseparater);
}
?>