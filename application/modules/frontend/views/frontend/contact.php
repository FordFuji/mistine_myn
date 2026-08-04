<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc_header.php'); ?>
    <style>
        .form-contact {
            color: #000 !important;
        }
    </style>
</head>

<body>
    <?php require('inc_menu.php'); ?>
    <div class="container-fluid">
        <div class="row pad-banner">
            <div class="col-12 nopan banner wow fadeInDown">
                <div class="text_banner">
                    <h2>Contact us</h2>
                    <p><a href="<?php echo site_frontend('index.php');?>">Home</a> l Contact us</p>
                </div>
                <img src="<?php echo base_frontend('images/banner/contact.jpg');?>" class="img-fluid" style="width: 100%;">
            </div>
        </div>
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-12 information_contact wow fadeInDown">
                        <div class="information">
                            <h4>Contact Information</h4>
                        </div>
                        <div class="row padding_icon_contact">
                            <div class="col-12 col-md-12 col-lg-4">
                                <div class="row">
                                    <div class="col-3 col-md-2 col-lg-4">
                                        <div class="icon_contact">
                                            <img src="<?php echo base_frontend('images/icon_contact_1.png');?>" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-9 col-md-9 col-lg-8 map_contact">
                                        <div class="text_map">
                                            <p>No.243, Sattmu (12) th street, Zaykabar Industrial Zone,Mingalardone Tsp,Yangon.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-4 pad_contactmd">
                                <div class="row">
                                    <div class="col-3 col-md-2 col-lg-4">
                                        <div class="icon_contact">
                                            <img src="<?php echo base_frontend('images/icon_contact_2.png');?>" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-9 col-md-9 col-lg-8 map_contact">
                                        <div class="text_map">
                                            <p>Tel : 09750077833/09750077689 <!-- <br>Fax : 0-2517-1515</p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-4 padding_contact">
                                <div class="row">
                                    <div class="col-3 col-md-2 col-lg-4">
                                        <div class="icon_contact">
                                            <img src="<?php echo base_frontend('images/icon_contact_3.png');?>" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-9 col-md-9 col-lg-8 map_contact">
                                        <div class="text_map">
                                            <p>Mail : onlinesale.mistinemyanmar@gmail.com</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 wow fadeInDown">
                        <div class="information">
                            <h4>Where We Located</h4>
                            <div class="map-contact">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3816.44661050221!2d96.1902139!3d16.9525683!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c191479355ef7d%3A0xf72183c4a8040702!2sMistine%20Myanmar!5e0!3m2!1sen!2sth!4v1654060566220!5m2!1sen!2sth" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 pad_information wow fadeInDown">
                        <div class="information">
                            <h4>Send Us A Messarge</h4>
                            <div class="row padding-form-contact">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="text-form-contact">
                                        <p>Your Name <span>*</span></p>
                                        <input type="text" name="contact_name" id="contact_name" class="form-contact">
                                    </div>
                                    <div class="text-form-contact">
                                        <p>Your Email / Facebook / Etc. <span>*</span></p>
                                        <input type="text" name="contact_email_facebook_etc" id="contact_email_facebook_etc" class="form-contact">
                                    </div>
                                    <div class="text-form-contact">
                                        <p>Tel <span>*</span></p>
                                        <input type="text" name="contact_tel" id="contact_tel" class="form-contact">
                                    </div>
                                    <div class="text-form-contact">
                                        <p>Subject <span>*</span></p>
                                        <input type="text" name="contact_subject" id="contact_subject" class="form-contact">
                                    </div>
                                    
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="text-form-contact">
                                        <p>Message</p>
                                        <textarea class="form-contact" id="contact_message" name="contact_message" rows="9"></textarea>
                                        <div class="text-form-contact">
                                            <!-- <img src="<?php echo base_frontend('images/img-publication-16.jpg');?>" class="img-fluid"> -->
                                            <?php echo $captcha;?>
                                            <p>Please enter the letters from the image <span>*</span></p>
                                            <input type="text" name="captcha" id="captcha" class="form-contact">
                                        </div>
                                        
                                        <button type="button" onclick="checkForm();" class="button_send">SEND</button>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require('inc_footer.php'); ?>
    </div>
    <script>
        function checkForm() {
            if($("#contact_name").val() == '') {
                alert('Please enter Your Name');

                $("#contact_name").focus();
            } else if($("#contact_email_facebook_etc").val() == '') {
                alert('Please enter Your Email / Facebook / Etc.');

                $("#contact_email_facebook_etc").focus();
            } else if($("#contact_tel").val() == '') {
                alert('Please enter Tel');

                $("#contact_tel").focus();
            } else if($("#contact_subject").val() == '') {
                alert('Please enter Subject');

                $("#contact_subject").focus();
            } else if($("#contact_message").val() == '') {
                alert('Please enter Message');

                $("#contact_message").focus();
            } else if($("#captcha").val() == '') {
                alert('Please enter Captcha');

                $("#captcha").focus();
            } else {
                $.post('<?php echo site_url("frontend/path/ajaxContact");?>', { contact_name: $("#contact_name").val(), contact_email_facebook_etc: $("#contact_email_facebook_etc").val(), contact_tel: $("#contact_tel").val(), contact_subject: $("#contact_subject").val(), contact_message: $("#contact_message").val(), captcha: $("#captcha").val() }, function(data) {
                    if(data != true) {
                        alert(data);
                    } else {
                        alert('Save Data Form Contact Success');

                        window.location.href = '<?php echo site_url();?>';
                    }
                });
            }
        }
    </script>
</body>

</html>