<div class="items-list">
    <div class="inner">
        <header>
            <h3>All Categories</h3>
        </header>
        <ul class="results list">
            <?php foreach ($categories as $category) { ?>
                <li>
                    <div class="item">
                        <a class="image" href="<?php echo site_url() ?>/spare_parts/category/load_category_items/<?php echo $category->id; ?>">
                            <div class="inner">
                                <?php if (!empty($category->image)) { ?>
                                    <img  alt="" src="<?php echo base_url() . 'uploads/spare_part_category/' . $category->image; ?>">
                                <?php } ?>
                            </div>
                        </a>
                        <div class="wrapper">
                            <a  href="<?php echo site_url() ?>/spare_parts/category/load_category_items/<?php echo $category->id; ?>">
                                <h3><?php echo $category->name; ?></h3>
                            </a>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
    <!--results-->
</div>