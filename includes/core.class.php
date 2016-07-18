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
        load_plugin_textdomain(SIMPLEDOC_SLUG, false, SIMPLEDOC_LANGUAGES);
    }


    /**
     *  Registered in the main plugin file
     */
    public static function activation()
    {
        // Check for import etc..
    }


    /**
     *  Registered in the main plugin file
     */
    public static function uninstall()
    {
        // Remove options etc...
    }
}
