<div class="container">
    <header>
        <h2>Subscribe</h2>
    </header>
    <form class="subscribe form-inline border-less-inputs" role="form" method="post" id="subscribe_form" name="subscribe_form">
        <div class="input-group">
            <input id="subscribe_email" name="subscribe_email" class="form-control" type="email" placeholder="Enter your email and get the newest updates">
            <span class="input-group-btn">
                <button class="btn btn-default btn-large" type="submit">
                    Subscribe
                    <i class="fa fa-angle-right"></i>
                </button>
            </span>
        </div>
    </form>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>application_resources/assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#subscribe_form").validate({
            rules: {
                subscribe_email:{
                    required:true,
                    email: true
                }
            }, submitHandler: function(form)
            {
                $.post(site_url + '/home/subscribe', $('#subscribe_form').serialize(), function(msg)
                {                  
                    if (msg == 1) {
                        toastr.success("Subscription successful !!", "AutoVille");
                    }else if(msg == 0){
                        toastr.error("You already subscribed to the newsletter !!", "AutoVille");
                    }
                });

            }
        });

    });
</script>