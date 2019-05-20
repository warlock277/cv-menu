<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Cv_Menu
 * @subpackage Cv_Menu/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Cv_Menu
 * @subpackage Cv_Menu/public
 * @author     Your Name <email@example.com>
 */
class Cv_Menu_Public {

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

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $cv_menu       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $cv_menu, $version ) {

		$this->cv_menu = $cv_menu;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->cv_menu.'core', plugin_dir_url( __FILE__ ) . 'css/cv-menu-public.css', array(), $this->version, 'all' );

        //wp_enqueue_style( $this->cv_menu.'mt', plugin_dir_url( __FILE__ ) . 'css/materialize.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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



        wp_enqueue_script( $this->cv_menu.'mt', plugin_dir_url( __FILE__ ) . 'js/materialize.min.js', array( 'jquery' ), $this->version, false );

        wp_enqueue_script( $this->cv_menu.'core', plugin_dir_url( __FILE__ ) . 'js/cv-menu-public.js', array( 'jquery' ), $this->version, false );

	}

	public function render_menu(){
        $topbg = $this->prefix_get_option('topbg','cvmenu_basic');
        $showtop = $this->prefix_get_option('showtop','cvmenu_basic');
        $topcontent = $this->prefix_get_option('topcontent','cvmenu_basic');
        $menu_select = $this->prefix_get_option('menu-select','cvmenu_basic');

        $html = '<ul id="%1$s" class="%2$s">			<li>';
        if($showtop == 'on') {
            $html .= '<div class="user-view">';
            if($topbg != '') {
                $html .= '<div class="background"><img src="'.$topbg.'" alt="cv-menu"></div>';
            }
			$html .= $topcontent;
            $html .= '</div>';
        }

		$html .= '</li>%3$s</ul>';
        if($menu_select != '') {
            wp_nav_menu(
                array(
                    'theme_location' => $menu_select,
                    'container_class' => 'cv-menu-primary-navigation',
                    'menu' => '',
                    'container' => 'div',
                    'container_id' => '',
                    'menu_class' => 'sidenav',
                    'menu_id' => 'slide-out',
                    'items_wrap' => $html,
                )
            );
        }
            ?>

		<a href="#" data-target="slide-out" class="sidenav-trigger"><div class="nav-icon"><span></span></div></a>
		<a class="sidenav-close" href="#!"><div class="nav-icon"><span></span></div></a>



        <?php

    }

    public function render_styles()
    {
        $button_position = $this->prefix_get_option('button-position','cvmenu_basic');
        $bgcolor = $this->prefix_get_option('bgcolor','cvmenu_basic');
        $btncolor = $this->prefix_get_option('button-color','cvmenu_basic');
        $btnbgcolor = $this->prefix_get_option('button-bg-color','cvmenu_basic','#fff');
        $itemcolor = $this->prefix_get_option('itemcolor','cvmenu_basic');
        $itembgcolor = $this->prefix_get_option('itembgcolor','cvmenu_basic');

        ?>
        <style>
            a.sidenav-trigger {
                <?php echo $button_position;?>:15px;
            }
            .cv-menu-primary-navigation ul {
                background-color: <?php echo $bgcolor;?>;
            }
            .cv-menu-primary-navigation ul li a {
                color: <?php echo $itemcolor;?>;
            }
            .cv-menu-primary-navigation ul li {
                background-color: <?php echo $itembgcolor;?>;
            }
            a.sidenav-trigger {
                border: 2px solid <?php echo $btncolor?>;
            }
            a.sidenav-trigger {
                background-color: <?php echo $btnbgcolor?>;
            }
            a.sidenav-trigger .nav-icon:after, a.sidenav-trigger .nav-icon:before, a.sidenav-trigger .nav-icon span {
                background-color: <?php echo $btncolor?>;
            }
        </style>
        <?php

    }

    public function render_scripts()
    {
        $direction = $this->prefix_get_option('direction','cvmenu_basic');
        $menu_select = $this->prefix_get_option('menu-select','cvmenu_basic');
        if($menu_select != '') {

            ?>
            <script>
                (function ($) {
                    "use strict";
                    $(document).ready(function () {
                        var elems = document.querySelectorAll('.sidenav');
                        var instances = M.Sidenav.init(elems, {
                            onCloseStart: function (e) {
                                $('a.sidenav-trigger').removeClass('open');
                                $('a.sidenav-close').css('top', '-100px');
                            },
                            onOpenEnd: function () {
                                $('a.sidenav-close').css('top', '0');
                                $('a.sidenav-close').css('opacity', 1);
                            },
                            edge: '<?php echo $direction; ?>'
                        });
                        $('a.sidenav-close').css('top', '-100px');
                    });


                })(jQuery);
            </script>
            <?php
        }
    }


    /**
     * Get the value of a settings field
     *
     * @param string $option settings field name
     * @param string $section the section name this field belongs to
     * @param string $default default text if it's not found
     *
     * @return mixed
     */
    public function prefix_get_option( $option, $section, $default = '' ) {

        $options = get_option( $section );

        if ( isset( $options[$option] ) ) {
            return $options[$option];
        }

        return $default;
    }

}
