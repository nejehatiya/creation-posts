<?php
/**
 * créer fonction pour ajouter shortcodes
 */

function shortcode_display_form($atts,$content=NULL){

    //
    $atts =  shortcode_atts(array(), $atts,'form_creation_post');

    // start html form
    ob_start();

    // include html form
    require 'html/form.php';
    
    // return html form
    return ob_get_clean();
}
/**
 * ajouter short code
 */
add_shortcode('form_creation_post', 'shortcode_display_form');