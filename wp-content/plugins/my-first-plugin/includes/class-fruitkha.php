<?php
if ( ! class_exists( 'Fruits_Cpt' ) ) :
   
   class Fruits_Cpt {
     function __construct() {
        //load actions
        add_action( 'init', array( $this, 'fruits_cpt') );
        add_action( 'init', array( $this, 'fruit_category_taxonomy' ) );
     }

      /**
	 * Register our Fruits Custom Post Type
	 *
	 * @return void
	 */
    public function fruits_cpt() {
        $labels = array(
            'name'                  => _x( 'Fruits', 'Post type general name', 'softuni' ),
            'singular_name'         => _x( 'Fruit', 'Post type singular name', 'softuni' ),
            'menu_name'             => _x( 'Fruits', 'Admin Menu text', 'softuni' ),
            'name_admin_bar'        => _x( 'Fruit', 'Add New on Toolbar', 'softuni' ),
            'add_new'               => __( 'Add New', 'softuni' ),
            'add_new_item'          => __( 'Add New Fruit', 'softuni' ),
            'new_item'              => __( 'New Fruit', 'softuni' ),
            'edit_item'             => __( 'Edit Fruit', 'softuni' ),
            'view_item'             => __( 'View Fruit', 'softuni' ),
            'all_items'             => __( 'All Fruits', 'softuni' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array(
                'title',
                'editor',
                'author',
                'thumbnail',
                'revisions',
            ),
            'show_in_rest'       => true
        );

        register_post_type( 'fruit', $args );
     }

     /**
	 * Register our Category taxonomy for our Fruits CPT
	 *
	 * @return void
	 */
	public function fruit_category_taxonomy () {
		$labels = array(
			'name'          => 'Categories',
			'singular_name' => 'Category',

		);

		$args = array(
			'labels'       => $labels,
			'show_in_rest' => true,
			'hierarchical' => true,
		);

		register_taxonomy( 'fruit-category', 'fruit', $args );
	}
   }

$fruits_cpt = new Fruits_Cpt;

endif;

