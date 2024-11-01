<?php
if (!defined('ABSPATH')) die();

/*
 *
 *  WE Testimonial Setting Page 
 *
 */
add_action('admin_menu', 'we_testimonial_setting_page');
 
function we_testimonial_setting_page() {
    add_submenu_page(
        'edit.php?post_type=testimonial',
        'WE Testimonial',
        'WE Testimonial',
        'manage_options',
        'we_testimonial_setting_page',
        'we_testimonial_setting_page_callback' );
}
 
function we_testimonial_setting_page_callback() { 
    wp_enqueue_style('we_dashboard_page_style', plugins_url('/we-testimonial-slider/css/dashboard_page.css'));
?>

   
    <div class="we_dashboard">
        <div class="we_deshboard_main">
            <div class="we_deshboard_title">
               <h1>WE – Testimonial</h1>
            </div>
            <div class="we_deshboard_logo">
                <img src="<?php echo plugins_url('/we-testimonial-slider/images'); ?>/logo.png" />
            </div>
        </div>
        <div class="cls"></div>
    </div>

    <div class="we_dashboard_setting">
        <div class="we_setting_dashboard">
            <div class="we_testimonial_setting">
                <p>WE - Testimonial Slider plugin is very easy to setup and a fully responsive & mobile friendly WordPress plugin to manage testimonials. <br>You can choose to display single testimonial or display testimonials as a slider using custom short codes. </p>
                <h3>Shortcode Instructions</h3>
                
                <p><strong>Slider</strong><br>Short code to call all testimonials as a slider.<br><pre>[we_testimonial_slider]</pre></p>
                <p><strong>List</strong><br>Short code to list all testimonials on a page/post use.<br><pre>[we_testimonial_list]</pre></p>
                <p><strong>Single</strong><br>Short code to display single testimonial.<br><pre>[we_single_testimonial id=YOURPOSTID]</pre></p>
            </div>
        </div>
        <div class="we_dashboard_banner">
            <div class="we_dashboard_right">
                <img src="<?php echo plugins_url('/we-testimonial-slider/images'); ?>/plugin-banner.jpg" />
            </div>
        </div>
        <div class="cls"></div>
    </div>
  
    <div class="we_dashboard_plugin_box">
        <?php
            $plugin_action = 'install-plugin';
            $plugin_slug = 'we-client-logo-carousel';
            $plugin_title = 'we-client-logo-carousel';
            $plugin_url = wp_nonce_url(
                add_query_arg(
                    array(
                        'action' => $plugin_action,
                        'plugin' => $plugin_slug
                    ),
                    admin_url( 'update.php' )
                ),
                $plugin_action.'_'.$plugin_slug
            );
        ?>

        <div class="we_dashboard_plugins">
            <div class="we_dashboard_plugin_box_1">
                <div class="we_plugin_icon">
                    <img src="https://ps.w.org/we-client-logo-carousel/assets/icon-256x256.png" />
                </div>
                <div class="cl_color"></div>
                <div class="cl_color2"></div>
                <div class="more_plugin">
                    <div class="more_plugin_details">
                       <h3>WE – Client Logo Carousel</h3>
                       <p class="content">Display your partners, clients or sponsors on your website in a WE – Client Logo Carousel.</p>
                       <p>By <a href="https://profiles.wordpress.org/wordpresteem">wordpresteem</a></p>
                       <a class="we-install-now button" data-slug="health-check" data-slug="<?php echo $plugin_slug ?>" href="<?php echo $plugin_url ?>" aria-label="<?php echo $plugin_title ?>" data-name="<?php echo $plugin_title ?>">Install Now</a>
                    </div>
                </div>
                <div class="cls"></div>
            </div>
        </div>
        
        <?php
            $plugin_action = 'install-plugin';
            $plugin_slug = 'ga-google-analytics-by-esteem-host';
            $plugin_title = 'ga-google-analytics-by-esteem-host';
            $plugin_url = wp_nonce_url(
                add_query_arg(
                    array(
                        'action' => $plugin_action,
                        'plugin' => $plugin_slug
                    ),
                    admin_url( 'update.php' )
                ),
                $plugin_action.'_'.$plugin_slug
            );
        ?> 
        <div class="we_dashboard_plugins">
            <div class="we_dashboard_plugin_box_2">
                <div class="we_plugin_icon">
                    <img src="https://s.w.org/plugins/geopattern-icon/ga-google-analytics-by-esteem-host.svg" />
                </div>
                <div class="more_plugin">
                    <div class="more_plugin_details">
                       <h3>WE – Google Analytics</h3>
                       <p class="content">This plugin enables Google Analytics for your entire WordPress site. Lightweight and fast with plenty of great features.</p>
                       <p>By <a href="https://profiles.wordpress.org/wordpresteem">wordpresteem</a></p>
                       <a class="we-install-now button" data-slug="health-check" data-slug="<?php echo $plugin_slug ?>" href="<?php echo $plugin_url ?>" aria-label="<?php echo $plugin_title ?>" data-name="<?php echo $plugin_title ?>">Install Now</a>
                    </div>
                </div>
                <div class="cls"></div>
            </div>
        </div>
        
        <?php
            $plugin_action = 'install-plugin';
            $plugin_slug = 'we-minify-html';
            $plugin_title = 'we-minify-html';
            $plugin_url = wp_nonce_url(
                add_query_arg(
                    array(
                        'action' => $plugin_action,
                        'plugin' => $plugin_slug
                    ),
                    admin_url( 'update.php' )
                ),
                $plugin_action.'_'.$plugin_slug
            );
        ?> 
        <div class="we_dashboard_plugins">
            <div class="we_dashboard_plugin_box_3">
                <div class="we_plugin_icon">
                    <img src="https://s.w.org/plugins/geopattern-icon/we-minify-html.svg" />
                </div>
                <div class="more_plugin">
                    <div class="more_plugin_details">
                       <h3>WE – Minify HTML</h3>
                       <p class="content">WE – Minify HTML will help in Compacting HTML code, including any inline JavaScript and CSS contained in it,can save many bytes of data.</p>
                       <p>By <a href="https://profiles.wordpress.org/wordpresteem">wordpresteem</a></p>
                       <a class="we-install-now button" data-slug="health-check" data-slug="<?php echo $plugin_slug ?>" href="<?php echo $plugin_url ?>" aria-label="<?php echo $plugin_title ?>" data-name="<?php echo $plugin_title ?>">Install Now</a>
                    </div>
                </div>
                <div class="cls"></div>
            </div>
        </div>
         
        <?php
            $plugin_action = 'install-plugin';
            $plugin_slug = 'we-client-logo-carousel';
            $plugin_title = 'we-client-logo-carousel';
            $plugin_url = wp_nonce_url(
                add_query_arg(
                    array(
                        'action' => $plugin_action,
                        'plugin' => $plugin_slug
                    ),
                    admin_url( 'update.php' )
                ),
                $plugin_action.'_'.$plugin_slug
            );
        ?> 
        <div class="we_dashboard_plugins" style="display: none;">
            <div class="we_dashboard_plugin_box_4">
                <div class="we_plugin_icon">
                    <img src="https://ps.w.org/buddypress/assets/icon.svg?rev=977480" />
                </div>
                <div class="more_plugin">
                    <div class="more_plugin_details">
                        <h3>BuddyPress</h3>
                        <p class="content">BuddyPress helps site builders & developers add community features to their websites, with user profiles, activity streams, and more!</p>
                        <p>By <a href="https://profiles.wordpress.org/wordpresteem">wordpresteem</a></p>
                       <a class="we-install-now button" data-slug="health-check" data-slug="<?php echo $plugin_slug ?>" href="<?php echo $plugin_url ?>" aria-label="<?php echo $plugin_title ?>" data-name="<?php echo $plugin_title ?>">Install Now</a>
                    </div>
                </div>
                <div class="cls"></div>
            </div>
         </div>        
    </div>    

    <?php
}
