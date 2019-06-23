<?php

/**
 *
 * @wordpress-plugin
 * Plugin Name:       SlideNav - Responsive Mobile Menu for Wordpress
 * Plugin URI:        http://charuvision.com/slide-nav/
 * Description:       Responsive Android Navigation Drawer style wordpress mobile menu.
 * Version:           1.0.0
 * Author:            Kazi Shiplu
 * Author URI:        https://profiles.wordpress.org/kazishiplu/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cv-menu
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Currently plugin version.
 */
define( 'CV_MENU_VERSION', '1.0.0' );

function activate_cv_menu() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-cv-menu-activator.php';
    Cv_Menu_Activator::activate();
}

function deactivate_cv_menu() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-cv-menu-deactivator.php';
    Cv_Menu_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cv_menu' );
register_deactivation_hook( __FILE__, 'deactivate_cv_menu' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cv-menu.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cv_menu() {

    $plugin = new Cv_Menu();
    $plugin->run();

}
run_cv_menu();
