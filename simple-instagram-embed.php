<?php
/*
Plugin Name: Simple Instagram Embed
Plugin URI: http://darkwhispering.com/wp-plugins/simple-instagram-embed
Description: Paste any link to a instagram picture or video in your post and the plugin replace your instagram link with the Instagram Embed directly in your posts just like wordpress replace your youtube links to youtube embeds.
Author: Mattias Hedman
Author URI: http://www.darkwhispering.com
Version: 1.3.0
*/

wp_embed_register_handler( 'simple_instagram_embed', '/https?\:\/\/instagram.com\/p\/(.+)/', 'simple_instagram_embed_handler' );

function simple_instagram_embed_handler( $matches, $attr, $url, $rawattr )
{
    $size = get_option( 'insta_embed_size' );
    $caption = get_option( 'insta_embed_caption' );

    switch( $size )
    {
        case 'large':
            $iframe_size = 'width="612" height="720"';
            break;

        case 'middle':
            $iframe_size = 'width="480" height="600"';
            break;

        case 'small':
            $iframe_size = 'width="350" height="470"';
            break;

        default:
            $iframe_size = 'width="612" height="720"';
            break;
    }

    $image_id = str_replace( '/', '', $matches[1] );

    $embed = sprintf(
        '<iframe src="//instagram.com/p/%1$s/embed/' . $caption . '?v=4" ' . $iframe_size . ' frameborder="0" scrolling="auto" allowtransparency="true" class="simple-instagram-embed instagram-embed"></iframe>',
        esc_attr( $image_id )
    );

    return apply_filters( 'simple_instagram_embed', $embed, $matches, $attr, $url, $rawattr );
}


function insta_embed_settings()
{
        if ( ! current_user_can( 'manage_options' ) )
        {
            wp_die( __( 'You do not have sufficient permissions to access this page.', 'simple_instagram_embed' ) );
        }

        $size = get_option( 'insta_embed_size' );
        $caption = get_option( 'insta_embed_caption' );

        switch( $size ) {
            case 'large':
                $large = 'selected="selected"';
                break;

            case 'middle':
                $middle = 'selected="selected"';
                break;

            case 'small':
                $small = 'selected="selected"';
                break;

            default:
                $large = 'selected="selected"';
                break;
        }
    ?>
        <div class="wrap insta-settings">
            <h2><?php _e( 'Simple Instagram Embed Settings', 'simple_instagram_embed' ); ?></h2>

            <form method="post" action="options.php">
                <?php wp_nonce_field( 'update-options' ); ?>

                <table class="form-table insta-settings-table">
                    <tbody>
                        <tr valign="top">
                            <th scope="row">
                                <strong><?php _e( 'Choose embed size:', 'simple_instagram_embed' ); ?></strong>
                            </th>
                            <td>
                                <select name="insta_embed_size">
                                    <option value="large" <?php echo $large; ?>>
                                        <?php _e( 'Large (w:612 x h:720 pixels)', 'simple_instagram_embed' ); ?>
                                    </option>
                                    <option value="middle" <?php echo $middle; ?>>
                                        <?php _e( 'Middle (w:480 x h:600 pixels)', 'simple_instagram_embed' ); ?>
                                    </option>
                                    <option value="small" <?php echo $small; ?>>
                                        <?php _e( 'Small (w:350 x h:470 pixels)', 'simple_instagram_embed' ); ?>
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">
                                <?php _e( 'Include caption', 'simple_instagram_embed'); ?>
                            </th>
                            <td>
                                <label for="insta_embed_caption">
                                    <input type="checkbox" id="insta_embed_caption" name="insta_embed_caption" value="captioned" <?php echo !empty( $caption ) ? 'checked="checked"' : '' ?> />
                                </label>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <input type="hidden" name="action" value="update" />
                <input type="hidden" name="page_options" value="insta_embed_size, insta_embed_caption" />
                <input type="submit" name="submit" value="<?php _e( 'Save', 'simple_instagram_embed' ); ?>" class="button-primary save" />
            </form>

        </div>
    <?php
    }


function insta_embed_menu()
{
    add_submenu_page( 'options-general.php', 'Simple Instagram Embed Settings', 'Simple Instagram Embed', 'manage_options', 'insta-settings', 'insta_embed_settings' );
}
add_action( 'admin_menu', 'insta_embed_menu' );
