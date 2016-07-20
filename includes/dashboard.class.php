<?php
/**
 *  Dashboard
 */

namespace SimpleDocumentation;

class Dashboard
{
    public static function maybeSetup()
    {
        /**
         *  We only need to handle this in the admin
         */
        if (!is_admin()) {
            return false;
        }

        /**
         *  Run check over User permissions to decide whether or not
         *  the widget should be displayed
         */
        if (!self::shouldDisplay()) {
            return false;
        }

        add_action('wp_dashboard_setup', array(__CLASS__, 'register'));

        if (is_multisite()) {
            add_action('wp_network_dashboard_setup', array(__CLASS__, 'register'));
        }
    }


    /**
     *  Register
     */
    public static function register()
    {
        wp_add_dashboard_widget(
            SIMPLEDOC_SLUG,
            'Simple Documentation Dashboard',
            array(__CLASS__, 'render')
        );
    }


    /**
     *  Whether or not the dashboard should be displayed
     *
     *  @return {bool}
     */
    public static function shouldDisplay()
    {
        /**
         *  We should check for the user capabilties etc...
         */
        return true;
    }


    /**
     *  Render Dashboard HTML Content
     */
    public static function render()
    {
        print('<p>Simple Documentation</p>');
    }
}
