<?php

/*
* insert post  in database
*/
function creation_posts_database($titre,$text){
    /**
     * init connection with database
     */
    global $wpdb;
    /**
     * database prefix
     */
    return wp_insert_post(array(
        'post_title'=>$titre,
        'post_content'=>$text,
        'post_type'=>'post',
        'post_status' => 'draft',
    ));
}
/**
 * check existance of posts
 */
function check_existance_database($titre){
    /** 
     * init connection with database
     */
    global $wpdb;
    /**
     * database prefix
     */
    $table_prefix=$wpdb->prefix;
    /**
     * return result select
     */
    return $wpdb->get_row('SELECT p.ID from '.$table_prefix.'posts p  WHERE p.post_title like "'.$titre.'" ');
}
/**
 * creation post function ajax
 */
add_action('wp_ajax_nopriv_creation_post','creation_post');
add_action('wp_ajax_creation_post','creation_post');
function creation_post(){
    /**
     * get value titre and text
     */
    $titre = trim(wp_strip_all_tags($_POST['titre']));
    $text = trim(wp_strip_all_tags($_POST['text']));
    // test titre count carectére
    if(!strlen($titre))
        die(json_encode(array('success'=>false,'message'=>'veuillez remplire le titre')));

    /**
     * check if existe post with this title
     */
    $check_existance = check_existance_database($titre);
    // test existance
    if(!empty($check_existance))
        die(json_encode(array('success'=>false,'message'=>'titre de post existe déja')));
    
    // insert_past
    $insert_post = creation_posts_database($titre,$text);
    // test insert
    if(!$insert_post)
        die(json_encode(array('success'=>false,'message'=>'insertion failed')));
    
    /*
    * send email to admin
    */
    // init email admin
    $email_admin = get_option('admin_email');
    // site name
    $site_name = get_bloginfo('name');
    // init headers
    $headers = 'From : '.$site_name.' < '.$email_admin.' >' . "\r\n";
    // send email 
    $send_email = wp_mail($email_admin,'Sujet : '.$titre, $text,  $headers );
    // return response final
    die(json_encode(array('success'=>true,'message'=>'inserted with success')));
}