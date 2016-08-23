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
 * Group observers.
 *
 * @package    mod_acclaim
 * @copyright  2014 Yancy Ribbens
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_acclaim;
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/acclaim/locallib.php');
class group_observers {

    public static function issue_badge($event) {

        //var_dump($event);
        error_log('Event Data: ' . print_r($event,true));
        //$f = "/tmp/moodle_called_issue_badge";
        //file_put_contents($f,"test");


        $org_id='6bb2e1c7-c66b-4d47-9301-4a6b9e792e2c';
        $url='https://jefferson-staging.herokuapp.com/api/v1/organizations/'.$org_id.'/badges';

        $username = 'FZ1QZ4sDtEwNR7Tcv-Yi';
        $password = "";

        $data = array(
            'badge_template_id' => '287d9248-89df-4ab8-af1c-71b195c494a8',
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
}

?>
