<?php
/*
Plugin Name: Simple Instagram Embed
Plugin URI: http://darkwhispering.com/wp-plugins/simple-instagram-embed
Description: Paste any link to a Instagram picture or video in your post and the plugin replace your Instagram link with the Instagram Embed directly in your posts just like Wordpress replace your Youtube links to Youtube embeds.
Author: Mattias Hedman
Author URI: http://www.darkwhispering.com
Version: 2.1.1
*/

// Initiate class
$Simple_Instagram_Embed = new Simple_Instagram_Embed;

// Register settings page and fields
add_action( 'admin_init', array( $Simple_Instagram_Embed, 'settings' ) );
add_action( 'admin_menu', array( $Simple_Instagram_Embed, 'menu' ) );

// Register embed
wp_embed_register_handler(
    'simple_instagram_embed',
    '/https?\:\/\/(?:www.)?instagram.com\/p\/(.+)/',
    array( $Simple_Instagram_Embed, 'embed' )
);

Class Simple_Instagram_Embed
{

    /**
     * Add plugin settings page
     */
    function menu()
    {
        add_options_page(
            __( 'Simple Instagram Embed Settings', 'simple_instagram_embed' ),
            __( 'Simple Instagram Embed', 'simple_instagram_embed' ),
            'manage_options',
            'insta-settings',
            array( $this, 'settings_page' )
        );
    }

    /**
     * Add plugin settings page fields
     */
    function settings()
    {
        // Add settings section
        add_settings_section(
            'insta_embed_settings_section',
            '',
            array( $this, 'settings_section_callback' ),
            'insta_embed_settings_group'
        );

        // Add settings field and register it
        add_settings_field(
            'insta_embed_size',
            __( 'Embed max width', 'simple_instagram_embed' ),
            array( $this, 'settings_insta_embed_size_callback' ),
            'insta_embed_settings_group',
            'insta_embed_settings_section'
        );
        register_setting( 'insta_embed_settings_group', 'insta_embed_size' );

        // Add settings field and register it
        add_settings_field(
            'insta_embed_caption',
            __( 'Hide image caption', 'simple_instagram_embed' ),
            array( $this, 'settings_insta_embed_caption_callback' ),
            'insta_embed_settings_group',
            'insta_embed_settings_section'
        );
        register_setting( 'insta_embed_settings_group', 'insta_embed_caption' );
    }

    /**
     * Has to exists, but we don't use it...
     */
    function settings_section_callback()
    {
        // We don't want to do anything here atm...
    }

    /**
     * Callback function that renders size settings field
     */
    function settings_insta_embed_size_callback()
    {
        // Get current value, or set 600 as default
        $size = get_option( 'insta_embed_size', 600 );

        // Convert old plugin string values to int
        switch( $size ) {
            case 'large':
                $size = 612;
                break;

            case 'middle':
                $size = 480;
                break;

            case 'small':
                $size = 320;
                break;
        }

        // Create HTML code
        $html = '<input name="insta_embed_size" id="insta_embed_size" type="number" value="' . $size . '" />';
        $html .= '<p class="description">'. __( 'There is no height setting because the height will adjust automatically based on the width. <br/> Instagram only allow a minimum width of 320 pixels. Using a lower value will break the embed.', 'simple_instagram_embed' ) .'</p>';

        // Echo HTML code
        echo $html;
    }

    /**
     * Callback function that renders caption settings field
     */
    function settings_insta_embed_caption_callback()
    {
        // Create HTML code
        $html = '<input name="insta_embed_caption" id="insta_embed_caption" type="checkbox" value="1" ' . checked( 1, get_option( 'insta_embed_caption' ), false ) . ' />';

        // Echo HTML code
        echo $html;
    }

    /**
     * Render settings page
     */
    function settings_page()
    {
        // Check so user has correct permissions
        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( __( 'You do not have sufficient permissions to access this page.', 'simple_instagram_embed' ) );
        }

        ?>

        <div class="wrap insta-settings">

            <h1><?php _e( 'Simple Instagram Embed Settings', 'simple_instagram_embed' ); ?></h1>

            <form method="post" action="options.php">
            <?php
                // Print out all needed fields and submit button.
                settings_fields( 'insta_embed_settings_group' );
                do_settings_sections( 'insta_embed_settings_group' );
                submit_button();
            ?>
            </form>

        </div>

        <?php
    }

    /**
     * Embed code
     */
    function embed( $matches, $attr, $url, $rawattr )
    {
        $size         = get_option( 'insta_embed_size' );
        $hide_caption = get_option( 'insta_embed_caption' );
        $image_id     = str_replace( '/', '', $matches[1] );
        $embed        = $this->get_embed_code( $image_id, $size, $hide_caption );

        return apply_filters( 'simple_instagram_embed', $embed, $matches, $attr, $url, $rawattr );
    }

    /**
     * Get embed code from Instagram
     *
     * @param   string   $image_id      Image ID on Instagram
     * @param   integer  $size          Size (width) in pixels
     * @param   boolean  $hide_caption  Should caption be hidden
     *
     * @return  html                    Returns embed HTML code
     */
    function get_embed_code( $image_id = null, $size = 600, $hide_caption = false )
    {
        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL            => 'https://api.instagram.com/oembed/?url=https://instagr.am/p/' . $image_id . '&maxwidth=' . $size . '&hidecaption=' . $hide_caption,
                CURLOPT_USERAGENT      => 'Simple Instagram Embed Wordpress Plugin'
            )
        );

        $result = json_decode( curl_exec( $curl ) );
        $http_status = curl_getinfo( $curl, CURLINFO_HTTP_CODE );

        curl_close( $curl );

        if ( $http_status === 200 ) {
            return $result->html;
        }

        return '';
    }
}
