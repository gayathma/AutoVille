<div class="one-half col-241 search-area">
    <div class="small-12 large-3 columns loan-calculator" data-layer-category="loan-calculator">
        <legend><span class="bold">Loan</span> calculator</legend>
        <div class="payload">
            <div class="row options">
                <div class="form-group">
                    <label>Down Payment</label>
                    <!--<div class="range-slider" id="price-slider" data-value-min="0" data-value-max="100000000"  data-step="10">data-currency="$" data-currency-placement="before" data-value-type="price"-->
                        <div class="values clearfix">
                            <!--<input class="value-min" id="minprice" name="minprice" readonly>-->
                            <!--<input class="value-max" id="maxprice" name="maxprice" readonly>-->
                            <input type="range" id="val1" min="0" max="100"><br>
                        </div>

                        <div class="element"></div>
                    <!--</div>-->
                </div>
                <br>
                <div class="form-group">
                    <label>Loan Term (Months)</label>
                    <!--<div class="ui-slider" id="month-slider" data-value-min="12" data-value-max="120"  data-step="10">data-currency="$" data-currency-placement="before" data-value-type="price"-->
                        <div class="values clearfix">
<!--                            <input class="value-min" id="minmonth" name="minmonth" readonly>
                            <input class="value-max" id="maxmonth" name="maxmonth" readonly>-->
                            <input type="range" id="val2" min="0" max="100"><br>
                        </div>
                        <div class="element"></div>
                    <!--</div>-->
                </div>
                <br>
                <div class="form-group">
                    <label>Interest Rate %</label>
                    <!--<div class="ui-slider" id="rate-slider" data-value-min="0" data-value-max="100"  data-step="10">data-currency="$" data-currency-placement="before" data-value-type="price"-->
                        <div class="values clearfix">
<!--                            <input class="value-min" id="minrate" name="minrate" readonly>
                            <input class="value-max" id="maxrate" name="maxrate" readonly>-->
                            <input type="range" id="val3" min="0" max="100"><br>
                        </div>
                        <div class="element"></div>
                    <!--</div>-->
                </div>
            </div>
        </div>
        <br>
        <div class="details">
            <div class="row">
                <!--<div class="medium-8 large-8 column" data-bank-period="1">-->
                <div class="car-value ">
                    <label>Car Value: </label>
                    <output> Rs.  <?php echo number_format($vehicle_detail->price, 2, '.', ','); ?></output>
                   
                </div>
            </div>
            <div class="row">
                <br>


                <label>Monthly Installment:</label>
                <div class="output" >
                    <!--<label> Rs</label>-->
                    <output id="monthly-payment"></output>
                     <!--<input type="text" id="val4" /><br>-->
                </div>
                <div class="medium-1 large-1 columns">
                    <i class="icon-info-circled" data-selector="monthly-instalment-tooltip" data-tooltip="" aria-haspopup="true" title=""></i>
                </div>

            </div>
            <br>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function(){
    var interestRate = 0.01;
    $("#val1 , #val2,#val3").mousemove(function(){
        $("#monthly-payment").val( 
            (parseInt($("#val1").val()) + parseInt($("#val2").val() )
             * interestRate ) 
        );
     });
});
//    $(document).ready(function () {
//
//        $('#price-slider').on('change', function () {
//            var maxprice = 100000000;
//            var carPrice = <?php echo $vehicle_detail->price; ?>;
//
////        var maxmonth = $('#maxmonth').val();
////        var maxrate = $('#maxrate').val();
////            console.log(carPrice);
//
//        });
//    });
//
//    function changeValue() {
//
//        console.log("Entered");
//        var installment = (carPrice - $("#price-slider").slider(".value"));
////                    + (($vehicle_detail - > price) * maxrate) / 100.0;
//        $("#monthly-payment").val(installment);
//    }
//
//    $("#price-slider").slider({
////                value: 100,
////                min: 0,
////                max: 500,
////                step: 50,
//        slide: function (event, ui) {
//            maxprice = $("#price-slider").slider(".value");
//            changeValue();
//            console.log(maxprice);
//        }
//    });
</script>

