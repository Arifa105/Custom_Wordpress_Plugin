<?php

/**
 * @package ArifaPlugin
 */

/*
Plugin Name: Arifa Plugin
Plugin URI: https://github.com/Arifa105
Description: This is my Custom post type Plugin.
Version: 1.0.0
Author: Arifa Awan
Author URI: https://github.com/Arifa105
Text Domain: Arifa-plugin
*/
defined ('ABSPATH') or die("Hey,you can't access this file");
class ArifaPlugin
{
    function __construct(){
        add_action('init', array($this, 'custom_post_type'));
    }
    function register(){
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }
    
    function activate(){
         //generate the CPT
         $this->custom_post_type();
        // Flush Rewrite the rules
        flush_rewrite_rules();

    }
    function deactivate(){
        // Flush Rewrite the rules
        flush_rewrite_rules();

    }
    
    function custom_post_type(){
        //register_post_type('books', ['public' => 'true','label' => 'Books']);
        register_post_type( 'books',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Books' ),
                'singular_name' => __( 'Books' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'books'),
            'show_in_rest' => true, ) );
         }
    function enqueue(){
        //enqueue all our scripts
        wp_enqueue_style('mypluginstyle', plugins_url('/assets/mystyle.css', __File__),array(''), false, 'all' );
        wp_enqueue_script('mypluginscript', plugins_url('/assets/myscript.js', __File__),array(''), false, 'all' );
    }
    
}
   
if(class_exists('ArifaPlugin')){
    $arifaPlugin = new ArifaPlugin();
    $arifaPlugin->register();

}
//Activation
register_activation_hook(__FILE__ , array($arifaPlugin,'activate'));

//deactivation
register_deactivation_hook(__FILE__ , array($arifaPlugin,'deactivate'));


?>