<?php
/**
 *  Main Plugin Page Handling
 */

namespace SimpleDocumentation;

use \SimpleDocumentation\Utils;
use \SimpleDocumentation\Core;

class Pages
{
    /**
     *  Setup
     */
    public static function setup()
    {
        add_action('admin_menu', array(__CLASS__, 'register'));
        add_action('network_admin_menu', array(__CLASS__, 'register'));
    }


    /**
     *  Register Plugin Pages
     */
    public static function register()
    {
        /**
         *  Register Main Plugin Page
         */
        add_menu_page(
            __('Documentation', 'simpledocumentation'),
            __('Documentation', 'simpledocumentation'),
            SIMPLEDOC_CAP_FULL_VIEW,
            SIMPLEDOC_SLUG . '_main',
            array(__CLASS__, 'renderMainPage'),
            'dashicons-editor-help'
        );


        /**
         *  Register Setting Page
         */
        add_options_page(
            Core::getLabel(),
            Core::getLabel(),
            'manage_options',
            SIMPLEDOC_SLUG . '_settings',
            array(__CLASS__, 'renderSettingsPage')
        );
    }


    /**
     *  Render Main Page
     */
    public static function renderMainPage()
    {
        /**
         *  Load the main plugin page
         */
        Utils::getTemplate('main-page');
    }


    /**
     *  Render Settings page
     */
    public static function renderSettingspage()
    {
        /**
         *  Load settings page template
         */
        Utils::getTemplate('settings');
    }
}
