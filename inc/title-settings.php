<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Per-page Title Settings: hide title, and/or set its alignment.
 *
 * Added in 1.7.27 as a proper, page-by-page replacement for relying on a
 * third-party "hide title" plugin, which previously left a stray gap
 * behind because the page template's entry-header wrapper rendered its
 * own margin-bottom even when its content was hidden by such a plugin.
 * This keeps both the visibility and the spacing decision inside the
 * theme, so hiding a title never leaves a gap, on any page, not just the
 * site's front page.
 *
 * @package BungAku_Theme
 */

/**
 * Register the Title Settings meta box on Pages (and Posts, since the
 * same need -- a clean title-free layout -- applies there too).
 */
function bungaku_theme_add_title_settings_meta_box() {
    add_meta_box(
        'bungaku_theme_title_settings',
        __( 'Title Settings', 'bungaku-theme' ),
        'bungaku_theme_render_title_settings_meta_box',
        array( 'page', 'post' ),
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'bungaku_theme_add_title_settings_meta_box' );

/**
 * Render the meta box fields.
 */
function bungaku_theme_render_title_settings_meta_box( $post ) {
    wp_nonce_field( 'bungaku_theme_title_settings_save', 'bungaku_theme_title_settings_nonce' );

    $hide_title = get_post_meta( $post->ID, '_bungaku_theme_hide_title', true );
    $alignment  = get_post_meta( $post->ID, '_bungaku_theme_title_align', true );
    if ( ! in_array( $alignment, array( 'left', 'center', 'right' ), true ) ) {
        $alignment = 'left'; // Matches the theme's existing default heading alignment.
    }
    ?>
    <p>
        <label>
            <input type="checkbox" name="bungaku_theme_hide_title" value="1" <?php checked( $hide_title, '1' ); ?> />
            <?php esc_html_e( 'Hide title on this page', 'bungaku-theme' ); ?>
        </label>
    </p>
    <p>
        <label for="bungaku_theme_title_align"><?php esc_html_e( 'Title alignment', 'bungaku-theme' ); ?></label><br>
        <select name="bungaku_theme_title_align" id="bungaku_theme_title_align" style="width: 100%;">
            <option value="left" <?php selected( $alignment, 'left' ); ?>><?php esc_html_e( 'Left', 'bungaku-theme' ); ?></option>
            <option value="center" <?php selected( $alignment, 'center' ); ?>><?php esc_html_e( 'Center', 'bungaku-theme' ); ?></option>
            <option value="right" <?php selected( $alignment, 'right' ); ?>><?php esc_html_e( 'Right', 'bungaku-theme' ); ?></option>
        </select>
    </p>
    <p class="description">
        <?php esc_html_e( 'Alignment has no effect if the title is hidden. The front page never shows its title, regardless of this setting.', 'bungaku-theme' ); ?>
    </p>
    <?php
}

/**
 * Save the meta box fields, with full nonce/capability/sanitization checks.
 *
 * Changed in 1.7.65: save_post also fires for the revision WordPress creates
 * on every manual save, with $_POST (and so a valid nonce) still present.
 * update_post_meta() redirects a revision ID to its parent post, so no meta
 * was ever stored on revisions -- but the handler still ran a second,
 * redundant time per save, rewriting the parent's meta with identical values.
 * Revisions are now skipped, per standard WordPress practice. The nonce is
 * also unslashed and sanitized before wp_verify_nonce().
 */
function bungaku_theme_save_title_settings_meta_box( $post_id ) {
    if ( wp_is_post_revision( $post_id ) ) {
        return;
    }
    if ( ! isset( $_POST['bungaku_theme_title_settings_nonce'] ) ||
        ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['bungaku_theme_title_settings_nonce'] ) ), 'bungaku_theme_title_settings_save' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $hide_title = isset( $_POST['bungaku_theme_hide_title'] ) ? '1' : '0';
    update_post_meta( $post_id, '_bungaku_theme_hide_title', $hide_title );

    $alignment = isset( $_POST['bungaku_theme_title_align'] ) ? sanitize_text_field( wp_unslash( $_POST['bungaku_theme_title_align'] ) ) : 'left';
    if ( ! in_array( $alignment, array( 'left', 'center', 'right' ), true ) ) {
        $alignment = 'left';
    }
    update_post_meta( $post_id, '_bungaku_theme_title_align', $alignment );
}
add_action( 'save_post', 'bungaku_theme_save_title_settings_meta_box' );

/**
 * Whether the title should be shown for the current post in the loop.
 * Always false on the front page, regardless of the per-page setting.
 */
function bungaku_theme_should_show_title() {
    if ( is_front_page() && is_page() ) {
        return false;
    }
    $hide_title = get_post_meta( get_the_ID(), '_bungaku_theme_hide_title', true );
    return '1' !== $hide_title && '' !== get_the_title();
}

/**
 * The current post's configured title alignment, as a sanitized CSS value.
 */
function bungaku_theme_get_title_align() {
    $alignment = get_post_meta( get_the_ID(), '_bungaku_theme_title_align', true );
    if ( ! in_array( $alignment, array( 'left', 'center', 'right' ), true ) ) {
        $alignment = 'left';
    }
    return $alignment;
}
