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
        load_plugin_textdomain(
            SIMPLEDOC_SLUG,
            false,
            basename(dirname(__FILE__)) . '/languages'
        );
    }


    public static function activation()
    {
        // Check for import etc..
    }


    public static function uninstall()
    {

    }
}
