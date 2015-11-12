<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>AutoVille</title>
        <!-- Designed by https://github.com/kaytcat -->
        <!-- Header image designed by Freepik.com -->


        <style type="text/css">
            /* Take care of image borders and formatting */

            img {
                max-width: 600px;
                outline: none;
                text-decoration: none;
                -ms-interpolation-mode: bicubic;
            }

            a img { border: none; }
            table { border-collapse: collapse !important; }
            #outlook a { padding:0; }
            .ReadMsgBody { width: 100%; }
            .ExternalClass {width:100%;}
            .backgroundTable {margin:0 auto; padding:0; width:100%;}
            table td {border-collapse: collapse;}
            .ExternalClass * {line-height: 115%;}


            /* General styling */

            td {
                font-family: Arial, sans-serif;
                color: #6f6f6f;
            }

            body {
                -webkit-font-smoothing:antialiased;
                -webkit-text-size-adjust:none;
                width: 100%;
                height: 100%;
                color: #6f6f6f;
                font-weight: 400;
                font-size: 18px;
            }


            h1 {
                margin: 10px 0;
            }

            a {
                color: #27aa90;
                text-decoration: none;

            }
            .topa{
                display:block;
                height:15px;
            }
            .force-full-width {
                width: 100% !important;
            }

            .force-width-80 {
                width: 80% !important;
            }


            .body-padding {
                padding: 0 75px;
            }

            .mobile-align {
                text-align: right;
            }



        </style>

        <style type="text/css" media="screen">
            @media screen {
                @import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,900);
                /* Thanks Outlook 2013! http://goo.gl/XLxpyl */
                * {
                    font-family: 'Source Sans Pro', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
                }
                .w280 {
                    width: 280px !important;
                }

            }
        </style>

        <style type="text/css" media="only screen and (max-width: 480px)">
            /* Mobile styles */
            @media only screen and (max-width: 480px) {

                table[class*="w320"] {
                    width: 320px !important;
                }

                td[class*="w320"] {
                    width: 280px !important;
                    padding-left: 20px !important;
                    padding-right: 20px !important;
                }

                img[class*="w320"] {
                    width: 250px !important;
                    height: 67px !important;
                }

                td[class*="mobile-spacing"] {
                    padding-top: 10px !important;
                    padding-bottom: 10px !important;
                }

                *[class*="mobile-hide"] {
                    display: none !important;
                }

                *[class*="mobile-br"] {
                    font-size: 12px !important;
                }

                td[class*="mobile-w20"] {
                    width: 20px !important;
                }

                img[class*="mobile-w20"] {
                    width: 20px !important;
                }

                td[class*="mobile-center"] {
                    text-align: center !important;
                }

                table[class*="w100p"] {
                    width: 100% !important;
                }

                td[class*="activate-now"] {
                    padding-right: 0 !important;
                    padding-top: 20px !important;
                }

                td[class*="mobile-block"] {
                    display: block !important;
                }

                td[class*="mobile-align"] {
                    text-align: left !important;
                }

            }
        </style>
    </head>
    <body  class="body" style="padding:0; margin:0; display:block; background:#eeebeb; -webkit-text-size-adjust:none;" bgcolor="#eeebeb">
        <table align="center" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td align="center" valign="top" style="background-color:#eeebeb" width="100%">

                    <center>

                        <table cellspacing="0" cellpadding="0" width="600" class="w320">

                            <tr>
                                <table cellspacing="0" cellpadding="0" class="force-full-width" style="background-color:#3bcdb0;" width="100%">
                                    <tr>
                                        <td>
                                            <img src="<?php echo base_url(); ?>application_resources/assets/img/logo.png" alt="logo"></a>
                                        </td>
                                        <td style="background-color:#3bcdb0;">
                                            <strong>Autoville Subscription Notification</strong>
                                        </td>
                                    </tr>
                                </table>
                            </tr>

                            <tr>
                                <td align="center" valign="top">


                                    <table style="margin:0 auto;" cellspacing="0" cellpadding="0" width="100%">
                                        <tr>
                                            <td style="text-align: center;">
                                                <a href="#" class="topa"> </a>
                                            </td>
                                        </tr>
                                    </table>                                   

                                    <table cellspacing="0" cellpadding="0" class="force-full-width" bgcolor="#ffffff"   width="100%">
                                        <tr>
                                            <td style="background-color:#ffffff; padding-top: 15px;">

                                                <left>

                                                    <table style="margin:0 auto;" cellspacing="0" cellpadding="0" class="force-width-80">
                                                        <tr>
                                                            <td  class="mobile-block">
                                                                <br>                                                                   
                                                                    <table cellspacing="10" cellpadding="10" class="force-full-width">
                                                                        <tr>
                                                                            <td style="border-bottom:1px solid #e3e3e3; font-weight: bold; text-align:left">
                                                                                Dear <?php echo $subscriber; ?>,
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align:left;">
                                                                                <br/>
                                                                                Thank you for subscribing seller  <?php echo $seller; ?> on <?php echo date('Y-m-d H:i:s'); ?>.
                                                                                From now on you will receive notifications on his/her updates.
                                                                            </td>
                                                                        </tr>                                                                        

                                                                        <tr>
                                                                            <td style="text-align:left;">                                                                                                                                                              
                                                                                <br/>
                                                                                Best Regards,
                                                                                <br/>
                                                                                <strong>AutoVille Customer Support</strong>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                            </td>
                                                        </tr>
                                                    </table>                                                   
                                                </left>

                                                <table style="margin:0 auto;" cellspacing="0" cellpadding="10" width="100%">
                                                    <tr>
                                                        <td style="text-align:center; margin:0 auto;">
                                                            <br>
                                                                <div><!--[if mso]>
                                                                  <v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://" style="height:45px;v-text-anchor:middle;width:180px;" stroke="f" fillcolor="#f5774e">
                                                                    <w:anchorlock/>
                                                                    <center>
                                                                  <![endif]-->

                                                                    <!--[if mso]>
                                                                  </center>
                                                                </v:rect>
                                                              <![endif]--></div>
                                                                <br>
                                                                    </td>
                                                                    </tr>
                                                                    </table>


                                                                    <table cellspacing="0" cellpadding="0" bgcolor="#363636"  class="force-full-width"  width="100%">
                                                                        <tr>
                                                                            <td style="background-color:#363636; text-align:center;">
                                                                                <br>
                                                                                    <br>
                                                                                        <img width="62" height="56" img src="https://www.filepicker.io/api/file/FjkhDKXsTFyaHnXhhBCw">
                                                                                            <img width="68" height="56" src="https://www.filepicker.io/api/file/W6gXqm5BRL6qSvQRcI7u">
                                                                                                <img width="61" height="56" src="https://www.filepicker.io/api/file/eV9YfQkBTiaOu9PA9gxv">
                                                                                                    <br>
                                                                                                        <br>
                                                                                                            </td>
                                                                                                            </tr>
                                                                                                            <tr>
                                                                                                                <td style="color:#f0f0f0; font-size: 14px; text-align:center; padding-bottom:4px;">
                                                                                                                    © Autoville All Rights Reserved
                                                                                                                </td>
                                                                                                            </tr>

                                                                                                            <tr>
                                                                                                                <td style="font-size:12px;">
                                                                                                                    &nbsp;
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                            </table>

                                                                                                            </td>
                                                                                                            </tr>
                                                                                                            </table>


                                                                                                            </td>
                                                                                                            </tr>
                                                                                                            </table>

                                                                                                            </center>




                                                                                                            </td>
                                                                                                            </tr>
                                                                                                            </table>
                                                                                                            </body>
                                                                                                            </html>

