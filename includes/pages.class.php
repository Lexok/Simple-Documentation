<?php
/**
 *  Main Plugin Page Handling
 */

namespace SimpleDocumentation;

use \SimpleDocumentation\Utils;
use \SimpleDocumentation\Core;

class Pages
{
    const MAIN = 'simpledocumentation_main';
    const SETTINGS = 'simpledocumentation_settings';

    /**
     *  Setup
     */
    public static function setup()
    {
        /**
         *  Register Plugin Pages
         */
        add_action('admin_menu', array(__CLASS__, 'register'));
        add_action('network_admin_menu', array(__CLASS__, 'register'));

        /**
         *  Load Assets
         */
        add_action('admin_init', array(__CLASS__, 'addAdminScripts'));
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
            self::MAIN,
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
            self::SETTINGS,
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


    /**
     *  Add Admin Script
     */
    public static function addAdminScripts()
    {
        global $pagenow;

        $own_pages = array(
            self::MAIN,
            self::SETTINGS
        );

        $is_dashboard = $pagenow == 'index.php';
        $is_own_page = $pagenow == 'admin.php' && isset($_GET['page']) && in_array($_GET['page'], $own_pages);

        /**
         *  Abort if it's not one of our pages or the dashboard
         */
        if (!$is_dashboard && !$is_own_page) {
            return false;
        }

        $local = array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'fieldsMissing' => __('Following fields are missing :', 'simpledocumentation'),
            'isMissing' => __('is missing !', 'simpledocumentation'),
            'itemNumber' => 10, // @todo 
            'viewList' => __('View List', 'simpledocumentation'),
            'orderSaved' => __('Order saved', 'simpledocumentation'),
            'loading' => __('Loading', 'simpledocumentation'),
            'processing' => __('Processing', 'simpledocumentation'),
            'labelDone' => __('Done', 'simpledocumentation'),
            'error' => __('Error!', 'simpledocumentation'),
            'addItem' => __('Add item', 'simpledocumentation'),
            'saveChanges' => __('Save changes', 'simpledocumentation'),
            'addNew' => __('Add new', 'simpledocumentation')
        );

        wp_enqueue_script('jquery-ui-sortable');

        wp_enqueue_script(SIMPLEDOC_SLUG . '_js', SIMPLEDOC_URI . '/assets/js/simpledocumentation.js', array('jquery'), SIMPLEDOC_VERSION);
        wp_localize_script(SIMPLEDOC_SLUG . '_js', 'ajax_object', $local);

        wp_enqueue_media();
    }
}
