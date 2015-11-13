<!DOCTYPE html>
<html lang="en">
    <head>
        <title>AutoVille</title>
        <link href="<?php echo base_url(); ?>application_resources/assets/fonts/font-awesome.css" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url(); ?>application_resources/assets/bootstrap/css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>application_resources/assets/css/style.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>application_resources/assets/css/colors/blue.css" type="text/css">

    </head>
    <body id="page-top" class="page-subpage page-404 navigation-off-canvas page-fade-in" onunload="">
        <div id="outer-wrapper">
            <div id="inner-wrapper">
                <div class="header">
                    <div class="wrapper">
                        <div class="brand">
                            <a class="lazy" href="<?php echo site_url(); ?>/home"><img src="<?php echo base_url(); ?>application_resources/assets/img/logo.png" alt="logo"></a>
                        </div>
                    </div>
                </div>
                <!-- end Navigation-->
                <div id="page-canvas">
                    <div id="page-content">
                        <section class="container">
                            <header>
                                <h1 class="page-title">Error</h1>
                            </header>
                            <div class="block">
                                <div id="title-404">
                                    <aside>
                                        Error
                                        <img alt="" src="<?php echo base_url(); ?>application_resources/assets/img/scissors.png">
                                    </aside>
                                    <h2>A PHP Error was encountered</h2>
                                    <p>Severity: <?php echo $severity; ?></p>
                                    <p>Message:  <?php echo $message; ?></p>
                                    <p>Filename: <?php echo $filepath; ?></p>
                                    <p>Line Number: <?php echo $line; ?></p>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
