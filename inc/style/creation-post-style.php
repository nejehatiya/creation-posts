<?php

/* 
 *add style and script function
*/

function creation_post_style(){
    // add jquery 
    if ( ! wp_script_is( 'jquery', 'enqueued' )) {
        // Enqueue
        wp_enqueue_script( 'jquery' );
    }
    // form style
    wp_enqueue_style("creation-poste-form-style",  plugin_dir_url('__FILE__').'creation-posts/css/creation-post-form-style.css');
    // form js
    wp_enqueue_script("creation-poste-form-javascript",  plugin_dir_url('__FILE__').'creation-posts/js/creation-poste-form-javascript.js',array(),FALSE,true);
    // passer url ajax admin au fichier js
    wp_localize_script("creation-poste-form-javascript", 'ajax_vars', array('url'=>admin_url('admin-ajax.php')));
}
// add_action with hook
add_action('wp_enqueue_scripts','creation_post_style');