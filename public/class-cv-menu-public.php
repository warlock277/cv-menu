<?php

class Cv_Menu_Public {

	private $cv_menu;

	private $version;

	public function __construct( $cv_menu, $version ) {

		$this->cv_menu = $cv_menu;
		$this->version = $version;

	}

	public function enqueue_styles() {



        wp_enqueue_style( $this->cv_menu.'fontello', plugin_dir_url( __FILE__ ) . 'fontello/css/fontello.css', array(), $this->version, 'all' );

        wp_enqueue_style( $this->cv_menu.'roboto', '//fonts.googleapis.com/css?family=Lato|Roboto&display=swap', array(), $this->version, 'all' );

        wp_enqueue_style( $this->cv_menu.'core', plugin_dir_url( __FILE__ ) . 'css/cv-menu-public.css', array(), $this->version, 'all' );

	}

	public function enqueue_scripts() {

        wp_enqueue_script( $this->cv_menu.'mt', plugin_dir_url( __FILE__ ) . 'js/materialize.min.js', array( 'jquery' ), $this->version, false );

        wp_enqueue_script( $this->cv_menu.'core', plugin_dir_url( __FILE__ ) . 'js/cv-menu-public.js', array( 'jquery' ), $this->version, false );

	}

	public function render_menu(){

        $showtop = $this->prefix_get_option('showtop','cvmenu_basic');
        $topcontent = $this->prefix_get_option('topcontent','cvmenu_basic');
        $menu_select = $this->prefix_get_option('menu-select','cvmenu_basic');
        $showheader = $this->prefix_get_option('showheader','cvmenu_header');
        $logotext = $this->prefix_get_option('logo-text','cvmenu_header',get_bloginfo('name'));
        $headertype = $this->prefix_get_option('header-type','cvmenu_header','text');
        $logo = $this->prefix_get_option('logo','cvmenu_header');
        $showsearch = $this->prefix_get_option('showsearch','cvmenu_basic','on');

        $html = '<ul id="%1$s" class="%2$s"><li>';
        if($showtop == 'on') {
            $html .= '<div class="user-view">';
            $html .= $topcontent;
            $html .= ' <form action="'.esc_url( home_url() ).'" class="responsive-menu-search-form" role="search">
                <input type="search" name="s" title="Search"
                       placeholder="'.esc_attr_x( 'Search &hellip;','placeholder','cv-menu' ).'"
                       value="'.get_search_query().'"
                       class="cv-menu-search-box">
                <button type="submit" class="search-submit"><i class="icon icon-search"></i></button>
            </form>';
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
                    'menu_class' => 'drawer-nav',
                    'menu_id' => 'slide-out',
                    'items_wrap' => $html,
                )
            );
        }
            ?>

        <?php if($showheader == 'on') { ?>
            <div class="cv-menu-header">
            <a href="<?php echo site_url(); ?>">
            <p>
                <?php
                if($headertype == 'text') {
                    echo esc_attr__($logotext);
                }
                else{ ?>
                    <img src="<?php echo $logo ?>" alt="cv-menu-logo">
            <?php
                }
                ?>
            </p>
            </a>

        <?php } ?>

		<a href="#" data-target="slide-out" class="drawer-nav-trigger sidenav-trigger"><div class="nav-icon"><span></span></div></a>

        <?php if($showsearch == 'on') { ?>

            <a href="#" class="drwaer-nav-search-trigger">
                <i class="icon icon-search"></i>
            </a>
        <div id="cv-menu-search-box">
            <form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="responsive-menu-search-form" role="search">
                <input type="search" name="s" title="Search"
                       placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'cv-menu' ); ?>"
                       value="<?php echo get_search_query(); ?>"
                       class="cv-menu-search-box">
                <button type="submit" class="search-submit"><i class="icon icon-search"></i></button>
            </form>
        </div>

        <?php } ?>

		<?php if($showheader == 'on') { ?>

            </div>

        <?php } ?>

		<a class="drawer-nav-close sidenav-close" href="javascript:void(0);" style="top: -100px;"><div class="nav-icon"><span></span></div></a>



        <?php

    }

    public function render_styles()
    {
        $button_position = $this->prefix_get_option('button-position','cvmenu_basic','left');
        $direction = $this->prefix_get_option('direction','cvmenu_basic');
        $closeposition = ($direction == 'left') ? 'right': 'left';
        $bgcolor = $this->prefix_get_option('bgcolor','cvmenu_color');
        $btncolor = $this->prefix_get_option('button-color','cvmenu_color');
        $btnbgcolor = $this->prefix_get_option('button-bg-color','cvmenu_color','#fff');
        $itemcolor = $this->prefix_get_option('itemcolor','cvmenu_color');
        $itembgcolor = $this->prefix_get_option('itembgcolor','cvmenu_color');
        $hideelem = $this->prefix_get_option('hideelem','cvmenu_basic','');
        $hideelem = explode(',',$hideelem);
        $showheader = $this->prefix_get_option('showheader','cvmenu_header');

        $primarycolor = $this->prefix_get_option('primary-color','cvmenu_color','#333333');
        $secondarycolor = $this->prefix_get_option('secondary-color','cvmenu_color','#f1f1f1');


        ?>
        <style>
            a.drawer-nav-trigger {
                <?php echo $button_position;?>:15px;
            }
            a.drawer-nav-close {
            <?php echo $closeposition;?>:0;
            }
            .cv-menu-primary-navigation ul {
                background-color: <?php echo $secondarycolor;?>;
            }
            .cv-menu-primary-navigation ul li a {
                color: <?php echo $primarycolor;?>;
            }
            .cv-menu-primary-navigation ul li {
                background-color: <?php echo $secondarycolor;?>;
            }
            /*a.drawer-nav-trigger {*/
            /**/
            /*    border-color: */<?php //echo $btncolor?>/*;*/
            /*}*/
            a.drawer-nav-trigger {
                /*background-color: */<?php //echo $btnbgcolor?>/*;*/
            }
            a.drawer-nav-trigger .nav-icon:after, a.drawer-nav-trigger .nav-icon:before, a.drawer-nav-trigger .nav-icon span {
                background-color: <?php echo $primarycolor?>;
            }
            .cv-menu-primary-navigation ul li.menu-item-has-children span.sub-holder:before {
                border-color: <?php echo $primarycolor?>;
            }
            .cv-menu-header p {
                color: <?php echo $primarycolor;?>;
            }
            div#cv-menu-search-box form button {
                color: <?php echo $primarycolor;?>;
            }
            div#cv-menu-search-box form input {
                border-color: <?php echo $primarycolor;?>2b;
            }
            ul#slide-out form button {
                color: <?php echo $primarycolor;?>;
            }
            .cv-menu-primary-navigation ul li {
                border-top: 1px solid #d8d8d8;
            }
            .cv-menu-header {
                background-color: <?php echo $secondarycolor;?>;
            }
            <?php
            foreach ($hideelem as $el) {
                echo $el.' { display:none !important; }';
            }
            ?>
            <?php
            if($showheader){
            ?>
            body {
                padding-top: 60px;
            }
            <?php
            }
            ?>
            a.drwaer-nav-search-trigger {
                color: <?php echo $primarycolor?>;
            }
            .drawer-nav .user-view {
                color: <?php echo $primarycolor?>;
            }
        </style>
        <?php

    }

    public function render_scripts()
    {
        $direction = $this->prefix_get_option('direction','cvmenu_basic');
        $menu_select = $this->prefix_get_option('menu-select','cvmenu_basic');
        $allowswipe = $this->prefix_get_option('allowswipe','cvmenu_basic','on');
        $allowswipe = ($allowswipe == 'on') ? 'true' : 'false';
        if($menu_select != '') {

            ?>
            <script>
                (function ($) {

                    $(document).ready(function () {
                        var elems = document.querySelectorAll('.drawer-nav');
                        var instances = M.Sidenav.init(elems, {
                            onCloseStart: function (e) {
                                $('a.drawer-nav-trigger').removeClass('open');
                                $('a.drawer-nav-close').css('top', '-100px');
                            },
                            onOpenEnd: function () {
                                $('a.drawer-nav-close').css('top', '0');
                                $('a.drawer-nav-close').css('opacity', 1);

                            },
                            edge: '<?php echo $direction; ?>',
                            draggable: <?php echo $allowswipe; ?>
                        });
                        $('a.drawer-nav-close').css('top', '-100px');

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
