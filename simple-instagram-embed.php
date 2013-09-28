<?php
/*
Plugin Name: Simple Instagram Embed
Plugin URI: http://darkwhispering.com/wp-plugins/simple-instagram-embed
Description: Paste any link to a instagram picture or video in your post and the plugin replace your instagram link with the NEW Instagram Embed directly in your posts just like wordpress replace your youtube links to youtube embeds.
Author: Mattias Hedman
Author URI: http://www.darkwhispering.com
Version: 1.2.0
*/

wp_embed_register_handler( 'simple_instagram_embed', '/https?\:\/\/instagram.com\/p\/(\w+)(\/|$)/', 'simple_instagram_embed_handler' );

function simple_instagram_embed_handler( $matches, $attr, $url, $rawattr ) {

    $size = get_option('insta_embed_size');
    if (empty($size)) {$size = 'large';}

    switch($size) {
        case 'large':
            $iframe_size = 'width="612" height="712"';
            break;

        case 'middle':
            $iframe_size = 'width="480" height="580"';
            break;

        case 'small':
            $iframe_size = 'width="350" height="450"';
            break;
    }

    $embed = sprintf(
            '<iframe src="//instagram.com/p/%1$s/embed/" '.$iframe_size.' frameborder="0" scrolling="no" allowtransparency="true" class="instagram-embed"></iframe>',
            esc_attr($matches[1])
            );

    return apply_filters( 'simple_instagram_embed', $embed, $matches, $attr, $url, $rawattr );
}


function insta_embed_settings() {
        if (!current_user_can('manage_options'))  {
            wp_die( __('You do not have sufficient permissions to access this page.') );
        }

        $size = get_option('insta_embed_size');
        if (empty($size)) {$size = 'large';}

        switch($size) {
            case 'large':
                $large = 'selected="selected"';
                break;

            case 'middle':
                $middle = 'selected="selected"';
                break;

            case 'small':
                $small = 'selected="selected"';
                break;
        }
    ?>
        <div class="wrap insta-settings">
            <div class="icon32" id="icon-options-general"><br></div>
            <h2>Simple Instagram Embed Settings</h2>
            
            <form method="post" action="options.php">
                <?php wp_nonce_field('update-options'); ?>
                <p>
                    <strong><?php echo __('Choose embed size:'); ?></strong>
                    <select name="insta_embed_size">
                        <option value="large" <?php echo $large; ?>><?php echo __('Large (w:612 x h:712)'); ?></option>
                        <option value="middle" <?php echo $middle; ?>><?php echo __('Middle (w:480 x h:580)'); ?></option>
                        <option value="small" <?php echo $small; ?>><?php echo __('Small (w:350 x h:450)'); ?></option>
                    </select>
                </p>

                <input type="hidden" name="action" value="update" />
                <input type="hidden" name="page_options" value="insta_embed_size" />
                <input type="submit" name="submit" value="Save" class="button-primary save" />
            </form>

        </div>
    <?php
    }


function insta_embed_menu() {
    add_submenu_page('options-general.php', 'Simple Instagram Embed Settings', 'Simple Instagram Embed', 'manage_options', 'insta-settings', 'insta_embed_settings');
}
add_action('admin_menu', 'insta_embed_menu');