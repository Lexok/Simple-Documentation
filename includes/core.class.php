<?php
/**
 *  Simple Documentation Core
 */

namespace SimpleDocumentation;

use \SimpleDocumentation\Utils;
use \SimpleDocumentation\Dashboard;
use \SimpleDocumentation\Pages;

class Core
{
    /**
     *  Get Class
     *
     *  @return {string}
     */
    public static function getClass()
    {
        return __CLASS__;
    }


    /**
     *  Plugin initialisation
     */
    public static function init()
    {
        /**
         *  Load Translations
         */
        add_action('plugins_loaded', array(__CLASS__, 'loadTextDomain'));


        /**
         *  Register Post Type
         */
        self::registerPostType();


        /**
         *  Register Dashboard if necessary
         */
        Dashboard::maybeSetup();


        /**
         *  Register Plugin page
         */
        Pages::setup();
    }


    /**
     *  Load text domain (translations)
     */
    public static function loadTextDomain()
    {
        load_plugin_textdomain('simpledocumentation', false, plugin_basename(SIMPLEDOC_ROOT) . '/languages/');
    }


    /**
     *  Registered in the main plugin file
     */
    public static function activation()
    {
        /**
         *  Assign View Capability To Suitable Default WordPress Roles
         *
         *  @filter simpledocumentation_default_view_roles
         */
        $view_roles = apply_filters(Utils::slugIt('_default_view_roles'), array(
            'administrator',
            'editor',
            'author',
            'contributor'
        ));

        Utils::assignCapToRoles(SIMPLEDOC_CAP_VIEW, $view_roles);


        /**
         *  Assign Manage Capability To Suitable Default WordPress Roles
         *
         *  @filter simpledocumentation_default_manage_roles
         */
        $manage_roles = apply_filters(Utils::slugIt('_default_manage_roles'), array(
            'administrator'
        ));

        Utils::assignCapToRoles(SIMPLEDOC_CAP_MANAGE, $manage_roles);
        Utils::assignCapToRoles(SIMPLEDOC_CAP_FULL_VIEW, $manage_roles);


        /**
         *  Detect if the custom tables exist, if it's the case start the migration
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

        /**
         *  Remove Capabilities from all roles
         */
        $wp_roles = wp_roles();

        foreach ($wp_roles->role_objects as $role) {
            if ($role->has_cap(SIMPLEDOC_CAP_VIEW)) {
                $role->remove_cap(SIMPLEDOC_CAP_VIEW);
            }

            if ($role->has_cap(SIMPLE_DOC_CAP_MANAGE)) {
                $role->remove_cap(SIMPLEDOC_CAP_MANAGE);
            }
        }
    }


    /**
     *  Register Post Type
     */
    public static function registerPostType()
    {
        $params = array(
            'label' => __('Simple Documentation', 'simpledocumentation'),
            'description' => 'Client Documentation Plugin Post Type. Internal use only.',
            'public' => false,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'show_ui' => false,
            'show_in_nav_menus' => false,
            'show_in_menu' => false,
            'show_in_admin_bar' => false,
            'has_archive' => false,
            'rewrite' => false,
            'query_var' => false,
            'show_in_rest' => false,
            'hierarchical' => false,
            'supports' => array(
                'title',
                'editor',
                'author',
                'thumbnail',
                'revisions'
            ),
            'can_export' => true
        );

        /**
         *  Show Post Type in the Admin when Debugging
         */
        if (SIMPLEDOC_DEBUG) {
            $params['show_ui'] = true;
            $params['show_in_menu'] = true;
            $params['show_in_admin_bar'] = true;
        }

        register_post_type(SIMPLEDOC_POST_TYPE, $params);
    }


    /**
     *  Get Plugin Label
     *
     *  @return {string}
     */
    public static function getLabel()
    {
        return 'Simple Documentation';
    }
}
