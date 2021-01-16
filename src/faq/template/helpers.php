<?php
/**
 * Template helpers
 *
 * @package rushmark\moduule\faq\template
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
 
 
add_filter('archive_template', __NAMESPACE__ . '\load_the_faq_archive_template');
/**
 * Load the FAQ Archive template from our plugin.
 *
 * @since 1.0.0
 *
 * @param string $theme_archive_template Full qualified path to the archive template
 *
 * @return string
 */
function load_the_faq_archive_template($theme_archive_template)
{
    if (! is_post_type_archive('faq')) {
        return $theme_archive_template;
    }

    $plugin_archive_template = __DIR__ . '/archive-faq.php';

    if (! $theme_archive_template) {
        return $plugin_archive_template;
    }

    if (strpos($theme_archive_template, '/archive-faq.php') === false) {
        return $plugin_archive_template;
    }

    return $theme_archive_template;
}
