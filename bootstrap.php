<?php
/**
 * Collapsible Content Plugin
 *
 * @package rushmark\collapsiblecontent
 * @author Chris Clarke
 * @link https://www.chrisclarkewebservices.co.uk
 * @license GNU-2.0+
 *
 * Plugin Name:       Collapsible Content
 * Plugin URI:        https://github.com/Rushmark/collapsible-content
 * Description:       A plugin to display a teaser and, on request, a longer a version as well as an FAQ with custom post types
 * Version:           1.0
 * Author:            Chris Clarke
 * Author URI:		  https://www.chrisclarkewebservices.co.uk
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       collapsible_content
 * Requires WP:		  5.6
 * Requires PHP: 	  7.3
 */
 
 namespace rushmark\collapsiblecontent;

if (! defined('ABSPATH')) {
    die("Oh, silly, there's nothing to see here.");
}

define('COLLAPSIBLE_CONTENT_PLUGIN', __FILE__);
define('COLLAPSIBLE_CONTENT_DIR', plugin_dir_path(__FILE__));
$plugin_url = plugin_dir_url(__FILE__);
if (is_ssl()) {
    $plugin_url = str_replace('http://', 'https://', $plugin_url);
}
define('COLLAPSIBLE_CONTENT_URL', $plugin_url);
define('COLLAPSIBLE_CONTENT_TEXT_DOMAIN', 'collapsible_content');

include(__DIR__ . '/src/plugin.php');
