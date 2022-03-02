<?php

if (!class_exists('Woo_MoMo_Option_Page')) :
    class Woo_MoMo_Option_Page
    {
        private $Woo_MoMo_Options;

        public function __construct()
        {
            add_action('admin_menu', array($this, 'register_options_page'));
            register_activation_hook(__FILE__, array($this, 'option_page_data'));
            $this->Woo_MoMo_Options = get_option('woo_momo');
        }

        function register_options_page()
        {
            add_options_page('MoMo for WooCommerce', 'Woo MoMo', 'manage_options', 'momo-for-woo-option', array(
                $this,
                'option_page'
            ));
        }

        function option_page()
        {
            require_once('admin/option-page.php');
        }

        function option_page_data()
        {
            $Woo_MoMo_Options = array();
            $Woo_MoMo_Options["license_key"] = "";
            add_option('woo_momo', $Woo_MoMo_Options);
        }
    }

endif;
