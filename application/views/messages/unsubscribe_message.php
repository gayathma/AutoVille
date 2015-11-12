<section class="container">
    <header>
        <h1 class="page-title">404</h1>
    </header>
    <div class="block">
        <div id="title-404">
            <aside><?php if($status == 'success'){?> :) <?php }else{?> :( <?php }?>
                <img src="<?php echo base_url(); ?>application_resources/assets/img/scissors.png" alt="">
            </aside>
            <h2>Unsubscription</h2>
            <p><?php echo $message; ?></p>
        </div>
    </div>
</section>
<!-- /.block-->