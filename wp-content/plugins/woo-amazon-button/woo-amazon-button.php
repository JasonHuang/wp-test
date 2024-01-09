<?php
/*
Plugin Name: WooCommerce Amazon Button
Description: Adds a "Buy on Amazon" button to WooCommerce variable products.
Version: 1.0
Author: Jason Huang
*/

function display_amazon_link_fields() {
    global $woocommerce, $post;

    echo '<div class="options_group">';

    woocommerce_wp_text_input(
        array(
            'id'                => '_amazon_link',
            'label'             => __('Amazon Link', 'woocommerce'),
            'placeholder'       => 'http://',
            'desc_tip'          => true,
            'description'       => __('Enter the Amazon link for this product.', 'woocommerce')
        )
    );

    woocommerce_wp_text_input(
        array(
            'id'                => '_amazon_link_text',
            'label'             => __('Amazon Link Text', 'woocommerce'),
            'placeholder'       => 'Buy on Amazon',
            'desc_tip'          => true,
            'description'       => __('Enter the link text for the Amazon button.', 'woocommerce')
        )
    );

    wp_nonce_field('save_amazon_link_nonce', 'amazon_link_nonce_field');

    echo '</div>';
}
add_action('woocommerce_product_options_general_product_data', 'display_amazon_link_fields');

function save_amazon_link_fields($post_id) {
    // 检查权限
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // 检查Nonce字段的存在和验证
    if (!isset($_POST['amazon_link_nonce_field']) || !wp_verify_nonce($_POST['amazon_link_nonce_field'], 'save_amazon_link_nonce')) {
        return;
    }

    // 清理并保存数据
    $amazon_link = isset($_POST['_amazon_link']) ? sanitize_url($_POST['_amazon_link']) : '';
    if (!empty($amazon_link)) {
        update_post_meta($post_id, '_amazon_link', $amazon_link);
    }else {
        // 如果$amazon_link为空，则删除元数据
        delete_post_meta($post_id, '_amazon_link');
    }

    $amazon_link_text = isset($_POST['_amazon_link_text']) ? sanitize_text_field($_POST['_amazon_link_text']) : '';
    if (!empty($amazon_link_text)) {
        update_post_meta($post_id, '_amazon_link_text', $amazon_link_text);
    }else {
        // 如果$amazon_link_text为空，则删除元数据
        delete_post_meta($post_id, '_amazon_link_text');
    }
}
add_action('woocommerce_process_product_meta', 'save_amazon_link_fields');

function my_plugin_enqueue_styles() {
    // 使用插件_dir_url获取当前插件的URL，与你的CSS文件相结合
    $plugin_url = plugin_dir_url( __FILE__ );
    wp_enqueue_style( 'woo-amazon-button', $plugin_url . 'woo-amazon-button.css' );
}

// 将上述函数挂载到wp_enqueue_scripts动作钩子
add_action( 'wp_enqueue_scripts', 'my_plugin_enqueue_styles' );


function add_amazon_button() {
    global $product;
    $amazon_link = get_post_meta($product->get_id(), '_amazon_link', true);
    $amazon_link_text = get_post_meta($product->get_id(), '_amazon_link_text', true);

    if ($amazon_link && $amazon_link_text) {
        echo '<a href="' . esc_url($amazon_link) . '" class="amz-button button" target="_blank">' . esc_html($amazon_link_text) . '</a>';
    }
}
add_action('woocommerce_after_add_to_cart_button', 'add_amazon_button');


function woo_amazon_button_settings_page(){
    ?>
    <form method="post" action="options.php">
      <?php settings_fields('woo_amz_button-options'); ?>
      </br>
      <h1>Amazon Button Style Settings</h1>
      </br>
      <div>
        <li>These settings will change the Amazon Button on the product page, But if you are familiar with css, you could easily change the css file /plugins/woo-amazon-link/my-plugin-styles.css 
        <li>Although what you changes here will override the attribute in the css file.
      </div>
      </br>
      <h3>Settings</h3>
      <table class="form-table">
      <tr>
                <th>
                    <label>Button Font Color:</label>
                </th>
                <td>
                    <input type="color" name="amz_button_font_color" value="<?php echo get_option('amz_button_font_color','#000000'); ?>">
                </td>
        </tr>
        <tr>
                <th>
                    <label>Button Backgound Color:</label>
                </th>
                <td>
                    <input type="color" name="amz_button_bg_color" value="<?php echo get_option('amz_button_bg_color','#ffffff'); ?>">
                </td>
        </tr>
        <tr>
            <th>
                <label>Font Size:</label>
            </th>
            <td>
                <input type="number" name="amz_font_size" value="<?php echo get_option('amz_font_size','14'); ?>"> px
            </td>
        </tr>        
        <tr>
            <th>
                <label>Button Height:</label>
            </th>
            <td>
                <input type="number" name="amz_button_height" value="<?php echo get_option('amz_button_height','48'); ?>"> px
            </td>
        </tr>
        <tr>
            <th>
                <label>Button Width:</label>
            </th>
            <td>
                <input type="range" id="amz_button_width" name="amz_button_width" min="0" max="100" value="<?php echo get_option('amz_button_width','100'); ?>"> 
                <span id="woo_amz_btn_slider_value"><?php echo esc_attr(get_option('amz_button_width', '100')); ?></span>%
            </td>
        </tr>
        </table>
      <?php submit_button(); ?>
    </form>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        var amz_button_width = $('#amz_button_width');
        var woo_amz_btn_slider_value = $('#woo_amz_btn_slider_value');
        amz_button_width.on('input change', function() {
            woo_amz_btn_slider_value.text($(this).val());
        });
    });
    </script>
    <?php
  }

function woo_amazon_button_menu(){
    add_options_page('WooCommerce Amazon Button', 'Amazon button', 'manage_options', 'woo-amazon-button-settings', 'woo_amazon_button_settings_page', '');
}
add_action('admin_menu', 'woo_amazon_button_menu');



function woo_amz_button_settings(){
    register_setting('woo_amz_button-options', 'amz_button_font_color');
    register_setting('woo_amz_button-options', 'amz_button_bg_color');
    register_setting('woo_amz_button-options', 'amz_font_size');
    register_setting('woo_amz_button-options', 'amz_button_height');
    register_setting('woo_amz_button-options', 'amz_button_width');
}
add_action('admin_init', 'woo_amz_button_settings');


function woo_amz_button_custom_styles(){
    $amz_button_font_color = get_option('amz_button_font_color');
    $amz_button_bg_color = get_option('amz_button_bg_color');
    $amz_font_size = get_option('amz_font_size');
    $amz_button_height = get_option('amz_button_height');
    $amz_button_width = get_option('amz_button_width');
    echo "<style> .amz-button { color: $amz_button_font_color; background-color: ${amz_button_bg_color}; font-size: ${amz_font_size}px; height:${amz_button_height}; width:${amz_button_width}% } </style>";
}
add_action('wp_head', 'woo_amz_button_custom_styles');
