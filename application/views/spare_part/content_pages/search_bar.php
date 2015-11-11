<style>
    #spareparts_search_results{
        margin-top: 155px;
        min-height: 100px;
    }
</style>
<div class="search-bar horizontal">
    <form id="spare_parts_search_form" class="main-search border-less-inputs" role="form" method="post">
        <div class="input-row">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label>Price Rs.</label>
                <div class="ui-slider" id="price-slider" data-value-min="100" data-value-max="1000000"  data-step="10">
                    <div class="values clearfix">
                        <input class="value-min" id="minprice" name="minprice" readonly>
                        <input class="value-max" id="maxprice" name="maxprice" readonly>
                    </div>
                    <div class="element"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="manufacturer">Manufacturer</label>
                <select name="manufacturer" id="manufacturer" title="Manufacturer" data-live-search="true">
                    <option value="">Select Manufacturer</option>
                    <?php foreach ($manufactures as $manufacture) { ?>
                        <option value="<?php echo $manufacture->id; ?>"><?php echo $manufacture->name; ?></option>
                    <?php } ?>
                </select>
            </div>            
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" title="Category" data-live-search="true">
                    <option value="">Select Category</option>
                    <option value="1">test Category</option>
                </select>
            </div>
            <div class="form-group">
                <label>Keyword</label>
                <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Enter Keyword">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>           
        </div>        
    </form>    
</div>
<div id="spareparts_search_results" class="inner col-lg-12" style="padding: 30px">

</div>

<script type="text/javascript">
    $(document).ready(function() {

        $("#spare_parts_search_form").validate({
            focusInvalid: false,
            ignore: "",
            rules: {
            }, submitHandler: function(form) {

                var $form = $('#spare_parts_search_form');

                $.ajax({
                    type: "POST",
                    url: site_url + '/spare_parts/spare_parts_advertisements/search_spare_part',
                    data: $form.serialize(),
                    success: function(msg) {
                        $('#spareparts_search_results').html(msg);
                    }
                });

            }
        });
    });

</script>