
<style>

    .chat-box {
        font:normal normal 11px/1.4 Tahoma,Verdana,Sans-Serif;
        color:#333;
        width:200px; /* Chatbox width */
        border:1px solid #344150;
        border-bottom:none;
        background-color:white;
        position:fixed;
        right:10px;
        bottom:0;
        z-index:9999;
        -webkit-box-shadow:1px 1px 5px rgba(0,0,0,.2);
        -moz-box-shadow:1px 1px 5px rgba(0,0,0,.2);
        box-shadow:1px 1px 5px rgba(0,0,0,.2);
        overflow: visible!important;
    }

    .chat-box > input[type="checkbox"] {
        display:block;
        margin:0 0;
        padding:0 0;
        position:absolute;
        top:0;
        right:0;
        left:0;
        width:100%;
        height:26px;
        z-index:4;
        cursor:pointer;
        opacity:0;
        filter:alpha(opacity=0);
    }

    .chat-box > label {
        display:block;
        height:24px;
        line-height:24px;
        background-color:#344150;
        color:white;
        font-weight:bold;
        padding:0 1em 1px;
    }

    .chat-box > label:before {content:attr(data-collapsed)}

    .chat-box .chat-box-content {
        padding:10px;
        display:none;
        height:200px;
        overflow-y:scroll;
    }

    /* hover state */
    .chat-box > input[type="checkbox"]:hover + label {background-color:#404D5A}

    /* checked state */
    .chat-box > input[type="checkbox"]:checked + label {background-color:#212A35}
    .chat-box > input[type="checkbox"]:checked + label:before {content:attr(data-expanded)}
    .chat-box > input[type="checkbox"]:checked ~ .chat-box-content {display:block}

    .chatText{
        width:76%;   
    }
</style>
<script type="text/javascript" src="<?php echo base_url(); ?>application_resources/assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>application_resources/assets/js/richmarker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>application_resources/assets/js/maps.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>application_resources/assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>application_resources/assets/js/peer.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script>
    $.ajax({
        type: "POST",
        url: '<?php echo site_url(); ?>/vehicle_advertisements/add_search_history',
        data: {vehicle_id: <?php echo $vehicle_detail->id; ?>},
        success: function (msg) {

        }
    });

    $(window).load(function () {

        if ($('.owl-carousel').length > 0) {
            if ($('.carousel-full-width').length > 0) {
                setCarouselWidth();
            }
            $(".item-slider").owlCarousel({
                rtl: false,
                items: 1,
                lazyLoad: true,
                autoHeight: true,
                responsiveBaseWidth: ".slide",
                nav: false,
                callbacks: true,
                URLhashListener: true,
                navText: ["", ""]
            });

            $('.item-gallery .thumbnails a').on('click', function () {
                $('.item-gallery .thumbnails a').each(function () {
                    $(this).removeClass('active');
                });
                $(this).addClass('active');
            });
            $('.item-slider').on('translated.owl.carousel', function (event) {
                var thumbnailNumber = $('.item-slider .owl-item.active img').attr('data-hash');
                $('.item-gallery .thumbnails #thumbnail-' + thumbnailNumber).trigger('click');
            });
        }

        var latitude = <?php echo (!empty($vehicle_detail->latitude)) ? $vehicle_detail->latitude : 6.9006; ?>;
        var longitude = <?php echo (!empty($vehicle_detail->longitude)) ? $vehicle_detail->longitude : 79.8533; ?>;

        itemDetailMap(latitude, longitude);

    });
    $(document).ready(function () {

        //edit review form validation
        $("#edit_review_form").validate({
            rules: {
                description: "required"
            },
            messages: {
                description: "Please enter a description"
            }, submitHandler: function (form)
            {
                var id = $('#vehicle_id').val();
                $.post(site_url + '/vehicle_reviews/edit_review', $('#edit_review_form').serialize(), function (msg)
                {
                    if (msg == 1) {
                        $('#rtn_msg_edit').html('<div class="alert alert-success fade in"><button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button><strong>Successfully saved!!.</strong></div>');
                        window.location = site_url + '/vehicle_advertisements/vehicle_advertisement_detail_view' + '/' + id;
                    } else {
                        $('#rtn_msg_edit').html('<div class="alert alert-block alert-danger fade in"><button class="close close-sm" type="button" data-dismiss="alert"><i class="fa fa-times"></i></button><strong>An error occured.</strong></div>');

                    }
                });


            }
        });


        $("#subscribe_seller_form").validate({
            focusInvalid: false,
            ignore: "",
            rules: {
                subscriber_email: "required"
            }, submitHandler: function (form) {

                var $form = $('#subscribe_seller_form');

                $('#seller_id').val('<?php echo $vehicle_detail->added_by; ?>');
                $('#seller_name').val('<?php echo $vehicle_detail->added_by_user; ?>');

                $.ajax({
                    type: "POST",
                    url: site_url + '/subscribe_seller/add_seller_subscriber',
                    data: $form.serialize(),
                    success: function (msg) {
                        if (msg == '1') {
                            $('#fade_valid_msg_subsc').html('<div class="alert alert-success"><i class="fa fa-check-circle fa-fw fa-lg"></i>Subscribed Seller!!!</div>');
                            $('#fade_valid_msg_subsc').fadeIn();
                            $('#fade_valid_msg_subsc').fadeOut(4000);
                            $('#subscribe_seller_model').modal('hide');

                            $('#seller_subscription_span').html('<i class="fa fa-check-square"></i><a style="cursor: pointer" title="Unsubscribe Seller" onclick="unsubscribe_seller()">Unsubscribe Seller</a> ');
                        } else {
                            $('#fade_valid_msg_subsc').html('<div class="alert alert-danger"><i class="fa fa-times-circle fa-fw fa-lg"></i>Error!!!</div>');
                            $('#fade_valid_msg_subsc').fadeIn();
                            $('#fade_valid_msg_subsc').fadeOut(4000);
                        }
                    }
                });

            }
        });


    });

    function unsubscribe_seller() {

    }

</script>
<script>
// Connect to PeerJS, have server assign an ID instead of providing one
// Showing off some of the configs available with PeerJS :).
    var id = '<?php echo $this->session->userdata("USER_ID") . "_" . $this->session->userdata("USER_NAME"); ?>';
    var isAnn = false;
    if (id == '_') {
        isAnn = true;
        id = "";
    }
    var peer = new Peer(id, {
        // Set API key for cloud server (you don't need this if you're running your
        // own.

        key: '6rvbaekktla3jtt9',
        // Set highest debug level (log everything!).
        debug: 3,
        // Set a logging function:
        logFunction: function () {
            var copy = Array.prototype.slice.call(arguments).join(' ');
            $('.log').append(copy + '<br>');
        }
    });
    var connectedPeers = {};

// Show this peer's ID.
    peer.on('open', function (id) {
        $('#pid').text(id);
        var x = '<?php echo $this->session->userdata("USER_ID"); ?>';
        console.log(id + ' ' + x);
    });

// Await connections from others
    peer.on('connection', connect);

    peer.on('error', function (err) {
        console.log(err);
        $('#chat_error').modal('toggle');
    })

// Handle a connection object.
    function connect(c) {
        // Handle a chat connection.
        if (c.label === 'chat') {
            var chatbox = $('<div class="chat-box"><input type="checkbox" id="chkbx" /><label data-expanded="Close Chatbox" data-collapsed="Open Chatbox"></label></div>').addClass('connection').addClass('active1').attr('id', c.peer);
            //var header = $('<h1></h1>').html('Chat with <strong>' + c.peer + '</strong>');
            var messages;
            if (isAnn)
                messages = $('<div class="chat-box-content"><h1>' + c.peer.split("_")[1] + '</h1><em>Peer connected.</em></div>').addClass('messages');
            else
                messages = $('<div class="chat-box-content"><h1>' + 'Anonymous User' + '</h1><em>Peer connected.</em></div>').addClass('messages');
            //chatbox.append(header);
            chatbox.append(messages);
            chatbox.append('<input type="text" id="text" placeholder="Enter message" style="width: 70%;display:none;' +
                    'float: left;"><input class="button" id="send" type="button" value="Send" style="display:none;">');
            // Select connection handler.
            /* chatbox.on('click', function() {
             if ($(this).attr('class').indexOf('active') === -1) {
             $(this).addClass('active');
             } else {
             $(this).removeClass('active');
             }
             });*/
            $('.filler').hide();
            $('#ch').append(chatbox);

            c.on('data', function (data) {
                if (isAnn)
                    messages.append('<div><span class="peer">' + c.peer.split("_")[1] + '</span>: ' + data +
                            '</div>');
                else
                    messages.append('<div><span class="peer">' + 'Anonymous User' + '</span>: ' + data +
                            '</div>');
            });
            c.on('close', function () {
                //alert(c.peer + ' has left the chat.');
                chatbox.remove();
                if ($('.connection').length === 0) {
                    $('.filler').show();
                }
                delete connectedPeers[c.peer];
            });


        } else if (c.label === 'file') {
            c.on('data', function (data) {
                // If we're getting a file, create a URL for it.
                if (data.constructor === ArrayBuffer) {
                    var dataView = new Uint8Array(data);
                    var dataBlob = new Blob([dataView]);
                    var url = window.URL.createObjectURL(dataBlob);
                    if (isAnn)
                        $('#' + c.peer).find('.messages').append('<div><span class="file">' +
                                c.peer.split("_")[1] + ' has sent you a <a target="_blank" href="' + url + '">file</a>.</span></div>');
                    else
                        $('#' + c.peer).find('.messages').append('<div><span class="file">' +
                                'Anonymous User' + ' has sent you a <a target="_blank" href="' + url + '">file</a>.</span></div>');
                }
            });
        }
        connectedPeers[c.peer] = 1;
    }

    $(document).ready(function () {

        $('body').bind('beforeunload', function () {
            //do something
            c.close();
        });

        // Prepare file drop box.
        var box = $('#box');
        box.on('dragenter', doNothing);
        box.on('dragover', doNothing);
        box.on('drop', function (e) {
            e.originalEvent.preventDefault();
            var file = e.originalEvent.dataTransfer.files[0];
            eachActiveConnection(function (c, $c) {
                if (c.label === 'file') {
                    c.send(file);
                    $c.find('.messages').append('<div><span class="file">You sent a file.</span></div>');
                }
            });
        });
        function doNothing(e) {
            e.preventDefault();
            e.stopPropagation();
        }



        // Connect to a peer
        $('#startChat').click(function () {

            var requestedPeer = '<?php echo $vehicle_detail->added_by . "_" . $seller_add->user_name; ?>';
            if (!connectedPeers[requestedPeer]) {

                // Create 2 connections, one labelled chat and another labelled file.
                var c = peer.connect(requestedPeer, {
                    label: 'chat',
                    serialization: 'none',
                    metadata: {message: 'hi i want to chat with you about this car!'}
                });
                c.on('open', function () {
                    connect(c);
                    console.log('stated');
                });
                c.on('error', function (err) {
                    alert(err);
                });
                var f = peer.connect(requestedPeer, {label: 'file', reliable: true});
                f.on('open', function () {
                    connect(f);

                });
                f.on('error', function (err) {
                    alert(err);
                });
            } else {

            }
            connectedPeers[requestedPeer] = 1;

        });

        // Close a connection.
        $('#close').click(function () {
            eachActiveConnection(function (c) {
                c.close();
            });
        });

        // Send a chat message to all active connections.
        $(document).on('click', '#send', function (e) {

            //e.preventDefault();
            // For each active connection, send the message.
            var msg = $('#text').val();
            eachActiveConnection(function (c, $c) {
                console.log('a');
                if (c.label === 'chat') {

                    c.send(msg);
                    $c.find('.messages').append('<div><span class="you">You: </span>' + msg
                            + '</div>');
                }
            });
            $('#text').val('');
            $('#text').focus();

        });
        $(document).on('change', '#chkbx', function () {

            if (this.checked) {
                $('#text').show();
                $('#send').show();
            } else {
                $('#text').hide();
                $('#send').hide();
            }

        });
        // Goes through each active peer and calls FN on its connections.
        function eachActiveConnection(fn) {
            var actives = $('.active1');
            var checkedIds = {};
            actives.each(function () {
                var peerId = $(this).attr('id');

                if (!checkedIds[peerId]) {

                    var conns = peer.connections[peerId];
                    console.log($(this));
                    for (var i = 0, ii = conns.length; i < ii; i += 1) {
                        var conn = conns[i];
                        fn(conn, $(this));
                    }
                }

                checkedIds[peerId] = 1;
            });
        }

        // Show browser version
        $('#browsers').text(navigator.userAgent);
    });

// Make sure things clean up properly.

    window.onunload = window.onbeforeunload = function (e) {
        if (!!peer && !peer.destroyed) {
            peer.destroy();
        }
    };

</script>
<section class="container page-item-detail">
    <div class="row">
        <!--Item Detail Content-->
        <div class="col-md-9">
            <section class="block" id="main-content">
                <header class="page-title">
                    <div class="title">
                        <input type="hidden" name="vehicle_id" id="vehicle_id" value="<?php echo $vehicle_detail->id; ?>" />
                        <h1 itemprop="name"><?php echo $vehicle_detail->manufacture . ' ' . $vehicle_detail->model . ' ' . $vehicle_detail->year; ?></h1>
                        <figure style="color: red;"><strong>Rs. <?php echo number_format($vehicle_detail->price, 2, '.', ','); ?></strong></figure>
                    </div>
                    <div class="info">
                        <div class="type">
                            <i>
                                <img alt="" src="<?php echo base_url(); ?>application_resources/assets/icons/media/photo.png">
                            </i>
                            <span>The offer had <?php echo $review_looks_count; ?> Views</span>
                        </div>
                        <div class="type">
                            <a class="btn btn-default framed icon pull-right roll" href="#" onclick="window.print();">
                                Print
                                <i class="fa fa-print"></i>
                            </a>
                        </div>
                    </div>
                </header>
                <div class="row">
                    <!--Detail Sidebar-->
                    <aside class="col-md-4 col-sm-4" id="detail-sidebar">
                        <!--Contact-->
                        <section>
                            <header><h3>Contact</h3></header>
                            <address>
                                <div><?php echo $seller_add->address; ?></div>
                                <figure>
                                    <div class="info">
                                        <i class="fa fa-mobile"></i>
                                        <span><?php echo $seller_add->contact_no_1; ?></span>
                                    </div>
                                    <?php
                                    if (isset($seller_add->contact_no_2))
                                        if ($seller_add->contact_no_2 != '') {
                                            ?>
                                            <div class="info">
                                                <i class="fa fa-phone"></i>
                                                <span><?php echo $seller_add->contact_no_2; ?></span>
                                            </div>
                                        <?php } ?>
                                    <div class="info">
                                        <i class="fa fa-envelope"></i>
                                        <a href="mailto:<?php echo $seller_add->email; ?>"><?php echo $seller_add->email; ?></a>
                                    </div>
                                    <div class="info">
                                        <i class="fa fa-globe"></i>
                                        <a href="#">www.autoville.lankapanel.biz</a>
                                        <?php
                                        $user = $this->session->userdata("USER_ID");
                                        if (empty($user) || ($user != $vehicle_detail->added_by)) {
                                            ?>
                                            <i class="fa fa-comments"></i>
                                            <a href="#" id="startChat" class="">Chat with seller </a>
                                        <?php } ?>
                                    </div>
                                    <div class="info">                  
                                        <?php
                                        if ($user != $vehicle_detail->added_by) {
                                            ?>
                                            <span id="seller_subscription_span">
                                                <i class="fa fa-check-square-o"></i>
                                                <a data-toggle="modal" href="#subscribe_seller_model"> Subscribe Seller </a>                                                
                                            </span>
                                        <?php } ?>
                                    </div>
                                </figure>
                            </address>
                        </section>
                        <!--end Contact-->
                        <!--Share-->
                        <section class="clearfix">
                            <header class="pull-left">
                                <a class="roll" href="#reviews">
                                    <h3>Share</h3>
                                </a>
                            </header>
                            <figure class="pull-right">
                                <div class="addthis_sharing_toolbox"></div>

                            </figure>
                        </section>
                        <!--End Share-->
                        <!--Contact Form-->
                        <section>
                            <?php echo $this->load->view('vehicle_adds/ask_for_price_view'); ?>
                        </section>
                        <!--end Contact Form-->

                        <section style="background-color: #fff;">
                            <?php echo $this->load->view('vehicle_adds/loan_calculator'); ?>
                        </section>
                    </aside>
                    <!--end Detail Sidebar-->
                    <!--Content-->
                    <div class="col-md-8 col-sm-8">
                        <section>
                            <article class="item-gallery">
                                <div class="owl-carousel item-slider">
                                    <?php
                                    $i = 0;
                                    foreach ($images as $image) {
                                        ++$i
                                        ?>
                                        <div class="owl-item <?php if ($i == 1) { ?> active<?php } ?>">
                                            <div class="slide"><img <?php if ($i == 1) { ?> itemprop="image" <?php } ?> src="<?php echo base_url() . 'uploads/vehicle_images/vh_' . $vehicle_detail->id . '/' . $image->image_path; ?>" data-hash="<?php echo $i; ?>" alt=""></div>
                                        </div>

                                    <?php } ?>

                                </div>
                                <!-- /.item-slider -->
                                <div class="thumbnails">
                                    <span class="expand-content btn framed icon" data-expand="#gallery-thumbnails" >More<i class="fa fa-plus"></i></span>
                                    <div class="expandable-content height collapsed show-70" id="gallery-thumbnails">
                                        <div class="content">
                                            <?php
                                            $i = 0;
                                            foreach ($images as $image) {
                                                ++$i
                                                ?>
                                                <a href="#<?php echo $i; ?>" id="thumbnail-<?php echo $i; ?>" <?php if ($i == 1) { ?> class="active" <?php } ?>><img src="<?php echo base_url() . 'uploads/vehicle_images/vh_' . $vehicle_detail->id . '/' . $image->image_path; ?>" alt=""></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <!-- /.item-gallery -->
                            <article class="block">
                                <header><h2>Description</h2></header>
                                <p itemprop="description"><?php echo $vehicle_detail->description; ?></p>
                            </article>
                            <!-- /.block -->
                            <article class="block">
                                <header><h2>Info</h2></header>
                                <dl class="lines">
                                    <dt>Model, Body type</dt>
                                    <dd><?php echo $vehicle_detail->model . ' , ' . $vehicle_detail->body_type; ?></dd>
                                    <dt>Year</dt>
                                    <dd><?php echo $vehicle_detail->year; ?></dd>
                                    <dt>Fuel</dt>
                                    <dd><?php echo $vehicle_detail->fuel_type; ?></dd>
                                    <dt>Chassis Number</dt>
                                    <dd><?php echo $vehicle_detail->chassis_no; ?></dd>
                                    <dt>Doors</dt>
                                    <dd><?php echo $vehicle_detail->doors; ?></dd>
                                    <dt>Kilometers</dt>
                                    <dd><?php echo $vehicle_detail->kilometers; ?> km</dd>
                                </dl>
                            </article>
                            <!-- /.block -->

                            <article class="block">
                                <header><h2>Features</h2></header>
                                <ul class="bullets">
                                    <?php foreach ($equipments as $equipment) { ?>
                                        <li><span><?php echo $equipment->name; ?></span>&nbsp; <?php if (in_array($equipment->id, $vehicle_equipments)) { ?> Yes <?php } else { ?> No<?php } ?></li>

                                    <?php }
                                    ?>
                                </ul>
                            </article>
                            <!-- /.block -->

                        </section>
                        <!--Reviews-->
                        <?php echo $this->load->view('vehicle_adds/vehicle_reviews_view'); ?>
                        <!--end Review Form-->
                    </div>
                    <!-- /.col-md-8-->
                </div>
                <!-- /.row -->
            </section>
            <!-- /#main-content-->
        </div>
        <!-- /.col-md-8-->
        <!--Sidebar-->
        <div class="col-md-3">
            <aside id="sidebar">
                <section>
                    <header><h2>Similar Suggestions</h2></header>
                    <?php
                    foreach ($suggestions as $suggestion) {
                        if ($vehicle_detail->id == $suggestion->id)
                            continue;
                        ?>
                        <a href="<?php echo site_url() ?>/vehicle_advertisements/vehicle_advertisement_detail_view/<?php echo $suggestion->id; ?>" class="item-horizontal small">
                            <h3><?php echo $suggestion->manufacture . ' ' . $suggestion->model . ' ' . $suggestion->year; ?></h3>

                            <div class="wrapper">
                                <div class="image"><img src="<?php echo base_url() . 'uploads/vehicle_images/vh_' . $suggestion->id . '/' . $suggestion->image_path; ?>" alt=""></div>
                                <div class="info">
                                    <div class="type">
                                        <span><?php echo $suggestion->year; ?>, <?php echo $suggestion->fuel_type; ?></span>
                                        <span style="color: red; font-size: 15px;">Rs. <?php echo number_format($suggestion->price, 2, '.', ','); ?></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </section>
                <section>
                    <?php echo $this->load->view('vehicle_adds/commercial_add_view'); ?>
                </section>

            </aside>
            <!-- /#sidebar-->
        </div>
        <!-- /.col-md-3-->
        <!--end Sidebar-->
    </div><!-- /.row-->
</section>
<div id="ch" style="position:fixed;bottom:0;right:10; z-index:9999;"></div>
<!-- /.container-->
<div id="map-detail"></div>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55deb0b601ffb683" async="async"></script>
