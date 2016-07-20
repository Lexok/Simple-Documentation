<?php
/**
 *  Simple Documentation Constants
 */

/**
 *  Plugin Version
 */
define('SIMPLEDOC_VERSION', '1.3.0');

/**
 *  Plugin Slug
 */
define('SIMPLEDOC_SLUG', 'simpledocumentation');

/**
 *  Post Type Slug
 */
define('SIMPLEDOC_POST_TYPE', SIMPLEDOC_SLUG);

/**
 *  Capability Slug for Viewing Simple Documentation Items
 */
define('SIMPLEDOC_CAP_VIEW', SIMPLEDOC_SLUG . '_view');

/**
 *  Capability Slug for Viewing the Full Screen Documentation View
 *  (not only the dashboard)
 */
define('SIMPLEDOC_CAP_FULL_VIEW', SIMPLEDOC_SLUG . '_full_view');

/**
 *  Capability Slug for Managing Simple Documentation Items
 */
define('SIMPLEDOC_CAP_MANAGE', SIMPLEDOC_SLUG . '_manage');

/**
 *  Plugin Root Folder Path
 */
define('SIMPLEDOC_ROOT', dirname(__FILE__));

/**
 *  Plugin Includes Folder Path
 */
define('SIMPLEDOC_INCLUDES', SIMPLEDOC_ROOT . '/includes');

/**
 *  Plugin Templates Folder Path
 */
define('SIMPLEDOC_TEMPLATES', SIMPLEDOC_ROOT . '/templates');

/**
 *  Plugin Languages Folder path
 */
define('SIMPLEDOC_LANGUAGES', SIMPLEDOC_ROOT . '/languages');

/**
 *  Debug Mode For Simple Documentation
 */
if (!defined('SIMPLEDOC_DEBUG')) {
    define('SIMPLEDOC_DEBUG', false);
}
