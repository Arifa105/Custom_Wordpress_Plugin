<?php
/**
 *  trigger this file on Plugin uninstall
 * @package ArifaPlugin
 */


if(! defined('WP_UNINSTALL_PLUGIN')){
    die;

}
//clear database stroed data
/*$book = get_posts(array('post_type' => 'books', 'numberposts' => -1));
foreach($book as $books){
    wp_delete_post($books-> ID, true);
}*/


//Access the database via SQL
global $wpdb;
$wpdb->query(" Delete From wp_posts Where post_type = 'books' ");
$wpdb->query("Delete From wp_postmeta where post_id NOT IN(Select id From wp_posts)");
$wpdb->query("Delete From wp_term_relationships Where object_id NOT IN(Select id From wp_posts)");
?>