<?php

if (!defined('ABSPATH')) {
    exit;
}

return array(
    'enabled' => array(
        'title' => __('Bật/Tắt', 'woo-momo'),
        'type' => 'checkbox',
        'label' => __('Bật phương thức thanh toán', 'woo-momo'),
        'default' => 'yes'
    ),

    'title' => array(
        'title' => __('Tiêu đề', 'nfs-momo-payment-gateway'),
        'type' => 'text',
        'description' => __('Tên phương thức thanh toán.', 'woo-momo'),
        'default' => __('Ví điện tử MoMo', 'woo-momo'),
        'desc_tip' => true,
    ),

    'description' => array(
        'title' => __('Mô tả', 'woo-momo'),
        'type' => 'textarea',
        'description' => __('Mô tả phương thức thanh toán.', 'woo-momo'),
        'default' => __('Bạn cần cài đặt ứng dụng MoMo trên điện thoại di động.', 'woo-momo'),
        'desc_tip' => true,
    ),
    'button_label' => array(
        'title' => __('Nút thanh toán', 'woo-momo'),
        'type' => 'text',
        'description' => __('Thay đổi tên nút thanh toán.', 'woo-momo'),
        'default' => __('Thanh toán qua MoMo', 'woo-momo'),
        'desc_tip' => true,
    ),
    'phone' => array(
        'title' => __('Số điện thoại', 'woo-momo'),
        'type' => 'text',
        'description' => __('Số điện thoại đã đăng ký với MoMo.', 'woo-momo'),
        'desc_tip' => true,
    ),
    'account' => array(
        'title' => __('Tên tài khoản', 'woo-momo'),
        'type' => 'text',
        'description' => __('Tên chủ tài khoản MoMo.', 'woo-momo'),
        'desc_tip' => true,
    ),
    'email' => array(
        'title' => __('Email', 'woo-momo'),
        'type' => 'text',
        'description' => __('Email đã đăng ký với MoMo.', 'woo-momo'),
        'desc_tip' => true,
    ),
    'content' => array(
        'title' => __('Nội dung hiển thị', 'woo-momo'),
        'type' => 'textarea',
        'description' => __('Với {{qrcode}} là mã QR và {{orderid}} là mã đơn hàng.', 'woo-momo'),
        'default' => __('Mở ứng dụng MoMo trên điện thoại và quét mã QR bên dưới {{qrcode}} Nhập lời nhắn cho người nhận là: #{{orderid}}', 'woo-momo'),
        'desc_tip' => false,
    )
);