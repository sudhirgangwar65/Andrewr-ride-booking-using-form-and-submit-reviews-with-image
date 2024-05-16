<?php
/*
Template Name: Home Page
*/
get_header();
?>

    <!-- Start Banner -->
    <section class="banner" style="background-image: url('<?= (!empty(get_field('banner_background_image'))) ? get_field('banner_background_image') : get_site_url().'/wp-content/uploads/2024/05/banner.png'; ?>')">
        <div class="container">
            <div class="text">
                <h1><?= (!empty(get_field('banner_title'))) ? get_field('banner_title') : ' '; ?></h1>
                <p><?= (!empty(get_field('banner_description'))) ? get_field('banner_description') : ' '; ?></p>
            </div>
        </div>
    </section>
    <!-- End Banner -->

    <!-- Start Who We Are -->
    <section class="who">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="info">
                        <div class="row">
                            <div class="image">
                                <?php 
                                $image = get_field('who_we_image');
                                if(!empty($image)){
                                ?>
                                <img src="<?= $image; ?>" alt="who-we-image" />
                                <?php } ?>
                            </div>
                            <div class="title">
                                <h6><?= (!empty(get_field('who_we_subtitle'))) ? get_field('who_we_subtitle') : ' '; ?></h6>
                                <h2><?= (!empty(get_field('who_we_title'))) ? get_field('who_we_title') : ' '; ?></h2>
                                <div class="video">
                                    <?php 
                                    $thumb_image = get_field('thumb_image');
                                    if(!empty($thumb_image)){
                                    ?>
                                    <img src="<?= $thumb_image; ?>" alt="video-thumb.png" />
                                    <?php } ?>                                    
                                    <p><?= (!empty(get_field('who_we_content'))) ? get_field('who_we_content') : ' '; ?></p>
                                </div>
                            </div>
                            <div class="para">
                                <?= (!empty(get_field('who_we_paragraph'))) ? get_field('who_we_paragraph') : ' '; ?>
                                <?php 
                                    $btn = get_field('button_label_with_link');
                                    if(!empty($btn)){
                                ?>
                                <a href="<?= esc_url($btn['url']); ?>" class="globallink"><img
                                        src="http://devt61.sg-host.com/wp-content/uploads/2024/04/icon_arratw.png" alt="Next page" /><?= esc_html($btn['title']); ?> </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form">
                        <div class="title">
                            <h3><?= (!empty(get_field('conatct_form_title'))) ? get_field('conatct_form_title') : ' '; ?></h3>
                        </div>
                        <div class="booking_form_sec">
                            <?php // echo do_shortcode('[contact-form-7 id="4e50179" title="Booking Form"]'); ?>
                            <?php echo do_shortcode('[Booking_form_shortcode]'); ?>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Who We Are -->

    <!-- Start -->
    <section class="three">
        <div class="container">
            <div class="row">
                <?php 
                    $g = 1;
                    $grid_block = get_field('blurb_section_grid_block');
                    if(!empty($grid_block)){
                        foreach($grid_block as $grid_Item){
                            $g++;
                ?>
                <div class="col-md-4">
                    <div class="single">
                        <div class="row">
                            <div class="image">
                                <?php 
                                    if(!empty($grid_Item['grid_image'])){
                                ?>
                                <img src="<?= $grid_Item['grid_image']; ?>" alt="<?= $g; ?>" />
                            <?php } ?>
                            </div>
                            <div class="text">
                                <h4><?= (!empty($grid_Item['heading_title'])) ? $grid_Item['heading_title'] : ''; ?></h4>
                                <p><?= (!empty($grid_Item['grid_description'])) ? $grid_Item['grid_description'] : ''; ?></p>
                                <a href="javascript:void(0)" class="globallink"><img
                                        src="<?= get_site_url(); ?>/wp-content/uploads/2024/04/logout_wh.png" alt="Next page <?= $g; ?>" /> <?= (!empty($grid_Item['button_label'])) ? $grid_Item['button_label'] : ''; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    }
                }
                ?>              
            </div>
        </div>
    </section>
    <!-- End -->

    <!-- Start Gift Card -->
    <section class="giftcard">
        <div class="container">
            <?php 
            $gift_image = get_field('gift_card');
            if(!empty($gift_image)){
            ?>
        <a href="/gift-card" class="giftcard">
            <img src="<?= $gift_image; ?>" alt="Gift Card" />
        </a>
            <?php } ?>            
        </div>
    </section>
    <!-- End Gift Card -->
    <section class="waterbike_tour_sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="waterbike_tour_tophead">
                        <h4><?= (!empty(get_field('adv_subtitle'))) ? get_field('adv_subtitle') : ' '; ?></h6>
                        <h2><?= (!empty(get_field('adv_title'))) ? get_field('adv_title') : ' '; ?></h2>
                    </div>
                </div>
                <?php 
                $args = array(
                      'post_type'=> 'tour',
                      'post_status' => 'publish',
                      'order'    => 'DESC',
                      'posts_per_page' => 3 
                         );
                $query = new WP_Query($args);
                if($query->have_posts()) :
                while($query->have_posts()) : $query->the_post();
                $id = get_the_ID();
                ?>
                <div class="col-md-4">
                    <div class="water_bike_box">
                        <div class="wt_bi_mk">
                            <?php
                                if(has_post_thumbnail($id)): 
                                $img = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'single-post-thumbnail');
                            ?>
                            <img src="<?= $img[0]; ?>" alt="<?= get_the_title(); ?>">
                         <?php endif; ?>
                        </div>
                        <div class="waterbike_contbk">
                            <h2><?= get_the_title(); ?></h2>
                            <p><?= get_the_excerpt(); ?></p>
                            <a href="<?= get_site_url(); ?>/booking/">Book Now</a>
                        </div>
                    </div>
                </div>
                 <?php 
                    endwhile;
                    endif;
                    wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <!-- Start Our Thrill -->
    <section class="ourthrill">
        <div class="container">
            <div class="title">
                <h6><?= (!empty(get_field('overthrill_subtitle'))) ? get_field('overthrill_subtitle') : ' '; ?></h6>
                <h3><?= (!empty(get_field('overthrill_title'))) ? get_field('overthrill_title') : ' '; ?></h3>
            </div>
            <div class="swiper thrillSwiper">
                <div class="swiper-wrapper">
                    <?php 
                        $thrill = get_field('thrill_slider');
                        $i = 1;
                        if(!empty($thrill)){
                            foreach($thrill as $thrillItem){
                                $i++;
                    ?>
                    <div class="swiper-slide">
                        <div class="single">
                            <div class="image">
                                <img src="<?= $thrillItem['slide_image']; ?>" alt="Thrill<?= $i; ?>" />
                            </div>
                            <div class="content">
                                <div class="icon">
                                    <img src="<?= $thrillItem['slide_icon']; ?>" alt="Thrill<?= $i; ?>" />
                                </div>
                                <div class="text">
                                    <h6><?= $thrillItem['slide_badges']; ?></h6>
                                    <h5><?= $thrillItem['slide_title']; ?></h5>
                                    <a href="javascript:void(0)" class="globallink"><img
                                            src="<?php echo get_stylesheet_directory_uri();  ?>/assets/images/logout_4503872.svg" alt="Next page" /> <?= $thrillItem['slide_button_label']; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php                        
                        }   
                         }
                    ?>
                    
                </div>
            </div>
            <div class="thrill-swiper-pagination swiper-pagination"></div>
        </div>
    </section>
    <!-- End Our Thrill -->

    <!-- Start Testimonial -->
    <section class="testimonial">
        <div class="container">
            <div class="title">
                <h6><?= (!empty(get_field('testimonial_subtitle'))) ? get_field('testimonial_subtitle') : ' '; ?></h6>
                <h3><?= (!empty(get_field('testimonial_title'))) ? get_field('testimonial_title') : ' '; ?></h3>
            </div>
            <div class="swiper testimonialSwiper">
                <div class="swiper-wrapper">
                    <?php 
                        $testi = get_field('testimonial_slider');
                        $a= 1;
                        if(!empty($testi)){
                            foreach($testi as $testiItem){
                                $a++;
                    ?>
                    <div class="swiper-slide">
                        <div class="single">
                            <div class="row">
                                <div class="image">
                                    <img src="<?= $testiItem['authorr_image']; ?>" alt="Testimonial Image <?= $a; ?>" />
                                </div>
                                <div class="text">
                                    <div class="rating">
                                        <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
                                            </svg><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
                                            </svg><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
                                            </svg><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
                                            </svg><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
                                            </svg></p>
                                    </div>
                                    <h5><?= $testiItem['author_name']; ?></h5>
                                    <h6><?= $testiItem['auth_location']; ?></h6>
                                    <p><?= $testiItem['auth_description']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } }  ?>
                   
                </div>
                <div class="testimonial-swiper-pagination swiper-pagination"></div>
            </div>
        </div>
    </section>
    <!-- End Testimonial -->

<?php
get_footer();
?>
