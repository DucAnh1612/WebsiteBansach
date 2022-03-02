<?php
/**
 * Plugin Name: MoMo for WooCommerce
 * Author: Nhựt FS
 * Author URI: https://nhutfs.net
 * Description: Add MoMo payment gateway for WooCommerce
 * Version: 1.0.2
 * Text Domain: woo-momo
 */
if (!defined('ABSPATH')) {
    exit;
}

if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    return;
}

if (!class_exists('WooMoMo')) :
    class WooMoMo
    {
        protected $Option_Page;

        /**
         * WooMoMo constructor.
         */
        function __construct()
        {
            add_action('init', array($this, 'initialize'));
        }

        /**
         * WooMoMo initialize.
         */
        function initialize()
        {
            // defines
            $this->define('WOO_MOMO_PLUGIN_PATH', plugin_dir_path(__FILE__));
            $this->define('WOO_MOMO_PLUGIN_URL', plugin_dir_url(__FILE__));
            $this->define('WOO_MOMO_PLUGIN_BASENAME', plugin_basename(__FILE__));
            $this->define('WOO_MOMO_PRODUCT_ID', "woo-momo");

            // add the admin option page
            $this->woo_momo_include('includes/class-woo-momo-payment-gateway.php');
            $this->woo_momo_include('includes/phpqrcode/qrlib.php');
            if (is_admin()) {
                $this->woo_momo_include('includes/class-woo-momo-option-page.php');
                $this->Option_Page = new Woo_MoMo_Option_Page();
            }

            //
            add_filter('woocommerce_payment_gateways', array($this, 'add_gateway_class'));
            add_filter('plugin_action_links_' . WOO_MOMO_PLUGIN_BASENAME, array($this, 'add_settings_link'));
            add_filter('plugin_row_meta', array($this, 'woo_momo_plugin_row_meta'), 10, 2);

        }

        /**
         * define
         *
         * @param $name
         * @param bool $value
         */
        function define($name, $value = true)
        {
            if (!defined($name)) {
                define($name, $value);
            }
        }

        /**
         * get path
         *
         * @param string $path
         *
         * @return string
         */
        function get_path($path = '')
        {
            return WOO_MOMO_PLUGIN_PATH . $path;
        }

        /**
         * include
         *
         * @param $file
         */
        function woo_momo_include($file)
        {
            $path = $this->get_path($file);
            if (file_exists($path)) {
                include_once($path);
            }
        }

        /**
         * @param $methods
         * @return array
         */
        public function add_gateway_class($methods)
        {
            $methods[] = 'Woo_MoMo_Payment_Gateway';
            return $methods;
        }

        /**
         * @param $links
         * @return array
         */
        public function add_settings_link($links)
        {
            $plugin_links = array(
                '<a href="' . admin_url('admin.php?page=wc-settings&tab=checkout&section=woo_momo') . '">' . __('Thiết lập', 'woo-momo') . '</a>'
            );
            return array_merge($plugin_links, $links);
        }

        /**
         * @param $links
         * @param $file
         * @return array
         */
        public function woo_momo_plugin_row_meta($links, $file)
        {
            if (WOO_MOMO_PLUGIN_BASENAME === $file) {
                $row_meta = array(
                    'store' => '<a href="' . esc_url(apply_filters('store_url', 'https://store.nhutfs.net/')) . '" aria-label="' . esc_attr__('Nhựt FS Store', 'woo-momo') . '">' . esc_html__('Cửa hàng', 'woo-momo') . '</a>',
                    'docs' => '<a href="' . esc_url(apply_filters('docs_url', 'https://store.nhutfs.net/product/momo-payment-for-woocommerce/')) . '" aria-label="' . esc_attr__('Xem hướng dẫn sử dụng', 'woo-momo') . '">' . esc_html__('Hướng dẫn', 'woo-momo') . '</a>'
                );

                return array_merge($links, $row_meta);
            }
            return (array)$links;
        }
    }

    new WooMoMo();
endif;