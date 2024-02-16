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
flush_rewrite_rules();

// Add fruit category metabox
function add_fruit_category_metabox() {
    add_meta_box(
        'fruit_category_metabox',
        'Fruit Category',
        'render_fruit_category_metabox',
        'fruit', // Post type where the metabox will be displayed
        'side', // Context: 'normal', 'advanced', or 'side'
        'default' // Priority: 'high', 'core', 'default', or 'low'
    );
}
add_action('add_meta_boxes', 'add_fruit_category_metabox');

// Render the metabox content
function render_fruit_category_metabox($fruit) {
    $fruit_categories = array(
        'Strawberry',
        'Grape',
        'Kiwi',
        'Apple',
        'Raspberry'
    );

    $selected_category = get_post_meta($fruit->ID, 'fruit_category', true);

    // Output checkboxes for each fruit category
    foreach ($fruit_categories as $category) {
        $checked = ($category === $selected_category) ? 'checked' : '';
        echo "<label><input type='checkbox' name='fruit_category[]' value='$category' $checked class='fruit-checkbox'> $category</label><br>";
    }

    // Add JavaScript to ensure only one checkbox can be checked
    ?>
    <script type="text/javascript">
        var checkboxes = document.querySelectorAll('.fruit-checkbox');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                checkboxes.forEach(function(cb) {
                    if (cb !== checkbox) {
                        cb.checked = false;
                    }
                });
            });
        });
    </script>
    <?php
}

// Save the metabox data
function save_fruit_category_metabox($fruit_id) {
    if (isset($_POST['fruit_category'])) {
        $selected_categories = $_POST['fruit_category'];
        if (count($selected_categories) > 1) {
            // If more than one category is selected, only keep the last one selected
            $selected_category = end($selected_categories);
        } else {
            // If only one category is selected, use that category
            $selected_category = reset($selected_categories);
        }
        update_post_meta($fruit_id, 'fruit_category', $selected_category);
    } else {
        // If no category is selected, delete the meta
        delete_post_meta($fruit_id, 'fruit_category');
    }
}
add_action('save_post', 'save_fruit_category_metabox');

endif;