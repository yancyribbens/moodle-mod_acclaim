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
 * Library of interface functions and constants for module acclaim
 *
 * All the core Moodle functions, neeeded to allow the module to work
 * integrated in Moodle should be placed here.
 * All the acclaim specific functions, needed to implement all the module
 * logic, should go to locallib.php. This will help to save some memory when
 * Moodle is performing actions across all modules.
 *
 * @package   mod_acclaim
 * @copyright 2014 Yancy Ribbens
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/** example constant */
//define('NEWMODULE_ULTIMATE_ANSWER', 42);

/**
 * If you for some reason need to use global variables instead of constants, do not forget to make them
 * global as this file can be included inside a function scope. However, using the global variables
 * at the module level is not a recommended.
 */
//global $NEWMODULE_GLOBAL_VARIABLE;
//$NEWMODULE_QUESTION_OF = array('Life', 'Universe', 'Everything');

/**
 * Given an object containing all the necessary data,
 * (defined by the form in mod_form.php) this function
 * will create a new instance and return the id number
 * of the new instance.
 *
 * @param object $acclaim An object from the form in mod_form.php
 * @return int The id of the newly inserted acclaim record
 */
function acclaim_add_instance($acclaim) {
    global $DB;

    $acclaim->timecreated = time();

    # You may have to add extra stuff in here #

    return $DB->insert_record('acclaim', $acclaim);
}

/**
 * Given an object containing all the necessary data,
 * (defined by the form in mod_form.php) this function
 * will update an existing instance with new data.
 *
 * @param object $acclaim An object from the form in mod_form.php
 * @return boolean Success/Fail
 */
function acclaim_update_instance($acclaim) {
    global $DB;

    $acclaim->timemodified = time();
    $acclaim->id = $acclaim->instance;

    # You may have to add extra stuff in here #

    return $DB->update_record('acclaim', $acclaim);
}

/**
 * Given an ID of an instance of this module,
 * this function will permanently delete the instance
 * and any data that depends on it.
 *
 * @param int $id Id of the module instance
 * @return boolean Success/Failure
 */
function acclaim_delete_instance($id) {
    global $DB;

    if (! $acclaim = $DB->get_record('acclaim', array('id' => $id))) {
        return false;
    }

    # Delete any dependent records here #

    $DB->delete_records('acclaim', array('id' => $acclaim->id));

    return true;
}

/**
 * Return a small object with summary information about what a
 * user has done with a given particular instance of this module
 * Used for user activity reports.
 * $return->time = the time they did it
 * $return->info = a short text description
 *
 * @return null
 * @todo Finish documenting this function
 */
function acclaim_user_outline($course, $user, $mod, $acclaim) {
    $return = new stdClass;
    $return->time = 0;
    $return->info = '';
    return $return;
}

/**
 * Print a detailed representation of what a user has done with
 * a given particular instance of this module, for user activity reports.
 *
 * @return boolean
 * @todo Finish documenting this function
 */
function acclaim_user_complete($course, $user, $mod, $acclaim) {
    return true;
}

/**
 * Given a course and a time, this module should find recent activity
 * that has occurred in acclaim activities and print it out.
 * Return true if there was output, or false is there was none.
 *
 * @return boolean
 * @todo Finish documenting this function
 */
function acclaim_print_recent_activity($course, $viewfullnames, $timestart) {
    return false;  //  True if anything was printed, otherwise false
}

/**
 * Function to be run periodically according to the moodle cron
 * This function searches for things that need to be done, such
 * as sending out mail, toggling flags etc ...
 *
 * @return boolean
 * @todo Finish documenting this function
 **/
function acclaim_cron () {
    return true;
}

/**
 * Must return an array of users who are participants for a given instance
 * of acclaim. Must include every user involved in the instance,
 * independient of his role (student, teacher, admin...). The returned
 * objects must contain at least id property.
 * See other modules as example.
 *
 * @param int $acclaimid ID of an instance of this module
 * @return boolean|array false if no participants, array of objects otherwise
 */
function acclaim_get_participants($acclaimid) {
    return false;
}

/**
 * This function returns if a scale is being used by one acclaim
 * if it has support for grading and scales. Commented code should be
 * modified if necessary. See forum, glossary or journal modules
 * as reference.
 *
 * @param int $acclaimid ID of an instance of this module
 * @return mixed
 * @todo Finish documenting this function
 */
function acclaim_scale_used($acclaimid, $scaleid) {
    global $DB;

    $return = false;

    //$rec = $DB->get_record("acclaim", array("id" => "$acclaimid", "scale" => "-$scaleid"));
    //
    //if (!empty($rec) && !empty($scaleid)) {
    //    $return = true;
    //}

    return $return;
}

/**
 * Checks if scale is being used by any instance of acclaim.
 * This function was added in 1.9
 *
 * This is used to find out if scale used anywhere
 * @param $scaleid int
 * @return boolean True if the scale is used by any acclaim
 */
function acclaim_scale_used_anywhere($scaleid) {
    global $DB;

    if ($scaleid and $DB->record_exists('acclaim', 'grade', -$scaleid)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Execute post-uninstall custom actions for the module
 * This function was added in 1.9
 *
 * @return boolean true if success, false on error
 */
function acclaim_uninstall() {
    return true;
}

function issue_badge($event) {

    //$f = "/tmp/moodle_called_issue_badge";
    //file_put_contents($f,"test");

    $org_id='6bb2e1c7-c66b-4d47-9301-4a6b9e792e2c';
    $url='https://jefferson-staging.herokuapp.com/api/v1/organizations/'.$org_id.'/badges';

    $username = 'FZ1QZ4sDtEwNR7Tcv-Yi';
    $password = "";

    $data = array(
        'badge_template_id' => 'f2f26ee8-4882-4e03-a33c-5e2a6961c8b3',
        'issued_to_first_name' => 'yancy',
        'issued_to_last_name' => 'ribbens',
        'expires_at' => '2018-04-01 09:41:00 -0500',
        'recipient_email' => 'yancy.ribbens+test_again@gmail.com',
        'issued_at' => '2014-04-01 09:41:00 -0500'
    );

    $ch = curl_init();

    $curlConfig = array(
        CURLOPT_HTTPHEADER     => array('Accept: application/json'),
        CURLOPT_CUSTOMREQUEST  => "POST",
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_USERPWD        => $username . ":" . $password,
        CURLOPT_POSTFIELDS     => $data,
    );

    curl_setopt_array($ch, $curlConfig);

    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
}
