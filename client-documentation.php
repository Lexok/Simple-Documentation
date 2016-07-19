<?php
/*

	Plugin Name: Simple Documentation
	Plugin URI: https://mathieuhays.co.uk/simple-documentation/
	Description: This plugin helps webmasters/developers to provide documentation through the wordpress dashboard.
	Version: 1.3.0-alpha
	Author: Mathieu Hays
	Author URI: https://mathieuhays.co.uk
	License: GPL2
	Text Domain: simple-documentation
	Domain Path: /languages

	#-----------------------------------------------------------------------
	#-- Copyright ----------------------------------------------------------
	#-----------------------------------------------------------------------

	Copyright 2015  Mathieu Hays  (email : mathieu@mathieuhays.co.uk)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA


	#--------------------------------------------------------------------------
	#-- Contribution ----------------------------------------------------------
	#--------------------------------------------------------------------------

	If you feel like contributing to this plugin there is always translation to
	be made. I'm always happy to hear your ideas to extend the plugin
	functionnalities and make it better to use for everyone.

	Current Translations:
	* French ----------- based on v.1.2.4
	* English ---------- based on v.1.2.4
	* Spanish ---------- based on v.1.1.1
	* German ----------- based on v.1.1.6
	* Serbo-Croatian --- based on v.1.1.8
	* Dutch ------------ based on v.1.2.3

	Compatibility from 2.8.0
*/

/**
 *  Plugin's Constants
 */
require 'constants.php';

/**
 *  Plugin's Classes
 */
require SIMPLEDOC_INCLUDES . '/core.class.php';
require SIMPLEDOC_INCLUDES . '/utils.class.php';

use \SimpleDocumentation\Core;

/**
 *  Plugin Initialisation
 */
Core::init();


/**
 *  Register Activation Hook
 */
register_activation_hook(__FILE__, array(Core::getClass(), 'activation'));


/**
 *  Register Uninstall Hook
 */
register_uninstall_hook(__FILE__, array(Core::getClass(), 'uninstall'));
