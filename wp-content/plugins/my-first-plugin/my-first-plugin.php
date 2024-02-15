<?php
 /*
 * Plugin Name:       My First Plugin
 * Plugin URI:        https://softuni.bg
 * Description:       My first plugin for the course
 * Version:           1.0.0
 * Requires at least: 5.0
 * Requires PHP:      8.0
 * Author:            SoftUni
 * Author URI:        https://softuni.bg/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       softuni
 * Domain Path:       /languages
 */

if ( ! defined( 'FRUITKHA_PLUGIN_DIR' ) ) {
   define( 'FRUITKHA_PLUGIN_DIR', plugin_dir_path( __FILE__ ) . 'includes' );
} 

if ( ! defined( 'FRUITKHA_PLUGIN_INCLUDES_DIR' ) ) {
    define( 'FRUITKHA_PLUGIN_INCLUDES_DIR', plugin_dir_path( __FILE__ ) . 'includes' );
}

if ( ! defined( 'FRUITKHA_PLUGIN_ASSETS_DIR' ) ) {
    define( 'FRUITKHA_PLUGIN_ASSETS_DIR', plugins_url( 'assets', __FILE__ ) );
}

// load our important files
require FRUITKHA_PLUGIN_INCLUDES_DIR . '/functions.php' ;
require FRUITKHA_PLUGIN_INCLUDES_DIR . '/class-fruitkha.php' ;