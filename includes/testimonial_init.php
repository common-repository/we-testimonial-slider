<?php
if (!defined('ABSPATH')) die();
/*
 *
 *  WE Testimonial Register Testimonial Post Type
 *
 */
if (!function_exists('we_testimonial_init')) {
	function we_testimonial_init(){
		register_post_type( 'testimonial',
			array(
				'labels' => array(			
					'name'			=> 'Testimonials',
					'singular_name' => 'Testimonial',
					'add_new'		=> 'Add new',
					'add_new_item'	=> 'Add New Testimonial',
					'edit_item'		=> 'Edit Testimonial',
					'new_item'		=> 'New Testimonial',
					'not_found'		=> 'No Testimonials Found',
					'not_found_in_trash' => 'No testimonials found in Trash',
					'menu_name'		=> 'Testimonials',
				),

				'description' => 'Manipulating with testimonials',
				'public' => true,
				'show_in_nav_menus' => true,

				'supports' => array(
					'title',
					'thumbnail',
					'editor',
					'excerpt',
					'page-attributes',
				),

				'show_ui' => true,
				'show_in_menu' => true,
				'publicly_queryable' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'query_var' => true,
				'rewrite' => array( 'slug' => '','with_front' => false ),
			)
		);
		we_testimonial_init_category();
	}
}

/*
 *
 *  WE Testimonial Generate Testimonial Category
 *
 */
if (!function_exists('we_testimonial_init_category')) {
	function we_testimonial_init_category(){
		register_taxonomy( 'testimonial-category', array( 'testimonial' ), array(
			'hierarchical' => true,
			'labels' => array(

				'name'			=> _x( 'Categories', 'taxonomy general name' ),
				'singular_name' => _x( 'Category', 'taxonomy singular name' ),
				'search_items'	=> __( 'Search Category' ),
				'all_items'		=> __( 'All Gategories' ),
				'parent_item'	=> __( 'Parent Category' ),
				'parent_item_colon' => __( 'Parent Category:' ),
				'edit_item'		=> __( 'Edit Category' ),
				'update_item'	=> __( 'Update Gategory' ),
				'add_new_item'	=> __( 'Add New Category' ),
				'new_item_name' => __( 'New Category Name' ),

			),

			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'testimonial-category' ),
			'query_var' => 'testimonial-category',

		));

		// add uncategorized term
		if(!term_exists( 'Uncategorized Testimonials', 'testimonial-category' )){
			wp_insert_term( 'Uncategorized Testimonials', 'testimonial-category' );
		}
	}
	add_action( 'init', 'we_testimonial_init');
}

/*
 *
 *  WE Testimonial Add the Custom Meta Box
 *
 */
if (!function_exists('add_tes_author_meta_box')) {
	function add_tes_author_meta_box() {
	    add_meta_box(
	        'testimonial_author', // $id
	        'Testimonial Author', // $title 
	        'we_testimonial_slider_author_meta_box', // $callback
	        'testimonial', // $page
	        'normal', // $context
	        'high' // $priority
	    ); 
	}
	add_action('add_meta_boxes', 'add_tes_author_meta_box');
}

/*
 *
 *  WE Testimonial Custom meta fields array
 *
 */
$prefix = 'we_testimonial_';
$we_testimonial_meta_fields = array(
    array(
        'label'=> 'Author Name',
        'desc'  => 'Enter testimonial author name to be displayed',
        'id'    => 'testimonial_author',
        'type'  => 'text'
    ),
    array(
        'label'=> 'Author Position',
        'desc'  => 'Enter testimonial author position to be displayed',
        'id'    => 'testimonial_author_position',
        'type'  => 'text'
    )
);

/*
 *
 *  WE Testimonial Custom meta fields array
 *
 */
if (!function_exists('we_testimonial_slider_author_meta_box')) {
	function we_testimonial_slider_author_meta_box() {
	
		global $we_testimonial_meta_fields, $post;
		// Use nonce for verification
		echo '<input type="hidden" name="we_testimonial_author_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';		 
		// Begin the field table and loop
		echo '<table class="form-table">';
		
		foreach ($we_testimonial_meta_fields as $field) {
			// get value of this field if it exists for this post
			$meta = get_post_meta($post->ID, $field['id'], true);
			// begin a table row with
			echo '<tr>
					<th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
					<td>';
					switch($field['type']) {
						// text field
						case 'text':
							echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
								<br /><span class="description">'.$field['desc'].'</span>';
						break;
			        }
			echo '</td></tr>';
		}
		echo '</table>';		
	}
}

/*
 *
 *  WE Testimonial Save the custom meta data
 *
 */
if (!function_exists('save_we_testimonial_meta')) {
	function save_we_testimonial_meta($post_id) {
		global $we_testimonial_meta_fields;     
		// verify nonce
		if (!wp_verify_nonce($_POST['we_testimonial_author_meta_box_nonce'], basename(__FILE__))) 
			return $post_id;
			
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return $post_id;
			
		// check permissions
		if ('testimonial' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id))
				return $post_id;
			} elseif (!current_user_can('edit_post', $post_id)) {
				return $post_id;
		}
		 
		// loop through fields and save the data
		foreach ($we_testimonial_meta_fields as $field) {
			$old = get_post_meta($post_id, $field['id'], true);
			$new = $_POST[$field['id']];
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
	}
	add_action('save_post', 'save_we_testimonial_meta');
}