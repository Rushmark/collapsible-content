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
        'custom/custom-type.php',
        'custom/taxonomy.php',
        'shortcode/shortcode.php',
    );

    foreach ($files as $file) {
        include(__DIR__ . '/' . $file);
    }
}
autoload();
