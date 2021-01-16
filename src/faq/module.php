<?php
/**
 * FAQ module handler
 *
 * @package rushmark\moduule\faq
 *
 * @since 	1.0.0
 *
 * @author	Chris Clarke
 *
 * @link 	https://www.chrisclarkewebservices.co.uk
 *
 * @lincense 	GNU-2.0+
 *
 */
 
 namespace rushmark\module\faq;

 define('FAQ_MODULE_TEXT_DOMAIN', COLLAPSIBLE_CONTENT_TEXT_DOMAIN);


/**
 * Autoload plugin files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function autoload()
{
    $files = array(
        'custom/post-type.php',
        'custom/taxonomy.php',
        'shortcode/shortcode.php',
        'template/helpers.php',
    );

    foreach ($files as $file) {
        include(__DIR__ . '/' . $file);
    }
}
autoload();

register_activation_hook(COLLAPSIBLE_CONTENT_PLUGIN, __NAMESPACE__ . '\activate_the_plugin');

/*
 * Initialise the rewrites for our new cpt on activation.
 *
 * @since		1.0.0
 *
 * @return		void
 *
*/
function activate_the_plugin()
{
    custom\register_faq_custom_post_type();
    custom\register_custom_taxonomy();
  
    flush_rewrite_rules();
}

register_deactivation_hook(COLLAPSIBLE_CONTENT_PLUGIN, __NAMESPACE__ . '\deactivate_plugin');

/**
 * The plugin is deactivating.  Delete out the rewrite rules option.
 *
 * @since 1.0.1
 *
 * @return void
 */
function deactivate_plugin()
{
    delete_option('rewrite_rules');
}

register_uninstall_hook(COLLAPSIBLE_CONTENT_PLUGIN, __NAMESPACE__ . '\uninstall_plugin');

/**
 * Plugin is being uninstalled - clean up after ourselves.
 *
 * @since 1.0.1
 *
 * @return void
 */
function uninstall_plugin()
{
    delete_option('rewrite_rules');
}
