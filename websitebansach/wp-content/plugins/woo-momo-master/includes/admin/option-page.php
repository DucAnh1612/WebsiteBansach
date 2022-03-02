<?php
if (isset($_POST['submit_license_key'])) {
    $this->Woo_MoMo_Options = array();
    $this->Woo_MoMo_Options["license_key"] = sanitize_text_field(trim($_POST['license_key']));
    $this->Woo_MoMo_Options["qr_code_ecc"] = sanitize_text_field(trim($_POST['qr_code_ecc']));
    $this->Woo_MoMo_Options["qr_code_size"] = sanitize_text_field(trim($_POST['qr_code_size']));
    update_option("woo_momo", $this->Woo_MoMo_Options);
    echo '<div id="message" class="notice notice-success is-dismissible"><p><strong>Đã lưu mọi cài đặt</strong></p></div>';
}
?>
<div class="wrap">
    <h1>MoMo for WooCommerce</h1>
    <form action="" method="post" enctype="multipart/form-data" name="woo_momo_options">
        <table class="form-table">
            <tr>
                <th scope="row"><label for="qr_code_ecc">ECC</label></th>
                <td>
                    <select name="qr_code_ecc" id="qr_code_ecc">
                        <option value="L" <?php if ($this->Woo_MoMo_Options["qr_code_ecc"] == "L") {
                            echo "selected";
                        } ?>>L - smallest
                        </option>
                        <option value="M" <?php if ($this->Woo_MoMo_Options["qr_code_ecc"] == "M") {
                            echo "selected";
                        } ?>>M
                        </option>
                        <option value="Q" <?php if ($this->Woo_MoMo_Options["qr_code_ecc"] == "Q") {
                            echo "selected";
                        } ?>>Q
                        </option>
                        <option value="H" <?php if ($this->Woo_MoMo_Options["qr_code_ecc"] == "H") {
                            echo "selected";
                        } ?>>H - best
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="qr_code_size">QR size</label></th>
                <td>
                    <select name="qr_code_size" id="qr_code_size">
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <option value="<?php echo $i; ?>" <?php if ($this->Woo_MoMo_Options["qr_code_size"] == $i) {
                                echo "selected";
                            } ?>><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </td>
            </tr>
        </table>
        <p class="submit">
            <input type="hidden" name="submit_license_key" value=""/>
            <input type="submit" name="submit" id="submit" class="button button-primary" value="OK">
        </p>
    </form>
</div>