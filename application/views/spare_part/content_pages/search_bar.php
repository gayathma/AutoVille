<div class="search-bar horizontal">
    <form id="spare_part_search_form" class="main-search border-less-inputs" role="form" method="post">
        <div class="input-row">
            <div class="form-group">
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
            </div>
            <div class="form-group">                
                <select name="category_id" id="category_id" title="Category" data-live-search="true">
                    <option value="">Select Category</option>

                </select>
            </div>
            <div class="form-group">                
                <div class="ui-slider" id="price-slider" data-value-min="100000" data-value-max="100000000"  data-step="10"><!--data-currency="$" data-currency-placement="before" data-value-type="price"-->
                    <div class="values clearfix">
                        <input class="value-min" id="minprice" name="minprice" readonly>
                        <input class="value-max" id="maxprice" name="maxprice" readonly>
                    </div>
                    <div class="element"></div>
                </div>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Enter Keyword">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>  
</div>


<script type="text/javascript">

    $(document).ready(function () {

        $("#spare_part_search_form").validate({            
            ignore: "",
            rules: {
                name: "required"
            }, submitHandler: function (form) {

                var $form = $('#spare_part_search_form');

                $.ajax({
                    type: "POST",
                    url: site_url + '/spare_parts/spare_parts_advertisements/search_spare_part',
                    data: $form.serialize(),
                    success: function (msg) {
                        $('#spare_part_search_result').html(msg);
                    }
                });
            }
        });

    });

</script>