<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'websitebansach' );

/** Username của database */
define( 'DB_USER', 'root' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '8AJ!qJ;X~1TJlehgxhL,NO$e7V(R5>?nwPwEm(xx.7ksFn}RJ*)Z<qOY~L7A~uO|' );
define( 'SECURE_AUTH_KEY',  ')%!0DV.)?BR)AS%E;JxlN|NnS{e/vmcR.AD4K6LyFs`M&0KV_hSU=UN`7uPL(NDC' );
define( 'LOGGED_IN_KEY',    '7t_V]{U{6U>$$k;0b/>P=[}a<B@8H-GkdUDjR@U`8qZ5a]$eAVyragdRUCE]3}Gm' );
define( 'NONCE_KEY',        'Fr8tV?IK~rXD>p&DXG&PvoIJzQF]%LT<Hyo1C@f09{yvrB!8aD(=$E-09$hKkbPy' );
define( 'AUTH_SALT',        'R]w^tyisuN[|6WZ`.77+]WMMJfXP~lc$387{!cB7?xfPp-^UGp&n8h$<%P8u<k,I' );
define( 'SECURE_AUTH_SALT', 'dvQrxu;r*<Ay #N8wh0EO?ST:Tw$Y>NnU%!|K{Fu8PYxml:Sy5QfO#M&tq6XvRLO' );
define( 'LOGGED_IN_SALT',   '6fbcp-Dc*y=KfGyv:Xkc~uxwp>v96cG(e_s]d9a.OIm(1fN:GeHR-DPnWwsUB~E%' );
define( 'NONCE_SALT',       'wtan2tj!2k74`E-*F~5r<fV#(sI@amb,7+DD.}]-^mPgj<>MDlcuO.z=j8I{3Knu' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix  = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
