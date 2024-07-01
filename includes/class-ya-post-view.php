<?php
/**
 * Post View Counter
 *
 *  Copyright @ 2023 Alexander Yudaev
 *  https://www.alechko.name
 *  https://ya.digital
 *
 * Class Used for display post view counter
 *
 * @package aname
 * @since 21.11.0
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'YA_Posts_View' ) ) {
    /**
     * CUSTOM POST VIEW TRACKING AND DISPLAY
     * This class handles tracking and displaying post views in WordPress.
     */
    class YA_Posts_View {

        /**
         * Contains YA_Posts_View version number
         *
         * @var string
         */
        private static $version = '1.0.0';

        /**
         * Contains YA_Posts_View main meta key
         *
         * @var string
         */
        public static $meta_key = 'ya_post_view';

        /**
         * Constructor
         * Registers actions and filters for post view tracking and display.
         */
        function __construct() {
            // AJAX action for incrementing post views
            add_action('wp_ajax_ya_increment_post_view', array($this, 'ajax_update_post_view'));
            add_action('wp_ajax_nopriv_ya_increment_post_view', array($this, 'ajax_update_post_view'));

            // Add custom column for post views in the admin dashboard
            add_action('admin_head', array($this, 'add_custom_column_style'));
            add_filter('manage_posts_columns',  array($this, 'add_custom_column'));
            add_action('manage_posts_custom_column', array($this, 'add_custom_column_counter'), 10, 2);
            add_filter('manage_pages_columns', array($this, 'add_custom_column'));
            add_action('manage_pages_custom_column', array($this, 'add_custom_column_counter'), 10, 2);

            // Add AJAX code to increment post views in the footer
            add_action('wp_footer', array($this, 'add_ajax_footer_code'));
        }

        /**
         * AJAX callback to increment post views
         */
        function ajax_update_post_view() {
            $post_id = intval($_GET['post_id']);
            $nonce = $_REQUEST['nonce'];

            if(empty($_REQUEST['nonce']) || empty($_GET['post_id']) ) {
                wp_send_json_error();
                die();
            }

            if( !wp_verify_nonce( $nonce,"update_counter-{$post_id}" )) {
                wp_send_json_error();
                die();
            }

            $this->increment_post_view($post_id);
            wp_send_json_success();
            die();
        }

        /**
         * Increments the post view count
         *
         * @param int $post_id The ID of the post being viewed
         */
        function increment_post_view($post_id){
            $post = get_post( $post_id );
            if ( ! $post instanceof WP_Post ) {
                die();
            }

            $current_counter = get_post_meta($post_id, self::$meta_key, true);
            $current_counter++;
            update_post_meta($post_id, self::$meta_key, $current_counter);
            wp_send_json_success();
            die();
        }

        /**
         * Adds a custom column for post views in the admin dashboard
         *
         * @param array $columns The existing columns in the admin dashboard
         * @return array $columns The modified columns
         */
        function add_custom_column($columns){
            $html = '<span class="dash-icon dashicons dashicons-chart-bar" title="' . esc_attr__('Post Views', 'ya') . '">'
                . '<span class="screen-reader-text">' . esc_attr__('Post Views', 'ya') . '</span>'
                . '</span>';
            $columns['ya_post_view'] = $html;
            return $columns;
        }

        /**
         * Displays the post view count in the custom column
         *
         * @param string $column The current column being displayed
         * @param int $post_id The ID of the post being displayed
         */
        function add_custom_column_counter($column, $post_id) {
            if ($column === 'ya_post_view') {
                $page_views = get_post_meta($post_id, self::$meta_key, true);
                echo ($page_views) ? $page_views : '0';
            }
        }

        /**
         * Adds custom CSS style for the admin dashboard column
         */
        function add_custom_column_style() {
            echo '<style>
                    .column-ya_posts_views {
                        text-align: center;
                        width: 3em;
                    }
                </style>';
        }

        /**
         * Adds AJAX code to increment post views in the footer
         */
        function add_ajax_footer_code(){
            if (is_single() || is_page()) {
                $post_id = get_the_ID();
                $query_params = array(
                    'action' => 'ya_increment_post_view',
                    'post_id' => $post_id,
                    'nonce' => wp_create_nonce('update_counter-' . $post_id)
                );

                echo "<script>fetch(`" . admin_url('admin-ajax.php') . "?" . http_build_query($query_params) . "`)</script>";
            }
        }
    }
}

// Initialize the YA_Posts_View class
return new YA_Posts_View();
