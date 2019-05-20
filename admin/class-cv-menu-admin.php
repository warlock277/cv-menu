<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Cv_Menu
 * @subpackage Cv_Menu/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cv_Menu
 * @subpackage Cv_Menu/admin
 * @author     Your Name <email@example.com>
 */
class Cv_Menu_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $cv_menu    The ID of this plugin.
	 */
	private $cv_menu;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

    private $settings_api;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $cv_menu       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $cv_menu, $version ) {

		$this->cv_menu = $cv_menu;
		$this->version = $version;

        $this->settings_api = new WeDevs_Settings_API;
        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );

        add_filter('admin_notices', array($this, 'admin_notice'));

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cv_Menu_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cv_Menu_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->cv_menu, plugin_dir_url( __FILE__ ) . 'css/cv-menu-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cv_Menu_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cv_Menu_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->cv_menu, plugin_dir_url( __FILE__ ) . 'js/cv-menu-admin.js', array( 'jquery' ), $this->version, false );

	}

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_options_page( 'Settings API', 'Settings API', 'delete_posts', 'settings_api_test', array($this, 'plugin_page') );
        add_menu_page( 'Mobile Menu', 'Mobile Menu', 'delete_posts', 'cv_menu', array($this, 'plugin_page') );
    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id'    => 'cvmenu_basic',
                'title' => __( 'Basic Settings', 'cv-menu' )
            )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {

        $settings_fields = array(
            'cvmenu_basic' => array(
                array(
                    'name'    => 'menu-select',
                    'label'   => __( 'Select Menu to replace', 'cv-menu' ),
                    'desc'    => __( 'First Select Menu From Appearance > Menu', 'cv-menu' ),
                    'type'    => 'select',
                    'options' => $this->get_nav_menus(),
                    'default' => 'primary'
                ),
                array(
                    'name'    => 'button-position',
                    'label'   => __( 'Menu Button Position', 'cv-menu' ),
                    'desc'    => __( 'burger menu position left or right', 'cv-menu' ),
                    'type'    => 'radio',
                    'options' => array(
                        'left' => 'Left',
                        'right'  => 'Right'
                    ),
                    'default' => 'right'
                ),
                array(
                    'name'    => 'button-color',
                    'label'   => __( 'Button Color', 'cv-menu' ),
                    'type'    => 'color',
                    'default' => '#222'
                ),
                array(
                    'name'    => 'button-bg-color',
                    'label'   => __( 'Button Background Color', 'cv-menu' ),
                    'type'    => 'color',
                    'default' => '#fff'
                ),
                array(
                    'name'    => 'direction',
                    'label'   => __( 'Menu Entry Direction', 'cv-menu' ),
                    'desc'    => __( 'Entry Direction Left or Right', 'cv-menu' ),
                    'type'    => 'radio',
                    'options' => array(
                        'left' => 'Left',
                        'right'  => 'Right'
                    ),
                    'default' => 'left'
                ),
                array(
                    'name'    => 'bgcolor',
                    'label'   => __( 'Background Color', 'cv-menu' ),
                    'type'    => 'color',
                    'default' => '#fff'
                ),
                array(
                    'name'    => 'itemcolor',
                    'label'   => __( 'Menu Item Color', 'cv-menu' ),
                    'type'    => 'color',
                    'default' => '#666'
                ),
                array(
                    'name'    => 'itembgcolor',
                    'label'   => __( 'Menu Item Background Color', 'cv-menu' ),
                    'type'    => 'color',
                    'default' => '#00000008'
                ),
                array(
                    'name'    => 'topbg',
                    'label'   => __( 'Top Section Background', 'cv-menu' ),
                    'type'    => 'file',
                    'default' => 'http://materializecss.com/images/office.jpg',
                    'options' => array(
                        'button_label' => 'Choose Image'
                    )
                ),
                array(
                    'name'  => 'showtop',
                    'label' => __( 'Show Top Section', 'wedevs' ),
                    'type'  => 'checkbox',
                    'default' => 'on'
                ),
                array(
                    'name'    => 'topcontent',
                    'label'   => __( 'Top Section Content', 'wedevs' ),
                    'type'    => 'wysiwyg',
                    'default' => get_bloginfo('name')
                )
            )
        );

        return $settings_fields;
    }

    function plugin_page() {
        echo '<div class="wrap">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

    function prefix_get_option( $option, $section, $default = '' ) {

        $options = get_option( $section );

        if ( isset( $options[$option] ) ) {
            return $options[$option];
        }

        return $default;
    }

    public function admin_notice()
    {

        if(count($this->get_nav_menus()) < 1){
            $message = '<h2>WP Mobile Menu</h2>';
            $message .= '<h4>Please Assign a Menu first. <a href="nav-menus.php">Assign Menu</a></h4>';
            ?>
            <div class="notice error notice-errors is-dismissible">
                <?php echo $message; ?>
            </div>
            <?php
        }else{
            $menu_select = $this->prefix_get_option('menu-select','cvmenu_basic');

            if($menu_select == ''){
                $message = '<h2>WP Mobile Menu</h2>';
                $message .= '<h4>Please Select The Menu to Replace with Mobile Menu! <a href="admin.php?page=cv_menu">Select Menu</a></h4>';

                ?>
                <div class="notice error notice-errors is-dismissible">
                    <?php echo $message; ?>
                </div>
                <?php
            }
        }

    }


    public function get_nav_menus()
    {
        $location = get_nav_menu_locations();
        $locations=[];
        foreach ($location as $key => $value){
            $locations[$key]=strtoupper($key);
        }
        return $locations;
    }

}
