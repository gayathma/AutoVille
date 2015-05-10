<link rel="stylesheet" href="<?php echo base_url(); ?>application_resources/blue/css/main.css">
<!--<link rel="stylesheet" href="<?php echo base_url(); ?>application_resources/blue/css/uniform.default.css">-->
<!--<link rel="stylesheet" href="<?php echo base_url(); ?>application_resources/blue/css/prettyPhoto.css">-->

<div id="page-content">

    <section id="search-list" class="container">
        <div class="content-holder">
            <div class="full-width">

                <div class="one-half col-241 search-area">
                    <form id="search-filters"  method="post">
                        <!--Search Filter-->
                        <fieldset class="grey-corner-box">
                            <legend><span class="bold">Search</span> filters</legend>
                            <ul>
                                <li>
                                    <div class="form-group">
                                        <label for="manufacturer">Manufacturer</label>
                                        <select name="manufacturer" id="manufacturer" title="Manufacturer" data-live-search="true">
                                            <option value="">Select Manufacturer</option>
                                            <?php foreach ($manufactures as $manufacture) { ?>
                                                <option value="<?php echo $manufacture->id; ?>"><?php echo $manufacture->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        <label for="model">Model</label>
                                        <div id="model_wrapper">
                                            <select name="model" id="model" data-live-search="true" disabled="true">
                                                <option value="">Select Model</option>

                                            </select>
                                        </div>
                                    </div> 
                                </li>                                
                                <li>
                                    <div class="form-group">
                                        <label for="body_type">Body Type</label>
                                        <select name="body_type" id="body_type" title="Body Type" data-live-search="true">
                                            <option value="">Select Body Type</option>
                                            <?php foreach ($body_types as $body_type) { ?>
                                                <option value="<?php echo $body_type->id; ?>"><?php echo $body_type->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>          
                                </li>
                                <li>
                                    <div class="form-group">
                                        <label>Year</label>
                                        <div class="ui-slider" id="year-slider" data-value-min="1920" data-value-max="2015" data-step="1">
                                            <div class="values clearfix">
                                                <input class="value-min" id="minyear" name="minyear" readonly>
                                                <input class="value-max" id="maxyear" name="maxyear" readonly>
                                            </div>
                                            <div class="element"></div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        <label for="fuel">Fuel</label>
                                        <select name="fuel_type" id="fuel_type" title="Fuel" data-live-search="true">
                                            <option value="">Select Fuel Type</option>
                                            <?php foreach ($fuel_types as $fuel_type) { ?>
                                                <option value="<?php echo $fuel_type->id; ?>"><?php echo $fuel_type->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        <label for="sale_type">Sale Type</label>
                                        <select name="sale_type" id="sale_type" title="Sale Type" data-live-search="true">
                                            <option value="">Select Sale Type</option>
                                            <option value="New">New</option>
                                            <option value="Used">Used</option>
                                            <option value="Reconditioned">Reconditioned</option>
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        <label for="color">Color</label>
                                        <select name="color" id="color" title="Color" data-live-search="true">
                                            <option value="">Select Color</option>
                                            <option value="Blue">Blue</option>
                                            <option value="Yellow">Yellow</option>
                                            <option value="Purple">Purple</option>
                                            <option value="Pink">Pink</option>
                                            <option value="Red">Red</option>
                                            <option value="Green">Green</option>
                                            <option value="White">White</option>
                                            <option value="Black">Black</option>
                                            <option value="Silver">Silver</option>
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        <label>Price Rs.</label>
                                        <div class="ui-slider" id="price-slider" data-value-min="100000" data-value-max="100000000"  data-step="10"><!--data-currency="$" data-currency-placement="before" data-value-type="price"-->
                                            <div class="values clearfix">
                                                <input class="value-min" id="minprice" name="minprice" readonly>
                                                <input class="value-max" id="maxprice" name="maxprice" readonly>
                                            </div>
                                            <div class="element"></div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        <label for="transmission">Transmission</label>
                                        <select name="transmission" id="transmission" title="Transmission" data-live-search="true">
                                            <option value="">Select Transmission</option>
                                            <?php foreach ($transmissions as $transmission) { ?>
                                                <option value="<?php echo $transmission->id; ?>"><?php echo $transmission->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        <label for="kilometers">Kilometers</label>                                                
                                        <input type="text" class="form-control" id="kilometers" name="kilometers" placeholder="Enter Kilometers">
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <select name="location" id="location" title="Location" data-live-search="true">                            
                                            <?php foreach ($locations as $location) { ?>
                                                <option value="<?php echo $location->id; ?>"><?php echo $location->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group">
                                        <label for="keyword">Keyword</label>
                                        <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Enter Keyword">
                                    </div>  
                                </li>
                                <li>
                                    <!-- add this to general styles -->
                                    <div class="form-group">
                                        <button type="button" class="btn btn-default" onclick="search_vehicle()"><i class="fa fa-search"></i></button>
                                    </div>
                                </li>
                            </ul>
                        </fieldset>
                        <!--End Search Filter-->

                        <!--                        <fieldset id="loan-calculator" class="grey-corner-box">
                                                    <legend><span class="bold">Loan calculator</span> </legend>-->
                        <!--                            <ul>
                                                        <li>
                                                            <label for="loan-amount">Loan Amount:</label>
                                                            <select id="loan-amount">
                                                                <option value="0" selected="selected">0.00 Euro</option>
                                                                <option value="1000">1000.00 Euro</option>
                                                                <option value="5000">5000.00 Euro</option>
                                                                <option value="10000">10000.00 Euro</option>
                                                            </select>							
                                                        </li>
                                                        <li>
                                                            <label for="down-payment">Down Payment:</label>
                                                            <select id="down-payment">
                                                                <option value="0" selected="selected">0.00 Euro</option>
                                                                <option value="1000">1000.00 Euro</option>
                                                                <option value="5000">5000.00 Euro</option>
                                                                <option value="10000">10000.00 Euro</option>
                                                            </select>							
                                                        </li>
                                                        <li>
                                                            <label for="annual-rate">Annual Rate:</label>
                                                            <select id="annual-rate">
                                                                <option value="0" selected="selected">0.00 %</option>
                                                                <option value="0.1">10.00 %</option>
                                                                <option value="0.2">20.00 %</option>
                                                                <option value="0.3">30.00 %</option>
                                                            </select>							
                                                        </li>
                                                        <li>
                                                            <label for="loan-period">Loan Period:</label>
                                                            <select id="loan-period">
                                                                <option value="3" selected="selected">3 Years</option>
                                                                <option value="1">1 Year</option>
                                                                <option value="2">2 Years</option>
                                                                <option value="3">4 Years</option>
                                                            </select>
                                                        </li>
                                                        <li>
                                                            <div class="submit-button"><input type="submit" value="calculate" /></div>
                                                        </li>
                                                        <li class="rate-value">
                                                            <p>Rate value: <span class="amount-value">0,00</span></p>
                                                        </li>
                                                    </ul>							-->
<!--                        <div class="small-12 large-3 columns loan-calculator" data-layer-category="loan-calculator">
                            <h3>Loan Calculator</h3>
                            <div class="payload">
                                <div class="row options">
                                    <div class="form-group">
                                        <label>Down Payment</label>
                                        <div class="ui-slider" id="price-slider" data-value-min="0" data-value-max="100000000"  data-step="10">data-currency="$" data-currency-placement="before" data-value-type="price"
                                            <div class="values clearfix">
                                                <input class="value-min" id="minprice" name="minprice" readonly>
                                                <input class="value-max" id="maxprice" name="maxprice" readonly>
                                            </div>
                                            
                                            <div class="element"></div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label>Loan Term (Months)</label>
                                        <div class="ui-slider" id="price-slider" data-value-min="12" data-value-max="120"  data-step="10">data-currency="$" data-currency-placement="before" data-value-type="price"
                                            <div class="values clearfix">
                                                <input class="value-min" id="minprice" name="minprice" readonly>
                                                <input class="value-max" id="maxprice" name="maxprice" readonly>
                                            </div>
                                            <div class="element"></div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label>Interest Rate %</label>
                                        <div class="ui-slider" id="price-slider" data-value-min="0" data-value-max="100"  data-step="10">data-currency="$" data-currency-placement="before" data-value-type="price"
                                            <div class="values clearfix">
                                                <input class="value-min" id="minprice" name="minprice" readonly>
                                                <input class="value-max" id="maxprice" name="maxprice" readonly>
                                            </div>
                                            <div class="element"></div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="details">
                                <div class="row">
                                    <div class="medium-8 large-8 column" data-bank-period="1">
                                        <div class="car-value column">
                                            <label>Car Value:</label>
                                            <output>Rs. 119,900</output>
                                        </div>
                                        <br>
                                        <div class="monthly-instalment column">
                                            <label>Monthly Installment:</label>
                                            <div class="output">
                                                <label> Rs</label>
                                                <output id="monthly-payment">Rs. 5,524.79</output>
                                            </div>
                                            <div class="medium-1 large-1 columns">
                                                <i class="icon-info-circled" data-selector="monthly-instalment-tooltip" data-tooltip="" aria-haspopup="true" title=""></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>-->

                <!--</fieldset>-->
                </form>
            </div>
                
                

            <div class="results-list one-half col-701" id="search_result">

                <?php echo $this->load->view('vehicle_adds/search_result'); ?>

            </div>


        </div>
</div>
</section><!--#search-list-->

</div><!--#page-content-->

<script type="text/javascript">


    $('#manufacturer').on('change', function (e) {

        var manufacturer = $(this).val();

        $.post(site_url + '/vehicle_advertisements/get_models_for_manufacturer', {manufacturer: manufacturer}, function (msg)
        {
            $('#model_wrapper').html(msg);
        });
    });

    function search_vehicle() {

        var manufacturer = $('#manufacturer').val();
        var model = $('#model').val();
        var body_type = $('#body_type').val();
        var maxyear = $('#maxyear').val();
        var minyear = $('#minyear').val();
        var fuel_type = $('#fuel_type').val();
        var sale_type = $('#sale_type').val();
        var color = $('#color').val();
        var maxprice = $('#maxprice').val();
        var minprice = $('#minprice').val();
        var transmission = $('#transmission').val();
        var kilometers = $('#kilometers').val();
        var location = $('#location').val();
        var keyword = $('#keyword').val();
        var view_no = 1;

        $.ajax({
            type: "POST",
            url: site_url + '/vehicle_search/search_advertisements',
            data: "manufacturer=" + manufacturer + "&model=" + model + "&body_type=" + body_type + "&maxyear=" + maxyear +
                    "&minyear=" + minyear + "&fuel_type=" + fuel_type + "&sale_type=" + sale_type + "&color=" + color +
                    "&maxprice=" + maxprice + "&minprice=" + minprice + "&transmission=" + transmission +
                    "&kilometers=" + kilometers + "&location=" + location + "&keyword=" + keyword + "&view_no=" + view_no,
            success: function (msg) {
                $('#search_result').html(msg);
            }
        });
    }
    
    
</script>