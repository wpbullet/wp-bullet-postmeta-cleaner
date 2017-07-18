<?php
/*
Plugin name: WP Bullet postmeta Cleaner
Version: 1.0
Description: WP Bullet postmeta Cleaner
Author: WP Bullet
Author URI: https://wp-bullet.com
Plugin URI: https://wp-bullet.com
*/

add_action('admin_menu', 'basicPluginMenu');

function basicPluginMenu() {
	$appName = 'postmeta Cleaner';
	$appID = 'postmeta Cleaner';
	add_menu_page($appName, $appName, 'administrator', $appID, 'pluginAdminScreen');
}

function pluginAdminScreen() {
	echo "<h1>WP Bullet postmeta Cleaner</h1>";
    global $wpdb;
    $query = "SELECT CONCAT(LEFT(meta_key, LENGTH(meta_key) - LOCATE('_', REVERSE(meta_key))), '') AS MetaKey,
       COUNT(1) AS MetaKeyCount
	FROM $wpdb->postmeta
	WHERE meta_key LIKE '\_%\_%'
	GROUP BY LEFT(meta_key, LENGTH(meta_key) - LOCATE('_', REVERSE(meta_key)))
	ORDER BY MetaKeyCount DESC;";
    $postmeta_results = $wpdb->get_results($query);
    foreach( $postmeta_results as $postmeta ) {
        echo $postmeta->MetaKey . ' ' . $postmeta->MetaKeyCount . '<br>';
    }
//	echo '<pre>'; var_dump($wpdb->get_results($query)); echo '</pre>';
//	var_dump($wpdb->get_results($query));
}
