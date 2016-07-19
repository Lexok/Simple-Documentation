<?php
/**
 *  Simple Documentation Core
 */

namespace SimpleDocumentation;

class Core
{
    /**
     *  Plugin initialisation
     */
    public static function init()
    {
        /**
         *  Load Translations
         */
        load_plugin_textdomain(SIMPLEDOC_SLUG, false, plugin_basename(SIMPLEDOC_ROOT) . '/languages');
    }


    /**
     *  Registered in the main plugin file
     */
    public static function activation()
    {
        /**
         *  If we detect the tables we run the import and then delete them.
         *  Maybe create a backup in a log file just in case
         */

    }


    /**
     *  Registered in the main plugin file
     */
    public static function uninstall()
    {
        /**
         *  Remove Options & Posts
         *  Also try to remove tables in case someone failed to run the import
         */
    }
}
