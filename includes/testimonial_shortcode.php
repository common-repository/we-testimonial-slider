<?php
if (!defined('ABSPATH')) die();

/*
 *
 *  WE Testimonial Slider Shortcode
 *
 */
if (!function_exists('we_testimonials_slider_shortcode')) {		 
	function we_testimonials_slider_shortcode( $atts, $content = null ) {
		global $theme;
		$categories = $instance['categories'];		
		//echo $before_widget;		
		if($categories!=""){
			$recent_posts = new WP_Query(array(
				'posts_per_page' => -1,
				'post_type' => 'testimonial',
				'orderby' => 'date',
				'order' => 'DESC',
				'testimonial-category' => $categories,
			));
		}
		else{
			$recent_posts = new WP_Query(array(
				'posts_per_page' => -1,
				'orderby' => 'date',
				'order' => 'DESC',
				'post_type' => 'testimonial',
			));
		}
		global $post;
		$count = $recent_posts->post_count; 
		if($count > '1'){
			$id = 'testimonial-list';
		}else{
			$id = 'testimonial';
		}
		
		if($count >= '1'){
			$str = '<div id="testimonials">
				        <div class="carousel-nav clearfix">
				          <i class="fa fa-arrow-circle-left prevbtn" id="prv-testimonial"></i>
				          <i class="fa fa-arrow-circle-right nextbtn" id="nxt-testimonial"></i>
				        </div>
				        <div class="carousel-wrap">
				          <ul id="'.$id.'" class="clearfix">';


			while($recent_posts->have_posts()) {
				$recent_posts->the_post(); 

				$post_author_name =  get_post_meta(get_the_ID(), 'testimonial_author', true);
				$testimonial_author_position =  get_post_meta(get_the_ID(), 'testimonial_author_position', true);
				$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 

				$str .= '<li>
							<div class="testimonial-container">
								<div class="testimonial-icon">
									<i class="fa fa-comments"></i>
								</div>
								<div class="testimonial-content">
								'.get_the_content().'
								</div>';
				if($featured_img_url != ''){							
					$str .= '<div class="testimonial-user-img">
									<img src="'.$featured_img_url.'" alt="'.$post_author_name.'" />
								</div>';
				}

				if($post_author_name != ''){	
					$str .= '<div class="testimonial-author">'.$post_author_name.'</div>';
				}

				if($testimonial_author_position != ''){	
					$str .= '<div class="testimonial-author-position">'.$testimonial_author_position.'</div>';
				}

				$str .= '</div>
						</li>';
			}
			$str .= '</ul></div></div>';
		}else{
			$str = 'No testimonial found.';
		}
		return $str;
	}
	add_shortcode( 'we_testimonial_slider', 'we_testimonials_slider_shortcode' );
}

/*
 *
 *  WE Testimonial List Shortcode
 *
 */
if (!function_exists('we_testimonial_list_shortcode')) {
	function we_testimonial_list_shortcode( $atts, $content = null ) {		
			$recent_posts = new WP_Query(array(
				'posts_per_page' => -1,
				'post_type' => 'testimonial',
				'orderby' => 'date',
				'order' => 'DESC',
			));
		global $post;		
		$str = '<div class="testimonial-list">';
		while($recent_posts->have_posts()) {
			$recent_posts->the_post(); 
			
			$post_author_name =  get_post_meta(get_the_ID(), 'testimonial_author', true);
			$testimonial_author_position =  get_post_meta(get_the_ID(), 'testimonial_author_position', true);
			$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');

			$str .= '<div class="testimonial-container">
							<div class="testimonial-icon">
								<i class="fa fa-comments"></i>
							</div>
							<div class="testimonial-content">
							'.get_the_content().'
							</div>';
			if($featured_img_url != ''){							
				$str .= '<div class="testimonial-user-img">
								<img src="'.$featured_img_url.'" alt="'.$post_author_name.'" />
							</div>';
			}

			if($post_author_name != ''){	
				$str .= '<div class="testimonial-author">'.$post_author_name.'</div>';
			}

			if($testimonial_author_position != ''){	
				$str .= '<div class="testimonial-author-position">'.$testimonial_author_position.'</div>';
			}

			$str .= '</div>';
		}
		$str .= '</div>';
		return $str;
	}
	add_shortcode( 'we_testimonial_list', 'we_testimonial_list_shortcode' );
}

/*
 *
 *  WE Testimonial Single Shortcode
 *
 */
if (!function_exists('we_single_testimonial_shortcode')) {
	function we_single_testimonial_shortcode($atts, $content = null) {  
        extract(shortcode_atts(array( "name" => '', "id" => ''), $atts)); 

        //if post_tracks relation term was passed:
        if ($atts['name'] != ''){
        	$out = '';
            $tracks = new WP_Query(array('post_type' => 'testimonial', 'name' => $atts['name'], 'post_status' => 'publish'));
            while($tracks->have_posts()){
				
                $tracks->the_post();
                
				$post_author_name =  get_post_meta(get_the_ID(), 'testimonial_author', true);
				$testimonial_author_position =  get_post_meta(get_the_ID(), 'testimonial_author_position', true);
				$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');

                $out .= '<div class="testimonial-list">';
				$out .= '<div class="testimonial-container">
								<div class="testimonial-icon">
									<i class="fa fa-comments"></i>
								</div>
								<div class="testimonial-content">
								'.get_the_content().'
								</div>';
				if($featured_img_url != ''){							
					$out .= '<div class="testimonial-user-img">
									<img src="'.$featured_img_url.'" alt="'.$post_author_name.'" />
								</div>';
				}

				if($post_author_name != ''){	
					$out .= '<div class="testimonial-author">'.$post_author_name.'</div>';
				}

				if($testimonial_author_position != ''){	
					$out .= '<div class="testimonial-author-position">'.$testimonial_author_position.'</div>';
				}

				$out .= '</div></div>';

			}
            return $out;
        }

        //if its a single track you want:
        $tracks = new WP_Query(array('post_type' => 'testimonial', 'post_status' => 'publish', 'post__in' => array($id) ));
		
            while($tracks->have_posts()){
                $tracks->the_post();
                
                $post_author_name =  get_post_meta(get_the_ID(), 'testimonial_author', true);
				$testimonial_author_position =  get_post_meta(get_the_ID(), 'testimonial_author_position', true);
				$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');

                $out .= '<div class="testimonial-list">';
				$out .= '<div class="testimonial-container">
								<div class="testimonial-icon">
									<i class="fa fa-comments"></i>
								</div>
								<div class="testimonial-content">
								'.get_the_content().'
								</div>';
				if($featured_img_url != ''){							
					$out .= '<div class="testimonial-user-img">
									<img src="'.$featured_img_url.'" alt="'.$post_author_name.'" />
								</div>';
				}

				if($post_author_name != ''){	
					$out .= '<div class="testimonial-author">'.$post_author_name.'</div>';
				}

				if($testimonial_author_position != ''){	
					$out .= '<div class="testimonial-author-position">'.$testimonial_author_position.'</div>';
				}

				$out .= '</div></div>';
            }
        return $out;
	}  

	add_shortcode('we_single_testimonial','we_single_testimonial_shortcode');
}