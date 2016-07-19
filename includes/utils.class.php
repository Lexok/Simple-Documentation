<?php
/**
 *  Utils
 */

namespace SimpleDocumentation;

class Utils
{
    /**
     *  Create a string starting with the plugin slug
     *
     *  @param  {string} $append - String to append
     *  @return {string}
     */
    public static function slugIt($append = '')
    {
        return SIMPLEDOC_SLUG . $append;
    }


    /**
     *  Assign given capabilities to given roles
     *
     *  @param  {array} $capabilities - array of string
     *  @param  {array} $roles - array of slug
     */
    public static function assignCapToRoles($capabilities, $roles)
    {
        $capabilities = is_array($capabilities) ? $capabilities : array($capabilities);
        $roles = is_array($roles) ? $roles : array($roles);

        foreach ($roles as $role) {
            $wp_role = get_role($role);

            foreach ($capabilities as $cap) {
                $wp_role->add_cap($cap);
            }
        }
    }
}
