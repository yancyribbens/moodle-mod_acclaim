<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * The workshop module configuration variables
 *
 * The values defined here are often used as defaults for all module instances.
 *
 * @package    mod_acclaim
 * @copyright  2014 Yancy Ribbens <yancy.ribbens@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/mod/acclaim/locallib.php');
$pagetitle = get_string('modulename','acclaim');

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_configtext( 'api', 'Acclaim API', 'Example: https://youracclaim.com/api/v1/organizations/your_org_id/badges', null, PARAM_TEXT));

    $settings->add(new admin_setting_configtext( 'org_id', 'Organization ID', 'Example: 6bb2e1c7-c66b-4d47-9301-4a6b9e792e2c', null, PARAM_TEXT)); 

    $settings->add(new admin_setting_configtext( 'token', 'Token', 'Example: FZ9QZ4sDtEwNR7Tcv-Yi', null, PARAM_TEXT));

    $settings->add(new admin_setting_configtext( 'badge_template_id', 'Badge Template ID', 'Example: ab8b9e91-b83b-4e80-acb6-33449016ec11', null, PARAM_TEXT));

    $settings->add(new admin_setting_configtext( 'issued_to_first_name', 'Issued To First Name', 'Example: Yancy', null, PARAM_TEXT));

    $settings->add(new admin_setting_configtext( 'issued_to_last_name', 'Issued To Last Name', 'Example: Ribbens', null, PARAM_TEXT));

    $settings->add(new admin_setting_configtext( 'recipient_email', 'Recipient Email', 'Example: yancy.ribbens@example.com', null, PARAM_TEXT));

    $settings->add(new admin_setting_configtext( 'issued_at', 'Issued At', 'Example: 2014-04-01 09:41:00 -0500', null, PARAM_TEXT));

    $settings->add(new admin_setting_configtext( 'expires_at', 'Expires At', 'Example: 2018-04-01 09:41:00 -0500', null, PARAM_TEXT));
}

