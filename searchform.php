<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Custom search form
 *
 * @package BungAku_Theme
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'bungaku-theme' ); ?></span>
        <input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search ...', 'bungaku-theme' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
    </label>
    <button type="submit" class="search-submit" aria-label="<?php esc_attr_e( 'Search', 'bungaku-theme' ); ?>">
        <span aria-hidden="true">&#128269;</span>
    </button>
</form>
