<div class="row">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row bg_boxfooter">
                    <div class="col-6 col-md-6 col-lg-3 col-xl-3">
                        <div class="row">
                            <div class="col-4 pad_md_footer pad_xs_footer">
                                <img src="<?php echo base_frontend('images/icon_freeshipping.png');?>" class="img-fluid">
                            </div>
                            <div class="col-8">
                                <div class="footer_shipping">
                                    <h6><?php if(!empty($master_page_inc)) echo get2Lang($this->session->userdata('lang'), $master_page_inc->master_page_free_shipping_lang1, $master_page_inc->master_page_free_shipping_lang2);?></h6>
                                    <p>Nationwide</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 col-lg-3 col-xl-3">
                        <div class="row">
                            <div class="col-4 pad_md_footer">
                                <img src="<?php echo base_frontend('images/icon_contactcenter.png');?>" class="img-fluid">
                            </div>
                            <div class="col-8">
                                <div class="footer_shipping">
                                    <h6><?php if(!empty($master_page_inc)) echo get2Lang($this->session->userdata('lang'), $master_page_inc->master_page_contact_center_lang1, $master_page_inc->master_page_contact_center_lang2);?></h6>
                                    <p><?php if(!empty($social_inc)) echo $social_inc->tel_social_network_tel;?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 col-lg-3 col-xl-3">
                        <div class="row">
                            <div class="col-4 pad_md_footer">
                                <img src="<?php echo base_frontend('images/icon_delivery.png');?>" class="img-fluid">
                            </div>
                            <div class="col-8">
                                <div class="footer_shipping">
                                    <h6><?php if(!empty($master_page_inc)) echo get2Lang($this->session->userdata('lang'), $master_page_inc->master_page_delivery_lang1, $master_page_inc->master_page_delivery_lang2);?></h6>
                                    <p><?php if(!empty($master_page_inc)) echo get2Lang($this->session->userdata('lang'), $master_page_inc->master_page_within_lang1, $master_page_inc->master_page_within_lang2);?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 col-lg-3 col-xl-3">
                        <div class="row">
                            <div class="col-4 pad_md_footer">
                                <img src="<?php echo base_frontend('images/icon_express.png');?>" class="img-fluid">
                            </div>
                            <div class="col-8">
                                <div class="footer_shipping">
                                    <h6><?php if(!empty($master_page_inc)) echo get2Lang($this->session->userdata('lang'), $master_page_inc->master_page_express_lang1, $master_page_inc->master_page_express_lang2);?></h6>
                                    <p><?php if(!empty($master_page_inc)) echo get2Lang($this->session->userdata('lang'), $master_page_inc->master_page_express_within_lang1, $master_page_inc->master_page_express_within_lang2);?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row bg_footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row pad_textfooter">
                    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                        <div class="logofooter">
                            <img src="<?php echo base_frontend('images/logofooter_mistine_myanmar.png');?>" class="img-fluid">
                            <p><?php if(!empty($master_page_inc)) echo get2Lang($this->session->userdata('lang'), $master_page_inc->master_page_footer_lang1, $master_page_inc->master_page_footer_lang2);?></p>
                            <a href="<?php echo site_url('frontend/path/about');?>"><?php if(!empty($master_page_inc)) echo get2Lang($this->session->userdata('lang'), $master_page_inc->master_page_readmore_lang1, $master_page_inc->master_page_readmore_lang2);?></a>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 col-lg-3 col-xl-3">
                        <div class="topic_footer">
                            <h4><?php if(!empty($master_page_inc)) echo get2Lang($this->session->userdata('lang'), $master_page_inc->master_page_information_lang1, $master_page_inc->master_page_information_lang2);?></h4>
                        </div>
                        <ul class="ul_footer">
<?php
if(!empty($this->model_frontend->getProductFirstCategory3()->category3_id)) {
?>
                            <li><a href="<?php echo site_url('frontend/path/products/category3/'.$this->model_frontend->getProductFirstCategory3()->category3_id);?>"><?php if(!empty($master_page_inc)) echo get2Lang($this->session->userdata('lang'), $master_page_inc->master_page_products_lang1, $master_page_inc->master_page_products_lang2);?></a></li>
<?php
}
?>
                            <li><a href="<?php echo site_url('frontend/path/about');?>"><?php if(!empty($master_page_inc)) echo get2Lang($this->session->userdata('lang'), $master_page_inc->master_page_about_us_lang1, $master_page_inc->master_page_about_us_lang2);?></a></li>
                            <li><a href="<?php echo site_url('frontend/path/news_promotions');?>"><?php if(!empty($master_page_inc)) echo get2Lang($this->session->userdata('lang'), $master_page_inc->master_page_new_promotion_lang1,$master_page_inc->master_page_new_promotion_lang2);?></a></li>
                            <li><a href="<?php echo site_url('frontend/path/contact');?>"><?php if(!empty($master_page_inc)) echo get2Lang($this->session->userdata('lang'), $master_page_inc->master_page_contact_us_lang1, $master_page_inc->master_page_contact_us_lang2);?></a></li>
                            <li><a href="<?php echo site_url('frontend/path/privacy_and_confidentaility');?>" target="_blank"><?php if(!empty($master_page_inc)) echo get2Lang($this->session->userdata('lang'), $master_page_inc->master_page_privacy_lang1, $master_page_inc->master_page_privacy_lang2);?></a></li>
                            <li><a href="<?php echo site_url('frontend/path/terms_condition');?>" target="_blank"><?php if(!empty($master_page_inc)) echo get2Lang($this->session->userdata('lang'), $master_page_inc->master_page_terms_lang1, $master_page_inc->master_page_terms_lang2);?></a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-6 col-lg-2 col-xl-2">
                        <div class="topic_footer">
                            <h4><?php if(!empty($master_page_inc)) echo get2Lang($this->session->userdata('lang'), $master_page_inc->master_page_help_lang1, $master_page_inc->master_page_help_lang2);?></h4>
                        </div>
                        <ul class="ul_footer">
                            <li><a href="<?php echo site_url('frontend/path/question');?>"><?php if(!empty($master_page_inc)) echo get2Lang($this->session->userdata('lang'), $master_page_inc->master_page_question_lang1, $master_page_inc->master_page_question_lang2);?></a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 col-xl-3">
                        <div class="topic_help">
                            <h4><?php if(!empty($master_page_inc)) echo get2Lang($this->session->userdata('lang'), $master_page_inc->master_page_we_can_help_you_lang1, $master_page_inc->master_page_we_can_help_you_lang2);?></h4>
                            <a href="<?php if(!empty($social_inc)) echo $social_inc->tel_social_network_facebook;?>" target="_blank"><img src="<?php echo base_frontend('images/icon_facebook.png');?>" class="img-fluid"></a> 
                            <a href="<?php if(!empty($social_inc)) echo $social_inc->tel_social_network_line;?>" target="_blank"><img src="<?php echo base_frontend('images/icon_line.png');?>" class="img-fluid"></a> 
                            <a href="<?php if(!empty($social_inc)) echo $social_inc->tel_social_network_youtube;?>" target="_blank"><img src="<?php echo base_frontend('images/icon_youtube.png');?>" class="img-fluid"></a> 
                            <a href="<?php if(!empty($social_inc)) echo $social_inc->tel_social_network_instagram;?>" target="_blank"><img src="<?php echo base_frontend('images/icon_instagram.png');?>" class="img-fluid"></a>
                        </div>
                        
                    </div>
                </div>
                <div class="line_footer"></div>
                <div class="copyright">Copyright © 2020 Mistine | All Rights Reserved</div>
            </div>
        </div>
    </div>
</div>