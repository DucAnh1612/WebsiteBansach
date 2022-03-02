<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Woo_MoMo_Payment_Gateway')) :
    class Woo_MoMo_Payment_Gateway extends WC_Payment_Gateway
    {
        /**
         * Woo_MoMo_Payment_Gateway constructor.
         */
        public function __construct()
        {

            $this->id = 'woo_momo';
            $this->has_fields = false;
            $this->method_title = __('Ví điện tử MoMo', 'woo-momo');
            $this->method_description = __('Thực hiện thanh toán qua ví điện tử MoMo, sử dụng tài khoản cá nhân để nhận thanh toán.', 'woo-momo');

            // Load the settings.
            $this->init_form_fields();
            $this->init_settings();

            // Define user set variables
            $this->title = $this->get_option('title');
            $this->description = $this->get_option('description');
            $this->instructions = "";

            // Process the admin options
            add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
            add_action('woocommerce_thankyou_' . $this->id, array($this, 'momo_return_qr_code'));
            add_filter('woocommerce_order_button_text', array($this, 'order_button_name'));

        }

        public function init_form_fields()
        {
            $this->form_fields = include('momo/momo-settings.php');
        }


        /**
         * Output for the order received page.
         * @param $order_id
         */

        public function momo_return_qr_code($order_id)
        {
            $arrContextOptions = array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );
            $woo_momo_data = get_option('woo_momo');
            $ecc = $woo_momo_data['qr_code_ecc'];
            $size = $woo_momo_data['qr_code_size'];
            $order = wc_get_order($order_id);
            $phone = $this->get_option('phone');
            $account = $this->get_option('account');
            $email = $this->get_option('email');
            $content = $this->get_option('content');
            $total_price = number_format($order->get_total(), 0, "", "");
            $fileName = 'qr-code-order-' . $order_id . '-' . $ecc . '.png';
            $tempDir = WOO_MOMO_PLUGIN_PATH . 'data/qrcode/';
            $pngAbsoluteFilePath = $tempDir . $fileName;
            $urlRelativeFilePath = WOO_MOMO_PLUGIN_URL . 'data/qrcode/' . $fileName;
            $codeContents = "2|99|" . $phone . "|" . $account . "|" . $email . "|0|0|" . $total_price;
            if (!file_exists($pngAbsoluteFilePath)) {
                QRcode::png($codeContents, $pngAbsoluteFilePath, $ecc, $size, 2);
            }
            $qr_img_src = preg_replace("/ /", "%20", $urlRelativeFilePath);
            $img_src = file_get_contents($qr_img_src, false, stream_context_create($arrContextOptions));
            $imageData = base64_encode($img_src);
            $array = array(
                '{{qrcode}}' => '<img src="data:image/png;base64, ' . $imageData . '">',
                '{{orderid}}' => $order_id
            );
            echo wpautop(strtr($content, $array));
        }

        /**
         * @param int $order_id
         * @return array
         */
        public function process_payment($order_id)
        {

            $order = wc_get_order($order_id);
            // Mark as on-hold (we're awaiting the payment)
            $order->update_status('on-hold', __('Tạm giữ', 'woo-momo'));
            // Reduce stock levels
            $order->reduce_order_stock();
            // Remove cart
            WC()->cart->empty_cart();
            // Return thankyou redirect
            return array(
                'result' => 'success',
                'redirect' => $this->get_return_url($order)
            );
        }

        /**
         * @param $order_button_name
         * @return string
         */
        public function order_button_name($order_button_name)
        {
            $chosen_payment_method = WC()->session->get('chosen_payment_method');
            if ($chosen_payment_method == 'woo_momo') {
                $order_button_name = $this->get_option('button_label');;
            } ?>
            <script type="text/javascript">
                (function ($) {
                    $('form.checkout').on('change', 'input[name^="payment_method"]', function () {
                        var t = {
                            updateTimer: !1, dirtyInput: !1,
                            reset_update_checkout_timer: function () {
                                clearTimeout(t.updateTimer)
                            }, trigger_update_checkout: function () {
                                t.reset_update_checkout_timer(), t.dirtyInput = !1,
                                    $(document.body).trigger("update_checkout")
                            }
                        };
                        t.trigger_update_checkout();
                    });
                })(jQuery);
            </script><?php
            return $order_button_name;
        }

        /**
         * @return bool
         */
        public function isValidCurrency()
        {
            return in_array(get_woocommerce_currency(), array('VND'));
        }

        public function admin_options()
        {
            if ($this->isValidCurrency()) {
                parent::admin_options();
            } else {
                ?>
                <div class="inline error">
                    <p>
                        <strong><?php _e('Phương thức thanh toán không khả dụng', 'woo-momo'); ?></strong>:
                        <?php _e('MoMo không hỗ trợ đơn vị tiền tệ của bạn. Hiện tại, MoMo chỉ hỗ trợ đơn vị tiền tệ Việt Nam Đồng (VND).', 'woo-momo'); ?>
                    </p>
                </div>
                <?php
            }
        }
    }
endif;
